<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>{{__("Invoices")}}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src={{asset("js/dashboard.js")}}></script>

<script>
    // Write on keyup event of keyword input element
    $(document).ready(function () {
        $("#search").keyup(function () {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#mytable tbody tr"), function () {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
    });
</script>
@include('sweetalert::alert')
</body>
</html>
