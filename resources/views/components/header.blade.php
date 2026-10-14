<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой новостной сайт</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="site-header">
    <div class="container">
        <h1><a href="/">Мой новостной сайт</a></h1>

        <nav class="site-nav">
            <a href="/">Главная</a>
            <a href="/category">Категория</a>

            @auth
                <a href="/journalist">Журналист</a>
                <a href="/admin">Админ</a>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit">Выйти ({{ auth()->user()->login }})</button>
                </form>
            @else
                <a href="/login">Вход</a>
                <a href="/register">Регистрация</a>
            @endauth
        </nav>
    </div>
</header>