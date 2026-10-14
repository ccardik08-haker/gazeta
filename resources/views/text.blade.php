@include('components.header')

<main>
    <article class="article-full">
        <h2>{{ $text->heading }}</h2>

        <p class="meta">
            <span>Категория: <a href="/category/{{ $text->category->id }}">{{ $text->category->name }}</a></span>
            <span>Автор: {{ $text->user->login }}</span>
            <span>{{ $text->created_at->format('d.m.Y H:i') }}</span>
            @if ($text->is_blocked)
                <span style="color:red">[Заблокирована]</span>
            @endif
        </p>

        <div class="article-content">
            {!! nl2br(e($text->text)) !!}
        </div>

        <p style="margin-top:20px">
            <a href="/">← Все новости</a>
        </p>
    </article>
</main>

@include('components.footer')