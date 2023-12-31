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
            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4"
                        href="#"><img class="me-2"
                            src="{{ asset('asset/backend/src/img/icons/spot-illustrations/falcon.png') }}"
                            alt="" width="58" /><span
                            class="font-sans-serif fw-bolder fs-5 d-inline-block">pyfatora</span></a>
                    <div class="card">
                        @if (\Session::has('message'))
                            <div class="alert alert-danger">
                                <li>{!! \Session::get('message') !!}</li>
                            </div>
                        @endif
                        <div class="card-body p-4 p-sm-5">
                            <div class="row flex-between-center mb-2">
                                <div class="col-auto">
                                    <h5>تسجيل دخول</h5>
                                </div>

                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="{{ $type }}">
                                <div class="mb-3">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row flex-between-center">
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" id="remember"
                                                name="remember" checked="checked"
                                                {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label mb-0" for="remember">تذكرني</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a class="fs--1" href="{{ route('password.request') }}">هل نسيت كلمة
                                            المرور؟</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                        name="submit">دخول</button>
                                </div>
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
