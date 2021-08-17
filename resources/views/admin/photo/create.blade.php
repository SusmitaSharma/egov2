
@extends('admin.layouts.app')
@section('title','नयाँ कर्मचारी दर्ता फारम')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/fileinput.css')}}">
<style type="text/css">
.box-solid,.box-footer{
    transition: box-shadow .3s;
}
.box-solid:hover{
    box-shadow: 0 0 11px rgba(33,33,33,.2);
}
.box-footer:hover{
    box-shadow: 0 0 11px rgba(35,35,33,.2);

}
</style>
@endpush
@section('content')
   @include('admin.elements.back_to_home')

<section class="content">

{!! success_or_failure_message() !!}

{!! validation_error_message($errors) !!}

<form action="{{$edit? route('photo.update',$model->id):route('photo.store')}}" class="form-horizontal"  method="post" id="userForm" enctype="multipart/form-data">
@csrf
@if($edit)
@method('PUT')
@endif

 <div class="box box-solid">
        <div class="box-body">

            <div class="row">
                <div class="col-md-8">

                      <div class="row">
                        <label class="col-md-3" for="Designation">फाेटाे एेलिवम छान्नुहाेस *</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-pagelines "></i>
                            </span>
                            <select class="form-control" name="gallery_id" required="true">
                                <option value="" selected="true">---एेलिवम---</option>
                                @foreach($galleries as $v)
                                <option 
                                value="{{$v->id}}"
                                {{$edit && $model->gallery_id==$v->id? 'selected':''}}

                                    >{{$v->name}}</option>

                                @endforeach
                            </select>
                            
                        </div>

                        </div>
                    </div>
                    <br>

                    <div class="row">
                    	 <label class="col-md-3" for="Designation">फाेटाे छान्नुहाेस *</label>
                    	
                    	 	<div class="col-md-9">

                    	 		<input type="checkbox" name="checkbox" id="url" value="1" {{$edit && $model->url!==null? 'checked':''}} > <span style="padding: 5px"><b>Use Image URL</b></span>
                    	 		<div id="image">
                    	 			@if(!$edit)
    							 <input id="input" name="images[]" type="file" multiple>
    							 @else
    							  <input id="input" name="image" type="file" >
								<div style="margin-top: 10px">

    								<img src="{{$model->image()}}" class="img-thumbnail">
    							</div>
    							
    							 @endif
    							</div>
    							<div id="text" style="display: none">
    								<input type="text" class="form-control" name="url" placeholder="Image url here.." value="{{$edit? $model->url:''}}">
    							</div>

    							
								
                    	 		
                    	 	</div>
                    	
                    	
                    </div>
               
             


               
                    </div>

                 
                    </div>

                    </div>
                 </div>
          

            <div class="row">
        <div class="col-md-12">
            <div class="box box-footer" style="margin-top:-10; border-top: 1px solid #c1c1c1">
                <button type="submit" class="btn btn-success">{{$edit? 'Update':'Save'}}</button>
                <a href="{{route('photo.index')}}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
        </div>
    </div>
    
</form>
</section>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('js/fileinput.js')}}"></script>

<script type="text/javascript">
	 $("#input").fileinput();

	 if($('#url').is(':checked'))
	 {
	 	    $('#text').css('display','block');
	 		$('#image').css('display','none');
	 }

	 $('#url').on('click',function(){
	 	if($(this).is(':checked'))
	 	{
	 		$('#text').css('display','block');
	 		$('#image').css('display','none');
	 	
	 	}else{
	 		$('#text').css('display','none');
	 		$('#image').css('display','block');

	 	}

	 });
	


</script>


@endpush
