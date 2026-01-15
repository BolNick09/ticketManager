<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Новая категория</h2>
    </x-slot>

    <div class="card">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <input type="text" name="name" class="w-full border p-2 mb-4">

            <button class="btn">Сохранить</button>
        </form>
    </div>
</x-app-layout>
