<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>

<body>
    <footer class="footer-distributed">

        <div class="footer-left">

            <h3>SMART<span>logo</span></h3>

            <p class="footer-links">
                <a href="#">Home</a>
                ·
                <a href="#">Blog</a>
                ·
                <a href="#">Pricing</a>
                ·
                <a href="#">About</a>
                ·
                <a href="#">Contact</a>
            </p>

            <p class="footer-company-name">Company Name © 2015</p>

            <div class="footer-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>


        </div>
        <div class="fter-right">
            <div class="address">
                <i class="fa-sharp fa-solid fa-location-dot"></i>
                <a href="#">address:<span> university linhconl</span> </a>
            </div>
            <div class="phone">
                <i class="fa-solid fa-phone"></i>
                <a href="tel:0386296319">phone: <span> 0386296319</span></a>
            </div>
            <div class="email">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:long300312a1@gmail.com">email:<span> long200312a1@gmail.com</span></a>
            </div>
        </div>
        <div class="footer-right">

            <p>Contact Us</p>

            <form action="#" method="post">

                <input type="email" name="email" placeholder="Email"
                    style="width: 400px;height: 20px; border-radius: 5px;">
                <textarea type="text" name="message" placeholder="Message" style="height:50px;"></textarea>
                <button>Send</button>

            </form>

        </div>

    </footer>



</body>

</html>