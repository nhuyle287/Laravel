@extends('layouts.master')
@section('title')
    Dashboard
@stop
@section('head')
    <link rel="stylesheet" href="css/home.css">

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
                    Thống kê
                </div>
                <div class="event">
                    <button id="day" class="btn sm-btn btn-default">Ngày</button>
                    <button id="month" class="btn sm-btn btn-default">Tháng</button>
                    <button id="year" class="btn sm-btn btn-default">Năm</button>
                </div>
                <div id="chart">
                    <canvas id="barChart"></canvas>
                </div>
            </div>


            <script>
                var day = <?php echo $day; ?>;
                let price_day = <?php echo $price_day; ?>;
                let price_day_expenditure = <?php echo $price_day_expenditure; ?>;
                var month = <?php echo $month; ?>;

                var price = <?php echo $price; ?>;
                let price_expenditure = <?php echo $price_expenditure; ?>;
                var year_ = <?php echo $year; ?>;
                let price_year_expenditure = <?php echo $price_year_expenditure; ?>;
                var price_year = <?php echo $price_year; ?>;

                var barChartDataDay = {
                    labels: day,
                    datasets: [{
                        label: "Thu",
                        backgroundColor: "pink",
                        borderColor: "red",
                        borderWidth: 1,
                        data: price_day
                    },
                        {
                            label: "Chi",
                            backgroundColor: "lightblue",
                            borderColor: "blue",
                            borderWidth: 1,
                            data: price_day_expenditure
                        },]
                };


               let  year_list = [];
                for (i = 0; i < year_.length; i++) {
                    year_list.push(year_[i].year);
                }

                var barChartDataYear = {
                    labels: year_list,
                    datasets: [{
                        label: "Thu",
                        backgroundColor: "pink",
                        borderColor: "red",
                        borderWidth: 1,
                        data: price_year
                    },
                        {
                            label: "Chi",
                            backgroundColor: "lightblue",
                            borderColor: "blue",
                            borderWidth: 1,
                            data: price_year_expenditure
                        },]
                };


                var barChartData = {
                    labels: month,
                    datasets: [
                        {
                            label: "Thu",
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: price
                        },
                        {
                            label: "Chi",
                            backgroundColor: "lightblue",
                            borderColor: "blue",
                            borderWidth: 1,
                            data: price_expenditure
                        },

                    ]
                };

                var chartOptions = {
                    responsive: true,
                    legend: {
                        position: "top"
                    },
                    title: {
                        display: true,
                        text: "Thống kê doanh thu"
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
                $(document).ready(function () {
                    $('#year').on('click', function () {
                        var ctx = document.getElementById("barChart").getContext("2d");
                        window.myBar = new Chart(ctx, {
                            // type: 'horizontalBar',
                            type: 'bar',
                            data: barChartDataYear,
                            options: chartOptions
                        });
                    });
                    $('#day').on('click', function () {
                        var ctx = document.getElementById("barChart").getContext("2d");
                        window.myBar = new Chart(ctx, {
                            // type: 'horizontalBar',
                            type: 'bar',
                            data: barChartDataDay,
                            options: chartOptions
                        });
                    });


                    $('#month').on('click', function () {
                        var ctx = document.getElementById("barChart").getContext("2d");
                        window.myBar = new Chart(ctx, {
                            // type: 'horizontalBar',
                            // type: 'bar',
                            // data: barChartData,
                            // options: {
                            //     elements: {
                            //         rectangle: {
                            //             borderWidth: 2,
                            //             borderColor: '#c1c1c1',
                            //             borderSkipped: 'bottom'
                            //         }
                            //     },
                            //     responsive: true,
                            //     title: {
                            //         display: true,
                            //         text: 'Doanh thu theo tháng'
                            //     }
                            // }
                            type: "bar",
                            data: barChartData,
                            options: chartOptions
                        })
                    });
                })
                window.onload = function () {

                    var ctx = document.getElementById("barChart").getContext("2d");
                    window.myBar = new Chart(ctx, {
                        // type: 'horizontalBar',
                        type: 'bar',
                        data: barChartDataDay,
                        options: chartOptions
                        // options: {
                        //     elements: {
                        //         rectangle: {
                        //             borderWidth: 2,
                        //             borderColor: '#c1c1c1',
                        //             borderSkipped: 'bottom'
                        //         }
                        //     },
                        //     responsive: true,
                        //     title: {
                        //         display: true,
                        //         text: 'Doanh thu theo tháng'
                        //     }
                        // }
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
