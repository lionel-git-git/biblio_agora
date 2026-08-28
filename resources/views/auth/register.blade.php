<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Agora - Créer un compte</title>
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
                    "secondary-container": "#d5e0f7",
                    "outline-variant": "#c4c6cf",
                    "on-error-container": "#93000a",
                    "background": "#faf9fd",
                    "error-container": "#ffdad6",
                    "on-error": "#ffffff",
                    "surface-container-lowest": "#ffffff",
                    "surface-variant": "#e3e2e6",
                    "on-surface": "#1a1c1e",
                    "primary-fixed": "#d6e3ff",
                    "primary-container": "#1a365d",
                    "primary": "#002045",
                    "on-primary": "#ffffff",
                    "on-surface-variant": "#43474e",
                    "outline": "#74777f",
                    "error": "#ba1a1a"
                },
                "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                "spacing": { "gutter": "20px", "lg": "24px", "xl": "48px", "base": "4px", "md": "16px", "sm": "8px", "xs": "4px" },
                "fontFamily": { "label-sm": ["Inter"], "display": ["Inter"], "body-md": ["Inter"], "body-lg": ["Inter"], "headline-md": ["Inter"], "headline-lg": ["Inter"] },
                "fontSize": {
                    "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                    "display": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                    "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                    "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                    "headline-lg": ["28px", { "lineHeight": "36px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
                }
            }
        }
    }
</script>
<style>
    .texture-bg {
        background-color: #faf9fd;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231a365d' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>
</head>
<body class="texture-bg min-h-screen flex items-center justify-center p-md md:p-lg antialiased text-on-surface">
<div class="w-full max-w-[1000px] bg-surface-container-lowest rounded-xl shadow-[0_10px_15px_rgba(26,54,93,0.1)] border border-surface-variant overflow-hidden flex flex-col md:flex-row">

    <div class="bg-primary-container p-xl flex flex-col justify-between w-full md:w-5/12 text-on-primary">
        <div>
            <div class="flex items-center gap-sm mb-xl">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                <h1 class="font-headline-lg text-headline-lg font-bold">Agora</h1>
            </div>
            <h2 class="font-display text-display mb-md">Rejoignez-nous</h2>
            <p class="font-body-lg text-body-lg text-on-primary/80 mb-xl">Créez votre compte pour accéder au catalogue complet, réserver des ouvrages et suivre vos emprunts en toute simplicité.</p>
            <div class="space-y-md">
                <div class="flex items-start gap-md">
                    <div class="bg-on-primary/10 p-sm rounded-lg"><span class="material-symbols-outlined">school</span></div>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-sm">Étudiants</h3>
                        <p class="font-body-md text-body-md text-on-primary/70 text-xs">Inscrivez-vous avec votre email universitaire.</p>
                    </div>
                </div>
                <div class="flex items-start gap-md">
                    <div class="bg-on-primary/10 p-sm rounded-lg"><span class="material-symbols-outlined">verified_user</span></div>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-sm">Sécurisé</h3>
                        <p class="font-body-md text-body-md text-on-primary/70 text-xs">Vos données sont protégées et confidentielles.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-xl pt-lg border-t border-on-primary/20">
            <p class="font-label-sm text-label-sm text-on-primary/60">© 2026 Agora Academic.</p>
        </div>
    </div>

    <div class="p-xl w-full md:w-7/12 flex flex-col justify-center">
        <div class="max-w-[400px] mx-auto w-full">
            <div class="mb-lg text-center md:text-left">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-sm">Créer un compte</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Remplissez le formulaire pour commencer.</p>
            </div>

            @if ($errors->any())
                <div class="mb-md p-sm bg-error-container text-on-error-container rounded-lg text-body-md">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form class="space-y-md" method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="name">Nom complet</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">person</span>
                        </div>
                        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface placeholder:text-outline/70"
                               id="name" name="name" placeholder="Jean Dupont" required type="text" value="{{ old('name') }}" autofocus>
                    </div>
                </div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="email">Adresse Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">mail</span>
                        </div>
                        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface placeholder:text-outline/70"
                               id="email" name="email" placeholder="john.doe@email.com" required type="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div>
    <label class="block font-label-sm text-label-sm text-on-surface dark:text-gray-200 mb-xs" for="sexe">Sexe</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
            <span class="material-symbols-outlined text-outline dark:text-gray-500">wc</span>
        </div>
        <select class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest dark:bg-[#26282e] border border-outline-variant dark:border-[#3a3d44] rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface dark:text-gray-100"
                id="sexe" name="sexe" required>
            <option value="" disabled selected>Sélectionnez...</option>
            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
        </select>
    </div>
</div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="password">Mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">lock</span>
                        </div>
                        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                               id="password" name="password" placeholder="••••••••" required type="password">
                    </div>
                </div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface mb-xs" for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-sm flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">lock</span>
                        </div>
                        <input class="block w-full pl-xl pr-sm py-sm font-body-md text-body-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-on-surface"
                               id="password_confirmation" name="password_confirmation" placeholder="••••••••" required type="password">
                    </div>
                </div>
                <button class="w-full flex justify-center items-center gap-sm py-sm px-md border border-transparent rounded-lg shadow-sm font-label-sm text-label-sm text-on-primary bg-primary-container hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors mt-lg"
                        type="submit">
                    Créer mon compte
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </form>

            <div class="mt-xl text-center">
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Déjà un compte ?
                    <a class="font-label-sm text-label-sm text-primary hover:text-primary-container transition-colors ml-xs" href="{{ route('login') }}">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>