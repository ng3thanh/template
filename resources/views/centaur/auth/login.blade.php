<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin | Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lib/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lib/admin-lte/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lib/iCheck/square/blue.css') }}">
        {{--<link rel="shortcut icon" href='{{ asset("$logo->favicon") }}' type="image/x-icon">--}}
        {{--<link rel="icon" href='{{ asset("$logo->favicon") }}' type="image/x-icon">--}}
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#">
                    <b>Admin</b> Management
                </a>
            </div>

            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.login.attempt') }}">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <div class="form-group has-feedback {{ ($errors->has('email')) ? 'has-error' : '' }}">
                        <input type="email" class="form-control" placeholder="E-mail" name="email" type="text" value="{{ old('email') }}">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        {!! ($errors->has('email') ? $errors->first('email', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group has-feedback {{ ($errors->has('password')) ? 'has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="Password" name="password" type="password" value="">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {!! ($errors->has('password') ? $errors->first('password', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input name="remember" type="checkbox" value="true" {{ old('remember') == 'true' ? 'checked' : ''}}> &nbsp;&nbsp;Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('lib/iCheck/icheck.min.js') }}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue'
                });
            });
        </script>
    </body>
</html>