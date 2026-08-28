@extends('layouts.public')

@section('title', 'Agora - Accueil')

@section('content')
<section class="relative bg-surface-container-lowest py-24 md:py-32 px-gutter md:px-xl overflow-hidden border-b border-outline-variant">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-fixed rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute top-48 -left-24 w-72 h-72 bg-secondary-container rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>
    <div class="max-w-container-max mx-auto relative z-10 flex flex-col items-center text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm mb-md border border-outline-variant">Portail Académique Officiel</span>
        <h1 class="font-display text-display text-on-background max-w-3xl mb-lg tracking-tight">
            Votre accès au <span class="text-primary">savoir</span> commence ici
        </h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mb-xl">
            Explorez des millions de ressources académiques, gérez vos emprunts et accédez à nos services de recherche spécialisés pour soutenir votre parcours universitaire.
        </p>
        <form action="{{ route('catalogue') }}" method="GET" class="w-full max-w-3xl bg-surface rounded-xl shadow-lg border border-outline-variant p-2 flex flex-col sm:flex-row gap-2">
            <div class="flex-grow flex items-center px-md">
                <span class="material-symbols-outlined text-secondary mr-sm">search</span>
                <input name="recherche" class="w-full bg-transparent border-none focus:ring-0 text-body-lg font-body-lg text-on-surface outline-none py-3" placeholder="Rechercher un livre, un auteur..." type="text">
            </div>
            <button type="submit" class="bg-primary text-on-primary rounded-lg px-xl py-3 font-label-sm text-label-sm hover:bg-tertiary transition-colors w-full sm:w-auto shrink-0">Rechercher</button>
        </form>
    </div>
</section>

<section class="py-xl px-gutter md:px-xl max-w-container-max mx-auto">
    <div class="flex justify-between items-end mb-lg">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background mb-sm">Nouveautés</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Découvrez les dernières acquisitions de la bibliothèque.</p>
        </div>
        <a class="hidden sm:flex items-center text-primary font-label-sm text-label-sm hover:underline" href="{{ route('catalogue') }}">
            Voir tout le catalogue <span class="material-symbols-outlined ml-1 text-[16px]">arrow_forward</span>
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg">
        @forelse ($nouveautes as $livre)
        <article class="bg-surface rounded-xl overflow-hidden shadow-sm border border-outline-variant hover:shadow-lg transition-all duration-300 flex flex-col h-full">
            <div class="aspect-[2/3] w-full relative overflow-hidden bg-surface-container flex items-center justify-center">
                @if ($livre->image_couverture)
                    <img src="{{ asset('storage/' . $livre->image_couverture) }}" alt="{{ $livre->titre }}" class="w-full h-full object-cover">
                @else
                    <span class="material-symbols-outlined text-6xl text-outline-variant">menu_book</span>
                @endif
            </div>
            <div class="p-md flex flex-col flex-grow">
                <span class="text-primary font-label-sm text-label-sm mb-1 uppercase tracking-wider">{{ $livre->genre }}</span>
                <h3 class="font-headline-md text-headline-md text-on-background mb-xs line-clamp-2">{{ $livre->titre }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant mb-md">{{ $livre->auteur }}</p>
                <div class="mt-auto flex justify-between items-center pt-sm border-t border-outline-variant">
                    <span class="flex items-center text-secondary font-label-sm text-label-sm">
                        @if ($livre->quantite_disponible > 0)
                            <span class="material-symbols-outlined text-[16px] mr-1 text-success">check_circle</span> Disponible
                        @else
                            <span class="material-symbols-outlined text-[16px] mr-1 text-error">schedule</span> Emprunté
                        @endif
                    </span>
                    <a href="{{ route('catalogue') }}" class="text-primary font-label-sm text-label-sm hover:underline">Voir</a>
                </div>
            </div>
        </article>
        @empty
        <p class="col-span-full text-center text-on-surface-variant py-lg">Aucun livre pour le moment.</p>
        @endforelse
    </div>
</section>

<section class="bg-surface-container-low py-xl px-gutter md:px-xl border-y border-outline-variant">
    <div class="max-w-container-max mx-auto">
        <div class="text-center mb-xl">
            <h2 class="font-headline-lg text-headline-lg text-on-background mb-sm">Nos Services</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">Une infrastructure complète conçue pour faciliter vos recherches et optimiser votre temps de travail.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <a href="{{ route('services') }}" class="group bg-surface rounded-xl p-lg shadow-sm border border-outline-variant hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-[24px]">menu_book</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background mb-sm group-hover:text-primary transition-colors">Consultation sur place</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Profitez de nos espaces de lecture silencieux et de nos salles de travail en groupe équipées.</p>
            </a>
            <a href="{{ route('services') }}" class="group bg-surface rounded-xl p-lg shadow-sm border border-outline-variant hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-secondary-container text-on-secondary-container rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-[24px]">swap_horiz</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background mb-sm group-hover:text-primary transition-colors">Gestion des Emprunts</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Empruntez jusqu'à 5 documents simultanément et suivez vos échéances en ligne.</p>
            </a>
            <a href="{{ route('aide') }}" class="group bg-surface rounded-xl p-lg shadow-sm border border-outline-variant hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-tertiary-container text-on-tertiary rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-[24px]">help_center</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background mb-sm group-hover:text-primary transition-colors">Assistance & Aide</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Nos bibliothécaires sont disponibles pour vous orienter dans vos recherches.</p>
            </a>
        </div>
    </div>
</section>

<section class="py-xl px-gutter md:px-xl">
    <div class="max-w-4xl mx-auto bg-primary text-on-primary rounded-2xl p-lg md:p-xl flex flex-col md:flex-row items-center justify-between shadow-lg">
        <div class="text-center md:text-left mb-lg md:mb-0 md:mr-lg">
            <h2 class="font-display text-[28px] leading-tight font-bold mb-sm">Accédez à votre espace personnel</h2>
            <p class="font-body-lg text-body-lg text-primary-fixed-dim">Connectez-vous pour gérer vos prêts et accéder aux ressources numériques exclusives.</p>
        </div>
        <a href="{{ route('login') }}" class="w-full md:w-auto bg-surface text-primary font-label-sm text-label-sm px-xl py-3 rounded hover:bg-surface-container transition-colors shadow-sm flex justify-center items-center gap-sm">
            Connexion Étudiant / Staff
            <span class="material-symbols-outlined text-[18px]">login</span>
        </a>
    </div>
</section>
@endsection