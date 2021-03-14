@forelse($register_medicines as $register_medicine)
    <tr>
        <td class="thstyleform"><input type="checkbox" class="btn-check"
                                       value="{{ $register_medicine->id }}"></td>
        <td class="thstyleform">{{$register_medicine->id}}</td>
        <td class="thstyleform">{{$register_medicine->name}}
        </td>


        <td class="thstyleform d-flex ">
            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" style="margin-right: 5px"
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
                                    <td>Mã khách hàng</td>
                                    <td>{{ $register_medicine->code }}</td>
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
                <form action="{{route('admin.medical-examinations.create', [$register_medicine->id])}}" method="get">
                    <input type="hidden" value="{{$register_medicine->customer_id}}" name="customer_id">
                    <button type="submit" class="btn  btn-secondary btn-xs">Khám</button>
                </form>
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

