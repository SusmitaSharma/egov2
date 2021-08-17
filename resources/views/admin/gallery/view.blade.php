
@extends('admin.layouts.app')
@section('title','ग्यालरी')
@push('style')
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

<link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">

@endpush
@section('content')
   @include('admin.elements.back_to_home')

<section class="content">
    <div class="row">
        <div class="col-xs-12">

{!! success_or_failure_message() !!}

{!! validation_error_message($errors) !!}
<div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-3">
                        <h3 class="box-title">फाेटाे एेलिबम</h3>
                       </div>
              
                  </div>
                  <hr/>

                  <div class="row">

                     <form action="{{$edit? route('gallery.update',$model):route('gallery.store')}}" method="post" id="gallery_form">
                    @csrf;
                    @if($edit)
                    @method('put')
                    @endif
                        <div class="col-md-4 col-md-offset-1">
                        
                             <input class="form-control" placeholder="Photo Album" name="name" type="text" value="{{$edit? $model->name:old('name')}}">
                      
                        </div>


                        <div class="col-md-4">
                          <button class="btn btn-success">{{$edit? 'सुरक्षाित गर्नुहोस':'नयाँ थप्नुहाेस'}}</button>

                          @if($edit)

                           <a href="{{route('gallery.index')}}" class="btn btn-default">Cancel</a>
                           @endif
                          
                        </div>
                      </form>

                     
                  
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>क्र॰सं॰</th>
                        <th>एेलिवम शिर्षक</th>
                        <th> दर्ता मिति</th>
                        <th>कार्य</th>
                      </tr>
                    </thead>
                    <tbody>

                       @foreach($galleries as $k=>$v)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$v->name}}</td>
                        <td>{{$v->created_at->format('Y-m-d')}}</td>
                       
                        <td>
                          <a href="{{route('gallery.edit',$v)}}" class="btn-edit btn-xs btn btn-primary" itle="Edit"><i class="fa fa-edit"></i></a>

                          <a href="javascript:void(0)"  onClick="if(confirm('Are you sure want to delete?'))
                          {document.getElementById('delete-form-{{$v->id}}').submit();}else{event.preventDefault();}"  title="Delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                           <form id="delete-form-{{$v->id}}" action="{{route('gallery.destroy',$v->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                                               
                            </form>
                  
                        </td>
                      </tr>
                      @endforeach
                     
                      
                      
                   
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->


</div>
</div>





</section>


@endsection
@push('scripts')
<script>
	

    $(document).ready(function(){
        $('#example2').DataTable({
         
        });
       $('#gallery_form').validate({
            rules:{
                
                   
              name:{
                    required:true,

                },
               
            }

        });




    })
    
         
   




     
   
</script>
@endpush
