<header id="header" class="full-header" data-sticky-class="not-dark">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <div id="logo">
                <a href="/" class="standard-logo" data-dark-logo="{{ asset('images/logo-dark.png') }}"><img
                            src="{{ asset('images/logo.png') }}" alt="Canvas Logo"></a>
                <a href="/" class="retina-logo" data-dark-logo="{{ asset('images/logo-dark@2x.png') }}"><img
                            src="{{ asset('images/logo%402x.png') }}" alt="Canvas Logo"></a>
            </div>

            <nav id="primary-menu">
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
                                    {{ Form::close() }}
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>


                <div id="top-cart">
                    <a href="#" id="top-cart-trigger"><i class="fas fa-bell"></i><span>5</span></a>
                    <div class="top-cart-content">
                        <div class="top-cart-title">
                            <h4>Shopping Cart</h4>
                        </div>
                        <div class="top-cart-items">
                            <div class="top-cart-item clearfix">
                                <div class="top-cart-item-image">
                                    <a href="#"><img src="#" alt="Blue Round-Neck Tshirt"/></a>
                                </div>
                                <div class="top-cart-item-desc">
                                    <a href="#">Blue Round-Neck Tshirt</a>
                                    <span class="top-cart-item-price">$19.99</span>
                                    <span class="top-cart-item-quantity">x 2</span>
                                </div>
                            </div>
                            <div class="top-cart-item clearfix">
                                <div class="top-cart-item-image">
                                    <a href="#"><img src="#" alt="Light Blue Denim Dress"/></a>
                                </div>
                                <div class="top-cart-item-desc">
                                    <a href="#">Light Blue Denim Dress</a>
                                    <span class="top-cart-item-price">$24.99</span>
                                    <span class="top-cart-item-quantity">x 3</span>
                                </div>
                            </div>
                        </div>
                        <div class="top-cart-action clearfix">
                            <span class="fleft top-checkout-price">$114.95</span>
                            <button class="button button-3d button-small nomargin fright">View Cart</button>
                        </div>
                    </div>
                </div>

                <div id="top-search">
                    <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                    {!! Form::open() !!}
                        <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
                    {!! Form::close() !!}
                </div>
            </nav>
        </div>
    </div>
</header>
