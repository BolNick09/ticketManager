<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Пользователи</h2>
    </x-slot>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Изменить</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.role', $user) }}">
                            @csrf
                            <select name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @selected($user->role_id === $role->id)>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn ml-2">Сохранить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
