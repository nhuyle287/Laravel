@forelse($register_medicines as $register_medicine)
    <tr>
        <td class="thstyleform"><input type="checkbox" class="btn-check"
                                       value="{{ $register_medicine->id }}"></td>
        <td class="thstyleform">{{$register_medicine->id}}</td>
        <td class="thstyleform">{{$register_medicine->name}}
        </td>


        <td class="thstyleform">
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                    data-target="#viewModal{{ $register_medicine->id }}">
                {{ __('general.view') }}
            </button>
            <div class="modal fade" id="viewModal{{ $register_medicine->id }}"
                 tabindex="-1"
                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
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
                            <table
                                class="table table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td>STT</td>
                                    <td>{{ $register_medicine->id }}</td>
                                </tr>
                                <tr>
                                    <td>Khách hàng</td>
                                    <td>{{$register_medicine->name}}
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('general.close') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            @can('list-medicine-update')
                @if($register_medicine->status === 0)
                    <button id="btnStatus" type="button" class="btn btn-sm btn-default"
                            data-id="{{$register_medicine->id}}"
                            data-transaction="{{$register_medicine->status}}"
                            data-toggle="modal"
                            data-target="#myModal"> {{ucfirst(array_search($register_medicine->status,$status))}}</button>
                @endif
                @if($register_medicine->status === 1)
                    <button id="btnStatus" type="button" class="btn btn-sm btn-secondary"
                            data-id="{{$register_medicine->id}}"
                            data-transaction="{{$register_medicine->status}}"
                            > {{ucfirst(array_search($register_medicine->status,$status))}}</button>
                @endif
                @if($register_medicine->status === 2)
                    <button id="btnStatus" type="button" class="btn btn-sm btn-danger"
                            data-id="{{$register_medicine->id}}"
                            data-transaction="{{$register_medicine->status}}"
                           > {{ucfirst(array_search($register_medicine->status,$status))}}</button>
                @endif


            @endcan
        </td>

    </tr>
@empty
    <tr>
        <td style="text-align: center" colspan="4">{{ __('general.nodata') }}</td>
    </tr>
@endforelse
<tr>
    <td colspan="5" align="right">
        <div class="float-right">
            {!! $register_medicines->links() !!}
        </div>
    </td>
</tr>
{{--cập nhật tình trạng --}}
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật trạng thái</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('admin.register-medicines.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">

                        <select
                            class="form-control" name="status" id="transaction">
                            @foreach($status as $transaction)
                                <option value="" selected disabled hidden>Cập nhật giao
                                    dịch
                                </option>
                                <option value="{{$transaction}}">
                                    {{ucfirst(array_search($transaction,$status))}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                    </div>
                    <button style="background: green;color: white;" type="submit"
                            class="btn btn-default">Save
                    </button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
