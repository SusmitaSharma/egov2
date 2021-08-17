@extends('admin.layouts.app')
@section('title','Admin Panel')

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

<section class="content">
  <div class="row">
            <div class="col-md-12">
              
               <span style="width: 100%;height:2px;border:1px solid #e1e1f1;display:flex;flex-direction:row"> <hr/></span>
                <h4>Welcome to admin panel, you can manage stuff from here</h4>

            </div>
        </div>


@endsection



