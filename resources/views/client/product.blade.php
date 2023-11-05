<!DOCTYPE html>
<html>

<head>
    <title>Product</title>
    <link rel="stylesheet" href="{{ asset('css/client/product.css') }}">
</head>

<body>
    @extends('layout.layout')
    @section('title', 'Trang chủ')
    @section('content')
    <h3>Product</h3>
    <div class="container-product">
        <div class="select">
            <p>Avaiable:{{ $initialProductCount }}</p>
            <form class="search-select" action="{{ route('product') }}" method="GET">
                <select name="brand" id="brand">
                    <option value="" disabled {{ old('brand') ? '' : 'selected' }}>Brand</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand }}" {{ old('brand') === $brand ? 'selected' : '' }}>
                        {{ $brand }}
                    </option>
                    @endforeach
                </select>

                <select name="category" id="category">
                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ old('category') === $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                    @endforeach
                </select>

                <select name="price_range" id="price_range">
                    <option value="" disabled {{ old('price_range') ? '' : 'selected' }}>Price</option>
                    <option value="0-200" {{ old('price_range') === '0-200' ? 'selected' : '' }}>0 - 500</option>
                    <option value="500-1000" {{ old('price_range') === '500-1000' ? 'selected' : '' }}>500 - 1000
                    </option>
                    <option value="1000-2000" {{ old('price_range') === '1000-2000' ? 'selected' : '' }}>1000 - 5000
                    </option>
                    <option value="5000" {{ old('price_range') === '5000' ? 'selected' : '' }}>Above 5000</option>
                </select>

                <select name="year" id="year">
                    <option value="" disabled {{ old('year') ? '' : 'selected' }}>Year</option>
                    <option value="2020" {{ old('year') === '2020' ? 'selected' : '' }}>2020</option>
                    <option value="2021" {{ old('year') === '2021' ? 'selected' : '' }}>2021</option>
                    <option value="2022" {{ old('year') === '2022' ? 'selected' : '' }}>2022</option>
                    <option value="2023" {{ old('year') === '2023' ? 'selected' : '' }}>2023</option>
                </select>

                <select name="sort" id="sort">
                    <option value="" disabled selected>Sort</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <button type="submit" style="padding: 0px 10px;
border-radius: 5px;color: white;background: #00884b;border: none;">Search</button>

            </form>
        </div>

        <!-- Display product -->
        <div class="show-product">
            <div class="box">
                <ul class="product-list">
                    @foreach ($products as $product)
                    <li class="product-item">
                        <div class="img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" width="200px">
                        </div>
                        <div class="product-info">
                            <div class="generall-info">
                                <h5>{{ $product->name }}</h5>
                                <p>{{ $product->brand->name }}</p>
                            </div>
                            <div class="price">
                                <h5>{{ $product->price }}$</h5>
                            </div>
                        </div>
                        <button class="view-product-btn" data-product-id="{{ $product->id }}">View</button>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="product-popup" id="productPopup">
        <div class="product-popup-content">
            <form class="add-to-cart-form" action="{{route('cart.create')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="product_id" value="">
                <img class="popup-product-image" src="" alt="" width="200">
                <div class="product-detail">
                    <h2 class="popup-product-name"></h2>
                    <p class="popup-product-price"></p>
                    <p class="popup-product-description"></p>
                    <p class="popup-product-brand"></p>
                    <p class="popup-product-category"></p>
                </div>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
        </div>
    </div>

    @endsection
    <!-- ... -->
    <script>
    let ProductId;
    document.addEventListener("DOMContentLoaded", function() {
        const viewButtons = document.querySelectorAll(".view-product-btn");
        const popup = document.getElementById("productPopup");
        const addToCartForm = popup.querySelector(".add-to-cart-form");
        const quantityInput = addToCartForm.querySelector("#quantity");
        const productIdInput = addToCartForm.querySelector('input[name="product_id"]');

        viewButtons.forEach(button => {
            button.addEventListener("click", function() {
                productId = button.dataset.productId;
                ProductId = productId;
                fetch(`/api/product/${productId}`)
                    .then(response => response.json())
                    .then(product => {

                        const popupProductName = popup.querySelector(".popup-product-name");
                        const popupProductImage = popup.querySelector(
                            ".popup-product-image");
                        const popupProductPrice = popup.querySelector(
                            ".popup-product-price");
                        const popupProductDescription = popup.querySelector(
                            ".popup-product-description");
                        const popupProductBrand = popup.querySelector(
                            ".popup-product-brand");
                        const popupProductCategory = popup.querySelector(
                            ".popup-product-category");

                        productIdInput.value = productId;
                        popupProductName.textContent = product.name;
                        popupProductImage.src = product.image;
                        popupProductPrice.textContent = "Price: " + product.price;
                        popupProductDescription.textContent = "Description: " +
                            product.description;
                        popupProductBrand.textContent = "Brand: " + product.brand;
                        popupProductCategory.textContent = "Category: " + product.category
                        popup.style.display = "block";
                    });
            });
        });

        addToCartForm.addEventListener("submit", function(event) {
            popup.style.display = "none";
        });

        popup.addEventListener('click', (event) => {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });
    });
    </script>
</body>

</html>