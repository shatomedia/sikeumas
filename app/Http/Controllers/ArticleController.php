<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:article', ['only' => ['index']]);
        $this->middleware('permission:create-article', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-article', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-article', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryArticle::all();

        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $requestData = $request->validate([
                'category_id' => 'required',
                'judul' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'konten' => 'required',
            ]);
            
            DB::beginTransaction();
            // Generate unique slug from judul
            $slug = Str::slug($requestData['judul']);

            // Check for existing slug to ensure uniqueness
            $count = Article::where('slug', $slug)->count();
            if ($count > 0) {
                $slug .= '-' . time();
            }

            $fileName = time() . rand(1, 200) . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move(public_path('blogs'), $fileName);

            $requestData['slug'] = $slug;
            $requestData['gambar'] = $fileName;
            $requestData['status'] = '0';
            $requestData['publish_date'] = Carbon::now()->format('Y-m-d');
            Article::create($requestData);

            DB::commit();

            return redirect()->route('article.index')->with('success', 'Article created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create article: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    public function toggleStatus($id)
    {
        $article = Article::findOrFail($id);
        $article->status = $article->status == '0' ? '1' : '0';
        $article->save();

        return redirect()->route('article.index')->with('success', 'Status artikel berhasil diubah.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = CategoryArticle::all();
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    try {
        $requestData = $request->validate([
            'category_id' => 'required',
            'judul' => 'required|unique:articles,judul,' . $id,
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $article = Article::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $fileName = time() . rand(1, 200) . '.' . $request->file('gambar')->getClientOriginalExtension();
            $filePath = $request->file('gambar')->storeAs('blogs', $fileName, 'public');
            $requestData['gambar'] = $filePath;

            // Delete old image
            if ($article->gambar) {
                Storage::disk('public')->delete('blogs/' . $article->gambar);
            }
        }

        $article->update($requestData);

        return redirect()->route('article.index')->with('success', 'Article updated successfully');
    } catch (Exception $e) {
        Log::error('Failed to update article: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Failed to update article: ' . $e->getMessage());
    }
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

