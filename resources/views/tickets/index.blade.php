<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Тикеты</h2>
    </x-slot>

    <div class="card">
        <a href="{{ route('tickets.create') }}" class="btn mb-4">
            Создать тикет
        </a>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Тема</th>
                <th>Статус</th>
                <th></th>
            </tr>

            @foreach($tickets as $ticket)
                <tr>
                    <td>#{{ $ticket->id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn">
                            Открыть
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
