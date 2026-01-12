<x-app-layout>
    <x-slot name="header">
        <h2>Категории тикетов</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('categories.create') }}">➕ Добавить категорию</a>

        <ul>
            @foreach ($categories as $category)
                <li>
                    <strong>{{ $category->name }}</strong><br>
                    {{ $category->description }}
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
