<nav class="navbar-vertical-nav d-none d-xl-block ">
    <div class="navbar-vertical">
        <div class="px-4 py-5">
            <a href="" class="navbar-brand">
                <img src="{{asset('assets/images/logo/freshcart-logo.svg')}}" alt="" style="width: 90%;">
            </a>
        </div>
        <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column" id="sideNavbar">
                <li class="nav-item ">
                    <a class="nav-link @if (Route::currentRouteName()=='dasbor') active @endif" href="{{route('dasbor')}}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-bar-chart-line-fill"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </div>
                    </a>
                </li>

                @if ($idnusr->role_id == 3)
                    <li class="nav-item mt-6 mb-3">
                        <span class="nav-label">MANU KOKI</span>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-card-checklist"></i></span>
                                <span class="nav-link-text">List Pesanan</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if ($idnusr->role_id == 2)
                    <li class="nav-item mt-6 mb-3">
                        <span class="nav-label">MANU KASIR</span>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-cash-coin"></i></span>
                                <span class="nav-link-text">Pembayaran</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if ($idnusr->role_id == 1)
                    <li class="nav-item mt-6 mb-3">
                        <span class="nav-label">MANU ADMIN</span>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='product') active @endif" href="{{route('product')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-boxes"></i></span>
                                <span class="nav-link-text">Product</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='category') active @endif" href="{{route('category')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-tags-fill"></i></span>
                                <span class="nav-link-text">Category</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='table') active @endif" href="{{route('table')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-table"></i></span>
                                <span class="nav-link-text">Table</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='users') active @endif" href="{{route('users')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-people-fill"></i></span>
                                <span class="nav-link-text">Manage Users</span>
                            </div>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

<nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
    <div class="navbar-vertical">
        <div class="px-4 py-5 d-flex justify-content-between align-items-center">
            <a href="" class="navbar-brand">
                <img src="{{asset('assets/images/logo/freshcart-logo.svg')}}" alt="" style="width: 90%;">
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column">
                <li class="nav-item ">
                    <a class="nav-link" href="">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-house"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </div>
                    </a>
                </li>

                @if ($idnusr->role_id == 3)
                    <li class="nav-item mt-6 mb-3">
                        <span class="nav-label">MANU KOKI</span>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-card-checklist"></i></span>
                                <span class="nav-link-text">List Pesanan</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if ($idnusr->role_id == 2)
                    <li class="nav-item mt-6 mb-3">
                        <span class="nav-label">MANU KASIR</span>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-cash-coin"></i></span>
                                <span class="nav-link-text">Pembayaran</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if ($idnusr->role_id == 1)
                    <li class="nav-item mt-6 mb-3">
                        <span class="nav-label">MANU ADMIN</span>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='product') active @endif" href="{{route('product')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-boxes"></i></span>
                                <span class="nav-link-text">Product</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='category') active @endif" href="{{route('category')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-tags-fill"></i></span>
                                <span class="nav-link-text">Category</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='table') active @endif" href="{{route('table')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-table"></i></span>
                                <span class="nav-link-text">Table</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if (Route::currentRouteName()=='users') active @endif" href="{{route('users')}}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"> <i class="bi bi-people-fill"></i></span>
                                <span class="nav-link-text">Manage Users</span>
                            </div>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
