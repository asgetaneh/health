<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-1">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link" style="background: #086098; color: white;">
        <span class="brand-text">Transportation</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <hr>
        @php
        $user = auth()->user();
        @endphp
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link ">
                        <i class="nav-icon  fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Transportation
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon icon fas fa fa-caret-right"></i>
                                <p>
                                    Setting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('station-or-towns.index') }}" class="nav-link">
                                        <i class="nav-icon icon fas fa fa-caret-right"></i>
                                        <p>Station</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('vehicles.index') }}" class="nav-link">
                                        <i class="nav-icon icon fas fa fa-caret-right"></i>
                                        <p>Vehicle</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('divers.index') }}" class="nav-link">
                                        <i class="nav-icon icon fas fa fa-caret-right"></i>
                                        <p>Driver</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('routes.index') }}" class="nav-link">
                                <i class="nav-icon icon fas fa fa-caret-right"></i>
                                <p>
                                    Route
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tickets.index') }}" class="nav-link">
                                <i class="nav-icon icon fas fa fa-caret-right"></i>
                                <p>
                                    Ticket
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon icon fas fa fa-caret-right"></i>
                                <p>
                                    User Managment
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="nav-icon icon fas fa fa-caret-right"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link">
                                        <i class="nav-icon icon fas fa fa-caret-right"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                         @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="nav-icon icon ion-md-exit"></i>
                                    <p>{{ __('Logout') }}</p>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                       
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    @endif
    <!-- /.sidebar -->
</aside>
