<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CartController extends Controller
{
    public function cart()
    { 
        $carts= Cart::all();
        return view('client.cart',compact('carts'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'quantity'=>'required',
        ]);
        
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::findOrFail($product_id);

        $product_price= $product->price;
        $price = $quantity * $product_price;

        $cartItem = new Cart([
            'product_id' => $product_id,
            'price' => $product->price,
            'quantity' => $request->quantity,
        ]);
        // Lưu thông tin vào giỏ hàng
        $cartItem->save();

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function delete($cartId)
    {
        $cart = Cart::find($cartId);

        if (!$cart) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Cart item removed successfully.');
    }

}