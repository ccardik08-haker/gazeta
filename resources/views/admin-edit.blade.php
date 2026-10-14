@include('components.header')

<main>
    <h2>Редактирование статьи</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/admin/texts/{{ $text->id }}/update">
        @csrf

        <p>
            <label>Заголовок:</label><br>
            <input type="text" name="heading" value="{{ old('heading', $text->heading) }}">
        </p>

        <p>
            <label>Категория:</label><br>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($text->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Текст статьи:</label><br>
            <textarea name="text" rows="12">{{ old('text', $text->text) }}</textarea>
        </p>

        <p>
            <button type="submit">Сохранить</button>
            <a href="/admin" style="margin-left:10px">Отмена</a>
        </p>
    </form>
</main>

@include('components.footer')