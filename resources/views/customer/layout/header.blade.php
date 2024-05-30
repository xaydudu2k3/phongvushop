<header class="w-100">
    <div class="container">
        <nav class="header-menu d-flex justify-content-between align-items-center">
            <a href="/" class="nav-link d-flex align-items-center header-menu-logo">
                <div><img src="/template/img/logoPV.svg" alt=""> </div>
                <h4 class="mb-0 ms-1 d-block d-md-none"><b>Phong Vũ</b></h4>
            </a>
            <div class="d-md-none d-block hamburger-menu">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3 d-md-none d-block"></div>
                <div class="bar4"></div>
            </div>
            <div class="menu-header d-md-flex  menu-header-close align-items-center">
                <ul class="menu-header-item d-md-flex align-items-center d-block me-auto mb-2 mb-md-0">
                    {!! \App\Helpers\MenuHelper::menus($menus) !!}
                </ul>
                <div class="d-md-flex d-block align-items-center">
                    <form class="menu-header-form d-flex mb-4 mb-md-0" role="search" action="/product">
                        <div class="w-100">
                            <div class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></div>
                            <input type="search" class="input-search input-search-ajax" id="search-menu"
                                placeholder="Tìm kiếm" name="search" autocomplete="off">
                        </div>
                        <div class="list-search"></div>
                    </form>
                    <div class="menu-header-shop ms-md-4 mt-md-0 mt-3">
                        <a href="/carts" style="position: relative; z-index: 10;" class="d-flex align-items-center">
                            <i class="fa-sharp fa-regular fa-cart-shopping"></i> <span class="ms-3">Giỏ
                                hàng</span>
                            <div class="menu-header-shop-num">{{ count(Session::get('carts', [])) }}</div>
                        </a>
                    </div>
                    <div class="menu-header-login ms-md-4 ms-2 d-flex align-items-center mt-md-0 mt-3">
                        @if (Auth::guard('cus')->check())
                            <i class="fa-duotone fa-user"></i>
                            <span class="ms-2 logout">
                                <div class="d-flex align-items-center">
                                    <a href="/info" class="text-dark">{{ Auth::guard('cus')->user()->name }}</a>
                                    {{-- <a href="{{ route('home.logout') }}" class="ms-3 text-dark"><i class="fa-regular fa-right-from-bracket d-flex" style="font-size: 20px"></i></a> --}}
                                    <a class="ms-3 text-dark border-0" style="background: none; cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fa-regular fa-right-from-bracket d-flex" style="font-size: 20px"></i>
                                    </a>
                                </div>
                            </span>
                        @else
                            <i class="fa-solid fa-user"></i>
                            <span class="ms-2">
                                <a href="{{ route('home.login') }}" class="text-dark">Đăng nhập</a>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Modal -->
<div class="modal fade" style="z-index: 9999" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 150px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Đăng xuất</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc là muốn đăng xuất tài khoản?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a href="{{ route('home.logout') }}" type="button" class="btn btn-danger">Đăng xuất</a>
            </div>
        </div>
    </div>
</div>
