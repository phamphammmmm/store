<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{

    public function save(Request $request)
    {
        $selectedCartIds = $request->input('selected_cart_ids');

        if (empty($selectedCartIds)) {
            return redirect()->back()->with('error', 'No items selected.');
        }

        // Tạo một lần mua hàng mới
        $order = new Order([
            'user_id' => Auth::user()->id,
            'date' => now(),
        ]);
        $order->save();

        foreach ($selectedCartIds as $cartId) {
            $cart = Cart::find($cartId);
            if ($cart) {
                $product = Product::find($cart->product_id);

                if ($product) {
                    // Lưu thông tin sản phẩm trong hóa đơn
                    $receipt = new Receipt([
                        'order_id' => $order->id,
                        'product_name' => $product->name,
                        'quantity' => $cart->quantity,
                        'total' => $cart->price * $cart->quantity,
                    ]);
                    $receipt->save();

                    // Xóa giỏ hàng sau khi tạo hóa đơn
                    $cart->delete();
                }
            }
        }

        return redirect()->route('order', ['id' => $order->id])->with('success', 'Orders have been saved successfully.');
    }

}