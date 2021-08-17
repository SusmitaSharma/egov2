@extends('admin.layouts.app')
@section('title','Notification')
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
                  <h3 class="box-title">सूचना</h3>
              </div>
              <div class="col-md-9 pull-right">
               <div class="box-tools pull-right">
                        <a href="{{route('notification.create')}}" class="btn btn-success btn-new" data-title="नयाँ बनाउने" data-col-width="Medium"><i class="fa fa-plus"></i></a>

                    </div>

              </div>
              </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>क्र॰सं॰</th>
                        <th>शिर्षक</th>
                          <th>Photo</th>
                          <th>कार्य</th>
                          <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($notifications as $k=>$v)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$v->title}}</td>
                          <td><img src="{{$v->image()}}" style="width:120px"></td>
                        <td>
                          <a href="{{route('notification.edit',$v)}}" class="btn-edit btn-xs btn btn-primary" data-title="सम्पादन : नेपाल सरकार"><i class="fa fa-edit"></i></a>
                          <a href="javascript:void(0)"  onClick="if(confirm('Are you sure want to delete?'))
                          {document.getElementById('delete-form-{{$v->id}}').submit();}else{event.preventDefault();}"  title="Delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                           <form id="delete-form-{{$v->id}}" action="{{route('notification.destroy',$v->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}

                            </form>
                        </td>
                          <td>
                              @if($v->status == 0)
                                  <button type="button" class="delete btn btn-xs btn-outline-success"
                                          id="changeStatus"
                                          data-id={{$v->id}}>
                                      ActivateStatus
                                  </button>
                              @else
                                  <button type="button" class="delete btn btn-xs btn-danger"
                                          id="changeStatus"
                                          data-id={{$v->id}}>
                                      DeactivateStatus
                                  </button>
                              @endif
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
            $('#example1').DataTable({

            });



        })

        $(document).ready(function () {
            $(document).on('click', '#changeStatus', function () {
                let modalId = $(this).attr("data-id")
                let url = '{{route('modal.status',123)}}'
                url = url.replace(123, modalId)
                $.ajax({

                    type: "GET",

                    dataType: "json",

                    url: url,

                    data: {'status': status, 'id': modalId},

                    success: function(data){

                        console.log(data.success)
                        location.reload();

                    }

                });
            })
        })
    </script>
@endpush
