<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="{{ route('home') }}" class="logo">{{ env('APP_NAME') }}</a>





        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            {{-- <li><a href="{{ route('home') }}">Home</a></li> --}}


            <li><a href="{{ route('post.index') }}">Posts</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
            <li><a href="{{ route('document') }}">Doc</a></li>


            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
            @role ('super admin')
                    <li><a href="{{ route('admin.dashboard') }}">Author</a></li>
            @endrole
            @role ('admin')
                    <li><a href="{{ route('admin.dashboard') }}">Author</a></li>


            @endrole
            @role ('operator')
                    <li><a href="{{ route('author.dashboard') }}">Author</a></li>


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
            {{-- <li><a href="#"><img src="{{asset('storage/profile/'.Auth::user()->image) }}" width="40px" alt="avatar">TEST</a></li> --}}


            @endguest

        </ul><!-- main-menu -->

        <div class="float-right" style="padding:10px">
            {{-- <form method="GET" action="{{ route('search') }}">
                <button class="src-btn" type="submit"><i class="ion-ios-search"></i></button>
                <input class="form-control typeahead" value="{{ isset($query) ? $query : '' }}" name="cari" type="text" placeholder="Search">
            </form> --}}
            <form method="GET" action="{{ route('search') }}">
                    <select class="cari form-control" style="width:200px;" name="cari"></select>
                <button class="src-btn" type="submit"><i class="ion-ios-search"></i></button>
            </form>

        </div>

</div><!-- conatiner -->

</header>
