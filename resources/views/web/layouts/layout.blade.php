<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description" content="{{ __('web.description') }}">
    <meta name="keywords" content="{{ __('web.keywords') }}">
    <meta name="author" content="Azizbek Kamolov">
    <title>{{ __('web.colleagues_of_advocates') }}-{{ env('APP_NAME') }}</title>
    <meta name="robots" content="noindex, nofollow">

    <link href="/source/favicons/android-chrome-192x192.png" sizes="192x192" type="image/png">
    <link href="/source/favicons/android-chrome-512x512.png" izes="512x512" type="image/png">
    <link href="/source/favicons/apple-touch-icon.png" sizes="72x72" type="image/png">
    <link href="/source/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="/source/favicons/favicon.ico" rel="icon" type="image/x-icon">


    <meta property="og:title" content="{{ __('web.colleagues_of_advocates') }}"/>
    <meta property="og:description" content="{{ __('web.colleagues_of_advocates') }}"/>
    <meta property="og:image" content="/source/favicons/favicon.ico"/>
    <meta property="og:url" content="https://bayunusobod.uz"/>
    <meta property="og:site_name" content="https://bayunusobod.uz"/>
    <meta property="og:type" content="https://bayunusobod.uz"/>

    <link rel="shortcut icon" href="/source/favicons/favicon.ico">


    {{--    <script async="" src="{{ asset('source/./saved_resource') }}"></script>--}}
    <link rel="stylesheet" href="{{ asset('source/widget-icon-list.min.css') }}">
    <link rel="stylesheet" id="hfe-widgets-style-css" href="{{ asset('/source/frontend.css') }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="hfe-widgets-style-css" href="{{ asset('/source/styles/custom.css') }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="odometer-css-css" href="{{ asset('source/odometer.css') }}" type="text/css" media="all">
    <link rel="stylesheet" id="bizmax-toolkit-css" href="{{ asset('source/bizmax-toolkit.css') }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="bizmax-updated-css" href="{{ asset("source/bizmax-updated.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="slick-css" href="{{ asset("source/slick.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="contact-form-7-css" href="{{ asset("source/styles.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="hfe-style-css" href="{{ asset("source/header-footer-elementor.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="elementor-icons-css" href="{{ asset("source/elementor-icons.min.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="elementor-frontend-css" href="{{ asset("source/frontend-lite.min.css") }}"
          type="text/css" media="all">
    <link rel="stylesheet" id="swiper-css" href="{{ asset("source/swiper.min.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-post-9-css" href="{{ asset("source/post-9.css") }}" type="text/css"
          media="all">
    {{--    <link rel="stylesheet" id="bizmax-essentials-css" href="{{ asset("source/bizmax-essentials.css") }}" type="text/css" media="all">--}}
    <link rel="stylesheet" id="elementor-global-css" href="{{ asset("source/global.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="elementor-post-17-css" href="{{ asset("source/post-17.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="elementor-post-4144-css" href="{{ asset("source/post-4144.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="sorex-google-fonts-css" href{{ asset("source/./css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="animate-css" href="{{ asset("source/animate.min.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="bootstrap-css" href="{{ asset("source/bootstrap.min.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="fontawesome-pro-css" href="{{ asset("source/font-awesome-pro.css") }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="meanmenu-css" href="{{ asset("source/meanmenu.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="bizmax-reset-css" href="{{ asset("source/reset.css") }}" type="text/css" media="all">
    <link rel="stylesheet" id="bizmax-style-css" href="{{ asset("source/style.css") }}" type="text/css" media="all">
    {{--    <link rel="stylesheet" id="bizmax-custom-style-css" href="{{ asset("source/theme-style.css") }}" type="text/css" media="all">--}}
    <link rel="stylesheet" id="csf-google-web-fonts-css" href="{{ asset('source/css(1)') }}" type="text/css"
          media="all">
    <link rel="stylesheet" id="google-fonts-1-css" href="{{ asset('source/css(2)') }}" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-icons-shared-0-css" href="{{ asset('source/fontawesome.min.css') }}"
          type="text/css" media="all">
    <link rel="stylesheet" id="elementor-icons-fa-brands-css" href="{{ asset('source/brands.min.css') }}"
          type="text/css" media="all">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <script type="text/javascript" src="{{ asset('source/jquery.min.js') }}" id="jquery-core-js"></script>
    <script type="text/javascript" src="{{ asset('source/jquery-migrate.min.js') }}" id="jquery-migrate-js"></script>

    <meta name="cdp-version" content="1.4.8">
    <meta name="generator"
          content="Elementor 3.23.4; features: e_optimized_css_loading, additional_custom_breakpoints, e_lazyload; settings: css_print_method-external, google_font-enabled, font_display-swap">
    <link rel="icon" href="{{ asset('source/logos/logo2.png') }}"
          sizes="32x32">
    <link rel="icon" href="{{ asset('source/logos/logo2.png') }}"
          sizes="192x192">
    <link rel="apple-touch-icon"
          href="{{ asset('source/logos/logo2.png') }}">
    <meta name="msapplication-TileImage"
          content="{{ asset('source/logos/logo2.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="{{ asset('source/ajax.php') }}" id="aHR0cHM6Ly9iaXptYXgtd3AubGFyYWxpbmsuY29t"></script>
</head>

<body
    class="home page-template-default page page-id-17 wp-custom-logo ehf-footer ehf-template-bizmax-wp ehf-stylesheet-bizmax-wp no-sidebar elementor-default elementor-kit-9 elementor-page elementor-page-17 e--ua-blink e--ua-chrome e--ua-webkit"
    data-elementor-device-mode="desktop">
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
              style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>

<!-- back to top end -->

@yield('content')
@include('web.layouts.footer')
<link rel="stylesheet" id="e-animations-css" href="{{ asset('source/animations.min.css') }}" type="text/css"
      media="all">
<script type="text/javascript" src="{{ asset('source/imagesloaded-pkgd.js') }}"
        id="imagesloaded-pkgd-js"></script>
<script type="text/javascript" src="{{ asset('source/isotope-pkgd.js') }}" id="isotope-pkgd-js"></script>
<script type="text/javascript" src="{{ asset('source/ripples.min.js') }}" id="ripples-js"></script>
{{--        <script type="text/javascript" src="{{ asset('source/magnific-popup.js') }}" id="magnific-popup-js"></script>--}}
<script type="text/javascript" src="{{ asset('source/counter-up.min.js') }}" id="counterup-js"></script>
<script type="text/javascript" src="{{ asset('source/odometer.js') }}" id="odometer-js"></script>
<script type="text/javascript" src="{{ asset('source/slick.min.js') }}" id="slick-js-js"></script>
<script type="text/javascript" src="{{ asset('source/swiper.min.js') }}" id="swiper-js-js"></script>
<script type="text/javascript" src="{{ asset('source/youtube-video.min.js') }}" id="yt-player-js"></script>
<script type="text/javascript" src="{{ asset('source/plugin-active.js') }}" id="plugin-js"></script>
<script type="text/javascript" src="{{ asset('source/hooks.min.js') }}" id="wp-hooks-js"></script>
<script type="text/javascript" src="{{ asset('source/i18n.min.js') }}" id="wp-i18n-js"></script>
<script type="text/javascript" src="{{ asset('source/index.js') }}" id="swv-js"></script>
<script type="text/javascript" src="{{ asset('source/scripts/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('source/index(1).js') }}" id="contact-form-7-js"></script>
<script type="text/javascript" src="{{ asset('source/bootstrap.min.js') }}" id="bootstrap-js"></script>
<script type="text/javascript" src="{{ asset('source/meanmenu.js') }}" id="meanmenu-js"></script>
<script type="text/javascript" src="{{ asset('source/imagesloaded.min.js') }}" id="imagesloaded-js"></script>
<script type="text/javascript" src="{{ asset('source/masonry.min.js') }}" id="masonry-js"></script>
<script type="text/javascript" src="{{ asset('source/jquery.masonry.min.js') }}"
        id="jquery-masonry-js"></script>
<script type="text/javascript" src="{{ asset('source/main.js') }}" id="bizmax-active-js"></script>
<script type="text/javascript" defer="" src="{{ asset('source/forms.js') }}" id="mc4wp-forms-api-js"></script>
<script type="text/javascript" src="{{ asset('source/webpack.runtime.min.js') }}"
        id="elementor-webpack-runtime-js"></script>
<script type="text/javascript" src="{{ asset('source/frontend-modules.min.js') }}"
        id="elementor-frontend-modules-js"></script>
<script type="text/javascript" src="{{ asset('source/waypoints.min.js') }}"
        id="elementor-waypoints-js"></script>
<script type="text/javascript" src="{{ asset('source/core.min.js') }}" id="jquery-ui-core-js"></script>
<script type="text/javascript" src="{{ asset("source/frontend.min.js") }}" id="elementor-frontend-js"></script>

</body>
</html>
