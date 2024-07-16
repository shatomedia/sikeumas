<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:product', ['only' => ['index']]);
        $this->middleware('permission:create-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'foto' => 'required',
            'deskripsi' => 'required',
            'spesifikasi' => 'required',
        ]);

        $fileName = time() . rand(1, 200) . '.' . $request->file('foto')->getClientOriginalExtension();
        $request->file('foto')->move(public_path('products'), $fileName);

        $requestData['foto'] = $fileName;
        Product::create($requestData);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $requestData = $request->validate([
            'nama' => 'required',
            'foto' => 'image|nullable',
            'deskripsi' => 'required',
            'spesifikasi' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $fileName = time() . rand(1, 200) . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('products'), $fileName);
            $requestData['foto'] = $fileName;
        }

        $product->update($requestData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
