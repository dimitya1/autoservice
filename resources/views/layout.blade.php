<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>@yield('title')</title>
    <style>
        body {
            background-image: url(../assets/img/background.jpg); /* Путь к фоновому изображению */
        }
    </style>
</head>
<body>
<br>
    <style>
        div:not([id="bg"]):not([role="alert"]){
            background-color: #ffffe6
        }
        footer {
            background-color: #d6d6c2
        }
    </style>

    @yield('content')

<!-- Footer -->
<footer class="page-footer font-small mdb-color lighten-33 pt-4">
    <div class="container text-center text-md-left" id="bg">
        <div class="row" id="bg">
            <hr class="clearfix w-100 d-md-none">
            <div class="col-md-2 col-lg-2 mx-auto my-md-4 my-0 mt-4 mb-1" id="bg">
                <h5 class="font-weight-bold text-uppercase mb-4">Контакты</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="https://www.google.com/intl/ru/gmail/about/">
                            <img src="https://img.icons8.com/ios-filled/50/000000/email-open.png"/></a>autoservice.politex@gmail.com
                    </li>
                    <li>
                        <p><img src="https://img.icons8.com/ios-filled/50/000000/apple-phone.png"/>+380995683944</p>
                    </li>
                </ul>

            </div>
            <hr class="clearfix w-100 d-md-none" id="bg">
            <div class="col-md-4 col-lg-3 mx-auto my-md-4 my-0 mt-4 mb-1" id="bg">
                <h5 class="font-weight-bold text-uppercase mb-4">Адрес</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="https://www.google.com.ua/maps/place/просп.+Шевченко,+1,+Одесса,+Одесская+область,+65000/@46.4590146,30.7493358,16z/data=!4m5!3m4!1s0x40c6316278a07fd1:0xfd1e879a0df88d16!8m2!3d46.459835!4d30.7518678?hl=ru">
                            <img src="https://img.icons8.com/wired/64/000000/city.png"/></a>Одесса
                    </li>
                    <li>
                        <a href="https://www.google.com.ua/maps/place/просп.+Шевченко,+1,+Одесса,+Одесская+область,+65000/@46.4590146,30.7493358,16z/data=!4m5!3m4!1s0x40c6316278a07fd1:0xfd1e879a0df88d16!8m2!3d46.459835!4d30.7518678?hl=ru">
                            <img src="https://img.icons8.com/nolan/64/address.png"/></a>Пр-т Шевченка, 1
                    </li>
                </ul>

            </div>
            <hr class="clearfix w-100 d-md-none">
            <div class="col-md-2 col-lg-4 text-center mx-auto my-4" id="bg">
                <h5 class="font-weight-bold text-uppercase mb-4">Мы в социальных сетях</h5>
                <a href="https://www.facebook.com">
                    <img src="https://img.icons8.com/cute-clipart/64/000000/facebook.png"/></a>
                <a href="https://www.youtube.com">
                    <img src="https://img.icons8.com/cute-clipart/64/000000/youtube-play.png"/></a>
                <a href="https://www.instagram.com">
                    <img src="https://img.icons8.com/cute-clipart/64/000000/instagram-new.png"/></a>
                <a href="https://tlgrm.ru">
                    <img src="https://img.icons8.com/cute-clipart/64/000000/telegram-app.png"/></a>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center py-3" id="bg">© 2020 Copyright:
        <a href="#"> autoservice.com</a>
    </div>
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
