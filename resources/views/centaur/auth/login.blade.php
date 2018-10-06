<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{--<link rel="shortcut icon" href='{{ asset("$logo->favicon") }}' type="image/x-icon">--}}
    {{--<link rel="icon" href='{{ asset("$logo->favicon") }}' type="image/x-icon">--}}
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                        <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.login.attempt') }}">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <div class="input-group mb-3 has-error">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" placeholder="E-mail" name="email" type="text" value="{{ old('email') }}">
                                {!! ($errors->has('email') ? $errors->first('email', '<p class="text-danger">:message</p>') : '') !!}
                            </div>
                            <div class="input-group mb-4 has-error">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" name="password" type="password" value="">
                                {!! ($errors->has('password') ? $errors->first('password', '<p class="text-danger">:message</p>') : '') !!}
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" type="submit">Login</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <h2>Note</h2>
                            <p>This is login page for Management system. If you do not have permission, please click button below to return to the home page.</p>
                            <button class="btn btn-primary active mt-3" type="button">Homepage</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ mix('js/main.js') }}"></script>
</html>