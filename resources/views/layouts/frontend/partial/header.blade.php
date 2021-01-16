<header>
    <div class="container-fluid position-relative no-side-padding">

        <a class="logo">{{ env('APP_NAME') }}</a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('post.index') }}">Posts</a></li>
            <li><a href="{{ route('post.index') }}">About</a></li>
            <li><a href="{{ route('post.index') }}">Contact</a></li>
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
            @role ('super admin')
                    <li><a href="{{ route('admin.dashboard') }}">Author</a></li>
            @endrole
            @role ('admin')
                    <li><a href="{{ route('dashboard') }}">Author</a></li>
            @endrole
            @role ('operator')
                    <li><a href="{{ route('dashboard') }}">Author</a></li>
            @endrole
            @role ('guest')
                    <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
                    </li>
            @endrole
            @endguest
        </ul><!-- main-menu -->

        <div class="src-area">
            <form method="GET" action="{{ route('search') }}">
                <button class="src-btn" type="submit"><i class="ion-ios-search"></i></button>
                <input class="src-input" value="{{ isset($query) ? $query : '' }}" name="query" type="text" placeholder="Search">
            </form>
        </div>

    </div><!-- conatiner -->
</header>
