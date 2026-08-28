<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::withCount('emprunts')->orderBy('titre')->paginate(15);

        return view('livres.index', compact('livres'));
    }

    public function create()
    {
        return view('livres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'auteur' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'langue' => ['nullable', 'string', 'max:255'],
            'quantite_totale' => ['required', 'integer', 'min:1'],
            'image_couverture' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->except('image_couverture');
        $data['quantite_disponible'] = $request->quantite_totale;

        if ($request->hasFile('image_couverture')) {
            $data['image_couverture'] = $request->file('image_couverture')->store('livres', 'public');
        }

        Livre::create($data);

        return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès !');
    }

    public function edit(Livre $livre)
    {
        return view('livres.edit', compact('livre'));
    }

    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'auteur' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'langue' => ['nullable', 'string', 'max:255'],
            'quantite_totale' => ['required', 'integer', 'min:1'],
            'image_couverture' => ['nullable', 'image', 'max:2048'],
        ]);

        $empruntes = max(0, $livre->quantite_totale - $livre->quantite_disponible);

        if ($request->quantite_totale < $empruntes) {
            return back()
                ->withErrors(['quantite_totale' => "Le nombre total ne peut pas être inférieur aux {$empruntes} exemplaires actuellement empruntés."])
                ->withInput();
        }

        $data = $request->except('image_couverture');
        $data['quantite_disponible'] = $request->quantite_totale - $empruntes;

        if ($request->hasFile('image_couverture')) {
            if ($livre->image_couverture && Storage::disk('public')->exists($livre->image_couverture)) {
                Storage::disk('public')->delete($livre->image_couverture);
            }
            $data['image_couverture'] = $request->file('image_couverture')->store('livres', 'public');
        }

        $livre->update($data);

        return redirect()->route('livres.index')->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(Livre $livre)
    {
        if ($livre->emprunts()->enCours()->exists()) {
            return back()->with('error', 'Impossible de supprimer un livre actuellement emprunté.');
        }

        if ($livre->image_couverture && Storage::disk('public')->exists($livre->image_couverture)) {
            Storage::disk('public')->delete($livre->image_couverture);
        }

        $livre->delete();

        return redirect()->route('livres.index')->with('success', 'Livre supprimé.');
    }

    public function catalogue(Request $request)
    {
        $query = Livre::query();

        if ($request->filled('recherche')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%'.$request->recherche.'%')
                    ->orWhere('auteur', 'like', '%'.$request->recherche.'%');
            });
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->disponibilite === 'disponible') {
            $query->where('quantite_disponible', '>', 0);
        } elseif ($request->disponibilite === 'emprunte') {
            $query->where('quantite_disponible', 0);
        }

        $livres = $query->orderBy('titre')->paginate(12)->withQueryString();

        $genres = Livre::select('genre')->distinct()->whereNotNull('genre')->pluck('genre');

        return view('catalogue', compact('livres', 'genres'));
    }
}
