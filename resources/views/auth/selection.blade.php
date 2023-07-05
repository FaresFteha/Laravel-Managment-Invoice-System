<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    @include('layouts.backend.head')
</head>

<body>

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
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="avatar avatar-4xl">
                                <img class="rounded-circle" src="{{ asset('asset/backend/src/img/icons/shield.png') }}" alt="" />

                            </div>
                            <h5 class="mt-3 mb-0">حدد طريقة الدخول</h5><small> اختر من الاسفل</small>
                            <form class="mt-4 row g-0">
                                <div class="col">
                                    <a class="btn btn-default" href="{{ route('login.show', 'company') }}">
                                        <button class="btn btn-primary px-3 mb-2" id="user-password" type="button">
                                            شركة
                                        </button>
                                    </a>
                                </div>

                                <div class="col">
                                    <a class="btn btn-default" href="{{ route('login.show', 'client') }}">
                                        <button class="btn btn-primary px-3 mb-2" id="user-password" type="button">
                                            عميل
                                        </button>
                                    </a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.backend.scripts')
</body>

</html>
