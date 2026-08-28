

<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Agora - Accueil</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        "colors": {
          "secondary-container": "#d5e0f7", "tertiary-fixed": "#d3e4ff", "outline-variant": "#c4c6cf",
          "on-tertiary-container": "#68a2e9", "on-secondary": "#ffffff", "on-error-container": "#93000a",
          "background": "#faf9fd", "error-container": "#ffdad6", "on-error": "#ffffff",
          "surface-container-high": "#e9e7eb", "on-primary-container": "#86a0cd", "outline": "#74777f",
          "tertiary-container": "#003765", "surface-bright": "#faf9fd", "surface-container": "#efedf1",
          "on-secondary-container": "#586377", "error": "#ba1a1a", "surface-container-low": "#f4f3f7",
          "primary-container": "#1a365d", "primary": "#002045", "on-tertiary": "#ffffff",
          "on-primary": "#ffffff", "on-surface-variant": "#43474e", "surface": "#faf9fd",
          "on-background": "#1a1c1e", "secondary-fixed": "#d8e3fa", "primary-fixed-dim": "#adc7f7",
          "surface-container-lowest": "#ffffff", "surface-variant": "#e3e2e6", "on-surface": "#1a1c1e",
          "secondary": "#545f72", "inverse-primary": "#adc7f7"
        },
        "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
        "spacing": { "gutter": "20px", "lg": "24px", "xl": "48px", "container-max": "1280px", "base": "4px", "md": "16px", "sm": "8px", "xs": "4px" },
        "fontFamily": { "label-sm": ["Inter"], "display": ["Inter"], "body-md": ["Inter"], "body-lg": ["Inter"], "headline-md": ["Inter"], "headline-lg": ["Inter"] },
        "fontSize": {
          "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
          "display": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
          "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
          "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
          "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
          "headline-lg": ["28px", { "lineHeight": "36px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
        }
      }
    }
  }
</script>
<style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">
<header class="bg-surface shadow-sm border-b border-outline-variant z-50 sticky top-0">
<div class="flex justify-between items-center w-full px-lg py-md max-w-container-max mx-auto">
    <div class="flex items-center gap-sm">
        <span class="material-symbols-outlined text-primary text-[28px]" style="font-variation-settings: 'FILL' 1;">local_library</span>
        <span class="text-headline-md font-headline-md font-bold text-primary">Agora</span>
    </div>
    <nav class="hidden md:flex gap-lg">
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ url('/') }}">Accueil</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('catalogue') }}">Catalogue</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="#">Services</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="#">Aide</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="#">Contact</a>
    </nav>
    <div class="flex items-center gap-md">
        <div class="hidden lg:flex items-center bg-surface-container-low rounded-full px-md py-sm border border-outline-variant">
            <span class="material-symbols-outlined text-on-surface-variant mr-sm">search</span>
            <input class="bg-transparent border-none focus:ring-0 text-body-md font-body-md text-on-surface w-48 outline-none" placeholder="Recherche rapide..." type="text">
        </div>
        <a href="{{ route('login') }}" class="bg-primary text-on-primary font-label-sm text-label-sm px-lg py-sm rounded hover:bg-tertiary shadow-sm transition-all flex items-center gap-sm">
            Connexion
            <span class="material-symbols-outlined text-[16px]">login</span>
        </a>
    </div>
</div>
</header>

