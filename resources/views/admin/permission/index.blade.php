@extends('layouts.master')
@section('title')
    Quyền
@stop
@section('css')
    <link rel="stylesheet" href="css/responsive.css">
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @can('permission-view')
        <div class="body-content">



            <div class="card">
                <div class="card-header card-header-new">
                    {{ __('permission.list') }}
                </div>
                <div class="card-body">
                    <div class="clearfix">
                        <div style="float: left">
                            <div class="input-group mb-3 d-flex flex-nowrap">

                                <label class="btn btn-default" for="showRow">{{ __('general.show') }}</label>

                                <select class="custom-select" id="showRow">
                                    <option
                                        value="10" {{ isset($_GET['amount']) ? ($_GET['amount'] === '10' ? 'selected' : '') : '' }}>
                                        10
                                    </option>
                                    <option
                                        value="25" {{ isset($_GET['amount']) ? ($_GET['amount'] === '25' ? 'selected' : '') : '' }}>
                                        25
                                    </option>
                                    <option
                                        value="50" {{ isset($_GET['amount']) ? ($_GET['amount'] === '50' ? 'selected' : '') : '' }}>
                                        50
                                    </option>
                                    <option
                                        value="100" {{ isset($_GET['amount']) ? ($_GET['amount'] === '100' ? 'selected' : '') : '' }}>
                                        100
                                    </option>
                                </select>
                                @can('permission-delete')
                                    <div>
                                        <a id="btn-delete" style="margin-left: 0.25rem"
                                           class="btn btn-warning"
                                           data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash"> </i> Xóa
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.permissions.destroy-select') }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">{{ __('permission.permission') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" id="allValsDelete" name="allValsDelete[]"
                                                               style="display: none">
                                                        <p>{{ __('general.confirm_delete_all') }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('general.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ __('general.delete') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endcan
                                <div class="clearfix" style="margin-left: 0.25rem; margin-bottom: 0">
                                    @if(session('success'))
                                        <div class="btn btn-success button_  float-right">
                                            {{session('success')}}
                                        </div>
                                    @endif
                                    @if(session('fail'))
                                        <div class="btn btn-danger  button_ float-right">
                                            {{session('fail')}}
                                        </div>
                                    @endif
                                    @can('permission-create')
                                        <div class="create float-left">
                                            <a href="{{route('admin.permissions.create')}}" class="btn btn-success "><i
                                                    class="fas fa-plus"></i> {{ __('general.create') }}</a>
                                        </div>
                                    @endcan
                                </div>
                            </div>

                        </div>
                        @can('permission-search')
                            <div style="float: right">
                                <input id="search" class="form-control" type="search" placeholder="{{ __('general.search') }}" value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}">
                            </div>
                        @endcan
                    </div>
                    <div id="permission-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px"><input type="checkbox" id="check-all"></th>
                                    <th>{{ __('permission.id') }}</th>
                                    <th>{{ __('permission.screen') }}</th>
                                    <th>{{ __('permission.permission') }}</th>
                                    <th>{{__('permission.description') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($permissions as $item => $permission)
                                    <tr>
                                        <td><input type="checkbox" class="btn-check" value="{{ $permission->id }}"></td>
                                        <td>{{ $permissions->firstItem() + $item }}</td>
                                        <td>{{ $permission->feature }}</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-primary" style="width: 48px">{{ $permission->permission_type }}</button>
                                        </td>
                                        <td>{{ $permission->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $permission->id }}">
                                                {{ __('general.view') }}
                                            </button>
                                            <div class="modal fade" id="viewModal{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('permission.permission') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered table-striped table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>{{ __('permission.name') }}</th>
                                                                    <th>{{__('permission.description') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>{{ $permission->name }}</td>
                                                                    <td>{{ $permission->description }}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('general.close') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('permission-update')
                                                <a class="btn btn-xs btn-success" href="{{ route('admin.permissions.create').'?id='.$permission->id }}" role="button">{{ __('general.update') }}</a>
                                            @endcan
                                            @can('permission-delete')
                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $permission->id }}">
                                                    {{ __('general.delete') }}
                                                </button>
                                                <form action="{{ route('admin.permissions.destroy') }}" method="POST">
                                                    @csrf
                                                    <div class="modal fade" id="deleteItemModal{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('permission.permission') }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="text" name="id" value="{{ $permission->id }}" style="display: none">
                                                                    <p>{{ __('general.confirm_delete') }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('general.close') }}</button>
                                                                    <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td style="text-align: center" colspan="6">{{ __('general.nodata') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="clearfix">
                            <div style="float: right">
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <script>
        setTimeout(function () {
            $('.button_').fadeOut('fast');
        }, 2000);
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#check-all").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $("#btn-delete").on('click', function () {
                var allVals = [];
                $(".btn-check").not("#check-all").each(function() {
                    if ($(this).is(":checked")) {
                        allVals.push($(this).val());
                    }
                });
                console.log(allVals);
                $('#allValsDelete').val(allVals);
            });

            $("#search").on('keyup', function () {
                var key = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.permissions.search-row') }}',
                    data: {
                        key: key,
                        amount: {{ isset($_GET['amount']) ? $_GET['amount'] : 'null' }}
                    },
                    success: function (response) {
                        $("#permission-table").empty();
                        $("#permission-table").html(response);
                    },
                });
            });

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var amountRow = $("#showRow :selected").val();
                var key = $("#search").val();
                var url = $(this).attr('href') + '&amount=' + amountRow + '&key=' + key;
                window.location.assign(url);
            });

            $("#showRow").on('change', function () {
                var amountRow = $("#showRow :selected").val();
                var url = '{{ route('admin.permissions.index').'?amount=:amount' }}';
                url = url.replace(':amount', amountRow);
                window.location.assign(url);
            });

        });
    </script>
@stop
