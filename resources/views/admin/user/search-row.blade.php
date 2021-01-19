<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="check-all"></th>
            <th>{{ __('user.id') }}</th>
            <th style="min-width: 100px">{{ __('user.name') }}</th>
            <th>{{ __('user.email') }}</th>
            <th style="min-width: 200px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $item => $user)
            <tr>
                <td><input type="checkbox" class="btn-check" value="{{ $user->id }}"></td>
                <td>{{ $users->firstItem() + $item }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $user->id }}">
                        {{ __('general.view') }}
                    </button>

                    <div class="modal fade" id="viewModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('user.account') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{ __('user.name') }}</th>
                                            <th>{{ __('user.email') }}</th>
                                            <th>{{ __('user.password') }}</th>
                                            <th>{{ __('user.role') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>********</td>
                                            <td>{{ $user->role_name }}</td>
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
                    <a class="btn btn-xs btn-success" href="{{ route('admin.users.create').'?id='.$user->id }}" role="button">{{ __('general.update') }}</a>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $user->id }}">
                        {{ __('general.delete') }}
                    </button>

                    <form action="{{ route('admin.users.destroy') }}" method="POST">
                        @csrf
                        <div class="modal fade" id="deleteItemModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('user.account') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="id" value="{{ $user->id }}" style="display: none">
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
        {!! $users->links() !!}
    </div>
</div>
