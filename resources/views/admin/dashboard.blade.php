@extends('layouts.site')

@section('title', 'Administration - Agora')

@section('content')
    <section class="relative bg-surface-container-lowest py-12 md:py-16 px-lg overflow-hidden border-b border-outline-variant">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-24 right-1/4 w-96 h-96 bg-primary-fixed rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        </div>
        <div class="max-w-container-max mx-auto relative z-10">
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Administration</p>
            <h1 class="font-display text-display text-primary">Bonjour, {{ Auth::user()->name }} 👋</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-sm max-w-2xl">
                Vue d'ensemble de la plateforme : catalogue, emprunts, utilisateurs et messages.
            </p>
        </div>
    </section>

    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">

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

        <div class="grid grid-cols-2 md:grid-cols-4 gap-lg">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <p class="font-label-sm text-label-sm text-secondary">Livres au catalogue</p>
                <p class="font-display text-display text-primary mt-sm">{{ $totalLivres }}</p>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <p class="font-label-sm text-label-sm text-secondary">Étudiants</p>
                <p class="font-display text-display text-primary mt-sm">{{ $totalEtudiants }}</p>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <p class="font-label-sm text-label-sm text-secondary">Bibliothécaires</p>
                <p class="font-display text-display text-primary mt-sm">{{ $totalBibliothecaires }}</p>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <p class="font-label-sm text-label-sm text-secondary">Total des emprunts</p>
                <p class="font-display text-display text-primary mt-sm">{{ $totalEmprunts }}</p>
            </div>
            <a href="{{ route('emprunts.gestion', ['statut' => 'en_retard']) }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Emprunts en retard</p>
                <p class="font-display text-display text-primary mt-sm {{ $totalRetards > 0 ? 'text-error' : '' }}">{{ $totalRetards }}</p>
            </a>
            <a href="{{ route('emprunts.gestion', ['statut' => 'en_attente']) }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Demandes en attente</p>
                <p class="font-display text-display text-primary mt-sm">{{ $demandesEnAttente }}</p>
            </a>
            <a href="{{ route('admin.messages') }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Messages non lus</p>
                <p class="font-display text-display text-primary mt-sm {{ $messagesNonLus > 0 ? 'text-error' : '' }}">{{ $messagesNonLus }}</p>
            </a>
            <a href="{{ route('admin.utilisateurs') }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Gérer les utilisateurs</p>
                <p class="font-display text-display text-primary mt-sm text-[20px] leading-[28px] mt-sm">→</p>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-xl">
            <section>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Derniers emprunts</h2>
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
                    @forelse ($derniersEmprunts as $emprunt)
                        <div class="flex items-center justify-between gap-md px-lg py-md border-b border-surface-container-high last:border-b-0">
                            <div>
                                <p class="font-body-md text-body-md text-on-surface font-semibold">{{ $emprunt->livre->titre ?? '—' }}</p>
                                <p class="font-body-md text-body-md text-secondary">{{ $emprunt->user->name ?? '—' }}</p>
                            </div>
                            <span class="px-md py-xs rounded-full text-label-sm font-label-sm bg-surface-container-high text-secondary shrink-0">{{ $emprunt->statut }}</span>
                        </div>
                    @empty
                        <p class="p-lg text-secondary font-body-md">Aucun emprunt pour le moment.</p>
                    @endforelse
                </div>
            </section>

            <section>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Derniers livres ajoutés</h2>
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
                    @forelse ($derniersLivres as $livre)
                        <div class="flex items-center justify-between gap-md px-lg py-md border-b border-surface-container-high last:border-b-0">
                            <div>
                                <p class="font-body-md text-body-md text-on-surface font-semibold">{{ $livre->titre }}</p>
                                <p class="font-body-md text-body-md text-secondary">{{ $livre->auteur }}</p>
                            </div>
                            <span class="px-md py-xs rounded-full text-label-sm font-label-sm bg-surface-container-high text-secondary shrink-0">
                                {{ $livre->quantite_disponible }} / {{ $livre->quantite_totale }}
                            </span>
                        </div>
                    @empty
                        <p class="p-lg text-secondary font-body-md">Aucun livre pour le moment.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
@endsection