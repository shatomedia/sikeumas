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

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(10);
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

    public function uploadMedia(Request $request)
    {
        //code upload here
        $post = new Article();
        $post->id = 0;
        $post->exists = true;

        $images = $post->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url'=> $images->getUrl()
        ]);
    }
}
