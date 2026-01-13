<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <div class="p-4">
        <ul>
            <li>Открытые: {{ $open }}</li>
            <li>В работе: {{ $inProgress }}</li>
            <li>Ожидают клиента: {{ $waiting }}</li>
            <li>Закрытые: {{ $closed }}</li>
        </ul>
    </div>
</x-app-layout>
