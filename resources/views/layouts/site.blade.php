@php
    $current = request()->route() ? request()->route()->getName() : null;
    $u = auth()->user();

    $navItems = [
        ['label' => 'Tableau de bord', 'icon' => 'dashboard', 'route' => 'dashboard', 'active' => in_array($current, ['dashboard', 'etudiant.dashboard', 'bibliothecaire.dashboard', 'admin.dashboard'])],
    ];

    if ($u && in_array($u->role, ['bibliothecaire', 'admin'])) {
        $navItems[] = ['label' => 'Catalogue', 'icon' => 'menu_book', 'route' => 'catalogues.index', 'active' => in_array($current, ['catalogues.index', 'catalogues.create', 'catalogues.store', 'catalogues.edit', 'catalogues.update', 'catalogues.destroy'])];
    } else {
        $navItems[] = ['label' => 'Catalogue', 'icon' => 'menu_book', 'route' => 'catalogue', 'active' => in_array($current, ['catalogue'])];
    }

    if ($u && $u->role === 'etudiant') {
        $navItems[] = ['label' => 'Mes emprunts', 'icon' => 'history_edu', 'route' => 'emprunts.index', 'active' => in_array($current, ['emprunts.index', 'emprunts.store'])];
    }

    if ($u && in_array($u->role, ['bibliothecaire', 'admin'])) {
        $navItems[] = ['label' => 'Livres', 'icon' => 'library_books', 'route' => 'livres.index', 'active' => in_array($current, ['livres.index', 'livres.create', 'livres.store', 'livres.edit', 'livres.update', 'livres.destroy'])];
        $navItems[] = ['label' => 'Gestion des emprunts', 'icon' => 'swap_horiz', 'route' => 'emprunts.gestion', 'active' => in_array($current, ['emprunts.gestion', 'emprunts.valider', 'emprunts.refuser', 'emprunts.retour'])];
    }

    if ($u && $u->role === 'admin') {
        $navItems[] = ['label' => 'Utilisateurs', 'icon' => 'group', 'route' => 'admin.utilisateurs', 'active' => in_array($current, ['admin.utilisateurs', 'admin.utilisateurs.role', 'admin.utilisateurs.destroy'])];
        $navItems[] = ['label' => 'Messages', 'icon' => 'mail', 'route' => 'admin.messages', 'active' => in_array($current, ['admin.messages', 'admin.messages.lu', 'admin.messages.destroy'])];
    }

    $footerItems = [
        ['label' => 'Mon profil', 'icon' => 'settings', 'route' => 'profile.edit', 'active' => in_array($current, ['profile.edit', 'profile.update', 'profile.photo', 'profile.photo.destroy'])],
        ['label' => 'Centre d\'aide', 'icon' => 'help', 'route' => 'aide', 'active' => $current === 'aide'],
    ];

    $activeLabel = 'Bienvenue';
    foreach (array_merge($navItems, $footerItems) as $item) {
        if ($item['active']) {
            $activeLabel = $item['label'];
            break;
        }
    }
