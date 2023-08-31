<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct()
    { 
       $this->middleware('auth:sanctum')->except('index', 'show') ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Product::withoutglobalscope('owner')
            ->with(['user', 'category', 'gallery'])
            ->Filter($request)
            ->Paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $user = $request->user('sanctum');
        if (!$user->tokenCan('products.create')) { //هل التوكن بقدر ينشا منتج .اذا م كان معه الصلاحية يطلعله رسالة 403
            abort(403);
        }

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
        
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::withoutglobalscope('owner')->with('user', 'category', 'gallery')->findorfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $user = $request->user('sanctum');
        if (!$user->tokenCan('products.update')) { //هل التوكن بقدر ينشا منتج .اذا م كان معه الصلاحية يطلعله رسالة 403
            abort(403);
        }


        $data = $request->validate(
            [
                'name'=>['sometimes', 'required'],
                'slug' => ['sometimes', 'required'],
                'price'=> ['sometimes', 'required', 'numeric' , 'min:0'],
                'status'=> ['sometimes', 'required'],
                'category_id'=> ['sometimes', 'required']
            ]
        );
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
        return [
            "message" => __('messages.updated'),
            'product' => $offer
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Product $product)
    {
        $user = $request->user('sanctum');
        if (!$user->tokenCan('products.delete')) { //هل التوكن بقدر ينشا منتج .اذا م كان معه الصلاحية يطلعله رسالة 403
            abort(403);
        }


        $product->delete();
        return [
            "message" => __('messages.deleted'),
        ];
    }
}
