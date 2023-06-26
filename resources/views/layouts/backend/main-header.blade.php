<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="{{ route('home') }}">
        <div class="d-flex align-items-center">
            <?php
            $collection = \App\Models\Setting::all();
            $setting['setting'] = $collection->flatMap(function ($collection) {
                return [$collection->key => $collection->value];
            });
            ?>
            @if (isset($setting['photo']))
                <img class="me-2" src="{{ URL::asset('storage/Attachments/Logo/' . $setting['photo']) }}"
                    alt="Logo" width="40" />
            @else
                <img class="me-2" src="{{ URL::asset('asset/backend/src/img/icons/spot-illustrations/falcon.png') }}"
                    alt="Logo" width="40" />
            @endif
            <span class="font-sans-serif">
                @if (isset($setting['app_name']))
                    {{ $setting['app_name'] }}
                @endif
            </span>
        </div>
    </a>
    <ul class="navbar-nav align-items-center d-none d-lg-block">
        <li class="nav-item">
            <h3 id="clock"></h3>
        </li>
    </ul>

    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2">
                <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox"
                    data-theme-control="theme" value="dark" />
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to light theme"><span
                        class="fas fa-sun fs-0"></span></label>
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to dark theme"><span
                        class="fas fa-moon fs-0"></span></label>
            </div>
        </li>
        {{-- @if (Auth::user()->roles_name === ['Owner']) --}}
        @can('الاشعارات')
            <li class="nav-item dropdown">
                <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                    id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell" data-fa-transform="shrink-6"
                        style="font-size: 33px;"></span></a>
                <span class="notification-indicator-number"
                    id="newNotification">{{ auth()->user()->unreadNotifications->count() }}</span>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification"
                    aria-labelledby="navbarDropdownNotification">
                    <div class="card card-notification shadow-none">
                        <div class="card-header">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto" id="newNotification">
                                    <h6 class="card-header-title mb-0">
                                        الاشعارات:({{ auth()->user()->unreadNotifications->count() }})</h6>
                                </div>
                                <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal"
                                        href="{{ route('readAllNotify') }}">اشر عليها بانها قرات</a></div>
                            </div>
                        </div>
                        <div class="scrollbar-overlay" style="max-height:19rem">
                            <div class="list-group list-group-flush fw-normal fs--1">
                                <div class="list-group-title border-bottom">جديد</div>
                                <div class="list-group-item" id="listNotification">
                                    @forelse(auth()->user()->unreadNotifications->take(10) as $notification)
                                        <a class="notification notification-flush notification-unread"
                                            href="{{ $notification->data['url'] }}?notify_id={{ $notification->id }}">
                                            <div class="notification-avatar">
                                                <div class="avatar avatar-2xl me-3">
                                                    <img src="{{ asset('asset/backend/src/img/generic/image-file-2.png') }}"
                                                        alt="" />

                                                </div>
                                            </div>
                                            <div class="notification-body">
                                                <p class="mb-1"><strong>{{ $notification->data['user'] }}
                                                    </strong>{{ $notification->data['title'] }}</p>
                                                <span class="notification-time"><span class="me-2" role="img"
                                                        aria-label="Emoji">💬</span>اضيفت
                                                    بواسطة:{{ $notification->data['user'] }}</span>
                                                <br>
                                                <span class="notification-time"><span class="me-2" role="img"
                                                        aria-label="Emoji">🕕</span>{{ $notification->data['date'] }}</span>
                                            </div>
                                        </a>
                                    @empty
                                        <tr>
                                            <td class="alert-danger text-center" colspan="8">لا يوجد اشعارات
                                            </td>
                                        </tr>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-center border-top"><a class="card-link d-block"
                                href="{{ route('notifications-home') }}">عرض جميع الاشعارات</a></div>
                    </div>
                </div>
            </li>
        @endcan
        {{-- @endif --}}

        {{-- Setting --}}
        <li class="nav-item dropdown"><a class="nav-link pe-0" id="navbarDropdownUser" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="{{ asset('asset/backend/src/img/team/3-thumb.png') }}"
                        alt="" />

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <a class="dropdown-item fw-bold text-warning" href="#!"><span
                            class="fas fa-crown me-1"></span><span>{{ Auth::user()->name }}</span></a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('setting-home') }}">الحساب &amp; الاعدادت</a>

                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        this.closest('form').submit();">تسجيل
                            الخروج</a>
                    </form>

                </div>
            </div>
        </li>
    </ul>
</nav>
<script>
    // Get the clock element
    const clock = document.getElementById('clock');

    // Update the clock every second
    setInterval(() => {
        // Get the current time using Moment.js
        const now = moment().format('h:mm:ss A');

        // Set the clock element content
        clock.innerHTML = now;
    }, 1000);
</script>
