<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Details</title>
    <link rel="stylesheet" href="{{ asset('css/client/order.css') }}">

</head>

<body>
    @extends('layout.layout')
    @section('title', 'Trang chủ')
    @section('content')
    <div class="container">

        <!-- Button trigger modal -->
        <div class="container-bill">
            <div class="box-left">
                <div class="name-customer">
                    <p class="name">hi,{{ $order->user->name }}</p>
                    <p class="your-order">Your order confirmed</p>

                    <div class="time-order">
                        <div class="order-date">
                            <p>Order Date</p>
                            <span>{{ $order->date }}</span>
                        </div>
                        <div class="order-no">
                            <p>Order No</p>
                            <span>{{ $order->id }}</span>
                        </div>
                        <div class="Status">
                            <p>Status</p>
                            <span>Preparing</span>
                        </div>
                        <div class="address">
                            <p>Adrress</p>
                            <span>Flowers Street,30001,New York</span>
                        </div>
                    </div>
                    <div class="order">
                        @foreach ($order->receipts as $receipt)
                        <div class="products">
                            <div class="img">
                                <img src="{{ $receipt->product->image}}" alt="image">
                            </div>
                            <div class="info">
                                <p class="name-prd">
                                    {{ $receipt->product->name }}
                                </p>
                                <p class="quantity">quantity:{{ $receipt->quantity }}</p>
                                <p class="Color">Color: red</p>
                            </div>
                            <div class="price">{{ $receipt->total }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="box-right">
                <div class="pay">
                    <p class="title">Payment Details</p>
                    <p class="sub">Subtotal: <span>{{ $order->receipts->sum('total') }}$</span></p>
                    <p class="deli">Delivery: <span>10$</span></p>
                </div>
                <p class="total">Total Price: <span>144$</span></p>
                <div class="pay-method">
                    <img src="https://th.bing.com/th/id/OIP.DDsUYdUcu4KziDU-ZW9MLQHaE0?pid=ImgDet&rs=1" alt="">
                    <div class="info">
                        <p class="account">Debit **** **** 0123</p>
                        <p class="name">{{ $order->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endsection
</body>

</html>