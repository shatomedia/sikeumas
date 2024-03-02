<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Category;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kategori-informasi', ['only' => ['index']]);
        $this->middleware('permission:create-kategori-informasi', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kategori-informasi', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kategori-informasi', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('app.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        Category::create($requestData);
        return redirect()->route('kategori.index')->with('success', 'Kategori informasi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('app.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        $category = Category::findOrFail($id);

        $category->update($requestData);
        return redirect()->route('kategori.index')->with('success', 'Kategori informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori informasi berhasil dihapus.');
    }
}
