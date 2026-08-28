<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>@hasSection('title')@yield('title')@else Agora @endif</title>
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
          "secondary": "#545f72", "inverse-primary": "#adc7f7", "surface-container-highest": "#e3e2e6",
          "surface-dim": "#dad9dd", "primary-fixed": "#d6e3ff", "primary-fixed-variant": "#2d476f",
          "tertiary": "#002141", "on-primary-fixed": "#001b3c", "on-primary-fixed-variant": "#2d476f",
          "on-secondary-fixed": "#111c2c", "secondary-fixed-dim": "#bcc7dd", "success": "#137333",
          "success-container": "#e6f4ea", "on-success-container": "#155724"
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
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style> body { font-family: 'Inter', sans-serif; } </style>
@yield('styles')
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
<header class="bg-surface-container-lowest shadow-sm border-b border-outline-variant z-50 sticky top-0">
<div class="flex justify-between items-center w-full px-lg py-md max-w-container-max mx-auto" x-data="{ menu: false }">
    <div class="flex items-center gap-sm">
        <span class="material-symbols-outlined text-primary text-[28px]" style="font-variation-settings: 'FILL' 1;">local_library</span>
        <a href="{{ url('/') }}" class="text-headline-md font-headline-md font-bold text-primary">Agora</a>
    </div>
    <button @click="menu = ! menu" class="md:hidden p-sm text-primary hover:bg-surface-container rounded-lg transition-colors" aria-label="Menu">
        <span class="material-symbols-outlined" x-text="menu ? 'close' : 'menu'">menu</span>
    </button>
    <nav class="hidden md:flex gap-lg items-center ml-xl">
        <a href="{{ url('/') }}" class="font-label-sm text-label-sm {{ request()->is('/') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-secondary hover:text-primary' }} transition-colors duration-200">Accueil</a>
        <a href="{{ route('catalogue') }}" class="font-label-sm text-label-sm {{ request()->routeIs('catalogue') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-secondary hover:text-primary' }} transition-colors duration-200">Catalogue</a>
        <a href="{{ route('services') }}" class="font-label-sm text-label-sm {{ request()->routeIs('services') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-secondary hover:text-primary' }} transition-colors duration-200">Services</a>
        <a href="{{ route('aide') }}" class="font-label-sm text-label-sm {{ request()->routeIs('aide') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-secondary hover:text-primary' }} transition-colors duration-200">Aide</a>
        <a href="{{ route('contact') }}" class="font-label-sm text-label-sm {{ request()->routeIs('contact', 'contact.store') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-secondary hover:text-primary' }} transition-colors duration-200">Contact</a>
    </nav>
    <div class="hidden md:flex items-center gap-md">
        <form action="{{ route('catalogue') }}" method="GET" class="relative hidden lg:block">
            <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
            <input name="recherche" class="pl-lg pr-sm py-sm rounded-lg border border-outline-variant bg-surface focus:border-primary focus:ring-1 focus:ring-primary text-body-md font-body-md text-on-surface w-52 transition-all outline-none" placeholder="Rechercher..." type="text">
        </form>
        @auth
        <a href="{{ route('dashboard') }}" class="bg-primary text-on-primary font-label-sm text-label-sm px-lg py-sm rounded hover:bg-tertiary shadow-sm transition-all flex items-center gap-sm">
            Tableau de bord
            <span class="material-symbols-outlined text-[16px]">space_dashboard</span>
        </a>
        @else
        <a href="{{ route('register') }}" class="text-primary font-label-sm text-label-sm font-bold hover:underline">Créer un compte</a>
        <a href="{{ route('login') }}" class="bg-primary text-on-primary font-label-sm text-label-sm px-lg py-sm rounded hover:bg-tertiary shadow-sm transition-all flex items-center gap-sm">
            Connexion
            <span class="material-symbols-outlined text-[16px]">login</span>
        </a>
        @endauth
    </div>
    <template x-if="menu">
        <div x-transition class="md:hidden absolute left-0 right-0 top-full bg-surface-container-lowest border-b border-outline-variant shadow-lg" @click.away="menu = false">
            <nav class="flex flex-col px-lg py-md gap-sm max-w-container-max mx-auto">
                <form action="{{ route('catalogue') }}" method="GET" class="relative mb-sm">
                    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
                    <input name="recherche" class="w-full pl-lg pr-sm py-sm rounded-lg border border-outline-variant bg-surface focus:border-primary focus:ring-1 focus:ring-primary text-body-md font-body-md text-on-surface outline-none" placeholder="Rechercher un livre..." type="text">
                </form>
                <a href="{{ url('/') }}" class="font-label-sm text-label-sm {{ request()->is('/') ? 'text-primary font-bold' : 'text-secondary hover:text-primary' }} py-sm {{ request()->is('/') ? 'border-l-4 border-primary pl-md' : 'px-md' }}">Accueil</a>
                <a href="{{ route('catalogue') }}" class="font-label-sm text-label-sm {{ request()->routeIs('catalogue') ? 'text-primary font-bold' : 'text-secondary hover:text-primary' }} py-sm {{ request()->routeIs('catalogue') ? 'border-l-4 border-primary pl-md' : 'px-md' }}">Catalogue</a>
                <a href="{{ route('services') }}" class="font-label-sm text-label-sm {{ request()->routeIs('services') ? 'text-primary font-bold' : 'text-secondary hover:text-primary' }} py-sm {{ request()->routeIs('services') ? 'border-l-4 border-primary pl-md' : 'px-md' }}">Services</a>
                <a href="{{ route('aide') }}" class="font-label-sm text-label-sm {{ request()->routeIs('aide') ? 'text-primary font-bold' : 'text-secondary hover:text-primary' }} py-sm {{ request()->routeIs('aide') ? 'border-l-4 border-primary pl-md' : 'px-md' }}">Aide</a>
                <a href="{{ route('contact') }}" class="font-label-sm text-label-sm {{ request()->routeIs('contact', 'contact.store') ? 'text-primary font-bold' : 'text-secondary hover:text-primary' }} py-sm {{ request()->routeIs('contact', 'contact.store') ? 'border-l-4 border-primary pl-md' : 'px-md' }}">Contact</a>
                <div class="flex items-center gap-md mt-sm border-t border-outline-variant pt-md">
                    @auth
                    <a href="{{ route('dashboard') }}" class="flex-1 text-center bg-primary text-on-primary font-label-sm text-label-sm px-lg py-sm rounded shadow-sm flex items-center justify-center gap-sm">
                        Tableau de bord <span class="material-symbols-outlined text-[16px]">space_dashboard</span>
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="flex-1 text-center bg-primary text-on-primary font-label-sm text-label-sm px-lg py-sm rounded shadow-sm flex items-center justify-center gap-sm">
                        Connexion <span class="material-symbols-outlined text-[16px]">login</span>
                    </a>
                    @endauth
                </div>
            </nav>
        </div>
    </template>
