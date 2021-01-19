<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="check-all"></th>
            <th>{{ __('department.id') }}</th>
            <th>{{ __('department.name') }}</th>
            <th>{{ __('department.description') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($departments as $item => $department)
            <tr>
                <td><input type="checkbox" class="btn-check" value="{{ $department->id }}"></td>
                <td>{{ $departments->firstItem() + $item }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description }}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $department->id }}">
                        {{ __('general.view') }}
                    </button>
                    <div class="modal fade" id="viewModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('department.department') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td>{{ __('department.name') }}</td>
                                            <td>{{ $department->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('department.code') }}</td>
                                            <td>{{ $department->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('department.description') }}</td>
                                            <td>{{ $department->desciption }}</td>
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
                    @can('staff-update')
                        <a class="btn btn-xs btn-success" href="{{ route('admin.departments.create').'?id='.$department->id }}" role="button">{{ __('general.update') }}</a>
                    @endcan
                    @can('staff-delete')
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $department->id }}">
                            {{ __('general.delete') }}
                        </button>
                        <form action="{{ route('admin.departments.destroy') }}" method="POST">
                            @csrf
                            <div class="modal fade" id="deleteItemModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('department.department') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="id" value="{{ $department->id }}" style="display: none">
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
                <td style="text-align: center" colspan="5">{{ __('general.nodata') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="clearfix">
    <div style="float: right">
        {!! $departments->links() !!}
    </div>
</div>
