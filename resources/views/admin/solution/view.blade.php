@extends('admin.layouts.app')
@section('title','Feedback')

@push('style')
<style type="text/css">
.box,{
    transition: box-shadow .3s;
}
.box:hover{
    box-shadow: 0 0 11px rgba(33,33,33,.2);
}

</style>
@endpush


@section('content')
   @include('admin.elements.back_to_home')


    <!-- Main content -->
    <section class="content">
    {!! success_or_failure_message() !!}
    <div class="row">
    <div class="col-md-12">
        <div class="box box-primary" parent-section="">
            <div class="box-header">
                <form class="form-inline" id="searchForm">
                    <div class="pull-left">
                        <div class="form-group">
                            <input class="form-control col-sm-3" id="name" name="name" placeholder="Name to search" style="width: 200px;" type="text" value="">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="search" class="btn btn-success btnSearch" value="खोजी">
                        </div>
                    </div>
                    <div class="box-tools pull-right">
                       <!--  <button type="button" class="btn btn-success btn-new" data-title="नयाँ बनाउने" data-col-width="Medium"><i class="fa fa-plus"></i></button> -->
                        
                    </div>
                </form>
            </div>
            <br>
            <div class="box-body detail" child-section="">
<div class="table-responsive">
    <table class="table table-bordered" id="solutionTable">
        <thead>
            <tr class="bg-primary">
                <th style="width: 10px">सि.नं.</th>
                <th>नाम</th>
                <th>सम्पर्क नम्बर</th>
                <th>इमेल</th>
                <th>स्थिति</th>
                <th>दर्ता मिति</th>
                <th style="width: 120px">कार्य</th>
            </tr>
        </thead>
        <tbody>
        @foreach($feedbacks as $k=>$i)
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
                
                    </tbody>
    </table>

    <div class="pagination"
        data-total-count="{{ $feedbacks->total() }}"
        data-take="2">
    </div>
</div>
</div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
@include('admin.solution.modal')

       
    </section>
 
    <!-- /.content -->
@endsection
@push('scripts')
<script>
    $(function () {

        //view modal

        $(document).on('click','.btn-view',function(){
            let url=$(this).data('url');


        $.get(url,function(data){
                let feedback=data.data;
                console.log(feedback)

                $("#solutionModal #name").val(feedback.name);
                $("#solutionModal #number").val(feedback.mobile);
                $("#solutionModal #solution").html(feedback.solution);
                $('#solutionModal').modal({
                  backdrop:'static'
                 });

            });




        });


       //search functionality
        $pagination = $(".pagination");
        $pagination.pajinatify();
        $(document).on("submit", "#searchForm", function (e) {
            e.preventDefault();
            loadDesignationTable(1);
        });

        function loadDesignationTable(page = 1) {
            $pagination.show();
            let $tableBody = $("#solutionTable").find('tbody');
            let _token = "{{ csrf_token() }}";
            let name = $("#name").val();
            let data = {_token: _token, page:page, name: name};
            
            let url = "{{ route('feedback.load') }}";
           
            $tableBody.load(url, data, function () {//yesle view load garxa contoller bata ako view
                let totalData = $("#totalData").val();
                 $('.pagination').pajinatify('set', page, totalData);

                if(totalData === '0') {
                    $pagination.hide();
                }
            });
        }

        // on changing pagination
        $(document).on("click", ".pajinatify__button", function () {
           let page = $(this).data("page");
           loadDesignationTable(page);
        });

        function resetSearch() {
            $("#name").val('');
            
        }




      //delete functionality

      $(document).on("click", ".btn-delete", function(event){
            let th = $(this);
            th.closest("tr").addClass('selected-tr');
            event.preventDefault();
            let id = th.attr('data-id');
            let message = 'You want to delete the selected firm?';
            swal({
                title: "Are you sure?",
                text: message,
                dangerMode: true,
                buttons: {
                    cancel:'Cancel',
                    confirm: {
                        value: 'Ok',
                        className: 'confirm-delete-btn'
                    }
                }
            }).then(result => {
                if (result) {
                    deleteData(id);
                } else {
                    th.closest("tr").removeClass('selected-tr');
                }
            });
        });

        // to delete competency questions
        function deleteData(id) {
            var url = "{{ route('feedback.destroy', ':id') }}";
            url = url.replace(':id',id);
            let csrf_token = '{{ csrf_token() }}';
            let data = {_token: csrf_token, _method: 'DELETE', id:id};

            $.ajax({
                url:url,
                type:'post',
                data:data,
                success:function(response) {
                    let status = response.status;
                    let message = response.message;

                    if(status === 1) {
                        successMessage(message);
                        loadDesignationTable(1);

                    } else {
                        errorMessage(message);
                    }
                },
                error: function () {
                    errorMessage();
                }
            })
        }




 });
</script>
@endpush