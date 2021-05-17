<!-- Brand Logo -->
@role ('super admin|admin')


<a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('assets/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>
@endrole
@role ('operator')
<a href="{{ route('author.dashboard') }}" class="brand-link">
    <img src="{{ asset('assets/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>
@endrole





<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    @role ('super admin|admin')


    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{asset('storage/profile/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="Avatar">
    </div>
    <div class="info">
        <a href="{{ route('admin.settings') }}" class="d-block">{{auth()->user()->username}}</a>
    </div>
    </div>
    @endrole
    @role ('operator')
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('storage/profile/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="Avatar">
        </div>
        <div class="info">
            <a href="{{ route('author.settings') }}" class="d-block">{{auth()->user()->username}}</a>
        </div>
    </div>
    @endrole





    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @role ('super admin|admin')


        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Users
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Roles and Permissions
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('admin.role.index') }}" class="nav-link">
                    <i class="far fa-list nav-icon"></i>
                    <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permission.index') }}" class="nav-link">
                    <i class="far fa-list nav-icon"></i>
                    <p>Permissions</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                Category
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.tag.index') }}" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                Tag
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                Content
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('admin.post.index') }}" class="nav-link">
                    <i class="far fa-list nav-icon"></i>
                    <p>Post Created</p>
                    </a>
                </li>
                @can ('Content.approve')





                <li class="nav-item">
                    <a href="{{ route('admin.post.pending') }}" class="nav-link">
                    <i class="far fa-list nav-icon"></i>
                    <p>Post Pended</p>
                    <span class="badge badge-info right">
                        @php
                            $total_pending_posts = App\Models\Post::where('is_approved',false)->count();
                        @endphp
                        {{ $total_pending_posts }}
                    </span>
                    </a>
                </li>
@endcan





                <li class="nav-item">
                    <a href="{{ route('admin.post.trashed') }}" class="nav-link">


                    <i class="far fa-list nav-icon"></i>
                    <p>Post Trashed</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.message') }}" class="nav-link">
                <i class="nav-icon fas fa-inbox"></i>
                <p>
                    Message
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                    File Manager
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('admin.file') }}" class="nav-link">
                        <i class="far fa-list nav-icon"></i>
                        <p>Upload File</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.document.index') }}" class="nav-link">
                        <i class="far fa-list nav-icon"></i>
                        <p>File Config</p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.favorite.index') }}" class="nav-link">
                <i class="nav-icon fas fa-heart"></i>
                <p>
                    Favorite
                </p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.comment.index') }}" class="nav-link">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                Comment
                </p>
            </a>
        </li>

        {{-- <li class="nav-item">


            <a href="{{ route('admin.subscriber.index') }}" class="nav-link">
                <i class="nav-icon fab fa-youtube"></i>


                <p>
                Subscriber
                </p>
            </a>
        </li> --}}



        <li class="nav-header">System</li>
        <li class="nav-item">
            <a href="{{ route('admin.settings') }}" class="nav-link">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                Profile
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-arrow-left"></i>
                {{ __('Logout') }}
            </a>
            
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
        </li>

        @endrole


        @role ('operator')
        <li class="nav-item">
            <a href="{{ route('author.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Content
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('author.post.index') }}" class="nav-link">
                        <i class="far fa-list nav-icon"></i>
                        <p>Post Created</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('author.post.trashed') }}" class="nav-link">
                        <i class="far fa-list nav-icon"></i>
                        <p>Post Trashed</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('author.favorite.index') }}" class="nav-link">
                <i class="nav-icon fas fa-heart"></i>
                <p>
                    Favorite
                </p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('author.comment.index') }}" class="nav-link">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                    Comment
                </p>
            </a>
        </li>


        <li class="nav-header">System</li>
        <li class="nav-item">
            <a href="{{ route('author.settings') }}" class="nav-link">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                    Profile
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-arrow-left"></i>
                {{ __('Logout') }}
            </a>



            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>


        @endrole

    </nav>
    <!-- end sidebar-menu -->
</div>
<!-- /.sidebar -->