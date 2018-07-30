<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand" style="padding: 0px 32px;">
        <a href="{{ url('/') }}">
            <h1>Mrso</h1>
        </a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth">
                <i class="lnr lnr-arrow-left-circle"></i>
            </button>
        </div>
        <form class="navbar-form navbar-left">
            <div class="input-group">
                <input type="text" value="" class="form-control" placeholder="Search dashboard...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary">Go</button>
                </span>
            </div>
        </form>
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu notifications">
                        <li>

                        <li>
                            <a href="#" class="notification-item">
                                <span class="dot bg-danger"></span>Bạn đã thêm thông tin cho phim Deadpool 2</a>
                        </li>
                        <li>
                            <a href="#" class="notification-item">
                                <span class="dot bg-success"></span>Admin: Thông báo điều chỉnh phân quyền</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="lnr lnr-question-circle"></i>
                        <span>Help</span>
                        <i class="icon-submenu lnr lnr-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">Basic </a>
                        </li>
                        <li>
                            <a href="#">Working With Data</a>
                        </li>
                        <li>
                            <a href="#">Security</a>
                        </li>
                        <li>
                            <a href="#">Troubleshooting</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    {{-- @if (isset($userLogin)) --}}
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{-- <img src="{{ asset("storage/img/user/$userLogin->image") }}" class="img-circle" alt="Avatar"> --}}
                            <span>{{"name"}}</span>
                            <i class="icon-submenu lnr lnr-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">
                                    <i class="fas fa-user"></i>
                                    <span>Thông tin cá nhân</span>
                                </a>
                            </li>
                            <li>
                                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Thoát</span>
                                </a>
                                <form id="logout-form" action="" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    {{-- @endif --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
