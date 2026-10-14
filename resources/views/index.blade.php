<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>

@include('components.header')

<main>
    <h2>Все новости</h2>

    @if (session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    @forelse ($articles as $article)
        <article class="article">
            <h3>{{ $article->title }}</h3>
            <p class="meta">
                <span>Категория: {{ $article->category->name }}</span>
                <span>Автор: {{ $article->user->login }}</span>
                <span>{{ $article->created_at->format('d.m.Y H:i') }}</span>
            </p>
            <p>{{ $article->content }}</p>
        </article>
    @empty
        <p>Пока нет статей.</p>
    @endforelse

    {{ $articles->links() }}
</main>

@include('components.footer')

</body>
</html>