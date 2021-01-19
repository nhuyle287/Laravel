@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <div class="body-content">
        <div class="card">
            <div class="card-header card-header-new">
                {{ __('user.create') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input style="display: none" name="id" value="{{ isset($user->id) ? $user->id : '' }}">
                    <div class="clearfix">
                        <div class="form-group">
                            <label class="required" for="name">{{ __('user.name') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ isset($user->name) ? $user->name : '' }}">
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ __('user.email') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ isset($user->email) ? $user->email : '' }}">
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ __('user.password') }} <label class="content-required">*</label></label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label class="required" for="role_id">{{ __('user.role') }} <label class="content-required">*</label></label>
                            <select class="form-control" id="role_id" name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ ($role->id == (isset($user->role_id) ? $user->role_id : '-1')) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('admin.users.index') }}" role="button">{{ __('general.back') }}</a>
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
