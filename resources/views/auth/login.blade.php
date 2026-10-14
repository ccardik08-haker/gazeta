<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>

@include('components.header')

<main>
    <h2>Вход</h2>

    @if (session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/login">
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
            <button type="submit">Войти</button>
        </p>
    </form>

    <p><a href="/register">Нет аккаунта? Зарегистрироваться</a></p>
</main>

@include('components.footer')

</body>
</html>