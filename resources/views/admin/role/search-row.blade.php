<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="check-all"></th>
            <th>{{ __('role.id') }}</th>
            <th style="min-width: 100px">{{ __('role.role') }}</th>
            <th>{{ __('role.permission') }}</th>
            <th style="min-width: 200px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $item => $role)
            <tr>
                <td><input type="checkbox" class="btn-check" value="{{ $role->id }}"></td>
                <td>{{ $roles->firstItem() + $item }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @php /** @var TYPE_NAME $role */
                                            $permissions = \App\Models\PermissionRole::where('role_id', '=', $role->id)->get();
                    @endphp
                    @foreach($permissions as $permission)
                        <span class="badge badge-info">{{ \App\Models\Permission::find($permission->permission_id)->name }}</span>
                    @endforeach
                </td>
                <td>
                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $role->id }}">
                        {{ __('general.view') }}
                    </button>

                    <div class="modal fade" id="viewModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('role.role') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th style="min-width: 100px">{{ __('role.role') }}</th>
                                            <th>{{ __('role.permission') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @php /** @var TYPE_NAME $role */
                                                                        $permissions = \App\Models\PermissionRole::where('role_id', '=', $role->id)->get();
                                                @endphp
                                                @foreach($permissions as $permission)
                                                    <span class="badge badge-info">{{ \App\Models\Permission::find($permission->permission_id)->name }}</span>
                                                @endforeach
                                            </td>
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
                    <a class="btn btn-xs btn-success" href="{{ route('admin.roles.create').'?id='.$role->id }}" role="button">{{ __('general.update') }}</a>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $role->id }}">
                        {{ __('general.delete') }}
                    </button>

                    <form action="{{ route('admin.roles.destroy') }}" method="POST">
                        @csrf
                        <div class="modal fade" id="deleteItemModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('role.role') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="id" value="{{ $role->id }}" style="display: none">
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
        {!! $roles->links() !!}
    </div>
</div>
