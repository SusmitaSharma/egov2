@if($datas->count())
    @foreach($datas as $k=>$v)
    <tr>
                <td>{{$k+1}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->created_at->format('Y-m-d')}}</td>
               
                <td data-no-print="" class="btn-group-xs">
                    <a href="javascript:;" class="btn-edit btn-xs btn btn-primary" data-title="सम्पादन : कन्टेन्जेन्सी कट्टी" data-id="{{$v->id}}" data-url="{{route('designation.edit',$v->id)}}" data-url2="{{route('designation.update',$v->id)}}"><i class="fa fa-edit"></i></a>
                    <a href="javascript:;" class="btn-delete btn btn-xs btn-danger" data-id="{{ $v->id }}"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No data</td>
    </tr>

@endif

<input type="hidden" id="totalData" value="{{ $totalData }}">
