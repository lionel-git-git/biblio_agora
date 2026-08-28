@extends('layouts.site')

@section('title', 'Ajouter un livre - Agora')

@section('content')
    <div class="max-w-2xl mx-auto py-xl px-lg flex flex-col gap-lg">

        <div>
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Gestion des livres</p>
            <h1 class="font-headline-lg text-headline-lg text-primary">Ajouter un livre</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-xs">Renseignez les informations du nouvel ouvrage à ajouter au catalogue.</p>
        </div>

        @if ($errors->any())
            <div class="p-sm bg-error-container text-on-error-container rounded-lg text-body-md">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-xl">
            <form method="POST" action="{{ route('livres.store') }}" enctype="multipart/form-data" class="space-y-md">

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="titre">Titre</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">title</span>
                        </div>
                        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                               id="titre" name="titre" placeholder="Le titre du livre" required type="text" value="{{ old('titre') }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="auteur">Auteur</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline">person</span>
                            </div>
                            <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                   id="auteur" name="auteur" placeholder="Nom de l'auteur" required type="text" value="{{ old('auteur') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="genre">Genre</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline">category</span>
                            </div>
                            <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                   id="genre" name="genre" placeholder="Ex : Philosophie, Informatique..." required type="text" value="{{ old('genre') }}">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="catalogue_id">Catalogue</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline">collections_bookmark</span>
                            </div>
                            <select class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                   id="catalogue_id" name="catalogue_id">
                                <option value="">-- Aucun catalogue --</option>
                                @foreach ($catalogues as $catalogue)
                                    <option value="{{ $catalogue->id }}" @selected(old('catalogue_id') == $catalogue->id)>{{ $catalogue->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="font-body-md text-body-md text-secondary mt-xs">
                            <a href="{{ route('catalogues.create') }}" class="text-primary underline">Créer un catalogue</a> si nécessaire.
                        </p>
                    </div>

                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="statut">Statut</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline">monitor_heart</span>
                            </div>
                            <select class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                   id="statut" name="statut">
                                @foreach (\App\Models\Livre::STATUT_LABELS as $cle => $libelle)
                                    <option value="{{ $cle }}" @selected(old('statut', \App\Models\Livre::STATUT_DISPONIBLE) === $cle)>{{ $libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="font-body-md text-body-md text-secondary mt-xs">« Retiré » masque le livre du catalogue public.</p>
                    </div>
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="description">Description</label>
                    <div class="relative">
                        <div class="absolute top-sm left-0 pl-sm flex items-start pointer-events-none">
                            <span class="material-symbols-outlined text-outline">description</span>
                        </div>
                        <textarea class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                  id="description" name="description" rows="4" placeholder="Résumé ou description du livre">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="langue">Langue</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline">language</span>
                            </div>
                            <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                   id="langue" name="langue" placeholder="Français" type="text" value="{{ old('langue') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="quantite_totale">Nombre d'exemplaires</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline">inventory_2</span>
                            </div>
                            <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                   id="quantite_totale" name="quantite_totale" min="1" required type="number" value="{{ old('quantite_totale', 1) }}">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="image_couverture">Image de couverture</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">image</span>
                        </div>
                        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface file:mr-sm file:py-1 file:px-3 file:rounded file:border-0 file:bg-primary-container file:text-on-primary file:text-label-sm"
                               id="image_couverture" name="image_couverture" accept="image/*" type="file">
                    </div>
                </div>

                <div class="flex gap-md pt-md">
                    <button class="flex-1 flex justify-center items-center gap-sm py-sm px-md border border-transparent rounded-lg shadow-sm font-label-sm text-label-sm text-on-primary bg-primary-container hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors"
                            type="submit">
                        Ajouter le livre
                        <span class="material-symbols-outlined text-[18px]">add</span>
                    </button>
                    <a href="{{ route('livres.index') }}" class="flex justify-center items-center py-sm px-lg border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-low transition-colors">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection