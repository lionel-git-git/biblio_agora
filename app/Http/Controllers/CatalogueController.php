<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function index()
    {
        $catalogues = Catalogue::withCount('livres')->orderBy('nom')->paginate(20);

        return view('catalogues.index', compact('catalogues'));
    }

    public function create()
    {
        return view('catalogues.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:catalogues,nom'],
            'description' => ['nullable', 'string'],
        ]);

        Catalogue::create($data);

        return redirect()->route('catalogues.index')->with('success', 'Catalogue créé avec succès.');
    }

    public function edit(Catalogue $catalogue)
    {
        return view('catalogues.edit', compact('catalogue'));
    }

    public function update(Request $request, Catalogue $catalogue)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:catalogues,nom,'.$catalogue->id],
            'description' => ['nullable', 'string'],
        ]);

        $catalogue->update($data);

        return redirect()->route('catalogues.index')->with('success', 'Catalogue mis à jour.');
    }

    public function destroy(Catalogue $catalogue)
    {
        $nbrLivres = $catalogue->livres()->count();

        $catalogue->livres()->update(['catalogue_id' => null]);
        $catalogue->delete();

        $message = 'Catalogue supprimé.';
        if ($nbrLivres > 0) {
            $message .= " {$nbrLivres} livre(s) ont été retirés de ce catalogue (aucun livre supprimé).";
        }

        return redirect()->route('catalogues.index')->with('success', $message);
    }
}
