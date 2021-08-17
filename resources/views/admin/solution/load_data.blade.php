
@if($datas->count())
    @foreach($datas as $k=>$i)
     @php   
        $status=$i->status==='pending'? 'Pending':'Already Viewed';

        @endphp
           <tr>
                <td>{{$k+1}}</td>
                <td>{{$i->name}}</td>
                <td>{{$i->mobile}}</td>
                <td>{{$i->email}}</td>
                <td>{{$status}}</td>
                <td>{{$i->created_at->format('Y-m-d')}}</td>
                <td data-no-print="" class="btn-group-xs">
                    <a href="javascript:;" class="btn-view btn-xs btn btn-primary" data-title="सम्पादन : नेपाल सरकार" data-url="{{route('feedback.getData',$i->id)}}"><i class="fa fa-eye"></i>View</a>
                    <a href="javascript:;" class="btn-delete btn btn-xs btn-danger" data-id="{{ $i->id }}"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No data</td>
    </tr>

@endif

<input type="hidden" id="totalData" value="{{ $totalData }}">