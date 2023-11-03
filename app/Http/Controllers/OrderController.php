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

class OrderController extends Controller
{
    public function view($orderId)
    {
        $order = Order::with('receipts.product')->findOrFail($orderId);
        return view('client.order', compact('order'));
    }
    
}