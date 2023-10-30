<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/brand.css') }}">
    </style>
</head>

<body>
    @extends('admin.dashboard')
    @section('content')
    <div class="container">
        <div class="header">
            <h1>Brand</h1>
            <div class="add-brand-container">
                <button id="addBrandBtn" class="add-Brand-btn">Add Brand</button>
            </div>
        </div>
        @if (!empty($brands))
        <div class="content-brand">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Preview</th>
                        <th>Name</th>
                        <th>Created_at</th>
                        <th class="actions">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td data-id="{{ $brand->id }}">{{ $brand->id }}</td>
                        <td class="path" data-id="{{ $brand->id }}">
                            <img src="{{ asset( $brand->path) }}" alt="path">
                        </td>
                        <td class="name" data-id="{{ $brand->id }}">{{ $brand->name }}</td>
                        <td class="date" data-id="{{ $brand->id }}">{{ $brand->created_at }}</td>
                        <td class="action-buttons">
                            <button class="edit-brand-btn" data-id="{{ $brand->id }}">
                                <img src="{{asset('storage/logo/draw.png')}}" alt="edit">
                            </button>
                            <form method="POST" action="{{ route('brand.delete', ['id' => $brand->id]) }}">
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
    <div class="popup-overlay" id="addBrandPopup">
        <div class="popup-content">
            <h3>Add Brand</h3>
            <form id="editBrandForm" action="{{ route('brand.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-row">
                    <label for="BrandName">Brand Name:</label>
                    <input type="text" id="BrandName" name="name" required>
                </div>

                <div class="form-row">
                    <label for="path">Preview:</label>
                    <input type="file" name="path" accept="image/*">
                </div>
                <button type="submit" id="addBrandPopupBtn" class="add-button">Save</button>
            </form>
        </div>
    </div>

    <!-- Edit popup -->
    <div class="popup-overlay">
        <div class="popup-content">
            <h2>Edit Brand</h2>
            <form id="editBrandForm" action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" id="Brand_id" name="Brand_id" value="">
                <div class="form-row">
                    <label for="name">Brand:</label>
                    <input type="text" id="name" name="name" placeholder="Brand Name">
                </div>
                <div class="form-row">
                    <label for="path">Preview:</label>
                    <input type="file" name="path" accept="image/*">
                </div>
                <button type="submit" id="save-button" class="save-button">Save</button>
            </form>
        </div>
    </div>
    @endsection
    @section('footer')
    <script src="{{ asset('js/admin/brand.js') }}"></script>
</body>

</html>