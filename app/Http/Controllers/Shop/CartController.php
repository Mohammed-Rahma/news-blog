<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::all();
        return view('shop.cart' , [
            'cart' => $cart
        ] );
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1', 'max:99']
        ]);

        $cookie_value= $request->input('cookies_name');
        if (! $cookie_value) {
            $cookie_value = Str::uuid();
            Cookie::queue('cookies_name' , $cookie_value , 60*24*30);

            $item = Cart::where('cookie_id' , '=' , $cookie_value )
                    ->where('product_id' , '=' , $request->input('product_id'))
                    ->first();
                    if($item){
                        $item->increment('quantity' , $request->input('quantity', 1));
                    }else{
                        Cart::create([
                            'cookie_id' => $cookie_value,
                            'user_id' => Auth::id(),
                            'product_id' => $request->input('product_id'),
                            'quantity' => $request->input('quantity', 1)
                        ]);
                    }


        }

        return back()->with('success' , 'product added to cart');
    }
    public function destroy()
    {
    }
}
