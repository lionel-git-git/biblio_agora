@extends('layouts.public')

@section('title', 'Aide - Agora')

@section('content')
<div x-data="{ q: '' }">
    <section class="text-center py-xl px-gutter md:px-xl">
        <h1 class="font-display text-display md:text-[48px] font-bold text-primary mb-sm">Centre d'aide</h1>
        <p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto mb-lg">Comment pouvons-nous vous aider aujourd'hui ? Parcourez nos catégories ou utilisez la barre de recherche ci-dessous.</p>
        <div class="max-w-xl mx-auto relative">
            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline-variant text-[24px]">search</span>
            <input x-model="q" class="w-full pl-[56px] pr-lg py-[16px] rounded-full border border-outline-variant bg-surface-container-lowest shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none text-body-lg transition-all" placeholder="Rechercher une réponse (ex: 'renouveler un livre')" type="text">
        </div>
    </section>

    <section x-show="q === ''" x-transition class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-md px-gutter md:px-xl max-w-container-max mx-auto mb-xl">
        <a class="group bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-all flex flex-col items-start gap-md" href="#compte">
            <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined">manage_accounts</span>
            </div>
            <div>
                <h3 class="font-headline-md text-headline-md text-primary mb-xs group-hover:text-primary-container transition-colors">Mon Compte</h3>
                <p class="font-body-md text-body-md text-secondary">Gestion du profil, mots de passe, amendes.</p>
            </div>
        </a>
        <a class="group bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-all flex flex-col items-start gap-md" href="#emprunts">
            <div class="w-12 h-12 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                <span class="material-symbols-outlined">book</span>
            </div>
            <div>
                <h3 class="font-headline-md text-headline-md text-primary mb-xs group-hover:text-primary-container transition-colors">Emprunts &amp; Retours</h3>
                <p class="font-body-md text-body-md text-secondary">Règles, durées, renouvellements.</p>
            </div>
        </a>
        <a class="group bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-all flex flex-col items-start gap-md" href="#ressources">
            <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors">
                <span class="material-symbols-outlined">devices</span>
            </div>
            <div>
                <h3 class="font-headline-md text-headline-md text-primary mb-xs group-hover:text-primary-container transition-colors">Ressources Numériques</h3>
                <p class="font-body-md text-body-md text-secondary">Accès aux bases de données, e-books.</p>
            </div>
        </a>
        <a class="group bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md transition-all flex flex-col items-start gap-md" href="#guide">
            <div class="w-12 h-12 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant group-hover:bg-on-surface-variant group-hover:text-surface transition-colors">
                <span class="material-symbols-outlined">menu_book</span>
            </div>
            <div>
                <h3 class="font-headline-md text-headline-md text-primary mb-xs group-hover:text-primary-container transition-colors">Guide d'utilisation</h3>
                <p class="font-body-md text-body-md text-secondary">Comment utiliser Agora efficacement.</p>
            </div>
        </a>
    </section>

    <section class="max-w-3xl mx-auto px-gutter md:px-xl pb-xl">
        <h2 class="font-headline-lg text-headline-lg font-bold text-primary mb-lg border-b border-outline-variant pb-sm">Questions Fréquemment Posées</h2>
        <div class="flex flex-col gap-sm">

            <div id="emprunts" x-show="q === '' || $el.textContent.toLowerCase().includes(q.toLowerCase())" x-transition class="bg-surface-container-lowest border border-outline-variant rounded-lg shadow-sm overflow-hidden">
                <button class="w-full text-left px-lg py-md flex justify-between items-center focus:outline-none hover:bg-surface-container-low transition-colors" @click="open = !open" x-data="{ open: false }">
                    <span class="font-headline-md text-headline-md text-primary">Comment puis-je renouveler un livre ?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition class="px-lg bg-surface border-t border-outline-variant py-md">
                    <p class="font-body-md text-body-md text-on-surface-variant">Pour renouveler un livre, connectez-vous à votre compte, accédez à la section "Mes Emprunts", sélectionnez le ou les livres que vous souhaitez renouveler, puis cliquez sur le bouton "Renouveler". Notez qu'un livre ne peut être renouvelé si un autre usager l'a réservé.</p>
                </div>
            </div>

            <div id="compte" x-show="q === '' || $el.textContent.toLowerCase().includes(q.toLowerCase())" x-transition class="bg-surface-container-lowest border border-outline-variant rounded-lg shadow-sm overflow-hidden">
                <button class="w-full text-left px-lg py-md flex justify-between items-center focus:outline-none hover:bg-surface-container-low transition-colors" @click="open = !open" x-data="{ open: false }">
                    <span class="font-headline-md text-headline-md text-primary">Que faire si j'ai perdu mon mot de passe ?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition class="px-lg bg-surface border-t border-outline-variant py-md">
                    <p class="font-body-md text-body-md text-on-surface-variant">Cliquez sur "Mot de passe oublié" sur la page de connexion. Entrez votre adresse e-mail universitaire, et un lien de réinitialisation vous sera envoyé. Si vous ne recevez pas l'e-mail, veuillez contacter le bureau d'aide.</p>
                </div>
            </div>

            <div id="ressources" x-show="q === '' || $el.textContent.toLowerCase().includes(q.toLowerCase())" x-transition class="bg-surface-container-lowest border border-outline-variant rounded-lg shadow-sm overflow-hidden">
                <button class="w-full text-left px-lg py-md flex justify-between items-center focus:outline-none hover:bg-surface-container-low transition-colors" @click="open = !open" x-data="{ open: false }">
                    <span class="font-headline-md text-headline-md text-primary">Combien de documents puis-je emprunter simultanément ?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition class="px-lg bg-surface border-t border-outline-variant py-md">
                    <p class="font-body-md text-body-md text-on-surface-variant">Les étudiants de premier cycle peuvent emprunter jusqu'à 15 documents. Les étudiants des cycles supérieurs et le personnel enseignant peuvent emprunter jusqu'à 30 documents. Les revues et le matériel multimédia peuvent avoir des limites spécifiques.</p>
                </div>
            </div>

            <div id="guide" x-show="q === '' || $el.textContent.toLowerCase().includes(q.toLowerCase())" x-transition class="bg-surface-container-lowest border border-outline-variant rounded-lg shadow-sm overflow-hidden">
                <button class="w-full text-left px-lg py-md flex justify-between items-center focus:outline-none hover:bg-surface-container-low transition-colors" @click="open = !open" x-data="{ open: false }">
                    <span class="font-headline-md text-headline-md text-primary">Comment demander l'emprunt d'un livre sur Agora ?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition class="px-lg bg-surface border-t border-outline-variant py-md">
                    <p class="font-body-md text-body-md text-on-surface-variant">Connectez-vous à votre compte, parcourez le <a href="{{ route('catalogue') }}" class="text-primary font-bold hover:underline">catalogue</a> et cliquez sur "Demander l'emprunt" sur la fiche du livre souhaité. Votre demande sera examinée par un bibliothécaire ; vous recevrez une confirmation dès qu'elle sera validée. Suivez l'état de vos demandes dans la section "Mes Emprunts" de votre tableau de bord.</p>
                </div>
            </div>

            <div id="contact" x-show="q === '' || $el.textContent.toLowerCase().includes(q.toLowerCase())" x-transition class="bg-surface-container-lowest border border-outline-variant rounded-lg shadow-sm overflow-hidden">
                <button class="w-full text-left px-lg py-md flex justify-between items-center focus:outline-none hover:bg-surface-container-low transition-colors" @click="open = !open" x-data="{ open: false }">
                    <span class="font-headline-md text-headline-md text-primary">Comment contacter la bibliothèque ?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition class="px-lg bg-surface border-t border-outline-variant py-md">
                    <p class="font-body-md text-body-md text-on-surface-variant">Rendez-vous sur la <a href="{{ route('contact') }}" class="text-primary font-bold hover:underline">page de contact</a> pour envoyer un message à notre équipe, ou passez directement au bureau d'accueil de la bibliothèque sur le Campus Universitaire d'Abomey-Calavi, Bénin.</p>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection