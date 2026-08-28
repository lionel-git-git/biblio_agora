@extends('layouts.public')

@section('title', 'Services - Agora')

@section('styles')
<style>
    .bento-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; }
    .bento-item-large { grid-column: span 2; }
    @media (max-width: 768px) { .bento-item-large { grid-column: span 1; } }
</style>
@endsection

@section('content')
<section class="bg-surface-container-low py-xl px-gutter md:px-xl border-b border-outline-variant">
    <div class="max-w-container-max mx-auto">
        <h1 class="font-headline-lg text-headline-lg md:font-display md:text-display text-primary mb-md">Services de la Bibliothèque</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
            Découvrez l'ensemble des services mis à votre disposition pour soutenir vos travaux de recherche, faciliter votre apprentissage et encourager la collaboration académique au sein d'Agora.
        </p>
    </div>
</section>

<div class="max-w-container-max mx-auto px-gutter md:px-xl py-xl">
    <div class="bento-grid">

        <div class="bento-item-large bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden hover:shadow-md transition-shadow duration-300 group flex flex-col md:flex-row">
            <div class="md:w-1/2 h-64 md:h-auto relative bg-primary overflow-hidden flex items-center justify-center">
                <div class="absolute inset-0 opacity-10">
                    <span class="material-symbols-outlined text-[160px] leading-none" style="font-variation-settings: 'FILL' 1;">devices</span>
                </div>
                <span class="material-symbols-outlined text-on-primary text-[72px] relative z-10">devices</span>
            </div>
            <div class="p-lg md:w-1/2 flex flex-col justify-center">
                <div class="flex items-center gap-sm text-primary mb-sm">
                    <span class="material-symbols-outlined">devices</span>
                    <h2 class="font-headline-md text-headline-md">Ressources Numériques</h2>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant mb-md">
                    Accédez à des milliers d'articles scientifiques, de revues en ligne, et de bases de données spécialisées, disponibles 24/7 depuis n'importe quel appareil connecté.
                </p>
                <a href="{{ route('catalogue') }}" class="inline-flex items-center gap-xs font-label-sm text-label-sm text-primary font-bold hover:underline">
                    Explorer le catalogue en ligne <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg hover:shadow-md transition-shadow duration-300 flex flex-col">
            <div class="w-12 h-12 bg-primary-fixed rounded-full flex items-center justify-center text-primary mb-md">
                <span class="material-symbols-outlined">import_contacts</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-primary mb-sm">Prêt entre Bibliothèques</h3>
            <p class="font-body-md text-body-md text-on-surface-variant flex-1 mb-md">
                Un document n'est pas disponible dans nos collections ? Nous le faisons venir pour vous depuis une autre bibliothèque partenaire du réseau académique.
            </p>
            <a href="{{ route('contact') }}" class="bg-primary text-on-primary font-label-sm text-label-sm py-sm px-md rounded-lg shadow-sm hover:bg-primary-container transition-colors self-start">Faire une demande</a>
        </div>

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg hover:shadow-md transition-shadow duration-300 flex flex-col relative overflow-hidden">
            <div class="absolute top-0 right-0 p-md opacity-10">
                <span class="material-symbols-outlined text-[120px]">meeting_room</span>
            </div>
            <div class="relative z-10 flex flex-col h-full">
                <div class="w-12 h-12 bg-secondary-fixed rounded-full flex items-center justify-center text-primary mb-md">
                    <span class="material-symbols-outlined">groups</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-primary mb-sm">Espaces de Coworking</h3>
                <p class="font-body-md text-body-md text-on-surface-variant flex-1 mb-md">
                    Réservez l'une de nos salles de travail en groupe équipées d'écrans interactifs et de tableaux blancs pour vos projets collaboratifs.
                </p>
                <a href="{{ route('contact') }}" class="border border-primary text-primary font-label-sm text-label-sm py-sm px-md rounded-lg hover:bg-surface-container transition-colors self-start">Réserver une salle</a>
            </div>
        </div>

        <div class="bento-item-large bg-primary text-on-primary rounded-xl shadow-md p-lg hover:shadow-lg transition-shadow duration-300 flex flex-col md:flex-row justify-between items-center relative overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20" style="background-image: radial-gradient(circle at 100% 100%, rgba(255,255,255,0.8) 0%, transparent 50%);"></div>
            <div class="relative z-10 md:w-2/3 mb-md md:mb-0">
                <div class="flex items-center gap-sm mb-sm text-primary-fixed">
                    <span class="material-symbols-outlined">school</span>
                    <span class="font-label-sm text-label-sm uppercase tracking-wider">Formation</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg mb-sm">Ateliers de Recherche Documentaire</h3>
                <p class="font-body-md text-body-md text-primary-fixed-dim opacity-90 max-w-xl">
                    Participez à nos sessions de formation gratuites pour maîtriser les outils de recherche avancée, la gestion bibliographique (Zotero, Mendeley) et éviter le plagiat.
                </p>
            </div>
            <div class="relative z-10 md:w-1/3 flex justify-end">
                <a href="{{ route('contact') }}" class="bg-primary-fixed text-primary font-label-sm text-label-sm py-md px-lg rounded-full font-bold shadow-sm hover:bg-white transition-colors w-full md:w-auto text-center">Contacter le bureau</a>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg hover:shadow-md transition-shadow duration-300 flex flex-col">
            <div class="w-12 h-12 bg-surface-container-high rounded-full flex items-center justify-center text-primary mb-md">
                <span class="material-symbols-outlined">print</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-primary mb-sm">Reprographie</h3>
            <p class="font-body-md text-body-md text-on-surface-variant flex-1 mb-md">
                Services d'impression, de photocopie et de numérisation en libre-service. Rechargez votre carte d'étudiant pour y accéder.
            </p>
            <div class="flex items-center gap-sm mt-auto border-t border-outline-variant pt-md">
                <span class="w-3 h-3 rounded-full bg-tertiary-container"></span>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Disponible à la bibliothèque</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg hover:shadow-md transition-shadow duration-300 flex flex-col">
            <div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center text-on-secondary-container mb-md">
                <span class="material-symbols-outlined">book</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-primary mb-sm">Consultation sur place</h3>
            <p class="font-body-md text-body-md text-on-surface-variant flex-1 mb-md">
                Profitez de nos espaces de lecture silencieux, de nos salles d'étude et de nos collections patrimoniales consultables uniquement sur place.
            </p>
            <a href="{{ route('catalogue') }}" class="inline-flex items-center gap-xs font-label-sm text-label-sm text-primary font-bold hover:underline">
                Voir les collections <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>

    </div>
</div>
@endsection