<nav class="bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between h-16">

            {{-- Левая часть --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-lg font-semibold">
                        TicketManager
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>

                        <a href="{{ route('tickets.index') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Тикеты
                        </a>

                        @php
                            $role = auth()->user()->role->name;
                        @endphp

                        @if($role === 'admin')
                            <a href="{{ route('categories.index') }}"
                               class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Категории
                            </a>

                            <a href="{{ route('admin.users') }}"
                               class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Пользователи
                            </a>
                        @endif
                    @endauth

                </div>
            </div>

            {{-- Правая часть --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 mr-4">
                        Войти
                    </a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-700">
                        Регистрация
                    </a>
                @endguest

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="flex items-center text-sm font-medium text-gray-700 focus:outline-none"
                        >
                            {{ auth()->user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                      clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-48 bg-white border rounded shadow"
                        >
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm hover:bg-gray-100">
                                Профиль
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                    Выйти
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </div>
</nav>
