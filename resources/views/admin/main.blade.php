<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
    <style>
        .avatar {
            position: relative;
            margin-right: 60px;
            margin-left: auto;
        }

        .avatar .avatar-link {
            text-decoration: none;
            color: white;
            transition: 0.2s;
        }

        .avatar .avatar-link:hover {
            color: lightblue;
        }

        .avatar ul {
            padding: 0;
            display: none;
            list-style: none;
            position: absolute;
            left: 10px;
            width: 130px;
            top: 40px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background: #06283D;
        }

        .avatar ul li {
            padding: 10px;
        }

        .avatar ul a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
        }

        .avatar ul a:hover {
            color: lightblue;
        }

        .avatar ul i {
            width: 30px;
            text-align: center;
        }

        .avatar i {
            transform: rotate(0);
            transition: all 0.3s;
        }

        .avatar.show .fa-chevron-down {
            transform: rotate(-180deg);
            transition: all 0.3s;
        }

        .avatar.show .avatar-link {
            color: lightblue;
        }

        .avatar.show ul {
            display: block;
        }

        @media only screen and (max-width: 1023.98px) {
            body {
                font-size: 12px;
            }
        }

        @media only screen and (max-width: 767.98px) {
            body {
                font-size: 10px;
            }
        }

        @media only screen and (max-width: 479.98px) {
            body {
                font-size: 8px;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/admin/dist/img/logoPV.svg" alt="logo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="sticky-top main-header navbar navbar-expand navbar-white navbar-light" style="background: #003C43;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <div class="avatar ms-auto">
                <div class="avatar-link user-panel d-flex align-items-center" role="button">
                    <div class="image mr-2 d-flex align-items-center">
                        <img src="{{ Auth::user()->thumb }}" class="img-circle elevation-2" alt="User Image">
                        <b class="ml-2 text-white">{{ Auth::user()->name }}</b>
                    </div>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <ul class="avatar-detail">
                    <li><a href="/admin/info"><i class="fa-solid fa-info"></i> Chi tiết</a></li>
                    <li>

                        <!-- Modal -->

                        <a href="{{ route('admin.logout') }}"><i class="fa-solid fa-right-from-bracket"></i>
                            Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.sidebar')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @include('admin.alert')
                    <div class="mt-3 card card-info p-3">
                        <div class="card-header mb-2">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        @yield('content')
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>

        <!-- Content Wrapper. Contains page content -->


        <!-- /.control-sidebar -->
    </div>


    @include('admin.footer')

</body>

</html>
