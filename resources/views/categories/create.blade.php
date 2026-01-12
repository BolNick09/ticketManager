<x-app-layout>
    <x-slot name="header">
        <h2>Новая категория</h2>
    </x-slot>

    <div class="p-4">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div>
                <label>Название</label><br>
                <input type="text" name="name" required>
            </div>

            <div>
                <label>Описание</label><br>
                <textarea name="description"></textarea>
            </div>

            <button type="submit">Сохранить</button>
        </form>
    </div>
</x-app-layout>
