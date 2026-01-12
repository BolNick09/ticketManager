<x-app-layout>
    <x-slot name="header">
        <h2>{{ $ticket->subject }}</h2>
    </x-slot>

    <div class="p-4">
        <p><strong>Категория:</strong> {{ $ticket->category->name }}</p>
        <p><strong>Статус:</strong> {{ $ticket->status }}</p>
        <p><strong>Описание:</strong></p>
        <p>{{ $ticket->description }}</p>

        <hr>

        <h3>Переписка</h3>

        @foreach ($ticket->comments as $comment)
            <div style="margin-bottom: 10px;">
                <strong>{{ $comment->user->name }}</strong>
                <small>({{ $comment->created_at }})</small><br>
                {{ $comment->body }}
            </div>
        @endforeach

        <hr>

        <h3>Добавить сообщение</h3>

        <form method="POST" action="{{ route('comments.store', $ticket) }}">
            @csrf
            <textarea name="body" required></textarea><br>
            <button type="submit">Отправить</button>
        </form>
    </div>
</x-app-layout>
