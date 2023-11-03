<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/client/home.css') }}">
</head>

<body>
    @extends('layout.layout')
    @section('title', 'Trang chủ')
    @section('content')
    <div class="container">
        <div class="section1">
            <div class="content">
                <div class="title">
                    <h1>
                        SMART WATCHES FACILITATE YOUR EVERY ACTIVITY
                    </h1>
                    <h3>
                        Everyone needs a smartwatch that helps to accourately track all-day steps, calorie consumption,
                        distance traveled and heart rate. Always facilitating your every daily activity.
                    </h3>
                    <div class="learn-more">
                        <button><a href="{{route('product')}}" style="color:white;">Order now!</a></button>
                        <h3 class="learn">Learn more <span>></span></h3>
                    </div>
                    <h3 class="title-small">Collaborate with the best brands</h3>
                    <div class="brand-preview">
                        <img src="storage/logo/Philips.jpg" alt="philip">
                        <img src="storage/logo/kangaroo.jpg" alt="kangaroo">
                        <img src="storage/logo/sunhouse.jpg" alt="sunhouse">
                        <img src="storage/logo/toshiba.png" alt="toshiba">
                    </div>
                </div>
                <div class="famous-branch">
                    <img src="storage/home/hublot-steel.jpg" alt="home">
                </div>
            </div>

        </div>
        <div class="section2">
            <div class="product">
                <div class="preview-images">
                    <div class="img">
                        <div class="info">
                            <img src="https://cdn2.jomashop.com/media/catalog/product/cache/df24c858758eb768757877f23cd17493/r/o/rolex-cosmograph-daytona-champagne-dial-steel-and-18k-yellow-gold-men_s-watch-116503-78593.jpg"
                                alt="image">
                            <div class="infomation">
                                <div class="span"><span class="title">ROLEX DAYTONA</span></div>
                                <p class="price">$74.200</p>
                            </div>
                        </div>
                    </div>
                    <div class="img">
                        <div class="info">
                            <img src="https://th.bing.com/th/id/OIP.e9RmlaGr_ILzmprmgntYNAAAAA?pid=ImgDet&w=156&h=199&c=7&dpr=1.1"
                                alt="image">
                            <div class="infomation">
                                <div class="span"><span class="title">BREQUET VINTAGE</span></div>
                                <p class="price">$32.700</p>
                            </div>
                        </div>
                    </div>
                    <div class="img">
                        <div class="info">
                            <img src="https://th.bing.com/th/id/OIP.iXPl5BnJZTCGeWFKOaEsMAAAAA?pid=ImgDet&rs=1"
                                alt="image">
                            <div class="infomation">
                                <div class="span"><span class="title">HUBLOT DIAMOND</span></div>
                                <p class="price">$56.500</p>
                            </div>
                        </div>
                    </div>
                    <div class="img">
                        <div class="info">
                            <img src="https://www.chrono-shop.net/122369/rolex-rare-gold-ssteel-931537836378753-tutone-bitons-link-18k-oyster-band-bracelet-20mm.jpg"
                                alt="image">
                            <div class="infomation">
                                <div class="span"><span class="title">ZENITH LUXURY</span></div>
                                <p class="price">$68.400</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="reviews">
                <div class="title">
                    <h2>REVIEWS</h2>
                    <h3><span>240K+ </span> users</h3>
                </div>
                <p>98% of users recommend shopping here because the items sold are original and reliable, What our
                    loyal customers say.
                </p>
                <div class="review-content">
                    <img src="https://th.bing.com/th/id/OIP.caoWXQIpl3X5tSLKz1tQGgAAAA?pid=ImgDet&w=400&h=400&rs=1"
                        alt="">

                    <div class="user">
                        <h3>RAFFIALDO BAYU</h3>
                        <p>trusted marketplace buy branded watches of the highest quanlity</p>
                    </div>


                </div>
                <div class="review-content">
                    <img src="https://th.bing.com/th/id/OIP.caoWXQIpl3X5tSLKz1tQGgAAAA?pid=ImgDet&w=400&h=400&rs=1"
                        alt="">

                    <div class="user">
                        <h3>Dinda Anggita</h3>
                        <p>trusted marketplace buy branded watches of the highest quanlity</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection
    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>