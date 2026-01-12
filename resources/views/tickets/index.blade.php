<x-app-layout>
    <x-slot name="header">
        <h2>Тикеты</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('tickets.create') }}">➕ Создать тикет</a>

        <ul>
            @foreach ($tickets as $ticket)
                <li>
                    <strong>{{ $ticket->subject }}</strong><br>
                    Категория: {{ $ticket->category->name }}<br>
                    Статус: {{ $ticket->status }}
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
