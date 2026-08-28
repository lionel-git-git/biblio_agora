@extends('layouts.site')

@section('title', 'Gestion des emprunts - Agora')

@section('content')
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">
        <div>
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Gestion</p>
            <h1 class="font-display text-display text-primary">Emprunts</h1>
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

        <div class="flex flex-wrap gap-md">
            @foreach ($statuts as $cle => $libelle)
                <a href="{{ route('emprunts.gestion', ['statut' => $cle]) }}"
                   class="inline-flex items-center gap-sm rounded-full px-lg py-sm font-label-sm text-label-sm border transition-colors
                        {{ ($statut ?? 'en_cours') === $cle
                            ? 'bg-primary text-on-primary border-primary'
                            : 'bg-surface-container-lowest text-secondary border-outline-variant hover:bg-surface-container-low' }}">
                    {{ $libelle }}
                    @if (isset($compteurs[$cle]) && $compteurs[$cle] > 0)
                        <span class="px-xs py-0.5 rounded-full bg-surface-container-high text-on-surface-variant">{{ $compteurs[$cle] }}</span>
                    @endif
                </a>
            @endforeach
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
            @forelse ($emprunts as $emprunt)
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-md px-lg py-md border-b border-surface-container-high last:border-b-0">
                    <div class="flex items-center gap-md">
                        <div class="aspect-[2/3] w-12 bg-surface-container-high rounded overflow-hidden flex items-center justify-center shrink-0">
                            @if ($emprunt->livre->image_couverture)
                                <img src="{{ asset('storage/' . $emprunt->livre->image_couverture) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-outline">menu_book</span>
                            @endif
                        </div>
                        <div>
                            <p class="font-body-md text-body-md text-on-surface font-semibold">{{ $emprunt->livre->titre }}</p>
                            <p class="font-body-md text-body-md text-secondary">
                                {{ $emprunt->user->name }} · {{ $emprunt->user->email }}
                            </p>
                            <p class="font-body-md text-body-md text-secondary">
                                @if ($emprunt->date_emprunt)
                                    Emprunté le {{ $emprunt->date_emprunt->format('d/m/Y') }}
                                    @if ($emprunt->date_retour_prevue)
                                        · retour prévu le <span class="{{ $emprunt->statut === 'en_retard' ? 'text-error font-semibold' : '' }}">{{ $emprunt->date_retour_prevue->format('d/m/Y') }}</span>
                                    @endif
                                @else
                                    Demandé le {{ $emprunt->created_at->format('d/m/Y') }}
                                @endif
                                @if ($emprunt->date_retour_effective)
                                    · retourné le {{ $emprunt->date_retour_effective->format('d/m/Y') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-sm items-center shrink-0">
                        @if ($emprunt->statut === 'en_attente')
                            <button type="button"
                                    @click="$store.confirm.ask({
                                        title: 'Valider cette demande ?',
                                        message: 'La demande d\'emprunt de « {{ $emprunt->livre->titre }} » sera acceptée et un exemplaire sera retiré du stock.',
                                        action: '{{ route('emprunts.valider', $emprunt) }}',
                                        method: 'PATCH',
                                        tone: 'success',
                                        confirmIcon: 'check',
                                        confirmLabel: 'Valider'
                                    })"
                                    class="inline-flex items-center gap-xs bg-success-container text-on-success-container rounded-lg px-md py-sm font-label-sm text-label-sm hover:opacity-80 transition-opacity">
                                <span class="material-symbols-outlined text-[16px]">check</span> Valider
                            </button>
                            <button type="button"
                                    @click="$store.confirm.ask({
                                        title: 'Refuser cette demande ?',
                                        message: 'La demande d\'emprunt de « {{ $emprunt->livre->titre }} » sera refusée.',
                                        action: '{{ route('emprunts.refuser', $emprunt) }}',
                                        method: 'PATCH',
                                        tone: 'danger',
                                        confirmIcon: 'close',
                                        confirmLabel: 'Refuser'
                                    })"
                                    class="inline-flex items-center gap-xs bg-error-container text-on-error-container rounded-lg px-md py-sm font-label-sm text-label-sm hover:opacity-80 transition-opacity">
                                <span class="material-symbols-outlined text-[16px]">close</span> Refuser
                            </button>
                        @elseif (in_array($emprunt->statut, ['en_cours', 'en_retard'], true))
                            <span class="px-md py-sm rounded-full text-label-sm font-label-sm {{ $emprunt->statut === 'en_retard' ? 'bg-error-container text-on-error-container' : 'bg-primary-container text-on-primary' }} flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[16px]">{{ $emprunt->statut === 'en_retard' ? 'warning' : 'book' }}</span>
                                {{ $emprunt->statut === 'en_retard' ? 'En retard' : 'En cours' }}
                            </span>
                            <button type="button"
                                    @click="$store.confirm.ask({
                                        title: 'Enregistrer le retour ?',
                                        message: 'Le retour de « {{ $emprunt->livre->titre }} » sera enregistré et l\'exemplaire remis en stock.',
                                        action: '{{ route('emprunts.retour', $emprunt) }}',
                                        method: 'PATCH',
                                        tone: 'question',
                                        confirmIcon: 'assignment_return',
                                        confirmLabel: 'Enregistrer'
                                    })"
                                    class="inline-flex items-center gap-xs bg-primary-container text-on-primary rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-primary transition-colors">
                                <span class="material-symbols-outlined text-[16px]">assignment_return</span> Retour
                            </button>
                        @elseif ($emprunt->statut === 'retourne')
                            <span class="px-md py-sm rounded-full text-label-sm font-label-sm bg-success-container text-on-success-container flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[16px]">task_alt</span> Retourné
                            </span>
                        @else
                            <span class="px-md py-sm rounded-full text-label-sm font-label-sm bg-surface-container-high text-secondary flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[16px]">block</span> Refusé
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="p-xl text-center text-on-surface-variant">Aucun emprunt dans cette catégorie.</p>
            @endforelse
        </div>

        <div class="flex justify-center">
            {{ $emprunts->links() }}
        </div>
    </div>
@endsection