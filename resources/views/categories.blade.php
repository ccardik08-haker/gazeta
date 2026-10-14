@include('components.header')

<main>
    <h2>Категории</h2>

    @forelse ($categories as $cat)
        <article class="article">
            <h3><a href="/category/{{ $cat->id }}">{{ $cat->name }}</a></h3>
            <p class="meta">Статей: {{ $cat->texts_count }}</p>
        </article>
    @empty
        <p>Категорий пока нет.</p>
    @endforelse
</main>

@include('components.footer')