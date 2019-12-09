<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href={{route('home.index')}}>
                    <span data-feather="home"></span>
                    {{__('Dashboard')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">
                    <span data-feather="user-plus"></span>
                    {{__("Administrators")}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('invoices.index')}}">
                    <span data-feather="file"></span>
                    {{__("Invoices")}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('customers.index')}}">
                    <span data-feather="users"></span>
                    {{__("Customers")}}
                </a>
            </li>
        </ul>
    </div>
</nav>
