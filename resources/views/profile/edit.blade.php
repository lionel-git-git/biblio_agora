@extends('layouts.site')

@section('title', 'Mon profil - Agora')

@section('content')
<div class="max-w-container-max mx-auto px-gutter md:px-xl py-xl flex flex-col gap-lg">

    <header class="mb-sm">
        <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Mon espace</p>
        <h1 class="font-display text-display text-primary mb-xs">Mon profil</h1>
        <p class="font-body-lg text-body-lg text-secondary max-w-2xl">Gérez votre photo de profil, vos informations personnelles, votre mot de passe et votre compte.</p>
    </header>

    @if (session('status') === 'profile-updated')
        <div class="bg-success-container border border-[#ceead6] text-on-success-container rounded-lg px-md py-sm font-body-md text-body-md">Vos informations ont bien été enregistrées.</div>
    @elseif (session('status') === 'photo-updated')
        <div class="bg-success-container border border-[#ceead6] text-on-success-container rounded-lg px-md py-sm font-body-md text-body-md">Votre photo de profil a bien été mise à jour.</div>
    @elseif (session('status') === 'password-updated')
        <div class="bg-success-container border border-[#ceead6] text-on-success-container rounded-lg px-md py-sm font-body-md text-body-md">Votre mot de passe a bien été modifié.</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">

        <div class="lg:col-span-8 flex flex-col gap-lg">

            <section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg md:p-xl">
                <h2 class="font-headline-md text-headline-md text-primary mb-md flex items-center">
                    <span class="material-symbols-outlined mr-sm text-primary-container">account_circle</span>
                    Photo de profil
                </h2>
                <div class="flex flex-col md:flex-row items-center gap-lg">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-full overflow-hidden bg-primary-fixed flex items-center justify-center shadow-md shrink-0">
                        @if ($user->photo_url)
                            <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="font-display text-display text-primary">{{ $user->initials }}</span>
                        @endif
                    </div>
                    <div class="w-full md:flex-1 flex flex-col gap-md">
                        <form method="POST" action="{{ route('profile.photo') }}" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-md items-start sm:items-center">
                            @csrf
                            <label class="w-full sm:w-auto cursor-pointer bg-surface-container-low border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm text-on-surface hover:bg-surface-container-high transition-colors">
                                <span class="flex items-center gap-sm">
                                    <span class="material-symbols-outlined text-[18px] text-secondary">upload</span>
                                    Choisir une image
                                </span>
                                <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()">
                            </label>
                            <button type="submit" class="bg-primary text-on-primary font-label-sm text-label-sm font-bold py-sm px-lg rounded-lg hover:bg-tertiary transition-colors shadow-sm">
                                Mettre à jour
                            </button>
                        </form>
                        @error('photo')
                            <p class="text-error font-label-sm text-label-sm">{{ $message }}</p>
                        @enderror
                        <p class="font-body-md text-body-md text-on-surface-variant">Formats acceptés : JPG, PNG, WebP (2 Mo max). Votre photo apparaîtra sur la barre latérale et le tableau de bord.</p>
                        @if ($user->photo)
                            <form method="POST" action="{{ route('profile.photo.destroy') }}" onsubmit="return confirm('Supprimer votre photo de profil ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-sm font-label-sm text-label-sm text-error hover:underline">
                                    <span class="material-symbols-outlined text-[18px]">delete</span> Supprimer la photo
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </section>

            <section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg md:p-xl">
                <h2 class="font-headline-md text-headline-md text-primary mb-md flex items-center">
                    <span class="material-symbols-outlined mr-sm text-primary-container">badge</span>
                    Informations personnelles
                </h2>
                <form method="post" action="{{ route('profile.update') }}" class="space-y-md">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="name">Nom complet</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            @error('name') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="email">Adresse email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            @error('email') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="bg-[#fff4e0] border border-[#f7d9a0] text-[#7a5200] rounded-lg px-md py-sm">
                            <p class="font-body-md text-body-md">Votre adresse email n'est pas vérifiée.
                                <button form="send-verification" class="underline font-bold hover:opacity-80">Renvoyer l'email de vérification</button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="font-body-md text-body-md mt-xs text-success">Un nouveau lien de vérification a été envoyé à votre adresse email.</p>
                            @endif
                        </div>
                    @endif

                    <div class="flex items-center gap-md">
                        <button type="submit" class="bg-primary text-on-primary font-label-sm text-label-sm font-bold py-sm px-lg rounded-lg hover:bg-tertiary transition-colors shadow-sm">Enregistrer</button>
                        @if (session('status') === 'profile-updated')
                            <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="flex items-center gap-xs text-secondary font-body-md text-body-md">
                                <span class="material-symbols-outlined text-[18px] text-success">check_circle</span> Enregistré.
                            </span>
                        @endif
                    </div>
                </form>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>
            </section>

            <section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg md:p-xl">
                <h2 class="font-headline-md text-headline-md text-primary mb-md flex items-center">
                    <span class="material-symbols-outlined mr-sm text-primary-container">lock</span>
                    Changer le mot de passe
                </h2>
                <form method="post" action="{{ route('password.update') }}" class="space-y-md">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="update_password_current_password">Mot de passe actuel</label>
                        <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                               class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                        @error('current_password', 'updatePassword') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="update_password_password">Nouveau mot de passe</label>
                            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            @error('password', 'updatePassword') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="update_password_password_confirmation">Confirmer le nouveau mot de passe</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            @error('password_confirmation', 'updatePassword') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-md">
                        <button type="submit" class="bg-primary text-on-primary font-label-sm text-label-sm font-bold py-sm px-lg rounded-lg hover:bg-tertiary transition-colors shadow-sm">Enregistrer</button>
                        @if (session('status') === 'password-updated')
                            <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="flex items-center gap-xs text-secondary font-body-md text-body-md">
                                <span class="material-symbols-outlined text-[18px] text-success">check_circle</span> Enregistré.
                            </span>
                        @endif
                    </div>
                </form>
            </section>
        </div>

        <div class="lg:col-span-4 flex flex-col gap-lg">

            <section class="bg-primary text-on-primary rounded-xl p-lg shadow-md">
                <h2 class="font-headline-md text-headline-md text-on-primary mb-md flex items-center">
                    <span class="material-symbols-outlined mr-sm text-inverse-primary">manage_accounts</span>
                    Mon compte
                </h2>
                <dl class="space-y-md">
                    <div class="flex items-center justify-between border-b border-on-primary/20 pb-sm">
                        <dt class="font-label-sm text-label-sm text-inverse-primary">Rôle</dt>
                        <dd class="font-body-md text-body-md text-on-primary font-bold">{{ $user->role_label }}</dd>
                    </div>
                    <div class="flex items-center justify-between border-b border-on-primary/20 pb-sm">
                        <dt class="font-label-sm text-label-sm text-inverse-primary">Sexe</dt>
                        <dd class="font-body-md text-body-md text-on-primary font-bold">{{ $user->sexe === 'F' ? 'Féminin' : ($user->sexe === 'M' ? 'Masculin' : '—') }}</dd>
                    </div>
                    <div class="flex items-center justify-between border-b border-on-primary/20 pb-sm">
                        <dt class="font-label-sm text-label-sm text-inverse-primary">Email vérifié</dt>
                        <dd class="font-body-md text-body-md text-on-primary flex items-center gap-xs">
                            @if ($user->hasVerifiedEmail())
                                <span class="material-symbols-outlined text-[18px]">check_circle</span> Oui
                            @else
                                <span class="material-symbols-outlined text-[18px]">schedule</span> Non
                            @endif
                        </dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="font-label-sm text-label-sm text-inverse-primary">Membre depuis</dt>
                        <dd class="font-body-md text-body-md text-on-primary font-bold">{{ $user->created_at->format('d/m/Y') }}</dd>
                    </div>
                </dl>
            </section>

            <section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-lg">
                <h2 class="font-headline-md text-headline-md text-error mb-sm flex items-center">
                    <span class="material-symbols-outlined mr-sm">warning</span>
                    Zone sensible
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-md">La suppression de votre compte est définitive : vos données et vos emprunts seront supprimés.</p>
                <div x-data="{ confirmOpen: false }">
                    <button @click="confirmOpen = true" class="w-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold py-sm px-md rounded-lg hover:bg-error hover:text-on-error transition-colors">
                        Supprimer mon compte
                    </button>

                    <div x-show="confirmOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-md" style="display:none;">
                        <div class="absolute inset-0 bg-black/50" @click="confirmOpen = false"></div>
                        <div class="relative bg-surface-container-lowest rounded-xl shadow-xl max-w-lg w-full p-lg">
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-sm">Êtes-vous sûr de vouloir supprimer votre compte ?</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-md">Cette action est irréversible. Toutes vos données seront définitivement supprimées. Saisissez votre mot de passe pour confirmer.</p>
                            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-md">
                                @csrf
                                @method('delete')
                                <div>
                                    <label class="block font-label-sm text-label-sm text-on-surface-variant mb-xs" for="delete_password">Mot de passe</label>
                                    <input id="delete_password" name="password" type="password" placeholder="Votre mot de passe"
                                           class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-md py-sm text-body-md focus:border-error focus:ring-1 focus:ring-error outline-none">
                                    @error('password', 'userDeletion') <p class="text-error font-label-sm text-label-sm mt-xs">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex justify-end gap-md">
                                    <button type="button" @click="confirmOpen = false" class="bg-surface-container-low text-on-surface font-label-sm text-label-sm py-sm px-lg rounded-lg hover:bg-surface-container-high transition-colors">Annuler</button>
                                    <button type="submit" class="bg-error text-on-error font-label-sm text-label-sm font-bold py-sm px-lg rounded-lg hover:bg-error-container transition-colors">Supprimer définitivement</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection