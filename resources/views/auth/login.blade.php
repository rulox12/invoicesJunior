<!doctype html>
<html lang="en">
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
<link href="{{asset('css/login.css')}}" rel="stylesheet">
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">{{__('Login')}}</h5>
                    <form class="form-signin" method="POST" action="{{ route('login') }}" >
                        <div class="form-label-group">
                            <input type="email" id="email" class="form-control" placeholder="Email address"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email">{{__('Email')}}</label>
                        </div>
                        @csrf
                        <div class="form-label-group">
                            <input type="password" id="password" class="form-control" placeholder="Password"
                                   name="password"  required>
                            <label for="password">{{__('Password')}}</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase"
                                type="submit">{{__('Login')}}</button>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
