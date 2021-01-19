@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <div class="body-content">
        <div class="card">
            <div class="card-header card-header-new">
                {{ __('staff.create') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.staffs.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input style="display: none" name="id" value="{{ isset($staff->id) ? $staff->id : old('id') }}">
                    <div class="clearfix">
                        <div class="form-group form-group-left">
                            <label class="required" for="name">{{ __('staff.name') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ isset($staff->name) ? $staff->name : old('name') }}">
                        </div>
                        <div class="form-group form-group-right">
                            <label class="required" for="email">{{ __('staff.email') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ isset($staff->email) ? $staff->email : old('email') }}">
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group form-group-left">
                            <label class="required" for="password">{{ __('staff.password') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group form-group-right">
                            <label class="required" for="address">{{ __('staff.address') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ isset($staff->address) ? $staff->address : old('address') }}">
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group form-group-left">
                            <label class="required" for="phone_number">{{ __('staff.phone_number') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="number" name="phone_number" id="phone_number" value="{{ isset($staff->phone_number) ? $staff->phone_number : old('phone_number') }}">
                        </div>
                        <div class="form-group form-group-right">
                            <label class="required" for="birthday">{{ __('staff.birthday') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="date" name="birthday" id="birthday" value="{{ isset($staff->birthday) ? $staff->birthday : old('birthday') }}">
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group form-group-left">
                            <label class="required" for="salary">{{ __('staff.salary') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="number" name="salary" id="salary" value="{{ isset($staff->salary) ? $staff->salary : old('salary') }}">
                        </div>
                        <div class="form-group form-group-right">
                            <label for="position_code">{{ __('staff.position') }} <label class="content-required">*</label></label>
                            <select class="form-control" id="position_code" name="position_code">
                                @foreach($positions as $position)
                                    <option value="{{ $position->code }}" {{ ($position->code == (isset($staff->position_code) ? $staff->position_code : old('possition_code'))) ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group form-group-left">
                            <label class="required" for="start_time">{{ __('staff.start_time') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="date" name="start_time" id="start_time" value="{{ isset($staff->start_time) ? $staff->start_time : old('start_time') }}">
                        </div>
                        <div class="form-group form-group-right">
                            <label for="position_code">{{ __('staff.department') }} <label class="content-required">*</label></label>
                            <select class="form-control" id="department_code" name="department_code">
                                @foreach($departments as $department)
                                    <option value="{{ $department->code }}" {{ ($department->code == (isset($staff->department_code) ? $staff->department_code : old('department_code'))) ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('admin.staffs.index') }}" role="button">{{ __('general.back') }}</a>
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
