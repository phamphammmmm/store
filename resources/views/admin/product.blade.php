<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <ink rel="styleshet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}">
    </style>
</head>

<body>
    @extends('admin.dashboard')
    @section('content')
    <div class="container">
        <div class="header">
            <h1>Product</h1>
            <div class="add-product-container">
                <button id="addProductBtn" class="add-product-btn">Add Product</button>
            </div>
        </div>
        @if (!empty($products))
        <div class="content-category">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Preview</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Brand</th>
                        <th>Categroy</th>
                        <th class="actions">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td data-id="{{ $product->id }}">{{ $product->id }}</td>
                        <td class="image" data-id="{{ $product->id }}">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        </td>
                        <td class="name" data-id="{{ $product->id }}">{{ $product->name }}</td>
                        <td class="price" data-id="{{ $product->id }}">{{ $product->price }}</td>
                        <td class="description" data-id="{{ $product->id }}">{{ $product->description }}</td>
                        <td class="brand" data-id="{{ $product->id }}">{{ $product->brand->name }}</td>
                        <td class="category" data-id="{{ $product->id }}">{{ $product->category->name }}</td>
                        <td class="action-buttons">
                            <button>
                                <a href="#" class="edit-product-btn" data-product-id="{{ $product->id }}">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                            </button>
                            <form method="POST" action="{{ route('product.delete', ['id' => $product->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure to delete?')"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        @else
        <p>No categories found.</p>
        @endif
    </div>

    <!-- Add popup -->
    <div class="popup-overlay" id="addProductPopup">
        <div class="popup-content">
            <h3>Add Product</h3>
            <form id="editProductForm" action="{{ route('product.create') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-row">
                    <label for="mame">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Product" required>
                </div>
                <div class="form-row">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" required step="0.01">
                </div>
                <div class="form-row">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control"
                        placeholder="Enter description"></textarea>
                </div>
                <div class="form-row">
                    <label for="brand_id">Brand:</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="">Select a Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <button type="submit" id="addCategoryPopupBtn" class="add-button">Save</button>
            </form>
        </div>
    </div>

    <!-- Edit product -->
    <div class="popup-overlay" id="editProductPopup">
        <div class="popup-content">
            <h2>Edit Product</h2>
            <form id="editProductForm" method="POST" action="{{route('product.update', ['id' => ':id'])}}"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="ProductId" id="editProductId">
                <div class="form-row">
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" name="editName" required>
                </div>
                <div class="form-row">
                    <label for="editprice">Price:</label>
                    <input type="number" name="editprice" id="editprice" class="form-control" required step="0.01">
                </div>
                <div class="form-row">
                    <label for="description">Description:</label>
                    <textarea name="editdescription" id="editdescription" class="form-control"></textarea>
                </div>
                <div class="form-row">
                    <label for="brand_id">Brand:</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="">Select a Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="updatProductBtn" class="update-button">Update</button>
            </form>
        </div>
    </div>
    @endsection
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-product-btn");
        const editPopup = document.getElementById("editProductPopup");
        const editForm = document.getElementById("editProductForm");
        const editProductIdInput = document.getElementById("editProductId");
        const editProductNameInput = document.getElementById("name");
        const editProductPriceInput = document.getElementById("price");
        const editProductDescriptionInput = document.getElementById("description");
        const editProductBrandIdInput = document.getElementById("brand_id");
        const editProductCategoryIdInput = document.getElementById("category_id");

        editPopup.addEventListener('click', (event) => {
            if (event.target === editPopup) {
                editPopup.style.display = 'none';
            }
        });

        editButtons.forEach(button => {
            button.addEventListener("click", async function() {
                const productId = button.dataset.productId;

                // Fetch product data from API
                const response = await fetch(`/api/products/${productId}`);
                const productData = await response.json();
                // Assign product data to input fields
                editProductIdInput.value = productData.id;
                editProductNameInput.value = productData.name;
                editProductPriceInput.value = productData.price;
                editProductDescriptionInput.value = productData.description;
                editProductBrandIdInput.value = productData.brand;
                editProductCategoryIdInput.value = productData.category;

                // Show the edit popup
                editPopup.style.display = "block";
            });
        });

        // Handle form submission
        editForm.addEventListener("submit", async function(event) {
            const formData = new FormData(editForm);

            // Update product data using API
            const productId = formData.get("ProductId");
            const updateResponse = await fetch(`/api/product/${productId}`, {
                method: "POST",
                body: formData
            });

            if (updateResponse.status === 200) {
                // Product updated successfully
                // Close the edit popup
                editPopup.style.display = "none";
            }
        });
    });
    </script>
    <script src="{{ asset('js/admin/product.js') }}"></script>
</body>

</html>