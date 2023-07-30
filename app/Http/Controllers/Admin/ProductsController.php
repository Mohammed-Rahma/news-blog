<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            ])->active()
            // ->where('user_id' , '=' , 1)
            ->withoutglobalscope('owner')
            ->simplePaginate(2); //onlyTrashed(),withTrashed()
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
            'title' => 'Create Product',
            'status_options' => Product::StatusOptions()
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
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
               ProductImage::create([
                'product_id'=>$product->id,
                'image'=>$file->store('uploads/images', ['disk' => 'public'])
               ]);
            }
        }
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
    public function edit(Product $product)
    {
        $category = Category::all();
        $gallery = ProductImage::where('product_id' , '=' , $product->id);
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $category,
            'title' => 'Edit Products',
            'status_options' => Product::StatusOptions(),
            'gallery'=>$gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads\images', ['disk' => 'public']);
            $data['image'] = $path;
        }
        $old_image = $product->image;
        $product->update($data);
        if ($old_image && $old_image != $product->image) {
            Storage::disk('public')->delete($old_image);
        }
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', ['disk' => 'public'])
                ]);
            }
        }
        return redirect()->route('products.index')->with('success', "Product ({$product->name}) Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrfail($id);
        $product->delete();
        // Product::where('id' , '=' , $id)->delete();
        return redirect()->route('products.index')->with('success', "Product {($product->name)} deleted");
    }

    public function trashed(){
        $products = Product::onlyTrashed()->paginate();
        return view('admin.products.trashed' , [
            'products'=>$products
        ]);
    }
    public function restore(string $id){
        $product = Product::onlyTrashed()->findorfail($id);
         $product->restore();
        return redirect()->route('products.index')->with('success', "Product {($product->name)} Restore");

    }
    public function forceDelete(string $id){
        $product = Product::onlyTrashed()->findorfail($id);
        $product->forceDelete();
        return redirect()->route('products.index')->with('success', "Product {($product->name)} deleted");

    }
}
