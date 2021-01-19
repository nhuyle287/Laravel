<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="check-all"></th>
            <th>{{ __('staff.id') }}</th>
            <th>{{ __('staff.name') }}</th>
            <th>{{ __('staff.position') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($staffs as $item => $staff)
            <tr>
                <td><input type="checkbox" class="btn-check" value="{{ $staff->id }}"></td>
                <td>{{ $staffs->firstItem() + $item }}</td>
                <td>{{ $staff->name }}</td>
                <td>{{ $staff->position_name }}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $staff->id }}">
                        {{ __('general.view') }}
                    </button>

                    <div class="modal fade" id="viewModal{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('staff.staff') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td>{{ __('staff.name') }}</td>
                                            <td>{{ $staff->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('staff.email') }}</td>
                                            <td>{{ $staff->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('staff.address') }}</td>
                                            <td>{{ $staff->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('staff.phone_number') }}</td>
                                            <td>{{ $staff->phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('staff.birthday') }}</td>
                                            <td>{{ date('d/m/Y', strtotime($staff->birthday)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('staff.salary') }}</td>
                                            <td>{{ $staff->salary }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('staff.position') }}</td>
                                            <td>{{ $staff->position_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('staff.start_time') }}</td>
                                            <td>{{ date('d/m/Y', strtotime($staff->start_time)) }}</td>
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
                    <a class="btn btn-xs btn-success" href="{{ route('admin.staffs.create').'?id='.$staff->id }}" role="button">{{ __('general.update') }}</a>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $staff->id }}">
                        {{ __('general.delete') }}
                    </button>

                    <form action="{{ route('admin.staffs.destroy') }}" method="POST">
                        @csrf
                        <div class="modal fade" id="deleteItemModal{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('role.role') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="id" value="{{ $staff->id }}" style="display: none">
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="clearfix">
    <div style="float: right">
        {!! $staffs->links() !!}
    </div>
</div>
