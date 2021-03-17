@extends('layouts.master')
@section('title')
    Dashboard
@stop
@section('head')
    <link rel="stylesheet" href="css/login.css">
    {{--    <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>--}}
    {{--    <script src="http://www.chartjs.org/samples/latest/utils.js"></script>--}}
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }

        #month {
            margin-right: 0.5rem;
        }

        #chart {
            margin: 0.5rem 1.5rem;
            border: 1px solid #d2d0d0;
            border-radius: 5px;
            width: 500px;
            background-color: white;
            padding: 0.5rem;
            /*box-shadow: 5px 5px 8px #888888;*/

        }
        .chart{
            width: 550px;
            /*margin-top: 0.5rem;*/
            border: 1px solid #d2d0d0;
            border-radius: 5px;
            background-color: white;
            /*padding: 1rem;*/
            box-shadow: 5px 5px 8px #888888;
        }
        .title{
            display: block;
            padding: 0.5rem;
            text-align: center;
            background-image: linear-gradient(to top, #83abda, rgb(22, 53, 138));
            color: white;
            margin-bottom: 0.5rem;
        }
        #button{
            display: flex;
            justify-content: flex-end;
            margin-right: 0.5rem;
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
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text fadeIn first">Bệnh Nhân</span>
                            <span class="info-box-number fadeIn first" id="value">
                  {{$customer_count}}

                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-gray-dark elevation-1"><i class="fas fa-hand-holding-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text fadeIn first">Khám bệnh</span>
                            <span class="info-box-number fadeIn first" id="medical">{{$medical_examination}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>


                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- BAR CHART -->
           <div class="chart">
               <div class="title">
                   Thống kê doanh thu
               </div>
               <div id="button">
                   <button id="month" class="btn sm-btn btn-default">Tháng</button>
                   <button id="year" class="btn sm-btn btn-default">Năm</button>
               </div>
               <div id="chart">
                   <canvas id="barChart"></canvas>
               </div>
           </div>


            <script>
                var month = <?php echo $month; ?>;

                var price = <?php echo $price; ?>;

                var year_ = <?php echo $year; ?>;

                var price_year = <?php echo $price_year; ?>;

                year_list = [];
                for (i = 0; i < year_.length; i++) {
                    year_list.push(year_[i].year);
                }
                // console.log(year_[0].year)
                // console.log(year_list)
                var barChartData = {
                    labels: month,
                    datasets: [{
                        label: 'Tháng',
                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)"],
                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)", "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)"],
                        "borderWidth": 1,
                        data: price
                    }]
                };
                var barChartDataYear = {
                    labels: year_list,
                    datasets: [{
                        label: 'Năm',
                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)"],
                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)", "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)"],
                        "borderWidth": 1,
                        data: price_year
                    }]
                };
                $(document).ready(function () {
                    $('#year').on('click', function () {
                        var ctx = document.getElementById("barChart").getContext("2d");
                        window.myBar = new Chart(ctx, {
                            // type: 'horizontalBar',
                            type: 'bar',
                            data: barChartDataYear,
                            options: {
                                elements: {
                                    rectangle: {
                                        borderWidth: 2,
                                        borderColor: '#c1c1c1',
                                        borderSkipped: 'bottom'
                                    }
                                },
                                responsive: true,
                                title: {
                                    display: true,
                                    text: 'Doanh thu theo năm'
                                }
                            }
                        });
                    });
                    $('#month').on('click', function () {
                        var ctx = document.getElementById("barChart").getContext("2d");
                        window.myBar = new Chart(ctx, {
                            // type: 'horizontalBar',
                            type: 'bar',
                            data: barChartData,
                            options: {
                                elements: {
                                    rectangle: {
                                        borderWidth: 2,
                                        borderColor: '#c1c1c1',
                                        borderSkipped: 'bottom'
                                    }
                                },
                                responsive: true,
                                title: {
                                    display: true,
                                    text: 'Doanh thu theo tháng'
                                }
                            }
                        })
                    });
                })


                window.onload = function () {

                    var ctx = document.getElementById("barChart").getContext("2d");
                    window.myBar = new Chart(ctx, {
                        // type: 'horizontalBar',
                        type: 'bar',
                        data: barChartData,
                        options: {
                            elements: {
                                rectangle: {
                                    borderWidth: 2,
                                    borderColor: '#c1c1c1',
                                    borderSkipped: 'bottom'
                                }
                            },
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Doanh thu theo tháng'
                            }
                        }
                    });
                };


                function animateValue(obj, start = 0, end = null, duration = 1000) {
                    if (obj) {

                        // save starting text for later (and as a fallback text if JS not running and/or google)
                        var textStarting = obj.innerHTML;

                        // remove non-numeric from starting text if not specified
                        end = end || parseInt(textStarting.replace(/\D/g, ""));

                        var range = end - start;

                        // no timer shorter than 50ms (not really visible any way)
                        var minTimer = 50;

                        // calc step time to show all interediate values
                        var stepTime = Math.abs(Math.floor(duration / range));

                        // never go below minTimer
                        stepTime = Math.max(stepTime, minTimer);

                        // get current time and calculate desired end time
                        var startTime = new Date().getTime();
                        var endTime = startTime + duration;
                        var timer;

                        function run() {
                            var now = new Date().getTime();
                            var remaining = Math.max((endTime - now) / duration, 0);
                            var value = Math.round(end - (remaining * range));
                            // replace numeric digits only in the original string
                            obj.innerHTML = textStarting.replace(/([0-9]+)/g, value);
                            if (value == end) {
                                clearInterval(timer);
                            }
                        }

                        timer = setInterval(run, stepTime);
                        run();
                    }
                }

                animateValue(document.getElementById('value'));

                animateValue(document.getElementById('medical'));
            </script>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
