<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand" >
        <a href="{{ url('/') }}">
            <h1></h1>
        </a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth">
                <i class="lnr lnr-arrow-left-circle"></i>
            </button>
        </div>
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
                                <span class="dot bg-danger"></span></a>
                        </li>
                        <li>
                            <a href="#" class="notification-item">
                                <span class="dot bg-success"></span></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="lnr lnr-question-circle"></i>
                        <span>Language</span>
                        <i class="icon-submenu lnr lnr-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{!! route('user.change-language', ['en']) !!}">
                                <div>English</div>
                            </a></li>
                        <li><a href="{!! route('user.change-language', ['vi']) !!}">
                                <div>Vietnam</div>
                            </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    {{-- @if (isset($userLogin)) --}}
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{-- <img src="{{ asset("storage/img/user/$userLogin->image") }}" class="img-circle" alt="Avatar"> --}}
                            <span>{{"Admin"}}</span>
                            <i class="icon-submenu lnr lnr-chevron-down"></i>
                        </a>
                    <ul class="dropdown-menu">
                           @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item ">
                                <a id="navbar" class="nav-link toggle" href="#" role="button"
                                   data-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        {{ Form::open(['url' => 'logout', 'id' => 'logout-form', 'class' => 'd-none']) }}
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                    {{-- @endif --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
