@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <div class="body-content">
        <div class="card">
            <div class="card-header card-header-new">
                {{ __('department.create') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.departments.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input style="display: none" name="id" value="{{ isset($department->id) ? $department->id : '' }}">
                    <div class="form-group">
                        <label class="required" for="name">{{ __('department.department') }} <label class="content-required">*</label></label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ isset($department->name) ? $department->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label class="required" for="description">{{ __('department.description') }}</label>
                        <input class="form-control" type="text" name="description" id="description" value="{{ isset($department->description) ? $department->description : '' }}">
                    </div>
                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('admin.departments.index') }}" role="button">{{ __('general.back') }}</a>
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
