<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //collection of std object = array ستاندرد اوبجكت يعني اوبجكت ملوش كلاس 
        //Collection of model object 
        $products = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name'
            ])->get();
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = new Product();
        $category = Category::all();
        return view('admin.products.create', [
            'product' => $products,
            'categories' => $category,
            'title' => 'Create Products',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {


        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', ['disk' => 'public']);
            $data['image'] = $path;
        }
        $product = Product::create($data);
        //prg : post redirect get
        return  redirect()
            ->route('products.index')->with('success', "Product ({$product->name}) Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrfail($id);
        $category = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $category,
            'title' => 'Edit Products',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrfail($id);
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('products.index')->with('success', "Product ({$product->name}) Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrfail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', "Product ({$product->name}) deleted");
    }
}
