@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <div class="body-content">
        <div class="card">
            <div class="card-header card-header-new">
                {{ __('medicine.medicine') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.medicines.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input style="display: none" name="id" value="{{ isset($medicine->id) ? $medicine->id : old('id') }}">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="col-xs-12 form-group">
                                <label> {{ __('medicine.name') }} <label class="content-required">*</label></label>
                                <input type="text" class="form-control" name="name"
                                       value="{{isset($medicine->name) ? old('name', $medicine->name) : old('name')}}">
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
                                <label>{{ __('medicine.producer') }} <label class="content-required">*</label></label>
                                <input type="text" class="form-control" name="producer"
                                       value="{{isset($medicine->producer) ? old('producer', $medicine->producer) : old('producer')}}">
                                <p class="help-block text-danger"></p>
                                @if($errors->has('producer'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('producer') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="col-xs-12 form-group">
                                <label>{{ __('medicine.price') }} <label class="content-required">*</label></label>
                                <input type="number" step="0.000001" class="form-control" name="price"
                                       value="{{isset($medicine->price) ? old('price', $medicine->price) : old('price')}}">
                                <p class="help-block text-danger"></p>
                                @if($errors->has('price'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('price') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="col-xs-12 form-group">
                                <label>{{ __('medicine.purchase_price') }} <label class="content-required">*</label></label>
                                <input type="number" step="0.000001" class="form-control" name="purchase_price"
                                       value="{{isset($medicine->purchase_price) ? old('purchase_price', $medicine->purchase_price) : old('purchase_price')}}">
                                <p class="help-block text-danger"></p>
                                @if($errors->has('purchase_price'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('purchase_price') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('admin.medicines.index') }}" role="button">{{ __('general.back') }}</a>
                        <button class="btn btn-danger" type="submit">{{ __('general.save') }}</button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
