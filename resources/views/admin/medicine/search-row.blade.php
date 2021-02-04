
@forelse($medicines as $item => $medicine)
    <tr>
        <td><input type="checkbox" class="btn-check" value="{{ $medicine->id }}"></td>
        <td>{{ $medicine->id }}</td>
        <td>{{ $medicine->name }}</td>
        <td class="test">{{ $medicine->producer }}</td>
               <td class="test">
            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $medicine->id }}">
                {{ __('general.view') }}
            </button>
            <div class="modal fade" id="viewModal{{ $medicine->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('medicine.medicine') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td>{{ __('medicine.name') }}</td>
                                    <td>{{ $medicine->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('medicine.producer') }}</td>
                                    <td>{{ $medicine->producer }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('medicine.price') }}</td>
                                    <td>{{ $medicine->price }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('medicine.purchase_price') }}</td>
                                    <td>{{ $medicine->purchase_price }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('general.close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            @can('medicine-update')
                <a href="{{ route('admin.medicines.create').'?id='.$medicine->id }}"
                   class="btn  btn-success btn-xs">{{ __('general.edit') }}</a>
            @endcan
            @can('medicine-delete')
                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $medicine->id }}">
                    {{ __('general.delete') }}
                </button>
                <form action="{{ route('admin.medicines.destroy') }}" method="POST">
                    @csrf
                    <div class="modal fade" id="deleteItemModal{{ $medicine->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('medicine.medicine') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="id" value="{{ $medicine->id }}" style="display: none">
                                    <p>{{ __('general.confirm_delete') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('general.close') }}</button>
                                    <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
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
        <td style="text-align: center" colspan="6">{{ __('general.nodata') }}</td>
    </tr>
@endforelse
<tr>
    <td colspan="6" align="right">
        <div class="float-right">
            {!! $medicines->links() !!}
        </div>
    </td>
</tr>
