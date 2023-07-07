<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Regit</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite(['resources/scss/post.scss', 'resources/css/notification.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>

<body>
@if(Session::has('success') )
    <div class="noti-center">
        <div class="noti-check">
            <i class="far fa-check-circle noti-color"></i>
            &nbsp; &nbsp;
            <span>{{ Session::get('success') }}</span>
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="noti-center">
        <div class="noti-danger">
            <i class="far fa-times-circle noti-shine"></i>
            &nbsp; &nbsp;
            <span>{{ Session::get('error') }}</span>
        </div>
    </div>
@endif
@error('content')
    <div class="noti-center">
        <div class="noti-danger">
            <i class="far fa-times-circle noti-shine"></i>
            &nbsp; &nbsp;
            <span>{{ $message }}</span>
        </div>
    </div>
@enderror
@if (Session::has('warning'))
    <div class="noti-center">
        <div class="noti-warning">
            <i class="fa fa-exclamation-triangle noti-rotate"></i>
            &nbsp; &nbsp;
            <span>{{ Session::get('warning') }}</span>
        </div>
    </div>
@endif

@include("partials.header")
@yield("content")
@include("partials.footer")
@stack('js')
@vite(['resources/js/main.js'])
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>
</html>
