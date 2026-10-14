<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Главная страница админки
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        $texts = Text::with(['user', 'category'])->latest()->get();

        return view('admin', compact('users', 'roles', 'texts'));
    }

    // Удаление статьи
    public function destroyText($id)
    {
        $text = Text::findOrFail($id);
        $text->delete();

        return redirect('/admin')->with('ok', 'Статья удалена.');
    }

    // Блокировка / разблокировка
    public function toggleBlock($id)
    {
        $text = Text::findOrFail($id);
        $text->is_blocked = !$text->is_blocked;
        $text->save();

        return redirect('/admin')->with('ok', $text->is_blocked ? 'Статья заблокирована.' : 'Статья разблокирована.');
    }

    // Форма редактирования
    public function editText($id)
    {
        $text = Text::findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('admin-edit', compact('text', 'categories'));
    }

    // Сохранение изменений
    public function updateText(Request $request, $id)
    {
        $data = $request->validate([
            'heading' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'text' => 'required|string',
        ]);

        $text = Text::findOrFail($id);
        $text->update($data);

        return redirect('/admin')->with('ok', 'Статья обновлена.');
    }

    // Смена роли пользователя
    public function changeRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        // Защита от снятия последнего админа
        $adminRole = Role::where('name', 'Администратор')->first();
        if ($user->role_id == $adminRole->id && $request->role_id != $adminRole->id) {
            $adminCount = User::where('role_id', $adminRole->id)->count();
            if ($adminCount <= 1) {
                return redirect('/admin')->withErrors(['role' => 'Нельзя убрать последнего администратора.']);
            }
        }

        $user->role_id = $request->role_id;
        $user->save();

        return redirect('/admin')->with('ok', 'Роль обновлена.');
    }
}