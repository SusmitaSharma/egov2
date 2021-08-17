@extends('admin.layouts.app')
@section('title','नयाँ कर्मचारी दर्ता फारम')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/fileinput.css')}}">
    <style type="text/css">
        .box-solid, .box-footer {
            transition: box-shadow .3s;
        }

        .box-solid:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }

        .box-footer:hover {
            box-shadow: 0 0 11px rgba(35, 35, 33, .2);

        }
    </style>
@endpush
@section('content')
    @include('admin.elements.back_to_home')

    <section class="content">

        {!! success_or_failure_message() !!}

        {!! validation_error_message($errors) !!}

        <form action="{{$edit? route('slider.update',$model->id):route('slider.store')}}" class="form-horizontal"
              method="post" id="userForm" enctype="multipart/form-data">
            @csrf
            @if($edit)
                @method('PUT')
            @endif

            <div class="box box-solid">
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-8">

                            <div class="row">
                                <label class="col-md-3" for="Designation">शिर्षक *</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-book "></i>
                            </span>
                                        <input type="text" placeholder="Title" class="form-control" name="title"
                                               value="{{$edit?$model->title:old('title')}}">

                                    </div>

                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label class="col-md-3" for="Designation">फाेटाे छान्नुहाेस *</label>
                                <div class="col-md-9">
                                    <div id="image">
                                        <input id="input" name="image" type="file">
                                        @if($edit)
                                            <div style="margin-top: 10px">
                                                <img src="{{$model->image()}}" class="img-thumbnail">
                                            </div>
                                        @endif
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
                        <a href="{{route('slider.index')}}" class="btn btn-default">Cancel</a>
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

        if ($('#url').is(':checked')) {
            $('#text').css('display', 'block');
            $('#image').css('display', 'none');
        }

        $('#url').on('click', function () {
            if ($(this).is(':checked')) {
                $('#text').css('display', 'block');
                $('#image').css('display', 'none');

            } else {
                $('#text').css('display', 'none');
                $('#image').css('display', 'block');

            }

        });


    </script>


@endpush
