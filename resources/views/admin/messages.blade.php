@extends('layouts.site')

@section('title', 'Messages de contact - Agora')

@section('content')
    <div class="max-w-container-max mx-auto px-lg py-xl flex flex-col gap-xl">
        <div>
            <p class="font-label-sm text-label-sm text-secondary uppercase tracking-wider mb-sm">Administration</p>
            <h1 class="font-display text-display text-primary">Messages de contact</h1>
        </div>

        @if (session('success'))
            <div class="p-sm bg-success-container text-on-success-container rounded-lg text-body-md flex items-center gap-sm">
                <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
            </div>
        @endif

        @forelse ($messages as $message)
            <article class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm {{ $message->lu ? 'opacity-75' : 'border-primary' }}">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-md px-lg py-md {{ $message->lu ? '' : 'bg-primary-container/10' }}">
                    <div class="flex items-center gap-md">
                        @if (! $message->lu)
                            <span class="w-2 h-2 rounded-full bg-primary shrink-0" title="Non lu"></span>
                        @endif
                        <div>
                            <p class="font-headline-md text-headline-md text-primary">{{ $message->objet }}</p>
                            <p class="font-body-md text-body-md text-secondary">
                                De <span class="font-semibold">{{ $message->nom }}</span> · {{ $message->email }} · {{ $message->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-sm shrink-0">
                        @if (! $message->lu)
                            <form method="POST" action="{{ route('admin.messages.lu', $message) }}">
                                @csrf
                                @method('PATCH')
                                <button class="inline-flex items-center gap-xs bg-surface-container-low text-primary border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">mark_email_read</span> Marquer lu
                                </button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ce message ?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center gap-xs text-error border border-outline-variant rounded-lg px-md py-sm font-label-sm text-label-sm hover:bg-error-container transition-colors">
                                <span class="material-symbols-outlined text-[16px]">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="px-lg py-md {{ $message->lu ? '' : 'bg-surface-container-low' }}">
                    <p class="font-body-md text-body-md text-on-surface whitespace-pre-line">{{ $message->message }}</p>
                </div>
            </article>
        @empty
            <div class="bg-surface-container-lowest border border-dashed border-outline-variant rounded-xl p-xl text-center">
                <p class="text-secondary font-body-md">Aucun message de contact.</p>
            </div>
        @endforelse

        <div class="flex justify-center">
            {{ $messages->links() }}
        </div>
    </div>
@endsection