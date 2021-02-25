@extends('layouts.master')
@section('title')
    Đăng ký khám có ID
@stop
@section('head')
    <link rel="stylesheet" href="{{ asset('../css/responsive.css') }}">
@stop
@section('content')
    <section class="body-content">
        <div class="card">

            <div class="card-header card-header-new">
                Đăng ký khám bệnh có ID
            </div>
            <div class="card-body">
                <form action="{{route('register.havecode.register_code')}}" method="post">
                    @csrf
                    <div class="clearfix">
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label
                                            class="">Khách hàng <span
                                                class="aster">*</span></label>
                                        <select class="js-example-basic-single form-control"
                                                name="id_customer">
                                            @foreach($customer as $cus)
                                                <option value="{{$cus->id}}">{{$cus->code}} - {{$cus->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('name'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="form-row">--}}
                            {{--                                <div class="form-group col-md-12">--}}
                            {{--                                    <div class="col-xs-12 form-group">--}}
                            {{--                                        <label>Họ và tên <label class="content-required">*</label></label>--}}
                            {{--                                        <input type="text" class="form-control" name="name"--}}
                            {{--                                               value="{{isset($customer->name) ? old('birthday', $customer->birthday) : old('birthday')}}">--}}
                            {{--                                        <p class="help-block text-danger"></p>--}}
                            {{--                                        @if($errors->has('name'))--}}
                            {{--                                            <p class="help-block text-danger">--}}
                            {{--                                                {{ $errors->first('name') }}--}}
                            {{--                                            </p>--}}
                            {{--                                        @endif--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-row">--}}
                            {{--                                <div class="form-group col-md-12">--}}
                            {{--                                    <div class="col-xs-12 form-group">--}}
                            {{--                                        <label>Tuổi <label class="content-required">*</label></label>--}}
                            {{--                                        <input type="number" class="form-control" name="birthday"--}}
                            {{--                                               value="{{isset($customer->birthday) ? old('birthday', $customer->birthday) : old('birthday')}}">--}}
                            {{--                                        <p class="help-block text-danger"></p>--}}
                            {{--                                        @if($errors->has('birthday'))--}}
                            {{--                                            <p class="help-block text-danger">--}}
                            {{--                                                {{ $errors->first('birthday') }}--}}
                            {{--                                            </p>--}}
                            {{--                                        @endif--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-row">--}}
                            {{--                                <div class="form-group col-md-12">--}}
                            {{--                                    <div class="col-xs-12 form-group">--}}
                            {{--                                        <label>Số điện thoại</label>--}}
                            {{--                                        <input type="text" class="form-control" name="phone_number"--}}
                            {{--                                               value="{{isset($customer->phone_number) ? old('phone_number', $customer->phone_number) : old('birthday')}}">--}}
                            {{--                                        <p class="help-block text-danger"></p>--}}
                            {{--                                        @if($errors->has('phone_number'))--}}
                            {{--                                            <p class="help-block text-danger">--}}
                            {{--                                                {{ $errors->first('phone_number') }}--}}
                            {{--                                            </p>--}}
                            {{--                                        @endif--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <hr>
                            <div class="event_ ">
                                <a href="{{ route('admin.customers.index') }}"
                                   class="btn btn-secondary">{{ __('general.back') }}</a>
                                <button class="btn btn-danger">{{ __('general.save') }}</button>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>

        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {

            $('.js-example-basic-single').select2();
        })


    </script>
@stop
