<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Catalogue - Agora</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "outline-variant": "#c4c6cf", "background": "#faf9fd", "surface-container-lowest": "#ffffff",
                    "surface-variant": "#e3e2e6", "on-surface": "#1a1c1e", "primary-container": "#1a365d",
                    "primary": "#002045", "on-primary": "#ffffff", "on-surface-variant": "#43474e",
                    "outline": "#74777f", "surface": "#faf9fd", "surface-container-low": "#f4f3f7",
                    "surface-container-high": "#e9e7eb", "surface-container-highest": "#e3e2e6", "secondary": "#545f72"
                },
                "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                "spacing": { "gutter": "20px", "lg": "24px", "xl": "48px", "container-max": "1280px", "base": "4px", "md": "16px", "sm": "8px", "xs": "4px" },
                "fontFamily": { "label-sm": ["Inter"], "display": ["Inter"], "body-md": ["Inter"], "headline-md": ["Inter"] },
                "fontSize": {
                    "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                    "display": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                    "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                    "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }]
                }
            }
        }
    }
</script>
<style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">

<header class="bg-surface shadow-sm border-b border-outline-variant sticky top-0 z-50">
<div class="flex justify-between items-center w-full px-lg py-md max-w-container-max mx-auto">
    <a class="text-headline-md font-headline-md font-bold text-primary" href="{{ url('/') }}">Agora</a>
    <nav class="hidden md:flex items-center gap-lg">
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ url('/') }}">Accueil</a>
        <a class="text-primary border-b-2 border-primary font-bold pb-1" href="{{ route('catalogue') }}">Catalogue</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="#">Services</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="#">Aide</a>
        <a class="text-secondary font-body-md hover:text-primary transition-colors" href="{{ route('contact') }}">Contact</a>
    </nav>
    <a href="{{ route('login') }}" class="bg-primary-container text-on-primary rounded px-md py-sm font-label-sm text-label-sm hover:bg-primary transition-colors">Connexion</a>
</div>
</header>

<main class="flex-grow w-full max-w-container-max mx-auto px-lg py-xl flex flex-col md:flex-row gap-xl">

    <aside class="w-full md:w-[240px] flex-shrink-0">
        <form method="GET" action="{{ route('catalogue') }}" class="bg-surface-container-lowest border border-outline-variant rounded p-lg shadow-sm">
            <h3 class="font-headline-md text-headline-md text-primary mb-md pb-sm border-b border-surface-container-high">Filtres</h3>

            <div class="mb-lg">
                <label class="block font-label-sm text-label-sm text-secondary mb-sm">Rechercher</label>
                <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Titre, auteur..."
                       class="w-full border border-outline-variant rounded px-sm py-sm font-body-md text-body-md focus:ring-2 focus:ring-primary focus:border-primary outline-none">
            </div>

            <div class="mb-lg">
                <h4 class="font-label-sm text-label-sm text-secondary mb-sm">Genre</h4>
                <div class="flex flex-col gap-2">
                    <label class="flex items-center gap-2 cursor-pointer font-body-md text-body-md text-on-surface">
                        <input type="radio" name="genre" value="" {{ !request('genre') ? 'checked' : '' }} class="text-primary focus:ring-primary" onchange="this.form.submit()">
                        Tous
                    </label>
                    @foreach ($genres as $genre)
                        <label class="flex items-center gap-2 cursor-pointer font-body-md text-body-md text-on-surface">
                            <input type="radio" name="genre" value="{{ $genre }}" {{ request('genre') == $genre ? 'checked' : '' }} class="text-primary focus:ring-primary" onchange="this.form.submit()">
                            {{ $genre }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-lg">
                <h4 class="font-label-sm text-label-sm text-secondary mb-sm">Disponibilité</h4>
                <div class="flex flex-col gap-2">
                    <label class="flex items-center gap-2 cursor-pointer font-body-md text-body-md text-on-surface">
                        <input type="radio" name="disponibilite" value="" {{ !request('disponibilite') ? 'checked' : '' }} class="text-primary focus:ring-primary" onchange="this.form.submit()">
                        Tous
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer font-body-md text-body-md text-on-surface">
                        <input type="radio" name="disponibilite" value="disponible" {{ request('disponibilite') == 'disponible' ? 'checked' : '' }} class="text-primary focus:ring-primary" onchange="this.form.submit()">
                        Disponible
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer font-body-md text-body-md text-on-surface">
                        <input type="radio" name="disponibilite" value="emprunte" {{ request('disponibilite') == 'emprunte' ? 'checked' : '' }} class="text-primary focus:ring-primary" onchange="this.form.submit()">
                        Emprunté
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary-container text-on-primary rounded px-md py-sm font-label-sm text-label-sm hover:bg-primary transition-colors mb-sm">Filtrer</button>
            <a href="{{ route('catalogue') }}" class="w-full block text-center bg-surface-container-low text-primary border border-outline-variant rounded px-md py-sm font-label-sm text-label-sm hover:bg-surface-container-highest transition-colors">Réinitialiser</a>
        </form>
    </aside>

    <section class="flex-grow flex flex-col gap-lg">
        <div class="flex justify-between items-end mb-md">
            <div>
                <h1 class="font-display text-display text-primary">Catalogue</h1>
                <p class="font-body-md text-body-md text-secondary mt-1">
                    Affichage de {{ $livres->firstItem() ?? 0 }} à {{ $livres->lastItem() ?? 0 }} sur {{ $livres->total() }} résultats
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-lg">
            @forelse ($livres as $livre)
            <article class="bg-surface-container-lowest rounded border border-surface-container-highest shadow-sm hover:shadow-lg transition-shadow duration-200 overflow-hidden flex flex-col h-full relative">
                <div class="absolute top-2 right-2 z-10 font-label-sm text-label-sm px-2 py-1 rounded-full flex items-center gap-1 shadow-sm
                    {{ $livre->quantite_disponible > 0 ? 'bg-[#e6f4ea] text-[#137333] border border-[#ceead6]' : 'bg-surface-container-high text-secondary border border-outline-variant' }}">
                    <span class="material-symbols-outlined text-[14px]">{{ $livre->quantite_disponible > 0 ? 'check_circle' : 'schedule' }}</span>
                    {{ $livre->quantite_disponible > 0 ? 'Disponible' : 'Emprunté' }}
                </div>
                <div class="aspect-[2/3] w-full bg-surface-container-highest overflow-hidden flex items-center justify-center">
                    @if ($livre->image_couverture)
                        <img src="{{ asset('storage/' . $livre->image_couverture) }}" alt="{{ $livre->titre }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-6xl text-outline-variant">menu_book</span>
                    @endif
                </div>
                <div class="p-md flex flex-col flex-grow">
                    <span class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-1">{{ $livre->genre }}</span>
                    <h2 class="font-headline-md text-headline-md text-primary leading-tight mb-xs line-clamp-2">{{ $livre->titre }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-md flex-grow">{{ $livre->auteur }}</p>
                    <button class="w-full bg-surface-container-low text-primary border border-outline-variant rounded px-sm py-sm font-label-sm text-label-sm hover:bg-surface-container-highest transition-colors mt-auto">
                        Voir détails
                    </button>
                </div>
            </article>
            @empty
            <p class="col-span-full text-center text-on-surface-variant py-xl">Aucun livre ne correspond à votre recherche.</p>
            @endforelse
        </div>

        <div class="flex justify-center mt-xl">
            {{ $livres->links() }}
        </div>
    </section>
</main>
</body>
</html>