@extends('layouts.site')

@section('title', 'Mes emprunts - Agora')

@section('content')
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-md">
            <div>
                <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Mon espace</p>
                <h1 class="font-display text-display text-primary">Mes emprunts</h1>
            </div>
            <a href="{{ route('catalogue') }}" class="inline-flex items-center gap-sm bg-primary text-on-primary rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-tertiary transition-all shadow-sm shrink-0">
                <span class="material-symbols-outlined text-[18px]">add</span> Demander un livre
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

        <div class="flex flex-wrap gap-md">
            <a href="{{ route('dashboard') }}" class="text-secondary font-body-md hover:text-primary transition-colors flex items-center gap-xs">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Retour au tableau de bord
            </a>
        </div>

        @forelse ($emprunts as $emprunt)
            <article class="flex flex-col md:flex-row items-start md:items-center justify-between gap-md bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <div class="flex items-center gap-md">
                    <div class="aspect-[2/3] w-16 bg-surface-container-high rounded overflow-hidden flex items-center justify-center">
                        @if ($emprunt->livre->image_couverture)
                            <img src="{{ asset('storage/' . $emprunt->livre->image_couverture) }}" alt="" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-outline">menu_book</span>
                        @endif
                    </div>
                    <div>
                        <h2 class="font-headline-md text-headline-md text-primary">{{ $emprunt->livre->titre }}</h2>
                        <p class="font-body-md text-body-md text-on-surface-variant">{{ $emprunt->livre->auteur }}</p>
                        <p class="font-body-md text-body-md text-secondary mt-xs">
                            @if ($emprunt->date_emprunt)
                                Emprunté le {{ $emprunt->date_emprunt->format('d/m/Y') }}
                                @if ($emprunt->date_retour_prevue)
                                    · retour prévu le <span class="font-semibold">{{ $emprunt->date_retour_prevue->format('d/m/Y') }}</span>
                                @endif
                            @else
                                Demandé le {{ $emprunt->created_at->format('d/m/Y à H:i') }}
                            @endif
                        </p>
                    </div>
                </div>

                @php
                    $badges = [
                        'en_attente' => ['Demande en attente', 'bg-surface-container-high text-secondary', 'schedule'],
                        'en_cours' => ['En cours', 'bg-primary-container text-on-primary', 'book'],
                        'en_retard' => ['En retard', 'bg-error-container text-on-error-container', 'warning'],
                        'retourne' => ['Retourné', 'bg-success-container text-on-success-container', 'task_alt'],
                        'refuse' => ['Refusé', 'bg-surface-container-high text-secondary', 'block'],
                    ];
                    [$label, $classes, $icon] = $badges[$emprunt->statut] ?? ['Inconnu', 'bg-surface-container-high text-secondary', 'help'];
                @endphp
                <span class="px-md py-sm rounded-full text-label-sm font-label-sm flex items-center gap-sm shrink-0 {{ $classes }}">
                    <span class="material-symbols-outlined text-[16px]">{{ $icon }}</span> {{ $label }}
                    @if ($emprunt->statut === 'retourne' && $emprunt->date_retour_effective)
                        le {{ $emprunt->date_retour_effective->format('d/m/Y') }}
                    @endif
                </span>
            </article>
        @empty
            <div class="bg-surface-container-lowest border border-dashed border-outline-variant rounded-xl p-xl text-center">
                <p class="text-secondary font-body-md">Vous n'avez encore aucun emprunt.</p>
                <a href="{{ route('catalogue') }}" class="inline-flex items-center gap-sm mt-md bg-primary text-on-primary rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-tertiary transition-all">
                    Explorer le catalogue
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        @endforelse
    </div>
@endsection