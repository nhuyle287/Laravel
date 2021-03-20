@inject('request', 'Illuminate\Http\Request')
@extends('layouts.master')
@section('title')
    Phiếu chi
@stop
@section('head')
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        .col-left {
            width: 30%;
            margin-left: 1.25rem;
        }
        .total_price:first-letter{
            text-transform: capitalize;
        }
        .infor {
            margin-bottom: 1rem;
        }

        .title_revenue {
            text-align: center;
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }
        .col-right p{
            border-bottom: 1px dotted black;
        }
        .modal-body{
            margin: 1rem;
        }
    </style>
@stop
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @can('expenditure-view')
        <div class="body-content">

            <div class="card">
                <div class="card-header card-header-new">
                    {{ __('expenditure.list') }}
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
                                @can('expenditure-delete')
                                    <div>
                                        <a id="btn-delete" style="margin-left: 0.25rem"
                                           class="btn btn-warning"
                                           data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash"> </i> Xóa
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.expenditure.destroy-select') }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">{{__('expenditure.expenditure')}}</h5>
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
                                    @can('expenditure-create')
                                        <div class="create float-left">
                                            <a href="{{route('admin.expenditure.create')}}" class="btn btn-success "><i
                                                    class="fas fa-plus"></i> {{ __('general.create') }}</a>
                                        </div>
                                    @endcan
                                </div>
                            </div>

                        </div>
                        <div style="float: right">
                            {{--                            <div style="float: left">--}}
                            {{--                                <a style="margin-right: 5px" class="btn btn-warning" href="#" role="button"><i--}}
                            {{--                                        class="fas fa-search"></i></a>--}}
                            {{--                            </div>--}}
                            @can('expenditure-search')
                                <div>
                                    <input id="search" class="form-control" type="search"
                                           placeholder="{{ __('general.search') }}"
                                           value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}">
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div id="expenditure-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">

                                <thead>
                                <tr>
                                    <th style="width: 10px"><input type="checkbox" id="check-all"></th>
                                    <th>{{ __('expenditure.id') }}</th>
                                    <th>{{ __('expenditure.receiver') }}</th>
                                    <th class="test">{{__('expenditure.value')}}</th>
                                    <th>{{ __('expenditure.date_expenditure') }}</th>

                                    <th class="test"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($expenditures as $item => $expenditure)
                                    <tr>
                                        <td><input type="checkbox" class="btn-check"
                                                   value="{{ $expenditure->id }}"></td>
                                        <td>{{ $expenditures->firstItem() + $item }}</td>
                                        <td>{{ $expenditure->receiver }}</td>
                                        <td class="test">{{number_format($expenditure->price)}}</td>
                                        <td>{{ $expenditure->date }}</td>

                                        <td class="test">
                                            <button type="button" class="btn btn-xs btn-info" data-toggle="modal"
                                                    data-target="#viewModal{{ $expenditure->id }}">
                                                {{ __('general.view') }}
                                            </button>
                                            <div class="modal fade" id="viewModal{{ $expenditure->id }}"
                                                 tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLabel">{{ __('expenditure.expenditure') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="receipts">
                                                                <div>
                                                                    <div class="infor">
                                                                        <p><strong
                                                                            >Đơn
                                                                                vị:</strong><span> PHÒNG MẠCH LÝ KIM TÙNG</span>
                                                                        </p>
                                                                        <strong>Địa chỉ: </strong><span>Phường Bình Đức, Thành Phố Long Xuyên, Tỉnh An Giang</span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <p class="title_revenue">
                                                                        <b>BIÊN LAI CHI TIỀN</b></p>

                                                                    <p style="text-align: center">
                                                                        Ngày {{date("d",strtotime($expenditure->date))}}
                                                                        Tháng {{date("m",strtotime($expenditure->date))}}
                                                                        Năm {{date("Y",strtotime($expenditure->date))}}</p>
                                                                </div>
                                                                <?php
                                                                function convert_number_to_words($number)
                                                                {

                                                                    $hyphen = ' ';
                                                                    $conjunction = '  ';
                                                                    $separator = ' ';
                                                                    $negative = 'âm ';
                                                                    $decimal = ' phẩy ';
                                                                    $dictionary = array(
                                                                        0 => 'không',
                                                                        1 => 'một',
                                                                        2 => 'hai',
                                                                        3 => 'ba',
                                                                        4 => 'bốn',
                                                                        5 => 'năm',
                                                                        6 => 'sáu',
                                                                        7 => 'bảy',
                                                                        8 => 'tám',
                                                                        9 => 'chín',
                                                                        10 => 'mười',
                                                                        11 => 'mười một',
                                                                        12 => 'mười hai',
                                                                        13 => 'mười ba',
                                                                        14 => 'mười bốn',
                                                                        15 => 'mười năm',
                                                                        16 => 'mười sáu',
                                                                        17 => 'mười bảy',
                                                                        18 => 'mười tám',
                                                                        19 => 'mười chín',
                                                                        20 => 'hai mươi',
                                                                        30 => 'ba mươi',
                                                                        40 => 'bốn mươi',
                                                                        50 => 'năm mươi',
                                                                        60 => 'sáu mươi',
                                                                        70 => 'bảy mươi',
                                                                        80 => 'tám mươi',
                                                                        90 => 'chín mươi',
                                                                        100 => 'trăm',
                                                                        1000 => 'ngàn',
                                                                        1000000 => 'triệu',
                                                                        1000000000 => 'tỷ',
                                                                        1000000000000 => 'nghìn tỷ',
                                                                        1000000000000000 => 'ngàn triệu triệu',
                                                                        1000000000000000000 => 'tỷ tỷ'
                                                                    );

                                                                    if (!is_numeric($number)) {
                                                                        return false;
                                                                    }

                                                                    if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
// overflow
                                                                        trigger_error(
                                                                            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                                                                            E_USER_WARNING
                                                                        );
                                                                        return false;
                                                                    }

                                                                    if ($number < 0) {
                                                                        return $negative . convert_number_to_words(abs($number));
                                                                    }

                                                                    $string = $fraction = null;

                                                                    if (strpos($number, '.') !== false) {
                                                                        list($number, $fraction) = explode('.', $number);
                                                                    }

                                                                    switch (true) {
                                                                        case $number < 21:
                                                                            $string = $dictionary[$number];
                                                                            break;
                                                                        case $number < 100:
                                                                            $tens = ((int)($number / 10)) * 10;
                                                                            $units = $number % 10;
                                                                            $string = $dictionary[$tens];
                                                                            if ($units) {
                                                                                $string .= $hyphen . $dictionary[$units];
                                                                            }
                                                                            break;
                                                                        case $number < 1000:
                                                                            $hundreds = $number / 100;
                                                                            $remainder = $number % 100;
                                                                            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                                                                            if ($remainder) {
                                                                                $string .= $conjunction . convert_number_to_words($remainder);
                                                                            }
                                                                            break;
                                                                        default:
                                                                            $baseUnit = pow(1000, floor(log($number, 1000)));
                                                                            $numBaseUnits = (int)($number / $baseUnit);
                                                                            $remainder = $number % $baseUnit;
                                                                            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                                                                            if ($remainder) {
                                                                                $string .= $remainder < 100 ? $conjunction : $separator;
                                                                                $string .= convert_number_to_words($remainder);
                                                                            }
                                                                            break;
                                                                    }

                                                                    if (null !== $fraction && is_numeric($fraction)) {
                                                                        $string .= $decimal;
                                                                        $words = array();
                                                                        foreach (str_split((string)$fraction) as $number) {
                                                                            $words[] = $dictionary[$number];
                                                                        }
                                                                        $string .= implode(' ', $words);
                                                                    }

                                                                    return $string;
                                                                }
                                                                ?>
                                                                <div class="clearfix">
                                                                    <table class="table table-borderless table-sm"
                                                                           width="100%"
                                                                           style="font-size: 16px; margin: 0 auto">
                                                                        <tbody>
                                                                        <tr class="table-light">
                                                                            <td class="col-left">Họ tên người nhận
                                                                                tiền:
                                                                            </td>
                                                                            <td class="col-right">
                                                                                <p class="border-dotter">{{ $expenditure->receiver }}</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-left">Địa chỉ:</td>
                                                                            <td class="col-right">
                                                                                <p class="border-dotter">{{ $expenditure->address_receiver }}</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="table-light">
                                                                            <td class="col-left">Lý do chi:</td>
                                                                            <td class="col-right">
                                                                                <p class="border-dotter">{{$expenditure->description}}</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-left">Tổng số tiền:</td>
                                                                            <td class="col-right">
                                                                                <p class="border-dotter">{{number_format($expenditure->price)}}
                                                                                    VND</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="table-light">
                                                                            <td class="col-left">(Viết bằng chữ):</td>
                                                                            <td class="col-right">
                                                                                <p class="border-dotter total_price">{{convert_number_to_words($expenditure->price)}}
                                                                                    đồng.</p>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="clearfix">
                                                                    <p style="text-align: right">
                                                                        Ngày {{date("d",strtotime($expenditure->date))}}
                                                                        Tháng {{date("m",strtotime($expenditure->date))}}
                                                                        Năm {{date("Y",strtotime($expenditure->date))}}</p>
                                                                </div>
                                                                <div class="clearfix">
                                                                    <p style="float: left"><b>Người nhập tiền</b></p>
                                                                    <p style="float: right"><b>Người lập phiếu</b></p>
                                                                </div>

                                                            </div>
                                                            <br>
                                                            <br>
                                                            <br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route("admin.expenditure.print")}}"
                                                                  method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                       value="{{$expenditure->id}}">
                                                                <button type="submit" formtarget="_blank"
                                                                        class="btn btn-default">Xuất phiếu chi
                                                                </button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('general.close') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('expenditure-update')
                                                <a href="{{route('admin.expenditure.edit', [$expenditure->id])}}"
                                                   class="btn  btn-success btn-xs">{{ __('general.update') }}</a>
                                            @endcan
                                            @can('expenditure-delete')
                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                                        data-target="#deleteItemModal{{ $expenditure->id }}">
                                                    {{ __('general.delete') }}
                                                </button>
                                                <form action="{{ route('admin.expenditure.destroy') }}" method="POST">
                                                    @csrf
                                                    <div class="modal fade"
                                                         id="deleteItemModal{{ $expenditure->id }}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">{{ __('expenditure.expenditure') }}</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="text" name="id"
                                                                           value="{{ $expenditure->id }}"
                                                                           style="display: none">
                                                                    <p>{{ __('general.confirm_delete') }}</p>
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
                                {!! $expenditures->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop
@section('javascript')
    <script>
        setTimeout(function () {
            $('.button_').fadeOut('fast');
        }, 2000);
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $("#check-all").click(function () {
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

            $("#search").on('keyup', function () {
                var key = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.expenditure.search-row') }}',
                    data: {
                        key: key,
                        amount: {{ isset($_GET['amount']) ? $_GET['amount'] : 'null' }}
                    },
                    success: function (response) {
                        // alert(response)
                        $("#expenditure-table").empty();
                        $("#expenditure-table").html(response);
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
                var url = '{{ route('admin.expenditure.index').'?amount=:amount' }}';
                url = url.replace(':amount', amountRow);
                window.location.assign(url);
            });

        });
    </script>





    <script>

        $(document).ready(function () {
            $('.mdb-select').materialSelect();
        });
    </script>
@stop

