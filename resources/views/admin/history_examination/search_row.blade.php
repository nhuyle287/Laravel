@forelse($register_medicines as $register_medicine)
    <tr>
        <td class="thstyleform"><input type="checkbox" class="btn-check"
                                       value="{{ $register_medicine->id }}"></td>
        <td class="thstyleform">{{$register_medicine->id}}</td>
        <td class="thstyleform">{{$register_medicine->name}}
        </td>


        <td class="thstyleform">
            <a href="{{route("admin.history-examinations.show",$register_medicine->id)}}" class="btn btn-xs btn-info"                                                    >
                {{ __('general.view') }}
            </a>



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

