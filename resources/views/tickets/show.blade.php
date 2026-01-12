<x-app-layout>
    <x-slot name="header">
        <h2>{{ $ticket->subject }}</h2>
    </x-slot>

    <div class="p-4">

        {{-- Основная информация --}}
        <p><strong>Категория:</strong> {{ $ticket->category->name }}</p>

        <p>
            <strong>Статус:</strong>
            @switch($ticket->status)
                @case('open') Открыт @break
                @case('in_progress') В работе @break
                @case('waiting_user') Ожидает ответа пользователя @break
                @case('closed') Закрыт @break
                @default {{ $ticket->status }}
            @endswitch
        </p>

        <p>
            <strong>Агент:</strong>
            {{ $ticket->agent?->name ?? 'Не назначен' }}
        </p>

        <hr>

        <p><strong>Описание:</strong></p>
        <p>{{ $ticket->description }}</p>

        <hr>

        @php
            $role = auth()->user()->role->name;
        @endphp

        {{-- Кнопка "Взять в работу" --}}
        @if(in_array($role, ['agent', 'admin']) && !$ticket->agent_id && $ticket->status !== 'closed')
            <form method="POST" action="{{ route('tickets.take', $ticket) }}">
                @csrf
                <button type="submit">Взять в работу</button>
            </form>
            <hr>
        @endif

        {{-- Смена статуса агентом --}}
        @if(in_array($role, ['agent', 'admin']) && $ticket->status !== 'closed')
            <form method="POST" action="{{ route('tickets.status', $ticket) }}">
                @csrf

                <label>Изменить статус:</label><br>
                <select name="status">
                    <option value="open" @selected($ticket->status === 'open')>Открыт</option>
                    <option value="in_progress" @selected($ticket->status === 'in_progress')>В работе</option>
                    <option value="waiting_user" @selected($ticket->status === 'waiting_user')>Ожидает пользователя</option>
                    <option value="closed" @selected($ticket->status === 'closed')>Закрыт</option>
                </select>

                <button type="submit">Сохранить</button>
            </form>
            <hr>
        @endif

        {{-- Закрытие тикета пользователем --}}
        @if($role === 'user' && $ticket->status !== 'closed')
            <form method="POST" action="{{ route('tickets.close', $ticket) }}">
                @csrf
                <button type="submit">Закрыть тикет</button>
            </form>
            <hr>
        @endif

        {{-- Переписка --}}
        <h3>Переписка</h3>

        @forelse ($ticket->comments as $comment)
            <div style="margin-bottom: 15px;">
                <strong>{{ $comment->user->name }}</strong>
                <small>({{ $comment->created_at->format('d.m.Y H:i') }})</small><br>
                {{ $comment->body }}
            </div>
        @empty
            <p>Сообщений пока нет.</p>
        @endforelse

        <hr>

        {{-- Форма добавления комментария --}}
        @if($ticket->status !== 'closed')
            <h3>Добавить сообщение</h3>

            <form method="POST" action="{{ route('comments.store', $ticket) }}">
                @csrf

                <textarea name="body" rows="4" required></textarea><br><br>

                <button type="submit">Отправить</button>
            </form>
        @else
            <p><em>Тикет закрыт, добавление сообщений недоступно.</em></p>
        @endif

    </div>
</x-app-layout>
