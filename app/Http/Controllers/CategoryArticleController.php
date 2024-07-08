<?php

namespace App\Http\Controllers;

use App\Models\CategoryArticle;
use App\Http\Requests\StoreCategoryArticleRequest;
use App\Http\Requests\UpdateCategoryArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryArticles = CategoryArticle::OrderBy('id', 'DESC')->get();
        return view('category-article.index', compact('categoryArticles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required',
        ]);

        $requestData['slug'] = Str::slug($request->nama);

        CategoryArticle::create($requestData);
        return redirect()->route('category-article.index')->with('success', 'Category Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryArticle $categoryArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'nama' => 'required',
        ]);
        

        $requestData['slug'] = Str::slug($request->nama);

        $categoryArticle = CategoryArticle::find($id);
        $categoryArticle->update($requestData);
        return redirect()->route('category-article.index')->with('success', 'Category Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoryArticle = CategoryArticle::find($id);
        $categoryArticle->delete();
        return redirect()->route('category-article.index')->with('success', 'Category Article deleted successfully.');
    }
}
