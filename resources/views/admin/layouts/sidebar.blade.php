<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="admin" @if (Request::is('admin')) class="active" @endif>
                        <i class="fas fa-home"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                {{-- @if (Auth::user()->role == 1 || Auth::user()->role == 0) --}}

                <li>
                    <a href="admin/calendars" @if (Request::is('admin/calendars') || Request::is('admin/calendars/create')) class="active" @endif>
                        <i class="fas fa-calendar-alt"></i>
                        <span>Thể loại</span>
                    </a>
                </li>
                <li>
                    <a href="#subPages3" data-toggle="collapse"
                        @if (Request::is('admin/news') || Request::is('admin/reviews/create'))
                            class="active"
                        @else
                            class="collapsed"
                        @endif
                    >
                        <i class="fas fa-newspaper"></i>
                        <span>Reviews</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages3"
                        @if (Request::is('admin/news') || Request::is('admin/news/create'))
                            class="collapse in"
                        @else
                            class="collapse"
                        @endif
                    >
                        <ul class="nav">
                            <li>
                                <a href="{{ url('admin/news') }}" @if (Request::is('admin/news')) class="active" @endif>Danh sách</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/news/create') }}" @if (Request::is('admin/news/create')) class="active" @endif>Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- @if (Auth::user()->role == 1 || Auth::user()->role == 0) --}}
                    <li>
                        <a href="#subPages4" data-toggle="collapse"
                            @if (Request::is('admin/staf') || Request::is('admin/staf/create'))
                                class="active"
                            @else
                                class="collapsed"
                            @endif
                        >
                            <i class="fas fa-user-tie"></i>
                            <span>Người dùng</span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i>
                        </a>
                        <div id="subPages4"
                            @if (Request::is('admin/stafs') || Request::is('admin/customers') || Request::is('admin/users/create'))
                                class="collapse in"
                            @else
                                class="collapse"
                            @endif
                        >
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('admin/stafs') }}" @if (Request::is('admin/stafs')) class="active" @endif>Nhân viên</a>
                                </li>

                                <li>
                                    <a href="{{ url('admin/customers') }}" @if (Request::is('admin/customers')) class="active" @endif>Khách hàng</a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/users/create') }}" @if (Request::is('admin/users/create')) class="active" @endif>Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->role ==2) --}}
                <li>
                    <a href="admin/customers" @if (Request::is('admin/customers')) class="active" @endif>
                        <i class="fas fa-user-tie"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>
                {{-- @endif --}}
            </ul>
        </nav>
    </div>
</div>
