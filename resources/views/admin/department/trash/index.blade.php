@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('../css/default.css') }}">
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @can('staff-view')
        <div class="body-content">

            <div class="clearfix" style="margin-bottom: 15px">
                @if(session('success'))
                    <div class="alert-crud btn btn-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('fail'))
                    <div class="alert-crud btn btn-danger">
                        {{ session('fail') }}
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="card-header card-header-new">
                    {{ __('department.list') }}
                </div>
                <div class="card-body">
                    <div class="clearfix">
                        <div style="float: left">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="showRow">{{ __('general.show') }}</label>
                                </div>
                                <select class="custom-select" id="showRow">
                                    <option value="10" {{ isset($_GET['amount']) ? ($_GET['amount'] === '10' ? 'selected' : '') : '' }}>10</option>
                                    <option value="25" {{ isset($_GET['amount']) ? ($_GET['amount'] === '25' ? 'selected' : '') : '' }}>25</option>
                                    <option value="50" {{ isset($_GET['amount']) ? ($_GET['amount'] === '50' ? 'selected' : '') : '' }}>50</option>
                                    <option value="100" {{ isset($_GET['amount']) ? ($_GET['amount'] === '100' ? 'selected' : '') : '' }}>100</option>
                                </select>
                                @can('staff-delete')
                                    <button id="btn-delete" style="margin-left: 5px" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                        {{ __('general.delete') }}
                                    </button>
                                    <form action="{{ route('admin.departments.trash-force-select') }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('department.department') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" id="allValsDelete" name="allValsDelete[]" style="display: none">
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
                                <a style="margin-left: 5px" class="btn btn-secondary" href="{{ route('admin.departments.index') }}" role="button"><i class="fa fa-chevron-left"></i></a>
                            </div>
                        </div>
                        <div class="clearfix" style="float: right">
                            @can('staff-search')
                                <div style="float: right">
                                    <input id="search" class="form-control" type="search" placeholder="{{ __('general.search') }}" value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}">
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div id="department-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px"><input type="checkbox" id="check-all"></th>
                                    <th>{{ __('department.id') }}</th>
                                    <th>{{ __('department.name') }}</th>
                                    <th>{{ __('department.description') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($departments as $item => $department)
                                    <tr>
                                        <td><input type="checkbox" class="btn-check" value="{{ $department->id }}"></td>
                                        <td>{{ $departments->firstItem() + $item }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $department->id }}">
                                                {{ __('general.view') }}
                                            </button>
                                            <div class="modal fade" id="viewModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('department.department') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered table-striped table-hover">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ __('department.name') }}</td>
                                                                        <td>{{ $department->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ __('department.code') }}</td>
                                                                        <td>{{ $department->code }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ __('department.description') }}</td>
                                                                        <td>{{ $department->desciption }}</td>
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
                                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#restoreItemModal{{ $department->id }}">
                                                {{ __('general.restore') }}
                                            </button>
                                            @can('staff-delete')
                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $department->id }}">
                                                    {{ __('general.delete') }}
                                                </button>
                                                <form action="{{ route('admin.departments.trash-force') }}" method="POST">
                                                    @csrf
                                                    <div class="modal fade" id="deleteItemModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('department.department') }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="text" name="id" value="{{ $department->id }}" style="display: none">
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
                                            <form action="{{ route('admin.departments.trash-restore') }}" method="POST">
                                                @csrf
                                                <div class="modal fade" id="restoreItemModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{ __('department.department') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="text" name="id" value="{{ $department->id }}" style="display: none">
                                                                <p>{{ __('general.confirm_restore') }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('general.close') }}</button>
                                                                <button type="submit" class="btn btn-success">{{ __('general.restore') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td style="text-align: center" colspan="5">{{ __('general.nodata') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            <div style="float: right">
                                {!! $departments->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

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
                // console.log(allVals);
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
                    url: '{{ route('admin.departments.trash-search-row') }}',
                    data: {
                        key: key,
                        amount: {{ isset($_GET['amount']) ? $_GET['amount'] : 'null' }}
                    },
                    success: function (response) {
                        $("#department-table").empty();
                        $("#department-table").html(response);
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
                var url = '{{ route('admin.departments.trash-index').'?amount=:amount' }}';
                url = url.replace(':amount', amountRow);
                window.location.assign(url);
            });

        });
    </script>
@stop

