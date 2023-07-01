<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
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
        <?php
        $collection = \App\Models\Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        ?>
        <a class="navbar-brand" href="../index.html">
            <div class="d-flex align-items-center py-3">
                <?php
                $setting = App\Models\Setting::firstwhere('id', 1);
                ?>
                @if (isset($setting->photo))
                    <img class="me-2" src="{{ URL::asset('storage/Attachments/Logo/' . $setting->photo) }}"
                        alt="Logo" width="40" />
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
                    <!-- parent pages--><a class="nav-link" href="{{ route('home') }}" role="button">
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

                    <!-- Client pages-->
                    @can('العملاء')
                        <a class="nav-link" href="{{ route('clients.index') }}" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="far fa-address-card"></span></span><span
                                    class="nav-link-text ps-1">العملاء</span>
                            </div>
                        </a><!-- end/Client -->
                    @endcan

                    @can('ضرائب')
                        <!-- Tax pages -->
                        <a class="nav-link" href="{{ route('taxes.index') }}" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-percent"></span></span><span class="nav-link-text ps-1">ضرائب</span>
                            </div>
                        </a>
                        <!--end/Tax -->
                    @endcan

                    @can('الفئات')
                        <!-- Category pages -->
                        <a class="nav-link" href="{{ route('categories.index') }}" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="far fa-list-alt"></span></span><span class="nav-link-text ps-1">الفئات</span>
                            </div>
                        </a><!-- end/Category -->
                    @endcan

                    @can('المنتجات')
                        <!-- Products pages -->
                        <a class="nav-link" href="{{ route('products.index') }}" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-box"></span></span><span class="nav-link-text ps-1">المنتجات</span>
                            </div>
                        </a><!-- end/Products -->
                    @endcan

                    @can('الفواتير')
                        <!-- Invoice pages -->
                        <a class="nav-link" href="{{ route('invoices.index') }}" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-file-invoice"></span></span><span
                                    class="nav-link-text ps-1">الفواتير</span>
                            </div>
                        </a><!-- end/Invoice-->
                    @endcan

                    @can('ارشيف الفواتير')
                        <!-- Archive pages -->
                        <a class="nav-link" href="{{ route('invoicesArchive.index') }}" role="button"
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-archive"></span></span><span class="nav-link-text ps-1">ارشيف
                                    الفواتير</span>
                            </div>
                        </a><!-- end/Invoice-->
                    @endcan

                    @can('حالات الفواتير')
                        <!-- Trancaction pages -->
                        <a class="nav-link" href="{{ route('invoicesstatus.index') }}" role="button"
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-exchange-alt"></span></span><span class="nav-link-text ps-1">حالات
                                    الفواتير</span>
                            </div>
                        </a><!-- end/Trancaction-->
                    @endcan

                    @can('المدفوعات')
                        <!-- Payments pages -->
                        <a class="nav-link" href="{{ route('payment.index') }}" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-dollar-sign"></span></span><span
                                    class="nav-link-text ps-1">المدفوعات</span>
                            </div>
                        </a><!-- end/Payments-->
                    @endcan

                    @can('الصلاحيات والادوار')
                        <!-- Hero-Section-->
                        <a class="nav-link dropdown-indicator" href="#email" role="button" data-bs-toggle="collapse"
                            aria-expanded="false" aria-controls="email">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-star"></span></span><span class="nav-link-text ps-1">الصلاحيات
                                    والادوار</span>
                            </div>
                        </a>
                        <ul class="nav collapse false" id="email">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span
                                            class="nav-link-text ps-1">المستخدمين</span>
                                    </div>
                                </a>
                                <a class="nav-link" href="{{ route('roles.index') }}" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">الادوار</span>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    @endcan

                    <!-- Setting pages -->
                    <a class="nav-link" href="{{ route('notifications-home') }}" role="button"
                        aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                    class="fas fa-bell"></span></span><span
                                class="nav-link-text ps-1">الاشعارات</span>
                        </div>
                    </a><!-- end/Setting-->

                    @can('الاعدادت')
                        <!-- Setting pages -->
                        <a class="nav-link" href="{{ route('setting-home') }}" role="button" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-cog"></span></span><span class="nav-link-text ps-1">الاعدادت</span>
                            </div>
                        </a><!-- end/Setting-->
                    @endcan

                </li>
            </ul>
        </div>
    </div>
</nav>
