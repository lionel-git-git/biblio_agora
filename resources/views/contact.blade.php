@extends('layouts.public')

@section('title', 'Contact - Agora')

@section('content')
<div class="py-xl px-gutter md:px-xl max-w-container-max mx-auto w-full">
    <header class="mb-xl">
        <h1 class="font-display text-display text-primary mb-xs">Contactez-nous</h1>
        <p class="font-body-lg text-body-lg text-secondary max-w-2xl">
            Notre équipe est à votre disposition pour répondre à toutes vos questions concernant la bibliothèque, nos collections ou vos emprunts.
        </p>
    </header>

    @if (session('success'))
        <div class="mb-lg bg-success-container border border-[#ceead6] text-on-success-container rounded-lg px-md py-sm font-body-md text-body-md">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-lg bg-error-container border border-[#ffb4ab] text-on-error-container rounded-lg px-md py-sm font-body-md text-body-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none" id="email" name="email" value="{{ old('email') }}" placeholder="jean.dupont@universite.bj" type="email">
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
            <div class="bg-primary-container text-on-primary rounded-xl p-lg shadow-md">
                <h3 class="font-headline-md text-headline-md text-on-primary mb-md">Coordonnées</h3>
                <div class="space-y-md">
                    <div class="flex items-start">
                        <span class="material-symbols-outlined mr-md mt-xs text-inverse-primary">location_on</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-inverse-primary">Adresse</p>
                            <p class="font-body-md text-body-md text-on-primary mt-xs">Campus Universitaire d'Abomey-Calavi<br>Abomey-Calavi, Bénin</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="material-symbols-outlined mr-md mt-xs text-inverse-primary">phone</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-inverse-primary">Téléphone</p>
                            <p class="font-body-md text-body-md text-on-primary mt-xs">+229 01 63 45 67 89 / +229 01 63 45 64 87</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="material-symbols-outlined mr-md mt-xs text-inverse-primary">mail</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-inverse-primary">Email</p>
                            <p class="font-body-md text-body-md text-on-primary mt-xs">contact@agora.bj</p>
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
            </div>

            <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant flex-1 min-h-[220px]">
                <iframe
                    src="https://www.google.com/maps?q=Universite+d%27Abomey-Calavi,Benin&output=embed"
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
@endsection