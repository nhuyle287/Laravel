@extends('layouts.master')
@section('title')
    Phiếu chi
@stop
@section('head')
    <link rel="stylesheet" href="{{ asset('../css/responsive.css') }}">
@stop
@section('content')

    <section class="body-content">
        <div class="card">

            <div class="card-header card-header-new">
                {{__('expenditure.create')}}
            </div>
            <div class="card-body">
                <form action="{{route('admin.expenditure.store')}}" method="post"
                      class="needs-validation" novalidate enctype="multipart/form-data">
                    {{--                                <input type="hidden" name="id" value="{{isset($domain->id) ? $domain->id: ''}}">--}}
                    @csrf
                    <div class="row">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        @if(session('fail'))
                            <div class="alert alert-danger">
                                {{session('fail')}}
                            </div>
                        @endif
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-row">


                            </div>
                            {{-- ví dụ nha--}}
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <input id="" type="hidden"
                                           class="form-control" name="id" required

                                           value="{{isset($expenditures->id) ? old('id', $expenditures->id) : old('id')}}">

                                    <!--Top Table UI-->
                                    <div class="table-ui p-2 mb-3 mx-3 mb-4">

                                        <!--Grid row-->
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <div class="col-xs-12 form-group">
                                                    <label>Người nhận <label class="content-required">*</label></label>
                                                    <input id="price" type="text"
                                                           class="form-control" name="receiver" required

                                                           value="{{isset($expenditures->receiver) ? old('receiver', $expenditures->receiver) : old('receiver')}}">
                                                    <p class="help-block text-danger"></p>
                                                    <div class="invalid-feedback">
                                                        Người nhận không được trống.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="col-xs-12 form-group">
                                                    <label>Địa chỉ <label class="content-required">*</label></label>
                                                    <input id="price" type="text"
                                                           class="form-control" name="address_receiver"
                                                           required

                                                           value="{{isset($expenditures->address_receiver) ? old('address_receiver', $expenditures->address_receiver) : old('address_receiver')}}">
                                                    <p class="help-block text-danger"></p>
                                                    <div class="invalid-feedback">
                                                        Địa chỉ không được trống.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <div class="col-xs-12 form-group">
                                                    <label>Phí chi <label class="content-required">*</label></label>
                                                    <input id="price" type="number"
                                                           class="form-control" name="price" required

                                                           value="{{isset($expenditures->price) ? old('price', $expenditures->price) : old('price')}}">
                                                    <p class="help-block text-danger"></p>
                                                    <div class="invalid-feedback">
                                                        Phí chi không được trống.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">

                                                <div class="col-xs-12 form-group">
                                                    <label>Lí do chi <label class="content-required">*</label></label>
                                                    <textarea rows="5" id="receipt_type" type="text"
                                                              class="form-control"
                                                              name="description" required
                                                    >{{isset($expenditures->description) ? old('description', $expenditures->description) : old('description')}}</textarea>
                                                    <p class="help-block text-danger"></p>
                                                    <div class="invalid-feedback">
                                                        Lí do không được trống.
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>
                            <!--/.Accordion wrapper-->

                            <hr>
                            <div class="event_">
                                <a style="margin-right: 5px" href="{{ route('admin.expenditure.index') }}"
                                   class="btn btn-default">{{ __('general.back') }}</a>
                                <button type="submit" id="submit"
                                        class="btn btn-danger">{{ __('general.save') }}</button>

                            </div>

                            {{--                                        <a href="{{ route('admin.invoices.receiptsstore') }}"--}}
                            {{--                                           class="btn btn-default">{{ __('general.back') }}</a>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
@stop



@section('javascript')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script>
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

        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            // $("#start_date").datepicker({
            //     format: 'dd-mm-yyyy ',
            //     autoclose: true,
            // }).on('changeDate', function (selected) {
            //     var minDate = new Date(selected.date.valueOf());
            //     $('#end_date').datepicker('setStartDate', minDate);
            // });
            //
            // $("#end_date").datepicker({
            //     format: 'dd-mm-yyyy',
            //     autoclose: true,
            // }).on('changeDate', function (selected) {
            //     var minDate = new Date(selected.date.valueOf());
            //     $('#start_date').datepicker('setEndDate', minDate);
            // });

            $('.js-example-basic-single').select2();


        })


    </script>
@stop






