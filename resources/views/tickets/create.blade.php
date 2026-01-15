<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Создать тикет</h2>
    </x-slot>

    <div class="card">
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <div class="mb-4">
                <label>Тема</label>
                <input type="text" name="subject" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Категория</label>
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Описание</label>
                <textarea name="description" rows="5"></textarea>
            </div>

            <button class="btn">Создать</button>
        </form>
    </div>
</x-app-layout>
