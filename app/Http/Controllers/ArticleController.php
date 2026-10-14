<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user'])
            ->latest()
            ->paginate(5);

        return view('index', compact('articles'));
    }

    public function category()
    {
        $category = Category::first();

        $articles = Article::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(5);

        return view('category', compact('category', 'articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('journalist', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
        ]);

        $data['user_id'] = auth()->id();

        Article::create($data);

        return redirect('/')->with('ok', 'Статья опубликована!');
    }
}