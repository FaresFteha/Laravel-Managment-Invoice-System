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
                        href="../../../index.html"><img class="me-2"
                            src="{{ asset('asset/backend/src/img/icons/spot-illustrations/falcon.png') }}"
                            alt="" width="58" /><span
                            class="font-sans-serif fw-bolder fs-5 d-inline-block">pyfatora</span></a>
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="text-center">إعادة تعيين كلمة المرور الجديدة</h5>
                            <form method="POST" action="{{ route('password.update') }}" class="mt-3">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="mb-3">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">كلمة المرور الجديدة</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="كلمة المرور الجديدة">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">تاكيد كلمة
                                        المرور </label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="تاكيد كلمة المرور الجديدة">

                                </div>
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">إعادة
                                    تعيين كلمة المرور</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    @include('layouts.backend.scripts')
</body>

</html>
