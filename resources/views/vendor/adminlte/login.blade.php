@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #1aa891;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
            font-weight: 400;
        }

        .form button:hover, .form button:active, .form button:focus {
            background: #158e76;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #158e76;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before, .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }

        body {
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-weight: 600;
        }
     
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{url('assets/img/loading2.gif')}}") 50% 50% no-repeat white;
        }


    </style>
@stop

@section('body_class', 'login-page')

@section('body')
<div id="loader" class="loader"></div>
    <div class="form" style="display:none" id="tudo_page">
        <div style=" width: 100%; height: 30%">
            <img src="/assets/img/login.png" alt="logo" height="150px" width="270px" style="margin-top: -25px; margin-left: -2px; margin-bottom: -15px">
        </div>

        <hr>
        <p style="margin-top: 15px; margin-bottom: -15px" class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
            {!! csrf_field() !!}

            <div  class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : '' }}">
                <input type="text" name="username" value="{{ old('username') }}"
                       placeholder="Login" style="margin-bottom: -2px">
                @if ($errors->has('username'))
                    <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password"
                       placeholder="{{ trans('adminlte::adminlte.password') }}" style="margin-bottom: -2px">

                @if ($errors->has('password'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
            </div>

            <!-- /.col -->

            <button type="submit" style=" text-transform:uppercase; margin-bottom: -25px"
                    class="btn btn-primary btn-block btn-flat"><i
                        class="glyphicon glyphicon-log-in"></i> {{ trans('adminlte::adminlte.sign_in') }}</button>

            <!-- /.col -->
        </form>
    </div>
   
  
@stop

@section('adminlte_js')
@yield('js')

    <script src="https://code.jquery.com/jquery-2.1.3.min.js" integrity="sha256-ivk71nXhz9nsyFDoYoGf2sbjrR9ddh+XDkCcfZxjvcM=" crossorigin="anonymous"></script>
    <script type="text/javascript">
          
    jQuery(window).load(function () {
        $(".loader").fadeOut("slow"); //retire o delay quando for copiar!
        $("#tudo_page").toggle("fast");
    });
    </script>
 
@stop
