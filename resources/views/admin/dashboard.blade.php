<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @csrf
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>

<body>

    <div class="navbar">
        <div class="left_sidebar">
            <div class="infomation">
                <div class="avatar">
                    <img src="{{asset('storage/avatar/avatar.jpg')}}" alt="Avatar">
                    <div class="active-indicator"></div>
                </div>
                <div class="user-info">
                    <p>{{ Auth::user()->role }}</p>
                    <h3>{{ Auth::user()->name }}</h3>
                </div>
            </div>
            <ul>
                <li class="navbar-link">
                    <i class="fa-solid fa-clock"></i>
                    <a href="{{route('product.show')}}">Product</a>
                </li>
                <li class="dropdown-item" class="navbar-link">
                    <i class="fa-solid fa-image"></i>
                    <a href="{{route('brand.show')}}">Brand</a>
                </li>
                <li class="dropdown-item" class="navbar-link">
                    <i class="fa-solid fa-list"></i>
                    <a href="{{route('category.show')}}">Category</a>
                </li>
                <li class="dropdown-item" class="navbar-link">
                    <i class="fa-solid fa-image"></i>
                    <a href="{{route('contact.show')}}">Feedback</a>
                </li>
                <li class="navbar-link">
                    <i class="fa-solid fa-user"></i>
                    <a href="{{ route('manage') }}?show=user">Manage</a>
                </li>
            </ul>
            <div id="spacing" style="height:30%;"> </div>
            <div class="logout">
                <form action="{{route('logout')}}" method="POST" style="display:flex;">
                    @csrf
                    <button class="logout-circle">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                    <button type="submit" class="logout_btn">Log out</button>
                </form>
            </div>
        </div>
        <div class="content">
            <button id="sidebar-toggle"><i class="fa-solid fa-equals"></i></button>
            <div id="content-container">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>