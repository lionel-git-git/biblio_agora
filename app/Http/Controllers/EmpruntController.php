<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    public function index()
    {
        $emprunts = Emprunt::where('user_id', auth()->id())
            ->with('livre')
            ->latest()
            ->get();

        return view('emprunts.index', compact('emprunts'));
    }

    public function store(Request $request, Livre $livre)
    {
        if ($livre->quantite_disponible <= 0) {
            return back()->with('error', 'Ce livre n\'est actuellement pas disponible à l\'emprunt.');
        }

        $dejaDemande = Emprunt::where('user_id', auth()->id())
            ->where('livre_id', $livre->id)
            ->whereIn('statut', [Emprunt::STATUT_EN_ATTENTE, Emprunt::STATUT_EN_COURS, Emprunt::STATUT_EN_RETARD])
            ->exists();

        if ($dejaDemande) {
            return back()->with('error', 'Vous avez déjà une demande en attente ou un emprunt en cours pour ce livre.');
        }

        Emprunt::create([
            'user_id' => auth()->id(),
            'livre_id' => $livre->id,
            'statut' => Emprunt::STATUT_EN_ATTENTE,
        ]);

        return back()->with('success', 'Demande d\'emprunt envoyée ! Un bibliothécaire va la traiter.');
    }

    public function gestion(Request $request)
    {
        $this->marquerRetards();

        $statut = $request->get('statut', 'en_cours');

        $query = Emprunt::with(['user', 'livre']);

        if (in_array($statut, [
            Emprunt::STATUT_EN_ATTENTE,
            Emprunt::STATUT_EN_COURS,
            Emprunt::STATUT_EN_RETARD,
            Emprunt::STATUT_RETOURNE,
            Emprunt::STATUT_REFUSE,
        ], true)) {
            $query->where('statut', $statut);
        }

        $emprunts = $query->latest()->paginate(15)->withQueryString();

        $compteurs = Emprunt::selectRaw('statut, count(*) as total')->groupBy('statut')->pluck('total', 'statut');

        $statuts = [
            Emprunt::STATUT_EN_ATTENTE => 'En attente',
            Emprunt::STATUT_EN_COURS => 'En cours',
            Emprunt::STATUT_EN_RETARD => 'En retard',
            Emprunt::STATUT_RETOURNE => 'Retournés',
            Emprunt::STATUT_REFUSE => 'Refusés',
        ];

        return view('emprunts.gestion', compact('emprunts', 'statut', 'statuts', 'compteurs'));
    }

    public function valider(Emprunt $emprunt)
    {
        if ($emprunt->statut !== Emprunt::STATUT_EN_ATTENTE) {
            return back()->with('error', 'Cette demande n\'est plus en attente.');
        }

        if ($emprunt->livre->quantite_disponible <= 0) {
            return back()->with('error', 'Aucun exemplaire disponible pour ce livre.');
        }

        $emprunt->livre->decrement('quantite_disponible');

        $emprunt->update([
            'statut' => Emprunt::STATUT_EN_COURS,
            'date_emprunt' => now()->toDateString(),
            'date_retour_prevue' => now()->addDays(Emprunt::DUREE_PRET_JOURS)->toDateString(),
        ]);

        return back()->with('success', 'Demande validée, un exemplaire a été retiré du stock.');
    }

    public function refuser(Emprunt $emprunt)
    {
        if ($emprunt->statut !== Emprunt::STATUT_EN_ATTENTE) {
            return back()->with('error', 'Cette demande n\'est plus en attente.');
        }

        $emprunt->update(['statut' => Emprunt::STATUT_REFUSE]);

        return back()->with('success', 'Demande refusée.');
    }

    public function retour(Emprunt $emprunt)
    {
        if (! in_array($emprunt->statut, [Emprunt::STATUT_EN_COURS, Emprunt::STATUT_EN_RETARD], true)) {
            return back()->with('error', 'Cet emprunt n\'est pas en cours.');
        }

        $livre = $emprunt->livre;

        $quantiteDisponible = min($livre->quantite_disponible + 1, $livre->quantite_totale);
        $livre->update(['quantite_disponible' => $quantiteDisponible]);

        $emprunt->update([
            'statut' => Emprunt::STATUT_RETOURNE,
            'date_retour_effective' => now()->toDateString(),
        ]);

        return back()->with('success', 'Retour enregistré, l\'exemplaire est de nouveau disponible.');
    }

    private function marquerRetards(): void
    {
        Emprunt::where('statut', Emprunt::STATUT_EN_COURS)
            ->where('date_retour_prevue', '<', now()->toDateString())
            ->update(['statut' => Emprunt::STATUT_EN_RETARD]);
    }
}
