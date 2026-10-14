<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Журналист</title>
</head>
<body>

@include('components.header')

<main>
    <h2>Написать новую статью</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/journalist">
        @csrf

        <p>
            <label>Заголовок:</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
        </p>

        <p>
            <label>Категория:</label><br>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Текст статьи:</label><br>
            <textarea name="content" rows="12">{{ old('content') }}</textarea>
        </p>

        <p>
            <button type="submit">Опубликовать</button>
        </p>
    </form>
</main>

@include('components.footer')

</body>
</html>