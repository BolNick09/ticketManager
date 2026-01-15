<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">TicketManager</h1>
    </x-slot>

    <div class="card">
        <h2 class="card-title">Система управления заявками</h2>

        <p class="mb-4">
            TicketManager — это учебная система helpdesk,
            разработанная на Laravel с разграничением ролей.
        </p>

        <ul class="list-disc pl-5 mb-6">
            <li>Пользователи создают тикеты</li>
            <li>Агенты обрабатывают заявки</li>
            <li>Администратор управляет системой</li>
        </ul>

        @guest
            <a href="{{ route('login') }}" class="btn">Войти</a>
            <a href="{{ route('register') }}" class="btn ml-2">Регистрация</a>
        @else
            <a href="{{ route('dashboard') }}" class="btn">Перейти в систему</a>
        @endguest
    </div>
</x-app-layout>
