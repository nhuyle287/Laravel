@extends('layouts.master')
@section('title')
    Khám bệnh
@stop
@section('head')
    <link rel="stylesheet" href="{{ asset('../css/responsive.css') }}">
@stop
@section('content')

    <section class="body-content">
        <div class="card">

            <div class="card-header card-header-new">
                Khám bệnh
            </div>
            <div class="card-body">
                <form action="{{route('admin.medical-examinations.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($customer) ? $customer: ''}}">
                    <input type="hidden" name="customer_id" value="{{isset($customer) ? $customer: ''}}">

                    <div class="clearfix">
                        <div class="panel-body">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <div class="col-xs-12 form-group">
                                        <label>Mạch <label class="content-required">*</label></label>
                                        <input type="number" class="form-control" name="circuit"
                                               value="{{isset($customer->circuit) ? old('circuit', $customer->circuit) : old('circuit')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('circuit'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('circuit') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="col-xs-12 form-group">
                                        <label>Nhiệt độ <label class="content-required">*</label></label>
                                        <input type="number" step="0.01" class="form-control" name="temperature"
                                               value="{{isset($customer->temperature) ? old('temperature', $customer->temperature) : old('temperature')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('temperature'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('temperature') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="col-xs-12 form-group">
                                        <label>Nhịp thở <label class="content-required">*</label></label>
                                        <input type="number" class="form-control" name="breathing"
                                               value="{{isset($customer->breathing) ? old('breathing', $customer->breathing) : old('breathing')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('breathing'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('breathing') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="col-xs-12 form-group">
                                        <label>Huyết áp<label class="content-required">*</label></label>
                                        <input type="number" class="form-control" name="blood_pressure"
                                               value="{{isset($customer->blood_pressure) ? old('blood_pressure', $customer->blood_pressure) : old('blood_pressure')}}">
                                        <p class="help-block text-danger"></p>
                                        @if($errors->has('blood_pressure'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('blood_pressure') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12 form-group">
                                        <label>Chuẩn đoán</label>
                                        <input class="form-control" name="diagnostic"
                                               value="{{isset($customer->diagnostic) ? old('diagnostic', $customer->diagnostic) : old('diagnostic')}}">
                                    </div>
                                </div>
                            </div>


                            <h4 style="text-align: center;color:white;background-image: linear-gradient(to top, #83abda, rgb(22, 53, 138));">
                                Thuốc</h4>
                            <div class="chungchi">
                                <input type="hidden" id="id_medicine" class="form-control" readonly name="id_medicine"
                                       value=""
                                       style="margin-top: 5px; margin-left: 3px">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <div class="col-xs-12 form-group">
                                            <label>Tên thuốc <label class="content-required">*</label></label>
                                            <select onchange="selectNamedomain(this)" type="text"
                                                    class="form-control js-example-basic-single"
                                                    id="name_medicine"
                                                    name="name_medicine"
                                                    value="" >
                                                <option selected="selected" value="">Chọn tên thuốc</option>
                                                @foreach($medicine as $med)
                                                    <option value="{{$med->name}}"
                                                            {{--                                            @if(isset($do->id))--}}
                                                            {{--                                            selected--}}
                                                            {{--                                            @endif--}}
                                                            data-price_medicine="{{$med->price}}"
                                                            data-id_medicine="{{$med->id}}"

                                                    >{{$med->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Số lượng <label class="content-required">*</label></label>
                                        <div class="col-xs-12 form-group">
                                            <input type="number" name="amount_medicine"
                                                   id="amount_medicine" class="form-control">
                                            <p class="help-block text-danger"></p>
                                            @if($errors->has('amount_medicine'))
                                                <p class="help-block text-danger">
                                                    {{ $errors->first('amount_medicine') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Giá <label class="content-required">*</label></label>
                                        <div class="col-xs-12 form-group">
                                            <input type="number" readonly name="price"
                                                   id="price" class="form-control">

                                            <p class="help-block text-danger"></p>
                                            @if($errors->has('price'))
                                                <p class="help-block text-danger">
                                                    {{ $errors->first('price') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Thành tiền <label class="content-required">*</label></label>
                                        <div class="col-xs-12 form-group">
                                            <input type="number" readonly name="total_price" id="total_price"
                                                   class="form-control" step="0.00001">

                                            <p class="help-block text-danger"></p>
                                            @if($errors->has('total_price'))
                                                <p class="help-block text-danger">
                                                    {{ $errors->first('total_price') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row event" STYLE="float: right;margin-right: 0.5rem ">
                                    <a id="btcc" class="btn btn-primary eventadd"
                                       value="Create">Thêm</a>
                                </div>
                                <BR/>
                            </div>
                            <br/>

                            <div class="chitietcc">
                                <div class="content-content">
                                    <h4 style="text-align: center;color:white;background-image: linear-gradient(to top, #83abda, rgb(22, 53, 138));">
                                        Chi Tiết Thuốc</h4>
                                    <table id="tb_ctcc" class="table table-hover tm-table-small ">
                                        <tr>
                                            <th scope="col">&nbsp;</th>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên thuốc</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>

                                    </table>
                                </div>

                            </div>
                            <br>
                            <hr>


                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="col-xs-6 form-group">

                                        <input type="checkbox" id="price_public"  name="price_public" style="width: min-content"
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
                                <div class="form-group col-md-4">
                                    <div class="col-xs-6 form-group">

                                        <input type="checkbox" id="ECG"  name="ECG" style="width: min-content"
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
                                <div class="form-group col-md-4">
                                    <div class="col-xs-6 form-group">

                                        <input type="checkbox" id="blood_sugar"  name="blood_sugar" style="width: min-content"
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
                            </div>
                            <hr>
                            <div class="event_ ">
                                <a href="{{ route('admin.medical-examinations.index') }}"
                                   class="btn btn-secondary">{{ __('general.back') }}</a>
                                <button class="btn btn-danger">{{ __('general.save') }}</button>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation')

                // Loop over them and prevent submission
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            }, false)
        }())
    </script>



    <script>
        $(document).ready(function (){
            $('.js-example-basic-single').select2();

            $('#price_public').change(function (){
                $(this).val(this.checked ? "TRUE" : "FALSE");
            })

            $('#ECG').change(function (){
                $(this).val(this.checked ? "TRUE" : "FALSE");
            })
            $('#blood_sugar').change(function (){
                $(this).val(this.checked ? "TRUE" : "FALSE");
            })
        });

        function selectNamedomain(obj) {
            var data_price_medicine= $(obj).find(':selected').data('price_medicine');
            var price = document.getElementById('price');
            price.value = data_price_medicine;

            $('#name_medicine').on('change', function () {
                var quantity = $('#amount_medicine').val();
                // console.log(data_price_medicine)
                tien = parseInt(data_price_medicine) * parseInt(quantity);
                total_price.value = tien;
                calculatorTotal();
            });
            $('#amount_medicine').keyup(function () {
                var quantity = $('#amount_medicine').val();
                tien = parseInt(data_price_medicine) * parseInt(quantity);
                total_price.value = tien;
                calculatorTotal();
            });


            var data_id_medicine = $(obj).find(':selected').data('id_medicine');
            var id_medicine = document.getElementById('id_medicine');
            id_medicine.value = data_id_medicine;
        }


        function calculatorTotal() {
            let price_vps = $('#total_price').val();
            let total_all = parseInt(price_vps)
            $('#total_price').val(total_all);
            $('#total_price').text(total_all);

        }

        function fomat_curent_VND(number) {
            var formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            })
            var currentcy = formatter.format(number);
            return currentcy;
        }




        var list_cc = [];
        var i=1;
        $('#btcc').click(function () {
            let chungchi = {
                id: i,
                id_medicine:$('#id_medicine').val(),
                namemedicine: $('#name_medicine').val(),
                amountmedicine: $('#amount_medicine').val(),
                price: $('#price').val(),
                totalprice: $('#total_price').val(),
            }
            list_cc.push(chungchi);
            message = "<tr><td><a class='remove' id =" + chungchi.id + "><i class='fa fa-trash'></i></a></td><td>" +
                "<input class='list_datescc' type='hidden' name='list_datecc[]' " +
                "value='" +chungchi.id + ","+chungchi.id_medicine+"," +chungchi.namemedicine + "," + chungchi.amountmedicine + "," + chungchi.price + ","+chungchi.totalprice+"'>"
                + chungchi.id + "</td><td>" + chungchi.namemedicine + "</td><td>" + chungchi.amountmedicine + "</td><td>" + chungchi.price + "</td><td>" + chungchi.totalprice + "</td></tr>";
            $('#tb_ctcc').append(message);
            i++;
        })
        $("#tb_ctcc").on("click", ".remove", function () {
            z = list_cc.findIndex(obj => obj.id == $(this).attr("id"));
            list_cc.splice(z, 1);
            $(this).closest("tr").remove();
        });
    </script>
@stop

