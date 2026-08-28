<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\MessageContact;
use App\Models\User;

class DashboardController extends Controller
{
    public function redirect()
    {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'bibliothecaire' => redirect()->route('bibliothecaire.dashboard'),
            default => redirect()->route('etudiant.dashboard'),
        };
    }

    public function admin()
    {
        $this->marquerRetards();

        $totalLivres = Livre::count();
        $totalEtudiants = User::where('role', 'etudiant')->count();
        $totalBibliothecaires = User::where('role', 'bibliothecaire')->count();
        $totalEmprunts = Emprunt::count();
        $totalRetards = Emprunt::where('statut', Emprunt::STATUT_EN_RETARD)->count();
        $demandesEnAttente = Emprunt::where('statut', Emprunt::STATUT_EN_ATTENTE)->count();
        $messagesNonLus = MessageContact::where('lu', false)->count();

        $derniersEmprunts = Emprunt::with(['user', 'livre'])->latest()->take(5)->get();
        $derniersLivres = Livre::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLivres',
            'totalEtudiants',
            'totalBibliothecaires',
            'totalEmprunts',
            'totalRetards',
            'demandesEnAttente',
            'messagesNonLus',
            'derniersEmprunts',
            'derniersLivres',
        ));
    }

    public function etudiant()
    {
        $this->marquerRetards();

        $user = auth()->user();

        $empruntsEnCours = Emprunt::with('livre')
            ->where('user_id', $user->id)
            ->whereIn('statut', [Emprunt::STATUT_EN_COURS, Emprunt::STATUT_EN_RETARD])
            ->latest()
            ->get();

        $demandesEnAttente = Emprunt::with('livre')
            ->where('user_id', $user->id)
            ->where('statut', Emprunt::STATUT_EN_ATTENTE)
            ->latest()
            ->get();

        $historique = Emprunt::with('livre')
            ->where('user_id', $user->id)
            ->whereIn('statut', [Emprunt::STATUT_RETOURNE, Emprunt::STATUT_REFUSE])
            ->latest()
            ->take(5)
            ->get();

        return view('etudiant.dashboard', compact('empruntsEnCours', 'demandesEnAttente', 'historique'));
    }

    public function bibliothecaire()
    {
        $this->marquerRetards();

        $totalLivres = Livre::count();
        $empruntsEnCours = Emprunt::where('statut', Emprunt::STATUT_EN_COURS)->count();
        $demandesEnAttente = Emprunt::where('statut', Emprunt::STATUT_EN_ATTENTE)->count();
        $totalRetards = Emprunt::where('statut', Emprunt::STATUT_EN_RETARD)->count();
        $livresIndisponibles = Livre::where('quantite_disponible', 0)->count();

        $demandesRecentes = Emprunt::with(['user', 'livre'])
            ->where('statut', Emprunt::STATUT_EN_ATTENTE)
            ->latest()
            ->take(5)
            ->get();

        $empruntsEnCoursListe = Emprunt::with(['user', 'livre'])
            ->whereIn('statut', [Emprunt::STATUT_EN_COURS, Emprunt::STATUT_EN_RETARD])
            ->latest()
            ->take(5)
            ->get();

        return view('bibliothecaire.dashboard', compact(
            'totalLivres',
            'empruntsEnCours',
            'demandesEnAttente',
            'totalRetards',
            'livresIndisponibles',
            'demandesRecentes',
            'empruntsEnCoursListe',
        ));
    }

    private function marquerRetards(): void
    {
        Emprunt::where('statut', Emprunt::STATUT_EN_COURS)
            ->where('date_retour_prevue', '<', now()->toDateString())
            ->update(['statut' => Emprunt::STATUT_EN_RETARD]);
    }
}
