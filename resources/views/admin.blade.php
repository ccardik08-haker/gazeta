<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ — Панель управления</title>
</head>
<body>

@include('components.header')

<main>
    <h2>Панель администратора</h2>

    <h3>Пользователи и роли</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->role->name ?? '—' }}</td>
                    <td>
                        <select name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button">Изменить</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Статьи</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Автор</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Пример статьи</td>
                <td>admin</td>
                <td>Наука</td>
                <td>
                    <button type="button">Редактировать</button>
                    <button type="button">Заблокировать</button>
                    <button type="button">Удалить</button>
                </td>
            </tr>
        </tbody>
    </table>
</main>

@include('components.footer')

</body>
</html>