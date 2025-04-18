<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header" data-logobg="skin6">
            <a class="navbar-brand" href="index.html">
                <b class="logo-icon">
                    <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                    <img src="{{ asset('assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <span class="logo-text">
                    <img src="{{ asset('assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                    <img src="{{ asset('assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                </span>
            </a>
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="mdi mdi-menu"></i>
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-end ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/users/profile.png') }}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="mdi mdi-account-box"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="mdi mdi-logout"></i>
                            Logout
                        </a>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>