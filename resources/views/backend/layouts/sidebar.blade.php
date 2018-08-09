<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="/" >
                        <i class="fas fa-home"></i>
                        <span>{{ trans('message.homepage') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('movies.index') }}" >
                        <i class="fa fa-film"></i>
                        <span>{{ trans('message.movies') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('review.index') }}" >
                        <i class="fa fa-newspaper"></i>
                        <span>{{ trans('message.reviews') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.user.index') }}" >
                        <i class="fa fa-users"></i>
                        <span>{{ trans('message.users') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('genres.index') }}" >
                        <i class="fa fa-bars"></i>
                        <span>{{ trans('message.genres') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('actors.index') }}" >
                        <i class="fa fa-user-secret"></i>
                        <span>{{ trans('message.actors') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}" >
                        <i class="fa fa-bolt"></i>
                        <span>{{ trans('message.roles') }}</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
