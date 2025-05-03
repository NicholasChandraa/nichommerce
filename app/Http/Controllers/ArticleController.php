<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function manage(Request $request) // INI UNTUK ADMIN MELAKUKAN MANAGE ARTIKEL
    {
        $query = Article::query();

        // Tambahkan logika sorting
        if ($request->filled('sort_by') && $request->filled('sort_order')) {
            $query->orderBy($request->sort_by, $request->sort_order);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Tambahkan filter berdasarkan kategori jika ada
        if ($request->filled('category_id')) {
            $query->where('article_category_id', $request->category_id);
        }

        // Tambahkan pencarian berdasarkan judul atau penulis jika ada
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                    ->orWhere('author', 'LIKE', "%$search%");
            });
        }

        $articles = $query->paginate(5);
        $categories = ArticleCategory::all();

        return view('articles.manageArticles', compact('articles', 'categories'))
            ->with('sort_by', $request->sort_by)
            ->with('sort_order', $request->sort_order);
    }





    public function index(Request $request) //INI UNTUK PAGE UTAMA ARTIKEL
    {

        $query = Article::query();

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('article_category_id', $request->category_id);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Search by title or author
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                    ->orWhere('author', 'LIKE', "%$search%");
            });
        }

        $articles = Article::latest()->paginate(6);
        $allArticles = Article::inRandomOrder()->paginate(6);

        if ($request->ajax()) {
            return view('articles.partials.articles', compact('allArticles'))->render();
        }

        $categories = ArticleCategory::all();
        
        return view('articles.index', compact('articles', 'allArticles', 'categories'));
    }

    public function filter(Request $request)
    {
        $query = Article::query();

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('article_category_id', $request->category_id);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Search by title or author
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                    ->orWhere('author', 'LIKE', "%$search%");
            });
        }

        $articles = $query->latest()->paginate(6);
        $categories = ArticleCategory::all();

        return view('articles.filter', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = ArticleCategory::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'author' => 'required|string|max:255',
            'article_category_id' => 'required|exists:article_categories,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'author' => $request->author,
            'article_category_id' => $request->article_category_id,
        ]);

        session()->flash('success', 'Artikel berhasil dibuat.');

        return redirect()->route('manageArticles');
    }

    public function show($id)
    {
        $article = Article::find($id);
        $articles = Article::all();
        return view('articles.show', compact('article', 'articles'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = ArticleCategory::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'author' => 'required|string|max:255',
            'article_category_id' => 'required|exists:article_categories,id',
        ]);

        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'author' => $request->author,
            'article_category_id' => $request->article_category_id,
        ]);

        return redirect()->route('articlePages.edit', $article->id)->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        session()->flash('success', 'Artikel berhasil dihapus.');

        return redirect()->route('manageArticles');
    }
}
