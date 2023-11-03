<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/client/cart.css') }}">
</head>

<body>
    @extends('layout.layout')
    @section('title', 'Trang chủ')
    @section('content')
    <h2 style="margin-top:70px;font-size:40px">Your Cart</h2>
    <form action="{{ route('receipt.save') }}" method="POST" id="cart">
        @csrf
        <table class="cart-table">
            <tbody>
                @foreach ($carts as $cart)
                <tr>
                    <td>
                        <input type="checkbox" name="selected_cart_ids[]" value="{{ $cart->id }}">
                    </td>
                    <td>{{ $cart->id }}</td>
                    <td><img src="{{ $cart->product->image }}" alt="{{ $cart->product->name }}" width="50"></td>
                    <td>
                        <div class="product-details">
                            <p style="font-weight: bold;">{{ $cart->product_name }}</p>
                            <p style="color:#a2a2a4">price:{{ $cart->price }}$</p>
                            <p style="color:#a2a2a4">quantity:{{ $cart->quantity }}</p>
                        </div>
                    </td>
                    <td style="font-weight: bold;">{{ $cart->price * $cart->quantity }}$</td>
                    <td>
                        <form action="{{ route('cart.delete', ['id' => $cart->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn-remove"><i class="fa-solid fa-minus"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn-buy-now" style="margin-left: 88%;
        margin-top: 20px;margin-bottom: 40px;">Buy Now</button>
    </form>
    @endsection
</body>

</html>