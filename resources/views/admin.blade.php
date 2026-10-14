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

    <h3>Статьи</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Пример статьи</td>
                <td>Опубликовано</td>
                <td>
                    <button>Редактировать</button>
                    <button>Заблокировать</button>
                    <button>Удалить</button>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Пользователи</h3>
    <form>
        <p>
            <label>Пользователь:</label><br>
            <select name="user">
                <option>admin</option>
            </select>
        </p>
        <p>
            <label>Новая роль:</label><br>
            <select name="role">
                <option>Читатель</option>
                <option>Журналист</option>
                <option>Администратор</option>
            </select>
        </p>
        <p>
            <button type="submit">Изменить роль</button>
        </p>
    </form>
</main>

@include('components.footer')

</body>
</html>