@endphp
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
          "tertiary": "#002141", "success": "#137333", "success-container": "#e6f4ea",
          "on-success-container": "#155724"
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
<style> body { font-family: 'Inter', sans-serif; }
::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #c4c6cf; border-radius: 4px; }
</style>
</head>
<body class="bg-background text-on-background font-body-md antialiased min-h-screen">
<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    <div x-show="sidebarOpen" x-transition:opacity @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-30 lg:hidden" x-cloak></div>

    <aside class="bg-primary text-on-primary fixed top-0 left-0 h-screen w-[260px] flex flex-col shadow-xl z-40 transition-transform duration-300 -translate-x-full lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="px-md mb-xl flex flex-col items-center text-center gap-sm mt-lg">
            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-on-primary/30 flex items-center justify-center bg-primary-fixed-variant">
                @if ($u->photo_url)
                    <img src="{{ $u->photo_url }}" alt="{{ $u->name }}" class="w-full h-full object-cover">
                @else
                    <span class="font-headline-md text-headline-md text-on-primary font-bold">{{ $u->initials }}</span>
                @endif
            </div>
            <div>
                <h2 class="font-headline-md text-headline-md leading-tight">{{ $u->name }}</h2>
                <p class="font-label-sm text-label-sm text-on-primary/70">{{ $u->role_label }}</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto flex flex-col gap-xs px-xs">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="{{
                       $item['active']
                           ? 'bg-secondary-container text-on-secondary-container rounded-lg font-bold flex items-center px-4 py-3 mx-2'
                           : 'text-on-primary/80 flex items-center px-4 py-3 mx-2 hover:bg-on-primary/10 transition-all'
                   }} @if ($item['active']) font-bold @endif">
                    <span class="material-symbols-outlined mr-sm" style="{{ $item['active'] ? 'font-variation-settings: \'FILL\' 1;' : '' }}">{{ $item['icon'] }}</span>
                    <span class="font-label-sm text-label-sm">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="px-md mt-auto mb-lg">
            <a href="{{ route('catalogue') }}" class="w-full flex items-center justify-center gap-sm bg-on-primary text-primary font-label-sm text-label-sm py-sm px-md rounded hover:bg-surface-container-low transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">add</span> Demander un livre
            </a>
        </div>

        <div class="flex flex-col gap-xs px-xs border-t border-on-primary/10 pt-sm pb-lg">
            @foreach ($footerItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="{{ $item['active'] ? 'text-on-primary font-bold' : 'text-on-primary/70' }} flex items-center px-4 py-3 mx-2 hover:bg-on-primary/10 hover:text-on-primary transition-all">
                    <span class="material-symbols-outlined mr-sm">{{ $item['icon'] }}</span>
                    <span class="font-label-sm text-label-sm">{{ $item['label'] }}</span>
                </a>
            @endforeach
            <a href="#" @click.prevent="$store.confirm.ask({ title: 'Se déconnecter ?', message: 'Voulez-vous vraiment vous déconnecter de votre session Agora ?', action: '{{ route('logout') }}', method: 'POST', confirmLabel: 'Se déconnecter' })" class="text-on-primary/70 hover:text-on-primary flex items-center px-4 py-3 mx-2 hover:bg-on-primary/10 transition-all">
                <span class="material-symbols-outlined mr-sm">logout</span>
                <span class="font-label-sm text-label-sm">Déconnexion</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 lg:ml-[260px] min-h-screen flex flex-col bg-background relative">
        <header class="h-16 px-xl flex justify-between items-center border-b border-surface-variant bg-surface-container-lowest/80 backdrop-blur-md sticky top-0 z-20">
            <div class="flex items-center gap-md">
                <button @click="sidebarOpen = ! sidebarOpen" class="lg:hidden p-sm text-primary hover:bg-surface-container rounded-lg transition-colors" aria-label="Menu">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div>
                    <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider">{{ $u->role_label }}</p>
                    <h1 class="font-headline-md text-headline-md text-primary leading-tight">{{ $activeLabel }}</h1>
                </div>
            </div>
            <div x-data="{ open: false }" class="relative">
                <button @click="open = ! open" class="flex items-center gap-sm bg-surface-container-low rounded-full px-md py-sm border border-outline-variant hover:bg-surface-container-high transition-colors">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-primary-fixed flex items-center justify-center">
                        @if ($u->photo_url)
                            <img src="{{ $u->photo_url }}" alt="{{ $u->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-[12px] font-bold text-primary">{{ $u->initials }}</span>
                        @endif
                    </div>
                    <span class="hidden sm:inline font-label-sm text-label-sm text-on-surface">{{ $u->name }}</span>
                    <span class="material-symbols-outlined text-[16px] text-secondary" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" @click.outside="open = false" x-cloak class="absolute right-0 mt-2 w-56 bg-surface-container-lowest border border-outline-variant rounded-lg shadow-lg overflow-hidden z-50" style="display:none;">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-sm px-md py-sm text-body-md text-on-surface hover:bg-surface-container-low">
                        <span class="material-symbols-outlined text-[18px] text-secondary">settings</span> Mon profil
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-sm px-md py-sm text-body-md text-on-surface hover:bg-surface-container-low">
                        <span class="material-symbols-outlined text-[18px] text-secondary">space_dashboard</span> Tableau de bord
                    </a>
                    <a href="#" @click.prevent="$store.confirm.ask({ title: 'Se déconnecter ?', message: 'Voulez-vous vraiment vous déconnecter de votre session Agora ?', action: '{{ route('logout') }}', method: 'POST', confirmLabel: 'Se déconnecter' })" class="flex items-center gap-sm px-md py-sm text-body-md text-error hover:bg-error-container">
                        <span class="material-symbols-outlined text-[18px]">logout</span> Déconnexion
                    </a>
                </div>
            </div>
        </header>

        <div class="flex-grow">
            @yield('content')
        </div>

        <footer class="bg-surface border-t border-outline-variant py-md">
            <div class="max-w-container-max mx-auto px-lg flex flex-col md:flex-row justify-between items-center gap-sm">
                <p class="font-body-md text-body-md text-secondary">Bibliothèque universitaire — &copy; {{ date('Y') }} Agora</p>
                <p class="font-body-md text-body-md text-secondary">Campus Universitaire d'Abomey-Calavi, Bénin</p>
            </div>
        </footer>
    </main>
</div>

<div x-data>
    <div x-show="$store.confirm.open" x-transition:opacity class="fixed inset-0 z-[60] flex items-center justify-center p-md" x-cloak style="display:none;">
        <div class="absolute inset-0 bg-black/50" @click="$store.confirm.cancel()"></div>
        <div class="relative bg-surface-container-lowest rounded-xl shadow-xl max-w-md w-full p-lg">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-sm" x-text="$store.confirm.title"></h3>
            <p class="font-body-md text-body-md text-on-surface-variant mb-lg" x-text="$store.confirm.message"></p>
            <div class="flex justify-end gap-md">
                <button @click="$store.confirm.cancel()" class="bg-surface-container-low text-on-surface font-label-sm text-label-sm py-sm px-lg rounded-lg hover:bg-surface-container-high transition-colors">Annuler</button>
                <button @click="$store.confirm.confirm()" :disabled="$store.confirm.submitting" class="bg-error text-on-error font-label-sm text-label-sm font-bold py-sm px-lg rounded-lg hover:bg-error-container transition-colors disabled:opacity-60">
                    <span x-show="$store.confirm.submitting" class="inline-block w-3 h-3 border-2 border-on-error border-t-transparent rounded-full animate-spin align-middle mr-xs"></span>
                    <span x-text="$store.confirm.confirmLabel"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', function () {
        Alpine.store('confirm', {
            open: false,
            submitting: false,
            title: 'Êtes-vous sûr ?',
            message: 'Cette action est irréversible.',
            action: '',
            method: 'POST',
            confirmLabel: 'Confirmer',
            ask: function (config) {
                this.title = config.title || 'Êtes-vous sûr ?';
                this.message = config.message || 'Cette action est irréversible.';
                this.action = config.action;
                this.method = config.method || 'POST';
                this.confirmLabel = config.confirmLabel || 'Confirmer';
                this.open = true;
            },
            cancel: function () {
                this.open = false;
            },
            confirm: function () {
                var self = this;
                this.submitting = true;
                var data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                if (this.method !== 'POST') {
                    data.append('_method', this.method);
                }
                fetch(this.action, {
                    method: 'POST',
                    body: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(function (resp) {
                    if (resp.redirected) {
                        window.location.href = resp.url;
                    } else {
                        window.location.reload();
                    }
                }).catch(function () {
                    self.submitting = false;
                    self.open = false;
                });
            }
        });
    });
</script>

<style>[x-cloak] { display: none !important; }</style>
</body>
</html>