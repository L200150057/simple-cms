<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('vendor/admin-lte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->photo)
                    <img src="{{ Storage::url(auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('vendor/admin-lte/img/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('my.profile.index') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/tag*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/tag*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Tag
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tag.index') }}" class="nav-link {{ request()->is(['admin/tag', 'admin/tag/*']) && !request()->is('admin/tag/create') ? 'active' : '' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tag.create') }}" class="nav-link {{ request()->is('admin/tag/create') ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('admin/category*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{ request()->is(['admin/category', 'admin/category/*']) && !request()->is('admin/category/create') ? 'active' : '' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}" class="nav-link {{ request()->is('admin/category/create') ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('admin/post*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/post*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Post
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}" class="nav-link {{ request()->is(['admin/post', 'admin/post/*']) && !request()->is('admin/post/create') ? 'active' : '' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.create') }}" class="nav-link {{ request()->is('admin/post/create') ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
