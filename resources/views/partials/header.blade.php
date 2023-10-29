<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <!-- link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <header>
        <div class="navbar">
            <h3>SMART</h3>
            <div class="button">
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('product')}}">Product</a></li>
                </ul>
            </div>
            <div class="btn-icon">
                <div class="search" id="search"> <i class="fa-solid fa-magnifying-glass"></i></div>
                <form class="searchform" action="">
                    <div class="input">
                        <input type="text" placeholder="search here...">
                    </div>
                    <div class="search"> <i class="fa-solid fa-magnifying-glass"></i></div>
                </form>
                <div class="cart" id="cart-btn">
                    <a href="{{route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
                <div class="dropdown-user">
                    <button class="dropbtn-user"><i class="fa-solid fa-user"></i></button>
                    <div class="dropdown-login">
                        <a href="login.php" id="loginBtn">Login</a>
                        <a href="{{route('logout')}}" id="logoutBtn">Logout</a>
                    </div>
                </div>

                <div class="menu" id="menu-btn"><i class="fa-solid fa-bars"></i></div>
            </div>
        </div>
    </header>