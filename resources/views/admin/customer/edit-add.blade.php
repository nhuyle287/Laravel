@extends('layouts.master')
@section('title')
    Khách hàng
@stop
@section('head')
    <link rel="stylesheet" href="{{ asset('../css/responsive.css') }}">
@stop
@section('content')

    <section class="body-content">
        <div class="card">

            <div class="card-header card-header-new">
                {{ __('customer.create') }}
            </div>
            <div class="card-body">
                <form action="{{route('admin.customers.store')}}" method="post">
                    <input type="hidden" name="id" value="{{isset($customer->id) ? $customer->id: ''}}">
                    @csrf
                    <div class="clearfix">
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>Họ và tên <label class="content-required">*</label></label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{isset($customer->name) ? old('name', $customer->name) : old('name')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('name'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>ID <label class="content-required">*</label></label>
                                        <input type="text" readonly class="form-control" name="code"
                                               value="{{isset($customer->code) ? old('code', $customer->code) : old('name')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('code'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('code') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>Số Điện Thoại <label class="content-required">*</label></label>
                                        <input type="text" class="form-control" name="phone_number"
                                               value="{{isset($customer->phone_number) ? old('phone_number', $customer->phone_number) : old('phone_number')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('phone_number'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('phone_number') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>Tuổi <label class="content-required">*</label></label>
                                        <input type="number" class="form-control" name="birthday"
                                               value="{{isset($customer->birthday) ? old('birthday', $customer->birthday) : old('birthday')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('birthday'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('birthday') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                               value="{{isset($customer->email) ? old('email', $customer->email) : old('email')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('email'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>Địa Chỉ</label>
                                        <input  class="form-control" name="address"
                                               value="{{isset($customer->address) ? old('address', $customer->address) : old('address')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>Ghi chú</label>
                                        <input type="text" class="form-control" name="notes"
                                               value="{{isset($customer->notes) ? old('notes', $customer->notes) : old('notes')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('notes'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('notes') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
@stop
