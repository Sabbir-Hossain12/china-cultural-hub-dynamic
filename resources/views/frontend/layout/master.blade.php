<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Danpite Tech">
    <!-- Page Title -->
    <title>China Cultural Hub</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Google Fonts Css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('public/frontend') }}/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- SlickNav Css -->
    <link href="{{ asset('public/frontend') }}/css/slicknav.min.css" rel="stylesheet">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/swiper-bundle.min.css">
    <!-- Font Awesome Icon Css-->
    <link href="{{ asset('public/frontend') }}/css/all.min.css" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="{{ asset('public/frontend') }}/css/animate.css" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/magnific-popup.css">
    <!-- Mouse Cursor Css File -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/mousecursor.css">
    <!-- Main Custom Css -->
    <link href="{{ asset('public/frontend') }}/css/custom.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
          integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
<body>

<!-- Preloader Start -->
{{--<div class="preloader">--}}
{{--    <div class="loading-container">--}}
{{--        <div class="loading"></div>--}}
{{--        <div id="loading-icon"><img src="images/loader.svg" alt=""></div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Preloader End -->

@include('frontend.includes.header')

@yield('content')

@include('frontend.includes.footer')



<!-- Jquery Library File -->
<script src="{{ asset('public/frontend') }}/js/jquery-3.7.1.min.js"></script>
<!-- Bootstrap js file -->
<script src="{{ asset('public/frontend') }}/js/bootstrap.min.js"></script>
<!-- Validator js file -->
<script src="{{ asset('public/frontend') }}/js/validator.min.js"></script>
<!-- SlickNav js file -->
<script src="{{ asset('public/frontend') }}/js/jquery.slicknav.js"></script>
<!-- Swiper js file -->
<script src="{{ asset('public/frontend') }}/js/swiper-bundle.min.js"></script>
<!-- Counter js file -->
<script src="{{ asset('public/frontend') }}/js/jquery.waypoints.min.js"></script>
<script src="{{ asset('public/frontend') }}/js/jquery.counterup.min.js"></script>
<!-- Magnific js file -->
<script src="{{ asset('public/frontend') }}/js/jquery.magnific-popup.min.js"></script>
<!-- SmoothScroll -->
<script src="{{ asset('public/frontend') }}/js/SmoothScroll.js"></script>
<!-- Parallax js -->
<script src="{{ asset('public/frontend') }}/js/parallaxie.js"></script>
<!-- MagicCursor js file -->
<script src="{{ asset('public/frontend') }}/js/gsap.min.js"></script>
<script src="{{ asset('public/frontend') }}/js/magiccursor.js"></script>
<!-- Text Effect js file -->
<script src="{{ asset('public/frontend') }}/js/SplitText.js"></script>
<script src="{{ asset('public/frontend') }}/js/ScrollTrigger.min.js"></script>
<!-- YTPlayer js File -->
<script src="{{ asset('public/frontend') }}/js/jquery.mb.YTPlayer.min.js"></script>
<!-- Wow js file -->
<script src="{{ asset('public/frontend') }}/js/wow.min.js"></script>
<!-- Main Custom js file -->
<script src="{{ asset('public/frontend') }}/js/function.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/js/all.min.js"
        integrity="sha512-gBYquPLlR76UWqCwD06/xwal4so02RjIR0oyG1TIhSGwmBTRrIkQbaPehPF8iwuY9jFikDHMGEelt0DtY7jtvQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
