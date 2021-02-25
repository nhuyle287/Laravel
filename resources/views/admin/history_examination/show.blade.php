@extends('layouts.master')
@section('title')
    Lịch sử khám
@stop
@section('head')
    <link rel="stylesheet" href="css/responsive.css">
    <style>


    </style>
@stop

@section('content')

    <section class="content">
        <div class="body-content">
            <div class="card">

                <div class="card-header card-header-new">
                    Thông tin khám bệnh
                    <div class="float-right">
                        <a href="{{ route('admin.history-examinations.index') }}"
                           class="btn-sm btn-danger">X</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Khách hàng</th>
                            <td>{{ $register_medicines->name }}</td>
                            <th>Ngày khám</th>
                            <td>{{ date('d-m-Y',strtotime($register_medicines->date_examination)) }}</td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <th>Mạch</th>
                            <td>{{ $register_medicines->circuit }}</td>
                            <th>Nhiệt độ</th>
                            <td>{{ $register_medicines->temperature }}</td>
                        </tr>
                        <tr>
                            <th>Huyết áp</th>
                            <td>{{ $register_medicines->blood_pressure }}</td>
                            <th>Nhịp thở</th>
                            <td>{{ $register_medicines->breathing }}</td>
                        </tr>

                    </table>
                    <br>
                    <hr>
                    <div class="form-row">
                        @if($register_medicines->price_public!=0)
                            <div class="form-group col-md-4">
                                <div class="col-xs-6 form-group">

                                    <input type="checkbox" checked id="price_public" name="price_public"
                                           style="width: min-content"
                                           value="">
                                    <label class="col-xs-8">Công khám</label>
                                    <p class="help-block text-danger"></p>
                                    @if($errors->has('price_public'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('price_public') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        @else
                            <div class="form-group col-md-4">
                                <div class="col-xs-6 form-group">

                                    <input type="checkbox" id="price_public" name="price_public"
                                           style="width: min-content"
                                           value="">
                                    <label class="col-xs-8">Công khám</label>
                                    <p class="help-block text-danger"></p>
                                    @if($errors->has('price_public'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('price_public') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($register_medicines->ECG!=0)
                            <div class="form-group col-md-4">
                                <div class="col-xs-6 form-group">

                                    <input type="checkbox" checked id="ECG" name="ECG" style="width: min-content"
                                           value="">
                                    <label class="col-xs-8">ECG</label>
                                    <p class="help-block text-danger"></p>
                                    @if($errors->has('ECG'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('ECG') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @else
                                <div class="form-group col-md-4">
                                    <div class="col-xs-6 form-group">

                                        <input type="checkbox"  id="ECG" name="ECG" style="width: min-content"
                                               value="">
                                        <label class="col-xs-8">ECG</label>
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('ECG'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('ECG') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                        @endif
                        @if($register_medicines->blood_sugar!==0)
                            <div class="form-group col-md-4">
                                <div class="col-xs-6 form-group">

                                    <input type="checkbox" checked id="blood_sugar" name="blood_sugar"
                                           style="width: min-content"
                                           value="">
                                    <label class="col-xs-8">Đường huyết</label>
                                    <p class="help-block text-danger"></p>
                                    @if($errors->has('blood_sugar'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('blood_sugar') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @else
                                <div class="form-group col-md-4">
                                    <div class="col-xs-6 form-group">

                                        <input type="checkbox"  id="blood_sugar" name="blood_sugar"
                                               style="width: min-content"
                                               value="">
                                        <label class="col-xs-8">Đường huyết</label>
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('blood_sugar'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('blood_sugar') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                        @endif
                    </div>
                   <hr>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Thuốc</th>

                            <th>Giá</th>

                            <th>Số lượng</th>

                            <th>Thành tiền</th>

                        </tr>
                        @if(count($medicines)>0)
                            @foreach($medicines as $me)

                                <tr>
                                    <td>
                                        {{$me->name}}
                                    </td>
                                    <td>
                                        {{$me->price}}
                                    </td>
                                    <td>
                                        {{$me->amount_medicine}}
                                    </td>
                                    <td>
                                        {{$me->total_price}}
                                    </td>
                                </tr>

                            @endforeach
                        @endif

                    </table>
                </div>
            </div>


        </div>

        <!-- /.container-fluid -->
    </section>

@stop
