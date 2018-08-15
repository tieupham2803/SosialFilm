<header id="header" class="full-header" data-sticky-class="not-dark">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <div id="logo">
                <a href="/" class="standard-logo" data-dark-logo="{{ asset('images/logo-dark.png') }}"><img
                            src="{{ asset('images/logo.png') }}" alt="Canvas Logo"></a>
                <a href="/" class="retina-logo" data-dark-logo="{{ asset('images/logo.png') }}"><img
                            src="{{ asset('images/logo.png') }}" alt="Canvas Logo"></a>
            </div>

            <nav id="primary-menu">
                <ul>
                    <div class="nav-avatar">
                        {!! Form::open() !!}
                            <input type="search" name="q" class=" alert alert-success search-input" value="" placeholder="{{trans('message.search')}}" size="35">
                        {!! Form::close() !!}
                    </div>
                </ul>
                <ul>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> Language <span class="caret"></span>
                        </a>
                        <ul>
                            <li><a href="{!! route('user.change-language', ['en']) !!}">
                                    <div>English</div>
                                </a></li>
                            <li><a href="{!! route('user.change-language', ['vi']) !!}">
                                    <div>Vietnam</div>
                                </a></li>
                        </ul>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul>
                                @role('manager')
                                <li>
                                    <a href="{{ url('/admin') }}" class="dropdown-item" target="_blank">{{ __('Admin Dashboard') }}</a>
                                </li>
                                @endrole
                                <li>
                                    <a href="{{ route('reviews.index') }}">{{ __('My Reviews') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="dropdown-item">{{ __('Profile') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    {{ Form::open(['url' => 'logout', 'id' => 'logout-form', 'class' => 'd-none']) }}
                                    @csrf
                                    {{ Form::close() }}
                                </li>
                            </ul>
                        </li>
                        <div id="logo" class="nav-avatar">
                            <img src="{{ Auth::user()->avatar }}" class="img-circle img-avatar">
                        </div>
                    @endguest
                </ul>

            </nav>
        </div>
    </div>
</header>
