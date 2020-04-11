<nav class="col-md-2 bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item hr">
                <a class="nav-link" href={{route('home.index')}}>
                    <i class="fas fa-home"></i>
                    {{__('Dashboard')}}
                </a>
            </li>
            @canany(['user list','user create','user edit'])
                <li class="nav-item">
                    <a class="nav-link" href="#page-user" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <i class="fas fa-user-plus"></i>
                        {{__("Administrators")}}
                        <span data-feather="chevron-down"></span>
                    </a>
                    <ul class="collapse" id="page-user">
                        <li>
                            <a class="nav-link" href="{{route('users.index')}}">
                                <i class="fas fa-eye"></i>
                                {{__("View")}}
                            </a>
                        </li>
                        @can('user create')
                            <li>
                                <a class="nav-link" href="{{route('users.create')}}">
                                    <i class="fas fa-save"></i>
                                    {{__('Create')}}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['customer list','customer create','customer edit'])
                <li class="nav-item">
                    <a class="nav-link" href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <i class="fas fa-user"></i>
                        {{__("Customers")}}
                        <span data-feather="chevron-down"></span>
                    </a>
                    <ul class="collapse" id="pageSubmenu3">
                        <li>
                            <a class="nav-link" href="{{route('customers.index')}}">
                                <i class="fas fa-eye"></i>
                                {{__("View")}}
                            </a>
                        </li>
                        @can('customer create')
                            <li>
                                <a class="nav-link" href="{{route('customers.create')}}">
                                    <i class="fas fa-save"></i>
                                    {{__('Create')}}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['seller list','seller create','seller edit'])
                <li class="nav-item">
                    <a class="nav-link" href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <i class="fas fa-users"></i>
                        {{__("Sellers")}}
                        <span data-feather="chevron-down"></span>
                    </a>
                    <ul class="collapse" id="pageSubmenu2">
                        <li>
                            <a class="nav-link" href="{{route('sellers.index')}}">
                                <i class="fas fa-eye"></i>
                                {{__("View")}}
                            </a>
                        </li>
                        @can('seller create')
                            <li>
                                <a class="nav-link" href="{{route('sellers.create')}}">
                                    <i class="fas fa-save"></i>
                                    {{__('Create')}}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>@endcanany
            @canany(['invoice list','invoice create','invoice edit'])
                <li class="nav-item">
                    <a class="nav-link" href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <i class="fas fa-file"></i>
                        {{__("Invoices")}}
                        <span data-feather="chevron-down"></span>
                    </a>
                    <ul class="collapse" id="pageSubmenu">
                        <li>
                            <a class="nav-link" href="{{route('invoices.index')}}">
                                <i class="fas fa-eye"></i>
                                {{__("View")}}
                            </a>
                        </li>
                        @can('invoice create')
                            <li>
                                <a class="nav-link" href="{{route('invoices.create')}}">
                                    <i class="fas fa-save"></i>
                                    {{__('Create')}}
                                </a>
                            </li>
                        @endcan
                        @can('import')
                            <li>
                                <a class="nav-link" href="{{route('imports.index')}}">
                                    <i class="fas fa-file-import"></i>
                                    {{__('Import')}}
                                </a>
                            </li>
                        @endcan
                        @can('export')
                            <li>
                                <a class="nav-link" href="{{route('exports.index')}}">
                                    <i class="fas fa-file-export"></i>
                                    {{__('Export')}}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['payment list','payment generate'])
                <li class="nav-item">
                    <a class="nav-link" href="{{route('payments.index')}}">
                        <i class="fas fa-credit-card"></i>
                        {{__("Payments")}}
                    </a>
                </li>
            @endcanany
            @canany(['role list','role create','role edit'])
                <li class="nav-item">
                    <a class="nav-link" href="#pageSubmenuRoles" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <i class="fas fa-user-shield"></i>
                        {{__("Roles")}}
                        <span data-feather="chevron-down"></span>
                    </a>
                    <ul class="collapse" id="pageSubmenuRoles">
                        <li>
                            <a class="nav-link" href="{{route('roles.index')}}">
                                <i class="fas fa-eye"></i>
                                {{__("View")}}
                            </a>
                        </li>
                        @can('role create')
                            <li>
                                <a class="nav-link" href="{{route('roles.create')}}">
                                    <i class="fas fa-save"></i>
                                    {{__('Create')}}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
        </ul>
    </div>
</nav>
