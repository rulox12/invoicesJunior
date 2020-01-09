<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{__("Invoices")}}</title>
    <link rel="stylesheet" href="{{mix("vendor/css/app.css")}}">

</head>
<body>
<div class="container-fluid">
    <div class="row">
        @guest
            @include('auth.login')
        @else
            @include('layouts.nav.nav_higher')
            @include('layouts.nav.nav_side')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-0">
                @yield('content')
            </main>
        @endif
    </div>
</div>
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="{{mix("vendor/js/app.js")}}"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
    });
</script>
@yield('state')
</body>
</html>
