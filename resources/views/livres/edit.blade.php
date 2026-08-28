@extends('layouts.site')

@section('title', 'Modifier le livre - Agora')

@section('content')
    <div class="max-w-2xl mx-auto py-xl px-lg flex flex-col gap-lg">

        <div>
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Gestion du catalogue</p>
            <h1 class="font-headline-lg text-headline-lg text-primary">Modifier le livre</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-xs">{{ $livre->titre }}</p>
        </div>

        @if ($errors->any())
            <div class="p-sm bg-error-container text-on-error-container rounded-lg text-body-md">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-xl">
            <form method="POST" action="{{ route('livres.update', $livre) }}" enctype="multipart/form-data" class="space-y-md">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="titre">Titre</label>
                    <input class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                           id="titre" name="titre" required type="text" value="{{ old('titre', $livre->titre) }}">
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="auteur">Auteur</label>
                    <input class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                           id="auteur" name="auteur" required type="text" value="{{ old('auteur', $livre->auteur) }}">
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="genre">Genre</label>
                    <input class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                           id="genre" name="genre" required type="text" value="{{ old('genre', $livre->genre) }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="catalogue_id">Catalogue</label>
                        <select class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                               id="catalogue_id" name="catalogue_id">
                            <option value="">-- Aucun catalogue --</option>
                            @foreach ($catalogues as $catalogue)
                                <option value="{{ $catalogue->id }}" @selected(old('catalogue_id', $livre->catalogue_id) == $catalogue->id)>{{ $catalogue->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="statut">Statut</label>
                        <select class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                               id="statut" name="statut">
                            @foreach (\App\Models\Livre::STATUT_LABELS as $cle => $libelle)
                                <option value="{{ $cle }}" @selected(old('statut', $livre->statut) === $cle)>{{ $libelle }}</option>
                            @endforeach
                        </select>
                        <p class="font-body-md text-body-md text-secondary mt-xs">« Retiré » masque le livre du catalogue public.</p>
                    </div>
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="description">Description</label>
                    <textarea class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                              id="description" name="description" rows="4">{{ old('description', $livre->description) }}</textarea>
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="langue">Langue</label>
                    <input class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                           id="langue" name="langue" type="text" value="{{ old('langue', $livre->langue) }}">
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="quantite_totale">Nombre total d'exemplaires</label>
                    <input class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface"
                           id="quantite_totale" name="quantite_totale" min="1" required type="number" value="{{ old('quantite_totale', $livre->quantite_totale) }}">
                    <p class="font-body-md text-body-md text-secondary mt-xs">
                        {{ $livre->quantite_disponible }} exemplaire(s) disponible(s) actuellement.
                    </p>
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="image_couverture">Image de couverture</label>
                    @if ($livre->image_couverture)
                        <div class="mb-xs">
                            <img src="{{ asset('storage/' . $livre->image_couverture) }}" alt="" class="w-20 rounded border border-outline-variant">
                        </div>
                    @endif
                    <input class="block w-full px-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-on-surface file:mr-sm file:py-1 file:px-3 file:rounded file:border-0 file:bg-primary-container file:text-on-primary file:text-label-sm"
                           id="image_couverture" name="image_couverture" accept="image/*" type="file">
                    <p class="font-body-md text-body-md text-secondary mt-xs">Laissez vide pour conserver l'image actuelle.</p>
                </div>

                <div class="flex gap-md pt-md">
                    <button class="flex-1 flex justify-center items-center gap-sm py-sm px-md border border-transparent rounded-lg shadow-sm font-label-sm text-label-sm text-on-primary bg-primary-container hover:bg-primary transition-colors"
                            type="submit">
                        Enregistrer les modifications
                        <span class="material-symbols-outlined text-[18px]">save</span>
                    </button>
                    <a href="{{ route('livres.index') }}" class="flex justify-center items-center py-sm px-lg border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-low transition-colors">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection