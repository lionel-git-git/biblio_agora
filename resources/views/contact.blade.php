<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Agora - Contact</title>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "on-surface-variant": "#43474e", "outline-variant": "#c4c6cf", "secondary-fixed": "#d8e3fa",
                    "surface-variant": "#e3e2e6", "primary": "#002045", "outline": "#74777f",
                    "on-background": "#1a1c1e", "background": "#faf9fd", "primary-container": "#1a365d",
                    "on-primary": "#ffffff", "surface-container": "#efedf1", "on-surface": "#1a1c1e",
                    "surface-container-low": "#f4f3f7", "surface-container-lowest": "#ffffff", "secondary": "#545f72",
                    "surface": "#faf9fd", "error": "#ba1a1a", "on-primary-container": "#86a0cd",
                    "inverse-primary": "#adc7f7", "surface-container-highest": "#e3e2e6", "surface-dim": "#dad9dd",
                    "on-secondary-container": "#586377", "secondary-container": "#d5e0f7", "primary-fixed": "#d6e3ff",
                    "primary-fixed-variant": "#2d476f"
                },
                borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                spacing: { "lg": "24px", "container-max": "1280px", "md": "16px", "xs": "4px", "base": "4px", "sm": "8px", "xl": "48px", "gutter": "20px" },
                fontFamily: { "body-lg": ["Inter", "sans-serif"], "body-md": ["Inter", "sans-serif"], "headline-lg": ["Inter", "sans-serif"], "headline-md": ["Inter", "sans-serif"], "display": ["Inter", "sans-serif"], "label-sm": ["Inter", "sans-serif"] },
                fontSize: {
                    "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                    "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                    "headline-lg": ["28px", { "lineHeight": "36px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                    "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                    "display": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                    "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }]
                }
            }
        }
    }
</script>
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col md:flex-row">

<header class="md:hidden bg-surface-container-lowest border-b border-outline-variant shadow-sm sticky top-0 z-50">
<div class="flex justify-between items-center max-w-container-max mx-auto px-lg h-16 w-full">
    <div class="font-display text-headline-md font-bold text-primary">Agora</div>
    <nav class="flex space-x-md">
        <a class="text-secondary font-medium font-label-sm text-label-sm hover:text-primary-container transition-colors" href="{{ route('catalogue') }}">Catalogue</a>
        <a class="text-secondary font-medium font-label-sm text-label-sm hover:text-primary-container transition-colors" href="#">Services</a>
        <a class="text-secondary font-medium font-label-sm text-label-sm hover:text-primary-container transition-colors" href="#">Aide</a>
        <a class="text-primary border-b-2 border-primary font-bold pb-1 font-label-sm text-label-sm" href="{{ route('contact') }}">Contact</a>
    </nav>
</div>
</header>

<aside class="hidden md:flex bg-primary flex-col py-lg w-[260px] h-screen sticky top-0 shadow-md shrink-0">
    <div class="px-lg mb-xl">
        <div class="font-display text-headline-md font-bold text-on-primary">Agora</div>
        <div class="text-on-primary opacity-80 font-label-sm text-label-sm mt-xs">Système de Réservations Académiques</div>
    </div>
    <nav class="flex-1 px-sm space-y-sm">
        <a class="flex items-center px-md py-sm text-on-primary opacity-80 hover:opacity-100 hover:bg-primary-fixed-variant transition-all rounded-lg font-label-sm text-label-sm" href="{{ route('catalogue') }}">
            <span class="material-symbols-outlined mr-md">library_books</span>Catalogue
        </a>
        <a class="flex items-center px-md py-sm text-on-primary opacity-80 hover:opacity-100 hover:bg-primary-fixed-variant transition-all rounded-lg font-label-sm text-label-sm" href="#">
            <span class="material-symbols-outlined mr-md">business_center</span>Services
        </a>
        <a class="flex items-center px-md py-sm text-on-primary opacity-80 hover:opacity-100 hover:bg-primary-fixed-variant transition-all rounded-lg font-label-sm text-label-sm" href="#">
            <span class="material-symbols-outlined mr-md">help_outline</span>Aide
        </a>
        <a class="flex items-center px-md py-sm bg-secondary-container text-on-secondary-container font-bold rounded-lg ml-2 border-l-4 border-on-secondary-container transition-all font-label-sm text-label-sm" href="{{ route('contact') }}">
            <span class="material-symbols-outlined mr-md fill">contact_support</span>Contact
        </a>
    </nav>
</aside>

<div class="flex-1 flex flex-col min-h-screen">
<main class="flex-1 p-lg md:p-xl max-w-container-max mx-auto w-full">
    <header class="mb-xl">
        <h1 class="font-display text-display text-primary mb-xs">Contactez-nous</h1>
        <p class="font-body-lg text-body-lg text-secondary max-w-2xl">
            Notre équipe est à votre disposition pour répondre à toutes vos questions concernant la bibliothèque, nos collections ou vos emprunts.
        </p>
    </header>

    @if (session('success'))
        <div class="mb-lg bg-[#e6f4ea] border border-[#ceead6] text-[#137333] rounded-lg px-md py-sm font-body-md text-body-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">

        <div class="lg:col-span-7 bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg md:p-xl">
            <h2 class="font-headline-md text-headline-md text-primary mb-md flex items-center">
                <span class="material-symbols-outlined mr-sm text-primary-container">mail</span>
                Envoyer un message
            </h2>

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-md">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="nom">Nom complet</label>
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Jean Dupont" type="text">
                        @error('nom') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="email">Adresse Email</label>
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none" id="email" name="email" value="{{ old('email') }}" placeholder="jean.dupont@universite.fr" type="email">
                        @error('email') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="objet">Objet</label>
                    <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none text-on-surface" id="objet" name="objet">
                        <option value="Question sur le catalogue" {{ old('objet') == 'Question sur le catalogue' ? 'selected' : '' }}>Question sur le catalogue</option>
                        <option value="Problème de connexion" {{ old('objet') == 'Problème de connexion' ? 'selected' : '' }}>Problème de connexion</option>
                        <option value="Demande de réservation spéciale" {{ old('objet') == 'Demande de réservation spéciale' ? 'selected' : '' }}>Demande de réservation spéciale</option>
                        <option value="Autre" {{ old('objet') == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('objet') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="message">Message</label>
                    <textarea class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none resize-none" id="message" name="message" placeholder="Comment pouvons-nous vous aider ?" rows="5">{{ old('message') }}</textarea>
                    @error('message') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                </div>
                <div class="pt-sm">
                    <button class="bg-primary text-on-primary font-label-sm text-label-sm font-bold py-md px-lg rounded-lg hover:bg-primary-container transition-colors shadow-sm w-full md:w-auto flex items-center justify-center" type="submit">
                        <span>Envoyer le message</span>
                        <span class="material-symbols-outlined ml-sm text-[18px]">send</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-5 flex flex-col gap-lg">
            <div class="bg-primary-container text-on-primary-container rounded-xl p-lg shadow-md">
                <h3 class="font-headline-md text-headline-md text-on-primary mb-md">Coordonnées</h3>
                <div class="space-y-md">
                    <div class="flex items-start">
                        <span class="material-symbols-outlined mr-md mt-xs text-inverse-primary">location_on</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-inverse-primary">Adresse</p>
                            <p class="font-body-md text-body-md text-on-primary mt-xs">12 Rue de l'Académie<br>75005 Paris, France</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="material-symbols-outlined mr-md mt-xs text-inverse-primary">phone</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-inverse-primary">Téléphone</p>
                            <p class="font-body-md text-body-md text-on-primary mt-xs">+229 01 63 45 67 89 /+229 01 63 45 64 87</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="material-symbols-outlined mr-md mt-xs text-inverse-primary">mail</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-inverse-primary">Email</p>
                            <p class="font-body-md text-body-md text-on-primary mt-xs">contact@agora-library.fr</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg">
                <h3 class="font-headline-md text-headline-md text-primary mb-md flex items-center">
                    <span class="material-symbols-outlined mr-sm text-secondary">schedule</span>
                    Horaires d'ouverture
                </h3>
                <ul class="space-y-sm">
                    <li class="flex justify-between items-center py-xs border-b border-surface-variant last:border-0">
                        <span class="font-body-md text-body-md text-on-surface-variant">Lundi - Vendredi</span>
                        <span class="font-label-sm text-label-sm text-primary font-bold">08:00 - 20:00</span>
                    </li>
                    <li class="flex justify-between items-center py-xs border-b border-surface-variant last:border-0">
                        <span class="font-body-md text-body-md text-on-surface-variant">Samedi</span>
                        <span class="font-label-sm text-label-sm text-primary font-bold">09:00 - 18:00</span>
                    </li>
                    <li class="flex justify-between items-center py-xs border-b border-surface-variant last:border-0">
                        <span class="font-body-md text-body-md text-on-surface-variant">Dimanche</span>
                        <span class="font-label-sm text-label-sm text-error font-bold">Fermé</span>
                    </li>
                </ul>
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant flex-1 min-h-[220px]">
                    <iframe
                       src="https://www.google.com/maps?q=super+marche+Elefan,Calavi,Benin&output=embed"
                        width="100%"
                        height="100%"
                       style="border:0; min-height: 220px;"
                       allowfullscreen=""
                       loading="lazy"
                       referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
</div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-surface-container-highest border-t border-outline-variant w-full mt-auto">
    <div class="max-w-container-max mx-auto px-lg py-md flex flex-col md:flex-row justify-between items-center w-full">
        <div class="font-display text-headline-md font-bold text-primary mb-md md:mb-0">Agora</div>
        <div class="text-secondary font-body-md text-body-md text-center md:text-right">© 2026 Agora. Tous droits réservés.</div>
    </div>
</footer>
</div>
</body>
</html>