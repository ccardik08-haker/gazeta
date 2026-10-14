

@include('components.header')

<main>
    <h2>Все новости</h2>

    @if (session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    @forelse ($texts as $text)
        <article class="article">
            <h3><a href="/text/{{ $text->id }}">{{ $text->heading }}</a></h3>
            <p class="meta">
                <span>Категория: {{ $text->category->name }}</span>
                <span>Автор: {{ $text->user->login }}</span>
                <span>{{ $text->created_at->format('d.m.Y H:i') }}</span>
            </p>
            <p>{{ $text->text }}</p>
        </article>
    @empty
        <p>Пока нет статей.</p>
    @endforelse

    {{ $texts->links() }}
</main>

@include('components.footer')