@extends('layouts.site')

@section('title', 'Espace bibliothécaire - Agora')

@section('content')
    <section class="relative bg-surface-container-lowest py-12 md:py-16 px-lg overflow-hidden border-b border-outline-variant">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-24 right-1/4 w-96 h-96 bg-primary-fixed rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        </div>
        <div class="max-w-container-max mx-auto relative z-10">
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Espace bibliothécaire</p>
            <h1 class="font-display text-display text-primary">Bonjour, {{ Auth::user()->name }} 👋</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-sm max-w-2xl">
                Gérez le catalogue et traitez les demandes d'emprunt.
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

        <div class="grid grid-cols-2 md:grid-cols-5 gap-lg">
            <a href="{{ route('livres.index') }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Livres au catalogue</p>
                <p class="font-display text-display text-primary mt-sm">{{ $totalLivres }}</p>
            </a>
            <a href="{{ route('emprunts.gestion') }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Emprunts en cours</p>
                <p class="font-display text-display text-primary mt-sm">{{ $empruntsEnCours }}</p>
            </a>
            <a href="{{ route('emprunts.gestion', ['statut' => 'en_attente']) }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Demandes en attente</p>
                <p class="font-display text-display text-primary mt-sm">{{ $demandesEnAttente }}</p>
            </a>
            <a href="{{ route('emprunts.gestion', ['statut' => 'en_retard']) }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Emprunts en retard</p>
                <p class="font-display text-display text-primary mt-sm {{ $totalRetards > 0 ? 'text-error' : '' }}">{{ $totalRetards }}</p>
            </a>
            <a href="{{ route('livres.index') }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-shadow">
                <p class="font-label-sm text-label-sm text-secondary">Livres épuisés</p>
                <p class="font-display text-display text-primary mt-sm">{{ $livresIndisponibles }}</p>
            </a>
        </div>

        <div class="flex flex-wrap gap-md">
            <a href="{{ route('livres.create') }}" class="inline-flex items-center gap-sm bg-primary-container text-on-primary rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-primary transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span> Ajouter un livre
            </a>
            <a href="{{ route('livres.index') }}" class="inline-flex items-center gap-sm bg-surface-container-low text-primary border border-outline-variant rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-[18px]">inventory_2</span> Gérer le catalogue
            </a>
            <a href="{{ route('emprunts.gestion') }}" class="inline-flex items-center gap-sm bg-surface-container-low text-primary border border-outline-variant rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-[18px]">swap_horiz</span> Gérer les emprunts
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-xl">
            <section>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-md flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary">schedule</span> Demandes récentes
                </h2>
                @forelse ($demandesRecentes as $emprunt)
                    <article class="flex items-center justify-between gap-md bg-surface-container-lowest border border-outline-variant rounded-xl p-lg mb-md shadow-sm">
                        <div>
                            <p class="font-headline-md text-headline-md text-primary">{{ $emprunt->livre->titre }}</p>
                            <p class="font-body-md text-body-md text-secondary">
                                {{ $emprunt->user->name }} — {{ $emprunt->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex gap-sm shrink-0">
                            <form method="POST" action="{{ route('emprunts.valider', $emprunt) }}">
                                @csrf
                                @method('PATCH')
                                <button class="inline-flex items-center gap-xs bg-success-container text-on-success-container rounded-lg px-md py-sm font-label-sm text-label-sm hover:opacity-80 transition-opacity">
                                    <span class="material-symbols-outlined text-[16px]">check</span> Valider
                                </button>
                            </form>
                            <form method="POST" action="{{ route('emprunts.refuser', $emprunt) }}">
                                @csrf
                                @method('PATCH')
                                <button class="inline-flex items-center gap-xs bg-error-container text-on-error-container rounded-lg px-md py-sm font-label-sm text-label-sm hover:opacity-80 transition-opacity">
                                    <span class="material-symbols-outlined text-[16px]">close</span>
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="text-secondary font-body-md bg-surface-container-low rounded-xl p-lg border border-outline-variant">Aucune demande en attente.</p>
                @endforelse
            </section>

            <section>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-md flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary">book</span> Emprunts en cours
                </h2>
                @forelse ($empruntsEnCoursListe as $emprunt)
                    <article class="flex items-center justify-between gap-md bg-surface-container-lowest border border-outline-variant rounded-xl p-lg mb-md shadow-sm">
                        <div>
                            <p class="font-headline-md text-headline-md text-primary">{{ $emprunt->livre->titre }}</p>
                            <p class="font-body-md text-body-md text-secondary">
                                {{ $emprunt->user->name }} — retour le
                                @if ($emprunt->date_retour_prevue)
                                    <span class="{{ $emprunt->statut === 'en_retard' ? 'text-error font-semibold' : '' }}">{{ $emprunt->date_retour_prevue->format('d/m/Y') }}</span>
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                        <div class="flex gap-sm items-center shrink-0">
                            @if ($emprunt->statut === 'en_retard')
                                <span class="px-md py-sm rounded-full text-label-sm font-label-sm bg-error-container text-on-error-container flex items-center gap-sm">
                                    <span class="material-symbols-outlined text-[16px]">warning</span> Retard
                                </span>
                            @endif
                            <form method="POST" action="{{ route('emprunts.retour', $emprunt) }}">
                                @csrf
                                @method('PATCH')
                                <button class="inline-flex items-center gap-xs bg-primary-container text-on-primary rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-primary transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">assignment_return</span> Retour
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="text-secondary font-body-md bg-surface-container-low rounded-xl p-lg border border-outline-variant">Aucun emprunt en cours.</p>
                @endforelse
            </section>
        </div>
    </div>
@endsection