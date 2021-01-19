<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="check-all"></th>
            <th>{{ __('permission.id') }}</th>
            <th>{{ __('permission.screen') }}</th>
            <th>{{ __('permission.permission') }}</th>
            <th>{{__('permission.description') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($permissions as $item => $permission)
            <tr>
                <td><input type="checkbox" class="btn-check" value="{{ $permission->id }}"></td>
                <td>{{ $permissions->firstItem() + $item }}</td>
                <td>{{ $permission->feature }}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-primary">{{ $permission->permission_type }}</button>
                </td>
                <td>{{ $permission->description }}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $permission->id }}">
                        {{ __('general.view') }}
                    </button>
                    <div class="modal fade" id="viewModal{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('permission.permission') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{ __('permission.name') }}</th>
                                            <th>{{__('permission.description') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->description }}</td>
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
                    @can('permission-update')
                        <a class="btn btn-xs btn-success" href="{{ route('admin.permissions.create').'?id='.$permission->id }}" role="button">{{ __('general.update') }}</a>
                    @endcan
                    @can('permission-delete')
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $permission->id }}">
                            {{ __('general.delete') }}
                        </button>
                        <form action="{{ route('admin.permissions.destroy') }}" method="POST">
                            @csrf
                            <div class="modal fade" id="deleteItemModal{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('permission.permission') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="id" value="{{ $permission->id }}" style="display: none">
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
        </tbody>
    </table>
</div>
<div class="clearfix">
    <div style="float: right">
        {!! $permissions->links() !!}
    </div>
</div>
