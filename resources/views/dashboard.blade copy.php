<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Dashboard</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="card">
            <div class="card-title">Статистика тикетов</div>
            <ul>
                <li>Открытые: {{ $open }}</li>
                <li>В работе: {{ $inProgress }}</li>
                <li>Ожидают пользователя: {{ $waiting }}</li>
                <li>Закрытые: {{ $closed }}</li>
            </ul>
        </div>

        @if(auth()->user()->role->name === 'admin')
            <div class="card">
                <div class="card-title">Администрирование</div>
                <a href="{{ route('admin.users') }}" class="btn">
                    Управление пользователями
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
