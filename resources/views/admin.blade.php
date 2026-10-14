
@include('components.header')

<main>
    <h2>Панель администратора</h2>

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

    <h3>Пользователи и роли</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->role->name ?? '—' }}</td>
                    <td>
                        <form method="POST" action="/admin/users/{{ $user->id }}/role" style="display:flex; gap:8px; align-items:center">
                            @csrf
                            <select name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit">Изменить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Статьи</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Автор</th>
                <th>Категория</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($texts as $text)
                <tr>
                    <td>{{ $text->id }}</td>
                    <td>{{ $text->heading }}</td>
                    <td>{{ $text->user->login }}</td>
                    <td>{{ $text->category->name }}</td>
                    <td>
                        @if ($text->is_blocked)
                            <span style="color:red">Заблокирована</span>
                        @else
                            <span style="color:green">Опубликована</span>
                        @endif
                    </td>
                    <td style="display:flex; gap:6px">
                        <a href="/admin/texts/{{ $text->id }}/edit">
                            <button type="button">Редактировать</button>
                        </a>

                        <form method="POST" action="/admin/texts/{{ $text->id }}/block" style="display:inline">
                            @csrf
                            <button type="submit">
                                {{ $text->is_blocked ? 'Разблокировать' : 'Заблокировать' }}
                            </button>
                        </form>

                        <form method="POST" action="/admin/texts/{{ $text->id }}/delete" style="display:inline"
                              onsubmit="return confirm('Удалить статью?')">
                            @csrf
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Статей пока нет.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</main>

@include('components.footer')
