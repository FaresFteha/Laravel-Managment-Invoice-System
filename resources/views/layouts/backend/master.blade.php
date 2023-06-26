<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    @include('layouts.backend.head')
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            {{-- Main-Sidbar --}}
            @include('layouts.backend.main-sidebar')
            {{-- Main-Sidbar --}}

            <div class="content">
                {{-- Header --}}
                @include('layouts.backend.main-header')
                {{-- Header --}}

                @yield('header-title')
                {{-- Contnet --}}
                @yield('contnet')
                {{-- Contnet --}}
                @include('layouts.backend.footer')
            </div>

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    
    {{-- @include('layouts.backend.config-site') --}}
    


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->



    @include('layouts.backend.scripts')
</body>

</html>
