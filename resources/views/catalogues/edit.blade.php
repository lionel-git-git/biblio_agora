@extends('layouts.site')

@section('title', 'Modifier le catalogue - Agora')

@section('content')
    <div class="max-w-2xl mx-auto py-xl px-lg flex flex-col gap-lg">

        <div>
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Gestion des catalogues</p>
            <h1 class="font-headline-lg text-headline-lg text-primary">Modifier le catalogue</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-xs">{{ $catalogue->nom }}</p>
        </div>

        @if ($errors->any())
            <div class="p-sm bg-error-container text-on-error-container rounded-lg text-body-md">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-xl">
            <form method="POST" action="{{ route('catalogues.update', $catalogue) }}" class="space-y-md">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="nom">Nom du catalogue</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">collections_bookmark</span>
                        </div>
                        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                               id="nom" name="nom" required type="text" value="{{ old('nom', $catalogue->nom) }}">
                    </div>
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="description">Description</label>
                    <div class="relative">
                        <div class="absolute top-sm left-0 pl-sm flex items-start pointer-events-none">
                            <span class="material-symbols-outlined text-outline">description</span>
                        </div>
                        <textarea class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                                  id="description" name="description" rows="4">{{ old('description', $catalogue->description) }}</textarea>
                    </div>
                </div>

                <div class="flex gap-md pt-md">
                    <button class="flex-1 flex justify-center items-center gap-sm py-sm px-md border border-transparent rounded-lg shadow-sm font-label-sm text-label-sm text-on-primary bg-primary-container hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors"
                            type="submit">
                        Enregistrer les modifications
                        <span class="material-symbols-outlined text-[18px]">save</span>
                    </button>
                    <a href="{{ route('catalogues.index') }}" class="flex justify-center items-center py-sm px-lg border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-low transition-colors">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection