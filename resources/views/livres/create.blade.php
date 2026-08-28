<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Agora - Ajouter un livre</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "outline-variant": "#c4c6cf", "on-error-container": "#93000a", "background": "#faf9fd",
                    "error-container": "#ffdad6", "on-error": "#ffffff", "surface-container-lowest": "#ffffff",
                    "surface-variant": "#e3e2e6", "on-surface": "#1a1c1e", "primary-container": "#1a365d",
                    "primary": "#002045", "on-primary": "#ffffff", "on-surface-variant": "#43474e",
                    "outline": "#74777f", "error": "#ba1a1a", "surface": "#faf9fd",
                    "surface-container-low": "#f4f3f7", "success-container": "#d4edda", "on-success-container": "#155724"
                },
                "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                "spacing": { "gutter": "20px", "lg": "24px", "xl": "48px", "container-max": "1280px", "base": "4px", "md": "16px", "sm": "8px", "xs": "4px" },
                "fontFamily": { "label-sm": ["Inter"], "display": ["Inter"], "body-md": ["Inter"], "body-lg": ["Inter"], "headline-md": ["Inter"], "headline-lg": ["Inter"] },
                "fontSize": {
                    "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                    "display": ["30px", { "lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                    "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
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
    <a href="{{ route('bibliothecaire.dashboard') }}" class="flex items-center gap-sm text-secondary font-body-md hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        Retour au tableau de bord
    </a>
</div>
</header>

<main class="flex-grow py-xl px-lg">
<div class="max-w-2xl mx-auto">

    <div class="mb-lg">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-sm">Ajouter un livre</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Renseignez les informations du nouvel ouvrage à ajouter au catalogue.</p>
    </div>

    @if (session('success'))
        <div class="mb-md p-sm bg-success-container text-on-success-container rounded-lg text-body-md">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-md p-sm bg-error-container text-on-error-container rounded-lg text-body-md">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-xl">
        <form method="POST" action="{{ route('livres.store') }}" enctype="multipart/form-data" class="space-y-md">
            @csrf

            <div>
                <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="titre">Titre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-outline">title</span>
                    </div>
                    <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                           id="titre" name="titre" placeholder="Le titre du livre" required type="text" value="{{ old('titre') }}">
                </div>
            </div>

            <div>
                <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="auteur">Auteur</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-outline">person</span>
                    </div>
                    <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                           id="auteur" name="auteur" placeholder="Nom de l'auteur" required type="text" value="{{ old('auteur') }}">
                </div>
            </div>

            <div>
                <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="genre">Genre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-outline">category</span>
                    </div>
                    <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                           id="genre" name="genre" placeholder="Ex : Philosophie, Informatique..." required type="text" value="{{ old('genre') }}">
                </div>
            </div>

            <div>
                <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="description">Description</label>
                <div class="relative">
                    <div class="absolute top-sm left-0 pl-sm flex items-start pointer-events-none">
                        <span class="material-symbols-outlined text-outline">description</span>
                    </div>
                    <textarea class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                              id="description" name="description" rows="4" placeholder="Résumé ou description du livre">{{ old('description') }}</textarea>
                </div>
            </div>

           <div>
    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="langue">Langue</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
            <span class="material-symbols-outlined text-outline">language</span>
        </div>
        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
               id="langue" name="langue" placeholder="Français" type="text" value="{{ old('langue') }}">
    </div>
</div>
           

            <div>
                <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="quantite_totale">Nombre d'exemplaires</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-outline">inventory_2</span>
                    </div>
                    <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                           id="quantite_totale" name="quantite_totale" min="1" required type="number" value="{{ old('quantite_totale', 1) }}">
                </div>
            </div>

            <div>
                <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="image_couverture">Image de couverture</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-outline">image</span>
                    </div>
                    <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface file:mr-sm file:py-1 file:px-3 file:rounded file:border-0 file:bg-primary-container file:text-on-primary file:text-label-sm"
                           id="image_couverture" name="image_couverture" accept="image/*" type="file">
                </div>
            </div>

            <div class="flex gap-md pt-md">
                <button class="flex-1 flex justify-center items-center gap-sm py-sm px-md border border-transparent rounded-lg shadow-sm font-label-sm text-label-sm text-on-primary bg-primary-container hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors"
                        type="submit">
                    Ajouter le livre
                    <span class="material-symbols-outlined text-[18px]">add</span>
                </button>
                <a href="{{ route('bibliothecaire.dashboard') }}" class="flex justify-center items-center py-sm px-lg border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-low transition-colors">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
</main>
</body>
</html>