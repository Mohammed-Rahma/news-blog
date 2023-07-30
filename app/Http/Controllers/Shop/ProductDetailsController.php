<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function index()
    {
    }
    public function show(string $slug)
    {
        $product = Product::where('slug' , '=' , $slug)->firstorfail();
        $gallery = ProductImage::where('product_id', '=' , $product->id)->get();
        return view('shop.product-details', [
            'product' => $product,
            'gallery'=>$gallery
        ]);
    }
}
