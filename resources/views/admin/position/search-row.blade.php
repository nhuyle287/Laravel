<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 10px"><input type="checkbox" id="check-all"></th>
            <th>{{ __('position.id') }}</th>
            <th>{{ __('position.name') }}</th>
            <th>{{ __('position.description') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($positions as $item => $position)
            <tr>
                <td><input type="checkbox" class="btn-check" value="{{ $position->id }}"></td>
                <td>{{ $positions->firstItem() + $item }}</td>
                <td>{{ $position->name }}</td>
                <td>{{ $position->description }}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#viewModal{{ $position->id }}">
                        {{ __('general.view') }}
                    </button>

                    <div class="modal fade" id="viewModal{{ $position->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('position.name') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{ __('position.name') }}</th>
                                            <th>{{ __('position.description') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ $position->name }}</td>
                                            <td>{{ $position->description }}</td>
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
                    <a class="btn btn-xs btn-success" href="{{ route('admin.positions.create').'?id='.$position->id }}" role="button">{{ __('general.update') }}</a>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteItemModal{{ $position->id }}">
                        {{ __('general.delete') }}
                    </button>

                    <form action="{{ route('admin.positions.destroy') }}" method="POST">
                        @csrf
                        <div class="modal fade" id="deleteItemModal{{ $position->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('role.role') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="id" value="{{ $position->id }}" style="display: none">
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
        {!! $positions->links() !!}
    </div>
</div>
