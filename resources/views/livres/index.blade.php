@extends('layouts.site')

@section('title', 'Gestion des livres - Agora')

@section('content')
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-md">
            <div>
                <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Gestion</p>
                <h1 class="font-display text-display text-primary">Livres</h1>
                <p class="font-body-md text-body-md text-secondary mt-xs">Ajoutez, modifiez ou supprimez des ouvrages et gérez leur statut.</p>
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

        <div class="flex flex-wrap gap-sm items-center">
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider">Filtrer par statut :</p>
            <a href="{{ route('livres.index') }}"
               class="inline-flex items-center rounded-full px-sm py-1 font-label-sm text-label-sm border transition-colors {{ !request('statut') ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-lowest text-secondary border-outline-variant hover:bg-surface-container-low' }}">Tous</a>
            @foreach (\App\Models\Livre::STATUT_LABELS as $cle => $libelle)
                <a href="{{ route('livres.index', ['statut' => $cle]) }}"
                   class="inline-flex items-center rounded-full px-sm py-1 font-label-sm text-label-sm border transition-colors {{ request('statut') === $cle ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-lowest text-secondary border-outline-variant hover:bg-surface-container-low' }}">{{ $libelle }}</a>
            @endforeach
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
            <div class="hidden md:grid grid-cols-12 gap-md px-lg py-md bg-surface-container-low border-b border-outline-variant font-label-sm text-label-sm text-secondary">
                <div class="col-span-5">Livre</div>
                <div class="col-span-2">Statut</div>
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
                            <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">
                                {{ $livre->catalogue?->nom ?? $livre->genre }}
                            </p>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <span class="inline-flex items-center gap-xs rounded-full px-sm py-1 font-label-sm text-label-sm border
                            @if ($livre->statut === 'disponible') bg-[#e6f4ea] text-[#137333] border-[#ceead6]
                            @elseif ($livre->statut === 'indisponible') bg-[#fff4e0] text-[#7a5200] border-[#f7d9a0]
                            @else bg-surface-container-high text-secondary border-outline-variant @endif">
                            <span class="material-symbols-outlined text-[14px]">
                                {{ $livre->statut === 'disponible' ? 'check_circle' : ($livre->statut === 'indisponible' ? 'schedule' : 'block') }}
                            </span>
                            {{ $livre->statut_label }}
                        </span>
                    </div>
                    <p class="col-span-2 font-body-md text-body-md">
                        <span class="font-semibold {{ $livre->quantite_disponible === 0 ? 'text-error' : 'text-on-surface' }}">{{ $livre->quantite_disponible }}</span>
                        <span class="text-secondary">/ {{ $livre->quantite_totale }}</span>
                    </p>
                    <p class="col-span-1 font-body-md text-body-md text-secondary">{{ $livre->emprunts_count }}</p>
                    <div class="col-span-2 flex gap-sm justify-start md:justify-end">
                        <a href="{{ route('livres.edit', $livre) }}" class="inline-flex items-center gap-xs text-primary border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-[16px]">edit</span> Modifier
                        </a>
                        <button type="button"
                                @click="$store.confirm.ask({
                                    title: 'Supprimer ce livre ?',
                                    message: 'Le livre « {{ $livre->titre }} » sera définitivement supprimé du catalogue.',
                                    action: '{{ route('livres.destroy', $livre) }}',
                                    method: 'DELETE',
                                    confirmLabel: 'Supprimer'
                                })"
                                class="inline-flex items-center gap-xs text-error border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-error-container transition-colors">
                            <span class="material-symbols-outlined text-[16px]">delete</span>
                        </button>
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