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
    @if(auth()->user()->role->name === 'admin')
        <a href="{{ route('admin.users') }}">Управление пользователями</a>
    @endif
</x-app-layout>
