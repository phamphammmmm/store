<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
</head>

<body>
    @include('partials.header')

    <div class="content">
        @yield('content')
    </div>

    @include('partials.footer')
</body>

</html>