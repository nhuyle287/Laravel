@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <div class="body-content">
        <div class="card">
            <div class="card-header card-header-new">
                {{ __('permission.create') }}
            </div>

            <div class="card-body">
                <form id="form-submit" method="POST" action="{{ route("admin.permissions.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input style="display: none" name="id" value="{{ isset($permission->id) ? $permission->id : '' }}">
                    <div class="form-group">
                        <label class="required" for="feature">{{ __('permission.screen') }} <label class="content-required">*</label></label>
                        <input class="form-control" type="text" name="feature" id="feature" value="{{ isset($permission->feature) ? $permission->feature : '' }}">
                    </div>
                    <div class="form-group">
                        <label class="required" for="permission_type">{{ __('permission.permission') }} <label class="content-required">*</label></label>
                        <select class="form-control" id="permission_type" name="permission_type">
                            <option value="access">access</option>
                            <option value="view">view</option>
                            <option value="create">create</option>
                            <option value="update">update</option>
                            <option value="delete">delete</option>
                            <option value="search">search</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label  for="description">{{ __('permission.description') }} </label>
                        <input class="form-control" type="text" name="description" id="description" value="{{ isset($permission->description) ? $permission->description : '' }}">
                    </div>
                    <input style="display: none" id="per-name" name="name">
                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('admin.permissions.index') }}" role="button">{{ __('general.back') }}</a>
                        <button id="btn-submit" class="btn btn-danger" type="button">{{ __('general.save') }}</button>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-submit").on('click', function () {
                var feature = $("#feature").val();
                var permission_type = $("#permission_type").val();
                var text = feature + "-" + permission_type;
                $("#per-name").val(text);
                $("#form-submit" ).submit();
            });
        });
    </script>
@stop