</div>
</header>

<main class="flex-grow">
    @yield('content')
</main>

<footer class="bg-surface border-t border-outline-variant mt-auto">
    <div class="max-w-container-max mx-auto px-lg py-xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-xl">
        <div>
            <div class="flex items-center gap-sm mb-md">
                <span class="material-symbols-outlined text-primary text-[24px]" style="font-variation-settings: 'FILL' 1;">local_library</span>
                <span class="text-headline-lg font-headline-lg font-bold text-primary">Agora</span>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant mb-md">
                Votre portail académique unique pour explorer les ressources de la bibliothèque, gérer vos emprunts et accéder à des services de recherche spécialisés.
            </p>
            <div class="flex items-center gap-sm">
                <span class="material-symbols-outlined text-secondary text-[18px]">location_on</span>
                <span class="font-body-md text-body-md text-on-surface-variant">Campus Universitaire d'Abomey-Calavi, Bénin</span>
            </div>
        </div>
        <div>
            <h3 class="font-headline-md text-headline-md text-primary mb-md">Navigation</h3>
            <ul class="space-y-sm">
                <li><a href="{{ url('/') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Accueil</a></li>
                <li><a href="{{ route('catalogue') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Catalogue</a></li>
                <li><a href="{{ route('services') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Services</a></li>
                <li><a href="{{ route('aide') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Aide</a></li>
                <li><a href="{{ route('contact') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Contact</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-headline-md text-headline-md text-primary mb-md">Nos Services</h3>
            <ul class="space-y-sm">
                <li><a href="{{ route('services') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Consultation sur place</a></li>
                <li><a href="{{ route('services') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Gestion des emprunts</a></li>
                <li><a href="{{ route('services') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Ressources numériques</a></li>
                <li><a href="{{ route('services') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Prêt entre bibliothèques</a></li>
                <li><a href="{{ route('services') }}" class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors">Ateliers de formation</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-headline-md text-headline-md text-primary mb-md">Contact</h3>
            <ul class="space-y-md">
                <li class="flex items-start">
                    <span class="material-symbols-outlined text-secondary text-[18px] mr-sm mt-xs">location_on</span>
                    <span class="font-body-md text-body-md text-on-surface-variant">Campus Universitaire d'Abomey-Calavi<br>Abomey-Calavi, <span class="text-on-surface font-bold">Bénin</span></span>
                </li>
                <li class="flex items-start">
                    <span class="material-symbols-outlined text-secondary text-[18px] mr-sm mt-xs">call</span>
                    <span class="font-body-md text-body-md text-on-surface-variant">+229 01 63 45 67 89</span>
                </li>
                <li class="flex items-start">
                    <span class="material-symbols-outlined text-secondary text-[18px] mr-sm mt-xs">mail</span>
                    <span class="font-body-md text-body-md text-on-surface-variant">contact@agora.bj</span>
                </li>
                <li class="flex items-start">
                    <span class="material-symbols-outlined text-secondary text-[18px] mr-sm mt-xs">schedule</span>
                    <span class="font-body-md text-body-md text-on-surface-variant">Lun – Ven : 08h00 – 20h00<br>Sam : 09h00 – 18h00 · Dim : Fermé</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="border-t border-outline-variant">
        <div class="max-w-container-max mx-auto px-lg py-md flex flex-col md:flex-row justify-between items-center gap-md">
            <p class="font-body-md text-body-md text-on-surface-variant">&copy; {{ date('Y') }} Bibliothèque Agora — Abomey-Calavi, Bénin. Tous droits réservés.</p>
            <div class="flex gap-lg">
                <a href="#" class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">Politique de confidentialité</a>
                <a href="#" class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">Conditions d'utilisation</a>
                <a href="#" class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">Portail universitaire</a>
            </div>
        </div>
    </div>
</footer>

<style>[x-cloak] { display: none !important; }</style>
</body>
</html>