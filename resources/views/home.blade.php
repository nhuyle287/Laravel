@extends('layout.master')
@section('title')
    Dashboard
@stop
@section('css')
{{--    <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>--}}
{{--    <script src="http://www.chartjs.org/samples/latest/utils.js"></script>--}}
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
@stop
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
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
    <section class="content">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
