@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <div class="body-content">
        <div class="card">
            <div class="card-header card-header-new">
                {{ __('position.create') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.positions.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input style="display: none" name="id" value="{{ isset($position->id) ? $position->id : '' }}">
                    <div class="form-group">
                        <label class="required" for="name">{{ __('position.name') }} <label class="content-required">*</label></label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ isset($position->name) ? $position->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label class="required" for="description">{{ __('position.description') }}</label>
                        <input class="form-control" type="text" name="description" id="description" value="{{ isset($position->description) ? $position->description : '' }}">
                    </div>
                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('admin.positions.index') }}" role="button">{{ __('general.back') }}</a>
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
