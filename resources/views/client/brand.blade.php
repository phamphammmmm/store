<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand</title>
</head>

<body>
    @extends('layout.layout')
    @section('content')

    <h1>Home</h1>
    @foreach ($brands as $brand)
    <h3>{{ $brand->name }}</h3>
    <ul>
        @foreach ($brand->products as $product)
        <li>{{ $product->name }}</li>
        @endforeach
    </ul>
    @endforeach
    @endsection
</body>

</html>