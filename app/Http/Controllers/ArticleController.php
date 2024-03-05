<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = time() . rand(1, 200) . '.' . $request->file('gambar')->getClientOriginalExtension();
        $request->file('gambar')->move(public_path('blogs'), $fileName);

        $requestData['gambar'] = $fileName;
        Article::create($requestData);

        return redirect()->route('article.index')->with('success', 'Article created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = time() . rand(1, 200) . '.' . $request->file('gambar')->getClientOriginalExtension();
        $request->file('gambar')->move(public_path('blogs'), $fileName);

        $requestData['gambar'] = $fileName;
        Article::find($id)->update($requestData);

        return redirect()->route('article.index')->with('success', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Article::find($id)->delete();
            return redirect()->route('article.index')->with('success', 'Article deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('article.index')->with('error', 'Article failed to delete');
        }
    }
}
