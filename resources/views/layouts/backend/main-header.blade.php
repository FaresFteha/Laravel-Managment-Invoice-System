<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
    @if (auth('web')->check())
        @include('layouts.backend.main-header.company-main-header')
    @endif

    @if (auth('client')->check())
        @include('layouts.backend.main-header.client-main-header')
    @endif
</nav>
