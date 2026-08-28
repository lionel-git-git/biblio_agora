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
          "secondary": "#545f72", "inverse-primary": "#adc7f7", "success": "#137333",
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
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">
<header class="bg-surface shadow-sm border-b border-outline-variant z-50 sticky top-0">
<div class="flex justify-between items-center w-full px-lg py-md max-w-container-max mx-auto">
    <div class="flex items-center gap-sm">
        <span class="material-symbols-outlined text-primary text-[28px]" style="font-variation-settings: 'FILL' 1;">local_library</span>
        <a href="{{ url('/') }}" class="text-headline-md font-headline-md font-bold text-primary">Agora</a>
    </div>
    <nav class="hidden md:flex gap-lg items-center">
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ url('/') }}">Accueil</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('catalogue') }}">Catalogue</a>
        @auth
            <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('dashboard') }}">Tableau de bord</a>
            @if (auth()->user()->role === 'bibliothecaire' || auth()->user()->role === 'admin')
                <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('livres.index') }}">Livres</a>
                <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('emprunts.gestion') }}">Emprunts</a>
            @endif
            @if (auth()->user()->role === 'etudiant')
                <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('emprunts.index') }}">Mes emprunts</a>
            @endif
            @if (auth()->user()->role === 'admin')
                <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('admin.utilisateurs') }}">Utilisateurs</a>
                <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('admin.messages') }}">Messages</a>
            @endif
        @endauth
    </nav>
    <div class="flex items-center gap-md">
        @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = ! open" class="flex items-center gap-sm bg-surface-container-low rounded-full px-md py-sm border border-outline-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant">account_circle</span>
                    <span class="font-label-sm text-label-sm text-on-surface">{{ Auth::user()->name }}</span>
                    <span class="material-symbols-outlined text-[16px] text-secondary" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" @click.outside="open = false" x-cloak class="absolute right-0 mt-2 w-56 bg-surface-container-lowest border border-outline-variant rounded-lg shadow-lg overflow-hidden" style="display:none;">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-sm px-md py-sm text-body-md text-on-surface hover:bg-surface-container-low">
                        <span class="material-symbols-outlined text-[18px] text-secondary">space_dashboard</span> Tableau de bord
                    </a>
                    @if (auth()->user()->role === 'etudiant')
                        <a href="{{ route('emprunts.index') }}" class="flex items-center gap-sm px-md py-sm text-body-md text-on-surface hover:bg-surface-container-low">
                            <span class="material-symbols-outlined text-[18px] text-secondary">history_edu</span> Mes emprunts
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-sm px-md py-sm text-body-md text-on-surface hover:bg-surface-container-low">
                        <span class="material-symbols-outlined text-[18px] text-secondary">settings</span> Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-sm px-md py-sm text-body-md text-error hover:bg-error-container">
                            <span class="material-symbols-outlined text-[18px]">logout</span> Déconnexion
                        </a>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="bg-primary text-on-primary font-label-sm text-label-sm px-lg py-sm rounded hover:bg-tertiary shadow-sm transition-all flex items-center gap-sm">
                Connexion
                <span class="material-symbols-outlined text-[16px]">login</span>
            </a>
        @endauth
    </div>
</div>
</header>

<main class="flex-grow">
    @yield('content')
</main>

<footer class="bg-surface border-t border-outline-variant mt-xl">
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col md:flex-row justify-between items-center gap-md">
        <div class="flex items-center gap-sm">
            <span class="material-symbols-outlined text-primary">local_library</span>
            <span class="font-headline-md text-headline-md text-primary font-bold">Agora</span>
        </div>
        <p class="font-body-md text-body-md text-secondary">Bibliothèque universitaire — &copy; {{ date('Y') }} Agora</p>
    </div>
</footer>

<style>[x-cloak] { display: none !important; }</style>
</body>
</html>