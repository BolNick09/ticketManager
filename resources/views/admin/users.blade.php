<x-app-layout>
    <x-slot name="header">Управление пользователями</x-slot>

    <table border="1" cellpadding="5">
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Изменить</th>
        </tr>

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
                        <button>Сохранить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
