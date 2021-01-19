@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <div class="body-content">
        <div class="card">
            <div class="card-header card-header-new">
                {{ __('role.create') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
                    @csrf
                    <input style="display: none" name="id" value="{{ isset($role->id) ? $role->id : '' }}">
                    <div class="form-group">
                        <label class="required" for="name">{{ __('role.name') }} <label class="content-required">*</label></label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ isset($role->name) ? $role->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label class="required">{{ __('role.permission') }} <label class="content-required">*</label></label>
                        <div style="float: right">
                            <button type="button" class="btn btn-xs btn-primary">{{ __('role.select_all') }}</button>
                            <button type="button" class="btn btn-xs btn-danger">{{ __('role.delete_all') }}</button>
                        </div>
                        <div class="row">
                            @foreach($features as $feature)
                                <div class="col-md-4 form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input {{ $feature->feature }}" onclick="checkAll(this)">
                                        <label class="form-check-label">{{ $feature->feature }}</label>
                                    </div>
                                    @php
                                        /** @var TYPE_NAME $feature */
                                        $permissions = \App\Models\Permission::where('feature', '=', $feature->feature)->get();
                                    @endphp
                                    @foreach($permissions as $permission)
                                        <div class="form-check" style="margin-left: 30px">
                                            <input name="permission_id[]" value="{{ $permission->id }}" type="checkbox" class="form-check-input {{ $feature->feature }}" {{ in_array($permission->id, $arrayPermission) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $permission->permission_type }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('admin.roles.index') }}" role="button">{{ __('general.back') }}</a>
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

    <script type="text/javascript">
        function checkAll(elm) {
            var string = $(elm).attr("class");
            var feature = string.slice(17);
            var cls = "." + feature;
            $('input' + cls + ':checkbox').not(elm).prop('checked', elm.checked);
        };
    </script>
@stop
