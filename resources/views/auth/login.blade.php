@extends('layouts.master-unlogin')
@section('title')
    Đăng nhập
@stop
@section('head')
    <link rel="stylesheet" href="css/login.css">
    {{--        <link rel="stylesheet" href="css/loading.css">--}}
@stop
@section('content')
    {{--    <div class="loader">--}}
    {{--        <img src="images/loading1.gif" alt="loading"/>--}}
    {{--    </div>--}}
    {{--    <div class="loading">--}}
    {{--        <div class="borderKT icon"></div>--}}
    {{--        <span  class="fas fa-circle-notch icon"></span>--}}
    {{--    </div>--}}
    <div class="page-container login wrapper fadeInDown">
    
        <div class="row justify-content-center">

            <div class="login_box">
                <div class="card">
                    <div class="card-header fadeIn first">{{ __('general.login') }}</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success button_">
                                {{session('success')}}
                            </div>
                        @endif
                        @if(session('fail'))
                            <div class="alert alert-danger">
                                {{session('fail')}}
                            </div>
                        @endif
                        <form action="{{route('postLogin')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-3 col-ms-4 col-form-label text-left fadeIn second">{{ __('general.email') }}</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="email" id="email" class="form-control fadeIn second" name="email"
                                           value="@if(request('email')){{request('email')}}@endif{{ old('email') }}"
                                           autofocus>
                                    @if($errors->has('email'))
                                        <p class="help-block">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-3 col-form-label text-left fadeIn third">{{ __('general.password') }}</label>
                                <div class="col-md-6  col-xs-12">
                                    <input type="password" id="password" class="form-control fadeIn third"
                                           value="{{old('password')}}"
                                           name="password">
                                    @if($errors->has('password'))
                                        <p class="help-block">
                                            {{ $errors->first('password') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:0.5rem">
                                <input type="checkbox" id="remember_me" class="fadeIn third"
                                       name="remember_me" style="margin-left:9.5rem;width: 0.75rem;padding-bottom: 0.5rem"> <span style="font-size: 0.75rem;
                                       margin-left: 0.5rem; font-weight: bold;">Ghi nhớ đăng nhập</span>
                            </div>
                            <div class="form-group row">

                                <button type="submit" class="btn btn-sm fadeIn fourth" id="login">
                                    {{ __('general.login') }}
                                </button>


                            </div>
                        </form>
                        <br>
                        <br>
                        <strong> <a href="{{route('registeruser')}}" class="singup">Đăng ký tài khoản</a><span> / </span>
                            <a href="{{route('resetpass')}}" class="reset_pass">Quên mật khẩu</a></strong>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('javascript')
    <script>
        $(document).ready(function () {
            alert()
        })
    </script>
    @stop

