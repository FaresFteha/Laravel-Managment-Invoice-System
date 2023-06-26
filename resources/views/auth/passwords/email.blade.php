<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    @include('layouts.backend.head')
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
            <div class="row flex-center min-vh-100 py-6 text-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4"><img
                            class="me-2" src="{{ asset('asset/backend/src/img/icons/spot-illustrations/falcon.png') }}"
                            alt="" width="58" /><span
                            class="font-sans-serif fw-bolder fs-5 d-inline-block">pyfatora</span></a>
                    <div class="card">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="mb-0">نسيت كلمة السر؟</h5><small>أدخل بريدك الإلكتروني وسنرسل لك رابط إعادة
                                تعيين.</small>
                            <form method="POST" action="{{ route('password.email') }}" class="mt-4">
                                @csrf
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    id="email" name="email" placeholder="البريد الالكتروني" required
                                    autocomplete="email" autofocus />
                                <div class="mb-3"></div>
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">أرسل
                                    رابط إعادة التعيين</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    @include('layouts.backend.scripts')
</body>

</html>
