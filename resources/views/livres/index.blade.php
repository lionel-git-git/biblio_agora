@extends('layouts.site')

@section('title', 'Gestion du catalogue - Agora')

@section('content')
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-md">
            <div>
                <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Gestion</p>
                <h1 class="font-display text-display text-primary">Catalogue</h1>
            </div>
            <a href="{{ route('livres.create') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-tertiary transition-all shadow-sm shrink-0">
                <span class="material-symbols-outlined text-[18px]">add</span> Ajouter un livre
            </a>
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

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
            <div class="hidden md:grid grid-cols-12 gap-md px-lg py-md bg-surface-container-low border-b border-outline-variant font-label-sm text-label-sm text-secondary">
                <div class="col-span-5">Livre</div>
                <div class="col-span-2">Genre</div>
                <div class="col-span-2">Stock</div>
                <div class="col-span-1">Emprunts</div>
                <div class="col-span-2 text-right">Actions</div>
            </div>

            @forelse ($livres as $livre)
                <div class="grid grid-cols-1 md:grid-cols-12 gap-md items-center px-lg py-md border-b border-surface-container-high last:border-b-0">
                    <div class="col-span-5 flex items-center gap-md">
                        <div class="aspect-[2/3] w-10 bg-surface-container-high rounded overflow-hidden flex items-center justify-center shrink-0">
                            @if ($livre->image_couverture)
                                <img src="{{ asset('storage/' . $livre->image_couverture) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-outline">menu_book</span>
                            @endif
                        </div>
                        <div>
                            <p class="font-body-md text-body-md text-on-surface font-semibold">{{ $livre->titre }}</p>
                            <p class="font-body-md text-body-md text-secondary">{{ $livre->auteur }}</p>
                        </div>
                    </div>
                    <p class="col-span-2 font-body-md text-body-md text-on-surface-variant">{{ $livre->genre }}</p>
                    <p class="col-span-2 font-body-md text-body-md">
                        <span class="font-semibold {{ $livre->quantite_disponible === 0 ? 'text-error' : 'text-on-surface' }}">{{ $livre->quantite_disponible }}</span>
                        <span class="text-secondary">/ {{ $livre->quantite_totale }}</span>
                    </p>
                    <p class="col-span-1 font-body-md text-body-md text-secondary">{{ $livre->emprunts_count }}</p>
                    <div class="col-span-2 flex gap-sm justify-start md:justify-end">
                        <a href="{{ route('livres.edit', $livre) }}" class="inline-flex items-center gap-xs text-primary border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-[16px]">edit</span> Modifier
                        </a>
                        <form method="POST" action="{{ route('livres.destroy', $livre) }}" onsubmit="return confirm('Supprimer ce livre ?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center gap-xs text-error border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-error-container transition-colors">
                                <span class="material-symbols-outlined text-[16px]">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="p-xl text-center text-on-surface-variant">Aucun livre pour le moment.</p>
            @endforelse
        </div>

        <div class="flex justify-center">
            {{ $livres->links() }}
        </div>
    </div>
@endsection