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
        return view('cart',compact('carts'));
    }
    public function addToCart(Request $request, $product_id)
    {

        $product = Product::findOrFail($product_id);

        $cartItem = new Cart([
            'product_id' => $product_id,
            'product_name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'image' => $product->image,
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