<main class="flex-grow">
<section class="relative bg-surface-container-lowest py-24 md:py-32 px-lg overflow-hidden border-b border-outline-variant">
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
        <div class="w-full max-w-3xl bg-surface rounded-xl shadow-lg border border-outline-variant p-2 flex flex-col sm:flex-row gap-2">
            <div class="flex-grow flex items-center px-md border-r-0 sm:border-r border-outline-variant">
                <span class="material-symbols-outlined text-secondary mr-sm">search</span>
                <input class="w-full bg-transparent border-none focus:ring-0 text-body-lg font-body-lg text-on-surface outline-none py-3" placeholder="Rechercher un livre, un auteur..." type="text">
            </div>
            <div class="flex items-center px-md w-full sm:w-auto">
                <span class="material-symbols-outlined text-secondary mr-sm">filter_list</span>
                <select class="w-full bg-transparent border-none focus:ring-0 text-body-md font-body-md text-on-surface outline-none py-3 cursor-pointer">
                    <option>Tout le catalogue</option>
                    <option>Livres physiques</option>
                    <option>Articles numériques</option>
                </select>
            </div>
            <button class="bg-primary text-on-primary rounded-lg px-xl py-3 font-label-sm text-label-sm hover:bg-tertiary transition-colors w-full sm:w-auto">Rechercher</button>
        </div>
    </div>
</section>

<section class="py-xl px-lg max-w-container-max mx-auto">
    <div class="flex justify-between items-end mb-lg">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background mb-sm">Nouveautés</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Découvrez les dernières acquisitions de la bibliothèque.</p>
        </div>
        <a class="hidden sm:flex items-center text-primary font-label-sm text-label-sm hover:underline" href="#">
            Voir tout le catalogue <span class="material-symbols-outlined ml-1 text-[16px]">arrow_forward</span>
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg">
        @forelse ($nouveautes ?? [] as $livre)
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
                    @if ($livre->quantite_disponible > 0)
                        <span class="flex items-center text-secondary font-label-sm text-label-sm"><span class="material-symbols-outlined text-[16px] mr-1">check_circle</span> Disponible</span>
                    @else
                        <span class="flex items-center text-error font-label-sm text-label-sm"><span class="material-symbols-outlined text-[16px] mr-1">schedule</span> Emprunté</span>
                    @endif
                </div>
            </div>
        </article>
        @empty
        <p class="col-span-full text-center text-on-surface-variant py-lg">Aucun livre pour le moment.</p>
        @endforelse
    </div>
</section>

<section class="bg-surface-container-low py-xl px-lg border-y border-outline-variant">
    <div class="max-w-container-max mx-auto">
        <div class="text-center mb-xl">
            <h2 class="font-headline-lg text-headline-lg text-on-background mb-sm">Nos Services</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">Une infrastructure complète conçue pour faciliter vos recherches et optimiser votre temps de travail.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <div class="bg-surface rounded-xl p-lg shadow-sm border border-outline-variant">
                <div class="w-12 h-12 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-[24px]">menu_book</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background mb-sm">Consultation sur place</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Profitez de nos espaces de lecture silencieux et de nos salles de travail en groupe équipées.</p>
            </div>
            <div class="bg-surface rounded-xl p-lg shadow-sm border border-outline-variant">
                <div class="w-12 h-12 bg-secondary-container text-on-secondary-container rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-[24px]">swap_horiz</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background mb-sm">Gestion des Emprunts</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Empruntez jusqu'à 5 documents simultanément et suivez vos échéances en ligne.</p>
            </div>
            <div class="bg-surface rounded-xl p-lg shadow-sm border border-outline-variant">
                <div class="w-12 h-12 bg-tertiary-container text-on-tertiary rounded-lg flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-[24px]">help_center</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background mb-sm">Assistance & Aide</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Nos bibliothécaires sont disponibles pour vous orienter dans vos recherches.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-xl px-lg">
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
</main>

<footer class="bg-surface border-t border-outline-variant py-lg px-lg mt-auto">
    <div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-md">
        <div class="flex items-center gap-sm">
            <span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">local_library</span>
            <span class="text-body-md font-bold text-on-surface">Agora Academic</span>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-md">
            <div class="flex gap-md">
                <a href="#" class="text-body-md text-on-surface-variant hover:text-primary transition-colors">Politique de confidentialité</a>
                <a href="#" class="text-body-md text-on-surface-variant hover:text-primary transition-colors">Conditions d'utilisation</a>
            </div>
            <div class="text-body-md text-on-surface-variant">© 2026 Agora Academic. Tous droits réservés.</div>
        </div>
    </div>
</footer>
</body>
</html>