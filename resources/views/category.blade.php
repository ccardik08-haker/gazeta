<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Категория</title>
</head>
<body>

@include('components.header')

<main>
    <h2>Категория: {{ $category->name }}</h2>

    @forelse ($articles as $article)
        <article class="article">
            <h3>{{ $article->title }}</h3>
            <p class="meta">
                <span>Автор: {{ $article->user->login }}</span>
                <span>{{ $article->created_at->format('d.m.Y H:i') }}</span>
            </p>
            <p>{{ $article->content }}</p>
        </article>
    @empty
        <p>В этой категории пока нет статей.</p>
    @endforelse

    {{ $articles->links() }}
</main>

@include('components.footer')

</body>
</html>