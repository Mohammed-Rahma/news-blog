<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{
    public function __construct(Request $request)
    {
        if ($request->method() == 'GET') {
            $category = Category::all();
            View::share([
                'categories' => $category,
                'status_options' => Product::StatusOptions()
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //collection of std object = array ستاندرد اوبجكت يعني اوبجكت ملوش كلاس 
        //Collection of model object 
        $products = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name'
            ])
            // ->where('user_id' , '=' , 1)
            //$request->all()  ترجعلي بيانات من الفورم لو كان الفورم معمول بطريقة البوست و بتجيب كل الداتا الي تم تمريرها في البو ار ال url
            ->Filter($request)
            ->withoutglobalscope('owner')
            ->simplePaginate(4); //onlyTrashed(),withTrashed()
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
        return view('admin.products.create', [
            'product' => $products,
            'title' => 'Create Product',
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

        $data['user_id'] = Auth::id();
        $product = Product::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', ['disk' => 'public'])
                ]);
            }
        }
        
        //ajax
        if ($product) {
            return response()->json([
                'status' => true,
                'msg' => 'Successfully Created!'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'msg' => 'Failed Created!'
            ]);
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
        $gallery = ProductImage::where('product_id', '=', $product->id);
        return view('admin.products.edit', [
            'product' => $product,
            'title' => 'Edit Products',
            'gallery' => $gallery
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
        $offer = $product->update($data);
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

        //ajax
        if ($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'Successfully Updated!'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'msg' => 'Failed Updated!'
            ]);
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
        return redirect()->route('products.index')->with('success', "Product {($product->name)} deleted!");
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate();
        return view('admin.products.trashed', [
            'products' => $products
        ]);
    }
    public function restore(string $id)
    {
        $product = Product::onlyTrashed()->findorfail($id);
        $product->restore();
        return redirect()->route('products.index')->with('success', "Product {($product->name)} Restore");
    }
    public function forceDelete(string $id)
    {
        $product = Product::onlyTrashed()->findorfail($id);
        $product->forceDelete();
        return redirect()->route('products.index')->with('success', "Product {($product->name)} deleted");
    }
}
