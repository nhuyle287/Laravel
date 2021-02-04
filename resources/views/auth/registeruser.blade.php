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

            <div class="login_box" style="width: 40%!important; ">
                <div class="card" >
                    <div class="card-header fadeIn first">Đăng ký tài khoản</div>
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
                        <form action="{{route('postRegisteruser')}}" method="post" >
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-ms-4 col-form-label text-left fadeIn second">Tên người
                                    dùng</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" id="name" class="form-control fadeIn second" name="name"
                                           value="@if(request('name')){{request('name')}}@endif{{ old('name') }}"
                                           autofocus>
                                    @if($errors->has('name'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-ms-4 col-form-label text-left fadeIn second">{{ __('general.email') }}</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="email" id="email" class="form-control fadeIn second" name="email"
                                           value="@if(request('email')){{request('email')}}@endif{{ old('email') }}"
                                           autofocus>
                                    @if($errors->has('email'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-left fadeIn third">{{ __('general.password') }}</label>
                                <div class="col-md-6  col-xs-12">
                                    <input type="password" id="password" class="form-control fadeIn third"
                                           value="{{old('password')}}"
                                           name="password">
                                    @if($errors->has('password'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('password') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_id"
                                       class="col-md-4 col-form-label text-left fadeIn third">Quyền tài khoản</label>
                                <div class="col-md-6  col-xs-12">
                                    <select class="js-example-basic-single form-control"
                                            name="role_id">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}"> {{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('role_id'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('role_id') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row ">

                                <button type="submit" class="btn btn-sm fadeIn fourth" id="login"
                                        style="width: 20%!important; margin-left: 30%">
                                    {{ __('general.save') }}
                                </button>
                                <a href="{{ route('login') }}"
                                   class="btn btn-sm btn-default fadeIn fourth"
                                   style="margin-left: 0.5rem; padding-top: 0.5rem">Hủy bỏ</a>
                            </div>
                        </form>
                        <br>
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('javascript')

@stop

