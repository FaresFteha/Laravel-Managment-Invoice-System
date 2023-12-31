<script>
    var navbarStyle = localStorage.getItem("navbarStyle");
    if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
    }
</script>
<div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">

        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
            data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button>

    </div>
    <a class="navbar-brand" href="../index.html">
        <div class="d-flex align-items-center py-3">
            <?php
            $setting = App\Models\Setting::firstwhere('id', 1);
            ?>
            @if (isset($setting->photo))
                <img class="me-2" src="{{ URL::asset('storage/Attachments/Logo/' . $setting->photo) }}" alt="Logo"
                    width="40" />
            @else
                <img class="me-2" src="{{ URL::asset('asset/backend/src/img/icons/spot-illustrations/falcon.png') }}"
                    alt="Logo" width="40" />
            @endif
            <span class="font-sans-serif">
                @if (isset($setting->app_name))
                    {{ $setting->app_name }}
                @endif
            </span>
        </div>
    </a>
</div>

<div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <div class="navbar-vertical-content scrollbar">
        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
            {{-- Dashboard --}}
            <li class="nav-item">
                <!-- parent pages--><a class="nav-link" href="{{ route('home.client') }}" role="button">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">لوحة
                            القيادة</span>
                    </div>
                </a>
            </li>
            {{-- End Dashboard --}}

            {{-- App pages --}}
            <li class="nav-item">
                <!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">الفروع
                    </div>
                    <div class="col ps-0">
                        <hr class="mb-0 navbar-vertical-divider" />
                    </div>
                </div>

                <a class="nav-link" href="{{ route('products.client.index') }}" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                class="fas fa-box"></span></span><span class="nav-link-text ps-1">المنتجات</span>
                    </div>
                </a>
                <!--end/Client -->


                <a class="nav-link" href="{{route('incoices.client.index')}}" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                class="fas fa-file-invoice"></span></span><span
                            class="nav-link-text ps-1">الفواتير</span>
                    </div>
                </a>


                <a class="nav-link" href="{{ route('incoices.client.profile')}}" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                class="fas fa-cog"></span></span><span class="nav-link-text ps-1">الاعدادت</span>
                    </div>
                </a>


            </li>
        </ul>
    </div>
</div>
