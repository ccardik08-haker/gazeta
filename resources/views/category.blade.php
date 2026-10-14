
@include('components.header')

<main>
    <h2>Категория: {{ $category->name }}</h2>

    @forelse ($texts as $text)
        <article class="article">
            <h3><a href="/text/{{ $text->id }}">{{ $text->heading }}</a></h3>
            <p class="meta">
                <span>Автор: {{ $text->user->login }}</span>
                <span>{{ $text->created_at->format('d.m.Y H:i') }}</span>
            </p>
            <p>{{ $text->text }}</p>
        </article>
    @empty
        <p>В этой категории пока нет статей.</p>
    @endforelse

    {{ $texts->links() }}
</main>

@include('components.footer')
