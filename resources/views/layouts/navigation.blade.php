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

                {{-- Навигация --}}
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
                    <div class="relative ml-3">
                        <div>
                            <button type="button"
                                    class="flex text-sm rounded-full focus:outline-none"
                                    id="user-menu-button">
                                {{ auth()->user()->name }}
                            </button>
                        </div>

                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
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
