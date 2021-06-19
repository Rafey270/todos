
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Todos - Register</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    @toastr_css
    <![endif]-->
</head>

<body class="signin">


<section>

    <div class="panel panel-signin">
        <div class="panel-body">
            <div class="logo text-center">
                <h1>ToDos</h1>
                {{-- <img src="images/logo-primary.png" alt="Chain Logo" > --}}
            </div>
            <br />
            <h4 class="text-center mb5">Already a Member?</h4>
            <a href="{{ url('login') }}"><p class="text-center">Sign in</p></a>

            <div class="mb30"></div>

            <form action="{{ url('registerUser') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" placeholder="Full Name" required name="name" value="{{ old('name') }}">
                    </div>
                    @if($errors->has('name'))
                        <label class="text-danger">{{ $errors->first('name') }}</label>
                    @endif
                </div>

                <div class="form-group">
                    <div class="input-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class="form-control" placeholder="Email" required name="email" value="{{ old('email') }}">
                    </div>
                    @if($errors->has('email'))
                        <label class="text-danger">{{ $errors->first('email') }}</label>
                    @endif
                </div>

                <div class="form-group">
                    <div class="input-group {{ $errors->has('password') ? 'has-error' : ''}}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    @if($errors->has('password'))
                        <label class="text-danger">{{ $errors->first('password') }}</label>
                    @endif
                </div>

                <div class="form-group">
                    <div class="input-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                    </div>
                    @if($errors->has('password_confirmation'))
                        <label class="text-danger">{{ $errors->first('password_confirmation') }}</label>
                    @endif
                </div>

                <div class="clearfix">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">Sign Up <i class="fa fa-angle-right ml5"></i></button>
                    </div>
                </div>
            </form>

        </div>

</section>


<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/modernizr.min.js"></script>
<script src="/js/pace.min.js"></script>
<script src="/js/retina.min.js"></script>
<script src="/js/jquery.cookies.js"></script>

<script src="/js/custom.js"></script>
@toastr_js
@toastr_render

</body>
</html>
