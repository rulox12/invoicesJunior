<nav class="col-md-2 bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item hr">
                <a class="nav-link" href={{route('home.index')}}>
                    <span data-feather="home"></span>
                    {{__('Dashboard')}}
                </a>
            </li>
            <li class="nav-item hr">
                <a class="nav-link" href="{{route('users.index')}}">
                    <span data-feather="user-plus"></span>
                    {{__("Administrators")}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">
                    <span data-feather="users"></span>
                    {{__("Customers")}}
                    <span data-feather="chevron-down"></span>
                </a>
                <ul class="collapse" id="pageSubmenu3">
                    <li>
                        <a class="nav-link" href="{{route('customers.index')}}">
                            <span data-feather="eye"></span>
                            {{__("View")}}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('customers.create')}}">
                            <span data-feather="save"></span>
                            {{__('Create')}}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('imports.index')}}">
                            <span data-feather="folder-plus"></span>
                            {{__('Import')}}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">
                    <span data-feather="users"></span>
                    {{__("Sellers")}}
                    <span data-feather="chevron-down"></span>
                </a>
                <ul class="collapse" id="pageSubmenu2">
                    <li>
                        <a class="nav-link" href="{{route('sellers.index')}}">
                            <span data-feather="eye"></span>
                            {{__("View")}}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('sellers.create')}}">
                            <span data-feather="save"></span>
                            {{__('Create')}}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('imports.index')}}">
                            <span data-feather="folder-plus"></span>
                            {{__('Import')}}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">
                    <span data-feather="file"></span>
                    {{__("Invoices")}}
                    <span data-feather="chevron-down"></span>
                </a>
                <ul class="collapse" id="pageSubmenu">
                    <li>
                        <a class="nav-link" href="{{route('invoices.index')}}">
                            <span data-feather="eye"></span>
                            {{__("View")}}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('invoices.create')}}">
                            <span data-feather="save"></span>
                            {{__('Create')}}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('imports.index')}}">
                            <span data-feather="folder-plus"></span>
                            {{__('Import')}}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('exports.index')}}">
                            <span data-feather="folder-plus"></span>
                            {{__('Export')}}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('payments.index')}}">
                    <span data-feather="credit-card"></span>
                    {{__("Payments")}}
                </a>
            </li>
        </ul>
    </div>
</nav>
