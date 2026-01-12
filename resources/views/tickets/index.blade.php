<x-app-layout>
    <x-slot name="header">
        <h2>Тикеты</h2>
    </x-slot>

    <div class="p-4">

        <a href="{{ route('tickets.create') }}">➕ Создать тикет</a>

        <table border="1" cellpadding="5" cellspacing="0" style="margin-top: 15px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Тема</th>
                    <th>Категория</th>
                    <th>Статус</th>
                    <th>Агент</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket) }}">
                                {{ $ticket->subject }}
                            </a>
                        </td>
                        <td>{{ $ticket->category->name }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->agent?->name ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
