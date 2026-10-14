<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::with(['category', 'user'])
            ->latest()
            ->paginate(5);

        return view('index', compact('texts'));
    }

    public function category()
    {
        $category = Category::first();

        $texts = Text::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(5);

        return view('category', compact('category', 'texts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('journalist', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'heading' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'text' => 'required|string',
        ]);

        $data['user_id'] = auth()->id();

        Text::create($data);

        return redirect('/')->with('ok', 'Статья опубликована!');
    }
}