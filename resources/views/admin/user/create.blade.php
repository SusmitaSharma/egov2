@extends('admin.layouts.app')
@section('title','नयाँ कर्मचारी दर्ता फारम')
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
@endpush
@section('content')
   @include('admin.elements.back_to_home')

<section class="content">

{!! success_or_failure_message() !!}

{!! validation_error_message($errors) !!}

<form action="{{$edit? route('user.update',$user->id):route('user.store')}}" class="form-horizontal"  method="post" id="userForm" enctype="multipart/form-data">
@csrf
@if($edit)
@method('PUT')
@endif

 <div class="box box-solid">
        <div class="box-body">

            <div class="row">
                <div class="col-md-8">


                    <div class="row">
                        <label class="col-md-3" for="Name">कर्मचारीकाे नाम*</label>
                        <div class="col-md-9">
                            <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                            </span>
                             <input class="form-control" id="Name" name="name" type="text" value="{{$edit?$user->name:old('name')}}">
                         </div>
                        </div>
                    </div>
                    <br>





                    <div class="row">
                        <label class="col-md-3" for="Designation">कर्मचारीकाे पद*</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-pagelines "></i>
                            </span>
                            <select class="form-control" name="designation_id">
                                <option value="" selected="true">--पद छान्नुहाेस‍--</option>
                                @foreach($designations as $v)
                                <option
                                value="{{$v->id}}"
                                {{$edit && $user->profile->designation_id==$v->id? 'selected':''}}

                                    >{{$v->name}}</option>

                                @endforeach
                            </select>

                        </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-3" for="Address">कर्मचारीकाे ठेगाना*</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-book"></i>
                            </span>
                             <input class="form-control" id="Address" name="address" type="text" value="{{$edit?optional($user->profile)->address:old('address')}}">

                        </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-3" for="Phone">कर्मचारीकाे फाेन*</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                            </span>
                             <input class="form-control" id="Phone" name="phone" type="text" value="{{$edit?optional($user->profile)->phone:old('phone')}}">

                        </div>

                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-3" for="Email">कर्मचारीकाे इमेल</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                            </span>
                             <input class="form-control" id="Email" name="email" type="text" value="{{$edit?$user->email:old('email')}}">

                        </div>

                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-3" for="Password">Password</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-key"></i>
                            </span>
                             <input class="form-control" id="Password" name="password" type="password" value="">

                        </div>

                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-3" for="Priority">देखाउने क्र॰सं॰</label>
                        <div class="col-md-3">

                             <input class="form-control" id="Priority" name="priority" type="number" value="{{$edit?optional($user->profile)->priority:old('priority')}}">

                        </div>

                    </div>
                        {{-- <div class="row">
                            <div class="col-md-9 col-md-offset-3">
                                <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="type" id="type1" value="1" {{$edit? $user->profile->type==1? 'checked':'':'checked'}}>
                           कर्मचारी
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="type" id="type2" value="2" {{$edit && $user->profile->type==2? 'checked':''}}>
                         मुख्य अधिकारी
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="type" id="optionsRadios3" value="3" {{$edit && $user->profile->type==3? 'checked':''}}>
                         सूचना अधिकारी
                        </label>
                      </div>
                    </div>
                            </div>


                        </div> --}}


                    </div>

                    <div class="col-md-4">

                        <div class="fileupload fileupload-exists" data-provides="fileupload" data-name="myimage">
                      <input type="hidden" name="myimage" value="1" />
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        @if(!$edit)
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" />
                        @else


                         <img src="{{$user->profile->image()}}" style="width: 150px; height:140px" />

                        @endif
                    </div>

                      <div>
                       <input type="file" name="photo" accept="image/*" /></span>

                      </div>
                    </div>

                    </div>
                 </div>
            </div>

            <div class="row">
        <div class="col-md-12">
            <div class="box box-footer" style="margin-top:-10; border-top: 1px solid #c1c1c1">
                <button type="submit" class="btn btn-success">{{$edit? 'Update':'Save'}}</button>
                <a href="{{route('user.index')}}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
        </div>
    </div>

</form>
</section>


@endsection
@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script>
    $(function () {
        $('#userForm').validate({
            rules:{
                phone:{
                    required:true,


                },
                designation_id: {
                     required:true,


                    },
                name:{
                    required:true,

                },
                address:{
                    required:false
                }
            }

        });










    });
</script>
@endpush
