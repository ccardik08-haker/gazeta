<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>

@include('components.header')

<main>
    <h2>Регистрация</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <p>
            <label>Логин:</label><br>
            <input type="text" name="login" value="{{ old('login') }}">
        </p>
        <p>
            <label>Пароль:</label><br>
            <input type="password" name="password">
        </p>
        <p>
            <label>Подтверждение пароля:</label><br>
            <input type="password" name="password_confirmation">
        </p>
        <p>
            <button type="submit">Зарегистрироваться</button>
        </p>
    </form>

    <p><a href="/login">Уже есть аккаунт? Войти</a></p>
</main>

@include('components.footer')

</body>
</html>