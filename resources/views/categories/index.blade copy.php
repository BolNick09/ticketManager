<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Категории</h2>
    </x-slot>

    <div class="card">
        <a href="{{ route('categories.create') }}" class="btn mb-4">
            Добавить категорию
        </a>

        <ul class="list-disc pl-5">
            @foreach($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
