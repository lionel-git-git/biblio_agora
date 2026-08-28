@extends('layouts.site')

@section('title', 'Gestion des utilisateurs - Agora')

@section('content')
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">
        <div>
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Administration</p>
            <h1 class="font-display text-display text-primary">Utilisateurs</h1>
        </div>

        @if (session('success'))
            <div class="p-sm bg-success-container text-on-success-container rounded-lg text-body-md flex items-center gap-sm">
                <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-sm bg-error-container text-on-error-container rounded-lg text-body-md flex items-center gap-sm">
                <span class="material-symbols-outlined">error</span> {{ session('error') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.utilisateurs') }}" class="flex flex-wrap gap-md items-end">
            <div class="flex-grow min-w-[200px]">
                <label class="block font-label-sm text-label-sm text-secondary mb-xs">Rechercher</label>
                <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Nom ou email..."
                       class="w-full border border-outline-variant rounded-lg px-sm py-sm font-body-md text-body-md focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="block font-label-sm text-label-sm text-secondary mb-xs">Rôle</label>
                <select name="role" class="border border-outline-variant rounded-lg px-sm py-sm font-body-md text-body-md focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="">Tous</option>
                    <option value="etudiant" {{ request('role') === 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                    <option value="bibliothecaire" {{ request('role') === 'bibliothecaire' ? 'selected' : '' }}>Bibliothécaire</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center gap-sm bg-primary-container text-on-primary rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-primary transition-colors">
                <span class="material-symbols-outlined text-[18px]">search</span> Filtrer
            </button>
            @if (request('recherche') || request('role'))
                <a href="{{ route('admin.utilisateurs') }}" class="inline-flex items-center gap-sm bg-surface-container-low text-primary border border-outline-variant rounded-lg px-lg py-sm font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">
                    Réinitialiser
                </a>
            @endif
        </form>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
            <div class="hidden md:grid grid-cols-12 gap-md px-lg py-md bg-surface-container-low border-b border-outline-variant font-label-sm text-label-sm text-secondary">
                <div class="col-span-4">Utilisateur</div>
                <div class="col-span-2">Rôle</div>
                <div class="col-span-1">Emprunts</div>
                <div class="col-span-3">Vérifié</div>
                <div class="col-span-2 text-right">Actions</div>
            </div>

            @forelse ($users as $user)
                <div class="grid grid-cols-1 md:grid-cols-12 gap-md items-center px-lg py-md border-b border-surface-container-high last:border-b-0">
                    <div class="col-span-4">
                        <p class="font-body-md text-body-md text-on-surface font-semibold">{{ $user->name }}</p>
                        <p class="font-body-md text-body-md text-secondary">{{ $user->email }}</p>
                    </div>

                    <div class="col-span-2">
                        @if ($user->id === Auth::id())
                            <span class="inline-flex items-center gap-sm px-md py-xs rounded-full bg-primary-container text-on-primary font-label-sm text-label-sm">
                                {{ ucfirst($user->role) }}
                            </span>
                        @else
                            <form method="POST" action="{{ route('admin.utilisateurs.role', $user) }}">
                                @csrf
                                @method('PATCH')
                                <select name="role" onchange="this.form.submit()" class="border border-outline-variant rounded-lg px-sm py-sm font-body-md text-body-md focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="etudiant" {{ $user->role === 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                                    <option value="bibliothecaire" {{ $user->role === 'bibliothecaire' ? 'selected' : '' }}>Bibliothécaire</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>
                        @endif
                    </div>

                    <p class="col-span-1 font-body-md text-body-md text-secondary">{{ $user->emprunts_count }}</p>

                    <p class="col-span-3 font-body-md text-body-md">
                        @if ($user->email_verified_at)
                            <span class="inline-flex items-center gap-xs text-success">
                                <span class="material-symbols-outlined text-[16px]">verified</span> Vérifié
                            </span>
                        @else
                            <span class="inline-flex items-center gap-xs text-secondary">
                                <span class="material-symbols-outlined text-[16px]">hora</span> Non vérifié
                            </span>
                        @endif
                    </p>

                    <div class="col-span-2 flex justify-start md:justify-end">
                        @if ($user->id !== Auth::id())
                            <form method="POST" action="{{ route('admin.utilisateurs.destroy', $user) }}" onsubmit="return confirm('Supprimer l\'utilisateur {{ addslashes($user->name) }} ?');">
                                @csrf
                                @method('DELETE')
                                <button class="inline-flex items-center gap-xs text-error border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-error-container transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">delete</span> Supprimer
                                </button>
                            </form>
                        @else
                            <span class="font-body-md text-body-md text-secondary">Vous</span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="p-xl text-center text-on-surface-variant">Aucun utilisateur trouvé.</p>
            @endforelse
        </div>

        <div class="flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection