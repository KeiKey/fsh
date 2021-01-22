<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <i class=" fa fa-share elevation-3"></i>
        <span class="brand-text font-weight-light">FileShare</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User Panel
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/files/upload"
                               class="nav-link {{ Request::path() ==='files/upload' ? 'active' : ''}} ">
                                <i class="fa fa-upload nav-icon"></i>
                                <p>Upload File</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/files/all" class="nav-link {{ Request::path() ==='files/all' ? 'active' : ''}} ">
                                <i class="fa fa-folder nav-icon"></i>
                                <p>My Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/shares"
                               class="nav-link {{ Request::path() ==='files/shared' ? 'active' : ''}} ">
                                <i class="fa fa-folder-open nav-icon  "></i>
                                <p>Shared with me</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/files/trash"
                               class="nav-link {{ Request::path() ==='files/trash' ? 'active' : ''}} ">
                                <i class="fa fa-trash-alt nav-icon  "></i>
                                <p>Trash</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @auth
                    @if(auth()->user()->isAdmin())
                        {{--                admin panel --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Admin Panel
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/users"
                                       class="nav-link {{ Request::path() ==='admin/users' ? 'active' : ''}} ">
                                        <i class="fa fa-user-edit nav-icon"></i>
                                        <p>Manage Users</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        {{--                end of admin panel--}}
                    @endif
                @endauth


                <li class="nav-header">Other</li>
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link">--}}
                {{--                        <i class="nav-icon far fa-calendar-alt"></i>--}}
                {{--                        <p>--}}
                {{--                            Calendar--}}
                {{--                            <span class="badge badge-info right">2</span>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

                @auth
                    <li class="nav-item">
                        <a href="#" class="nav-link" href="javascript:void(0);"
                           class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-sign-out-alt"></i>
                            <p>
                                Sign Out
                            </p>
                        </a>
                    </li>
                @endauth

            </ul>
        </nav>
    </div>
</aside>
