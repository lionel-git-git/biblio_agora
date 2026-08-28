@extends('layouts.site')

@section('title', 'Espace étudiant - Agora')

@section('content')
    <section class="relative bg-surface-container-lowest py-12 md:py-16 px-lg overflow-hidden border-b border-outline-variant">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-24 right-1/4 w-96 h-96 bg-primary-fixed rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        </div>
        <div class="max-w-container-max mx-auto relative z-10">
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Espace étudiant</p>
            <h1 class="font-display text-display text-primary">Bonjour, {{ Auth::user()->name }} 👋</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-sm max-w-2xl">
                Retrouvez ici vos demandes d'emprunt et les livres que vous avez empruntés.
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

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-lg">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <p class="font-label-sm text-label-sm text-secondary">Emprunts en cours</p>
                <p class="font-display text-display text-primary mt-sm">{{ $empruntsEnCours->count() }}</p>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <p class="font-label-sm text-label-sm text-secondary">Demandes en attente</p>
                <p class="font-display text-display text-primary mt-sm">{{ $demandesEnAttente->count() }}</p>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm">
                <p class="font-label-sm text-label-sm text-secondary">Livres disponibles au catalogue</p>
                <p class="font-display text-display text-primary mt-sm">
                    <a href="{{ route('catalogue') }}" class="hover:underline">Explorer</a>
                </p>
            </div>
        </div>

        <section>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-md flex items-center gap-sm">
                <span class="material-symbols-outlined text-secondary">history_edu</span> Mes livres en cours
            </h2>

            @forelse ($empruntsEnCours as $emprunt)
                <article class="flex flex-col md:flex-row items-start md:items-center justify-between gap-md bg-surface-container-lowest border border-outline-variant rounded-xl p-lg mb-md shadow-sm">
                    <div class="flex items-center gap-md">
                        <div class="aspect-[2/3] w-16 bg-surface-container-high rounded overflow-hidden flex items-center justify-center">
                            @if ($emprunt->livre->image_couverture)
                                <img src="{{ asset('storage/' . $emprunt->livre->image_couverture) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-outline">menu_book</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-primary">{{ $emprunt->livre->titre }}</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">{{ $emprunt->livre->auteur }}</p>
                            <p class="font-body-md text-body-md text-secondary mt-xs">
                                Emprunté le {{ $emprunt->date_emprunt->format('d/m/Y') }} — retour prévu le
                                <span class="font-semibold">{{ $emprunt->date_retour_prevue->format('d/m/Y') }}</span>
                            </p>
                        </div>
                    </div>
                    @if ($emprunt->statut === 'en_retard')
                        <span class="px-md py-sm rounded-full text-label-sm font-label-sm bg-error-container text-on-error-container flex items-center gap-sm shrink-0">
                            <span class="material-symbols-outlined text-[16px]">warning</span> En retard
                        </span>
                    @else
                        <span class="px-md py-sm rounded-full text-label-sm font-label-sm bg-primary-container text-on-primary flex items-center gap-sm shrink-0">
                            <span class="material-symbols-outlined text-[16px]">book</span> En cours
                        </span>
                    @endif
                </article>
            @empty
                <div class="bg-surface-container-lowest border border-dashed border-outline-variant rounded-xl p-xl text-center">
                    <p class="text-secondary font-body-md">Aucun emprunt en cours.</p>
                    <a href="{{ route('catalogue') }}" class="inline-flex items-center gap-sm mt-md bg-primary text-on-primary rounded px-lg py-sm font-label-sm text-label-sm hover:bg-tertiary transition-all">
                        Parcourir le catalogue
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            @endforelse
        </section>

        <section>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Demandes en attente</h2>
            @forelse ($demandesEnAttente as $emprunt)
                <article class="flex items-center justify-between gap-md bg-surface-container-low border border-outline-variant rounded-xl p-lg mb-md">
                    <div>
                        <h3 class="font-headline-md text-headline-md text-primary">{{ $emprunt->livre->titre }}</h3>
                        <p class="font-body-md text-body-md text-secondary">Demande envoyée le {{ $emprunt->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <span class="px-md py-sm rounded-full text-label-sm font-label-sm bg-surface-container-high text-secondary flex items-center gap-sm shrink-0">
                        <span class="material-symbols-outlined text-[16px]">schedule</span> En attente de validation
                    </span>
                </article>
            @empty
                <p class="text-secondary font-body-md bg-surface-container-low rounded-xl p-lg border border-outline-variant">Aucune demande en attente.</p>
            @endforelse
        </section>

        @if ($historique->isNotEmpty())
            <section>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Historique récent</h2>
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
                    @foreach ($historique as $emprunt)
                        <div class="flex items-center justify-between gap-md px-lg py-md border-b border-surface-container-high last:border-b-0">
                            <div>
                                <p class="font-body-md text-body-md text-on-surface">{{ $emprunt->livre->titre }}</p>
                                <p class="font-body-md text-body-md text-secondary">{{ $emprunt->livre->auteur }}</p>
                            </div>
                            <span class="px-md py-xs rounded-full text-label-sm font-label-sm bg-surface-container-high text-secondary shrink-0">
                                {{ $emprunt->statut === 'retourne' ? 'Retourné le ' . $emprunt->date_retour_effective->format('d/m/Y') : 'Refusé' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection