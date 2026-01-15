<x-app-layout>
    <x-slot name="header">
        <h2>Новый тикет</h2>
    </x-slot>

    <div class="p-4">
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <div>
                <label>Категория</label><br>
                <select name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Тема</label><br>
                <input type="text" name="subject" required>
            </div>

            <div>
                <label>Описание</label><br>
                <textarea name="description" required></textarea>
            </div>

            <button type="submit">Создать</button>
        </form>
    </div>
</x-app-layout>
