@extends('layouts.master')
@section('title')
    Khám bệnh
@stop
@section('head')
    <link rel="stylesheet" href="css/responsive.css">

@stop
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @can('list-medicine-view')
        <div class="body-content">

            <div class="card">
                <div class="card-header card-header-new">
                    Danh sách khám bệnh
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
                                @can('list-medicine-delete')
                                    <div>
                                        <a id="btn-delete" style="margin-left: 0.25rem"
                                           class="btn btn-warning"
                                           data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash"> </i> Xóa
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.customers.destroy-select') }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">Khám bệnh</h5>
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

                                </div>
                            </div>

                        </div>
                        <div style="float: right">
                            {{--                            <div style="float: left">--}}
                            {{--                                <a style="margin-right: 5px" class="btn btn-warning" href="#" role="button"><i--}}
                            {{--                                        class="fas fa-search"></i></a>--}}
                            {{--                            </div>--}}
                            @can('list-medicine-search')
                                <div>
                                    <input id="search" class="form-control" type="search"
                                           placeholder="{{ __('general.search') }}"
                                           value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}">
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div id="order-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px"><input type="checkbox" id="check-all"></th>
                                    <th class="thstyleform">STT</th>
                                    <th class="thstyleform">
                                       Khách hàng
                                    </th>

                                    <th class="thstyleform">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @include('admin.register_medicine.search_row')
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>
                        {{--                        <div class="clearfix">--}}
                        {{--                            --}}
                        {{--                            <div class="text-right" style="float: right ; margin-top: 5px" id="page">--}}
                        {{--                                {{ $register_services->links() }}--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {

            $("#check-all").on('click', function () {
                // alert('a')
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $("#btn-delete").on('click', function () {
                var allVals = [];
                $(".btn-check").not("#check-all").each(function () {
                    if ($(this).is(":checked")) {
                        allVals.push($(this).val());
                    }
                });
                // console.log(allVals);
                $('#allValsDelete').val(allVals);
            });

            function fetch_data(page, amountRow, query) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.register-medicines.search-row') }}?page=' + page + '&amount=' + amountRow + '&key=' + query,
                    success: function (response) {
                        $("tbody").empty();
                        $("tbody").html(response);
                    }
                })
            }

            $("#search").on('keyup', function () {
                var key = $(this).val();
                var page = $('#hidden_page').val();
                var amountRow = $("#showRow :selected").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                fetch_data(page, amountRow, key);
                if(key!="")
                {
                    $(document).on('click', '.pagination a', function (event) {
                        event.preventDefault();
                        var amountRow = $("#showRow :selected").val();
                        var key = $("#search").val();
                        var page = $(this).attr('href').split('page=')[1];

                        $('#hidden_page').val(page);
                        $('li').removeClass('active');
                        $(this).parent().addClass('active');
                        fetch_data(page, amountRow, key);
                    });
                }

            });



            $("#showRow").on('change', function () {
                var amountRow = $("#showRow :selected").val();
                var url = '{{ route('admin.register-medicines.index').'?amount=:amount' }}';
                url = url.replace(':amount', amountRow);
                window.location.assign(url);
            });

        });
    </script>
    <script type="text/javascript">
        //update transaction
        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var transaction = button.data('transaction')
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #transaction option:selected').text();
            modal.find('.modal-body #id').val(id);
        })
    </script>

@stop


