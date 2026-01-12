
<x-app-layout>

    <link rel="stylesheet" href="{{ asset('css/ticket.css') }}">   

    <x-slot name="header">
        <h2>{{ $ticket->subject }}</h2>
    </x-slot>

    @php
        $role = auth()->user()->role->name;

        $statusLabels = [
            'open' => 'Открыт',
            'in_progress' => 'В работе',
            'waiting_user' => 'Ожидает пользователя',
            'closed' => 'Закрыт',
        ];
    @endphp

    <div class="ticket-card">

        {{-- Мета-информация --}}
        <div class="ticket-meta">
            <div>
                <strong>Категория</strong><br>
                {{ $ticket->category->name }}
            </div>

            <div>
                <strong>Статус</strong><br>
                <span class="status status-{{ $ticket->status }}">
                    {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                </span>
            </div>

            <div>
                <strong>Агент</strong><br>
                {{ $ticket->agent?->name ?? 'Не назначен' }}
            </div>
        </div>

        {{-- Описание --}}
        <div class="ticket-description">
            <strong>Описание</strong>
            <p>{{ $ticket->description }}</p>
        </div>

        {{-- Назначение агента администратором --}}
        @if($role === 'admin' && $ticket->status !== 'closed')
            <hr>

            <h3>Назначить агента</h3>

            <form method="POST" action="{{ route('tickets.assignAgent', $ticket) }}">
                @csrf

                <select name="agent_id" required>
                    <option value="">— выбрать агента —</option>
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}"
                            @selected($ticket->agent_id === $agent->id)>
                            {{ $agent->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Назначить</button>
            </form>
        @endif

        {{-- Взять в работу --}}
        @if(in_array($role, ['agent', 'admin']) && !$ticket->agent_id && $ticket->status !== 'closed')
            <hr>
            <form method="POST" action="{{ route('tickets.take', $ticket) }}">
                @csrf
                <button type="submit">Взять в работу</button>
            </form>
        @endif

        {{-- Смена статуса --}}
        @if(in_array($role, ['agent', 'admin']) && $ticket->status !== 'closed')
            <hr>
            <form method="POST" action="{{ route('tickets.status', $ticket) }}">
                @csrf
                <label>Изменить статус</label><br>
                <select name="status">
                    @foreach($statusLabels as $key => $label)
                        <option value="{{ $key }}" @selected($ticket->status === $key)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <button type="submit">Сохранить</button>
            </form>
        @endif

        {{-- Закрытие тикета пользователем --}}
        @if($role === 'user' && $ticket->status !== 'closed')
            <hr>
            <form method="POST" action="{{ route('tickets.close', $ticket) }}">
                @csrf
                <button type="submit">Закрыть тикет</button>
            </form>
        @endif

        {{-- Комментарии --}}
        <div class="comments">
            <h3>Переписка</h3>

            @forelse ($ticket->comments as $comment)
                <div class="comment {{ in_array($comment->user->role->name, ['agent', 'admin']) ? 'agent' : '' }}">
                    <strong>{{ $comment->user->name }}</strong>
                    <small>{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                    <p>{{ $comment->body }}</p>
                </div>
            @empty
                <p>Сообщений пока нет.</p>
            @endforelse
        </div>

        {{-- Форма комментария --}}
        @if($ticket->status !== 'closed')
            <hr>
            <form class="comment-form" method="POST" action="{{ route('comments.store', $ticket) }}">
                @csrf
                <textarea name="body" rows="4" required></textarea><br><br>
                <button type="submit">Отправить</button>
            </form>
        @else
            <p><em>Тикет закрыт. Комментарии недоступны.</em></p>
        @endif

    </div>
</x-app-layout>
