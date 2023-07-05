<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">

    @if (auth('web')->check())
        
        @include('layouts.backend.main-sidbar.company-main-sidebar')
        
    @endif

    @if (auth('client')->check())
        
        @include('layouts.backend.main-sidbar.client-main-sidebar')
        
    @endif




</nav>
