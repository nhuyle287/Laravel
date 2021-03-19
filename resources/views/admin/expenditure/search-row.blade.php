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
                                                        vị:</strong><span>CÔNG TY TNHH HI TECH THIÊN QUÂN</span>
                                                </p>
                                                <strong>Địa chỉ: </strong><span>Lô 09, Tòa nhà 4S Riverside Garden, Đường số 17, Hiệp Bình Chánh, Thủ Đức, TPHCM</span>
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
                                                0 => 'Không',
                                                1 => 'Một',
                                                2 => 'Hai',
                                                3 => 'Ba',
                                                4 => 'Bốn',
                                                5 => 'Năm',
                                                6 => 'Sáu',
                                                7 => 'Bảy',
                                                8 => 'Tám',
                                                9 => 'Chín',
                                                10 => 'Mười',
                                                11 => 'Mười một',
                                                12 => 'Mười hai',
                                                13 => 'Mười ba',
                                                14 => 'Mười bốn',
                                                15 => 'Mười năm',
                                                16 => 'Mười sáu',
                                                17 => 'Mười bảy',
                                                18 => 'Mười tám',
                                                19 => 'Mười chín',
                                                20 => 'Hai mươi',
                                                30 => 'Ba mươi',
                                                40 => 'Bốn mươi',
                                                50 => 'Năm mươi',
                                                60 => 'Sáu mươi',
                                                70 => 'Bảy mươi',
                                                80 => 'Tám mươi',
                                                90 => 'Chín mươi',
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
                                                        <p class="border-dotter">{{convert_number_to_words($expenditure->price)}}
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
                <td style="text-align: center" colspan="5">{{ __('general.nodata') }}</td>
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
