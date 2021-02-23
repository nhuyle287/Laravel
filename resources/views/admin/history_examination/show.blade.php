@extends('layouts.master')
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
                   <table class="table table-bordered table-striped">
                       <tr>
                           <th>Khách hàng</th>
                           <td>{{ $register_medicines->name }}</td>
                           <th>Ngày khám</th>
                           <td>{{ $register_medicines->date_examination }}</td>
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
                       <tr>

                       </tr>
                   </table>
                   <br/>
                   <table class="table table-bordered table-striped">
                       @if(count($medicines)>0)
                           @foreach($medicines as $me)
                               <tr>
                                   <th>Thuốc</th>

                                   <th>Giá</th>

                                   <th>Số lượng</th>

                                   <th>Thành tiền</th>

                               </tr>
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
