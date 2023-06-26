<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- ===============================================-->
<!--    Document Title-->
<!-- ===============================================-->
<title>@yield('title')</title>


<!-- ===============================================-->
<!--    Favicons-->
<!-- ===============================================-->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('asset/backend/src/img/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32"
    href="{{ asset('asset/backend/src/img/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16"
    href="{{ asset('asset/backend/src/img/favicons/favicon-16x16.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/backend/src/img/favicons/favicon.ico') }}">
<link rel="manifest" href="../assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="{{ asset('asset/backend/src/img/favicons/mstile-150x150.png') }}">
<meta name="theme-color" content="#ffffff">
<script src="{{ asset('asset/backend/src/js/config.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>


<!-- ===============================================-->
<!--    Stylesheets-->
<!-- ===============================================-->
<link href="{{ asset('asset/backend/src/vendors/leaflet/leaflet.css') }}" rel="stylesheet">
<link href="{{ asset('asset/backend/src/vendors/leaflet.markercluster/MarkerCluster.css') }}" rel="stylesheet">
<link href="{{ asset('asset/backend/src/vendors/leaflet.markercluster/MarkerCluster.Default.css') }}" rel="stylesheet">
<link href="{{ asset('asset/backend/src/vendors/fullcalendar/main.min.css') }}" rel="stylesheet">
<link href="{{ asset('asset/backend/src/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
    rel="stylesheet">
<link href="{{ asset('asset/backend/src/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
<link href="{{ asset('asset/backend/src/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
<link href="{{ asset('asset/backend/src/css/theme.min.css') }}" rel="stylesheet" id="style-default">
<link href="{{ asset('asset/backend/src/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
<link href="{{ asset('asset/backend/src/css/user.min.css') }}" rel="stylesheet" id="user-style-default">

<link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet">
<link href="{{ asset('asset/backend/src/vendors/prism/prism-okaidia.css') }}" rel="stylesheet">
@yield('css')
