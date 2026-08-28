@extends('layouts.site')

@section('title', 'Gestion des catalogues - Agora')

@section('content')
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-md">
            <div>
                <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Gestion</p>
                <h1 class="font-display text-display text-primary">Catalogues</h1>
                <p class="font-body-md text-body-md text-secondary mt-xs">Regroupez vos ouvrages en collections (littérature, informatique, sciences...).</p>
            </div>
            <div class="flex items-center gap-md">
                <a href="{{ route('catalogue') }}" class="inline-flex items-center gap-sm text-secondary border border-outline-variant rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-surface-container-low transition-colors shrink-0">
                    <span class="material-symbols-outlined text-[18px]">visibility</span> Voir le catalogue public
                </a>
                <a href="{{ route('catalogues.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-tertiary transition-all shadow-sm shrink-0">
                    <span class="material-symbols-outlined text-[18px]">add</span> Ajouter un catalogue
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="p-sm bg-success-container text-on-success-container rounded-lg text-body-md flex items-center gap-sm">
                <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-sm bg-error-container text-on-error-container rounded-lg text-body-md flex items-center gap-sm">
                <span class="material-symbols-outlined">error</span> {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-sm bg-error-container text-on-error-container rounded-lg text-body-md">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-lg">
            @forelse ($catalogues as $catalogue)
                <article class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-primary-container/20 text-primary flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined">collections_bookmark</span>
                    </div>
                    <h2 class="font-headline-md text-headline-md text-primary">{{ $catalogue->nom }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-xs flex-grow">
                        {{ $catalogue->description ?: 'Aucune description.' }}
                    </p>
                    <p class="font-label-sm text-label-sm text-secondary mt-md mb-md uppercase tracking-wider">
                        {{ $catalogue->livres_count }} livre(s) rattaché(s)
                    </p>
                    <div class="flex gap-sm pt-md border-t border-surface-container-high">
                        <a href="{{ route('catalogues.edit', $catalogue) }}" class="inline-flex items-center gap-xs text-primary border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-[16px]">edit</span> Modifier
                        </a>
                        <button type="button"
                                @click="$store.confirm.ask({
                                    title: 'Supprimer ce catalogue ?',
                                    message: 'Le catalogue « {{ $catalogue->nom }} » sera supprimé. {{ $catalogue->livres_count }} livre(s) seront retirés de ce catalogue (aucun livre ne sera supprimé).',
                                    action: '{{ route('catalogues.destroy', $catalogue) }}',
                                    method: 'DELETE',
                                    confirmLabel: 'Supprimer'
                                })"
                                class="inline-flex items-center gap-xs text-error border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-error-container transition-colors">
                            <span class="material-symbols-outlined text-[16px]">delete</span> Supprimer
                        </button>
                    </div>
                </article>
            @empty
                <p class="col-span-full text-center text-on-surface-variant py-xl">Aucun catalogue pour le moment. Créez votre premier catalogue pour organiser vos livres.</p>
            @endforelse
        </div>

        <div class="flex justify-center">
            {{ $catalogues->links() }}
        </div>
    </div>
@endsection