@extends('admin.layouts.app')
@section('title','प्रकाशन')
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

        <form action="{{$edit? route('publication.update',$publication->id):route('publication.store')}}" class="form-horizontal"  method="post" id="userForm" enctype="multipart/form-data">
            @csrf
            @if($edit)
                @method('PUT')
            @endif

            <div class="box box-solid">
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-8">


                            <div class="row">
                                <label class="col-md-3" for="Name">शिर्षक*</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-file"></i>
                            </span>
                                        <input class="form-control" id="Title" name="title" type="text" value="{{$edit?$publication->title:old('title')}}" placeholder="शिर्षक">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">

                                <label class="col-md-3" for="Description">संक्षिप्त विवरण*</label>
                                <div class="col-md-9">
                                    <div class="input-group">


                                        <textarea class="form-control bsb-tinymce" name="description">{{$edit?$publication->description:old('description')}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <label class="col-md-3" for="publishedDate">Published Date*</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-dashcube"></i>
                            </span>
                                        <input class="form-control" id="publishedDate" name="publishedDate" type="text"
                                               value="{{$edit?$publication->published_date:old('published_date')}}">
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="" id="status">
                                    <label class="col-md-3" for="Status">Status </label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                <i class="fa fa-file-o"></i>
                                </span>

                                            <select name="status" class="form-control">
                                                <option value="1" @if($edit){{(($publication->status=='1')? 'selected' : '')}} @endif>Active</option>
                                                <option value="0" @if($edit){{(($publication->status=='0')? 'selected' : '')}} @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-md-4">

                            <div class="fileupload fileupload-exists" data-provides="fileupload" data-name="myimage">
                                <input type="hidden" name="myimage" value="1" />
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    @if(!$edit)
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" />
                                    @else

                                        @if($publication->isImage())
                                            <img src="{{$publication->image()}}" style="width: 150px" />
                                        @else
                                            @if($publication->file)
                                                <a href="{{route('publication.download',$publication->file)}}">{{$publication->file}}(Clik To Download)</a>
                                            @endif
                                        @endif

                                    @endif
                                </div>

                                <div>
                                    <input type="file" name="file" /></span>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-footer" style="margin-top:-10; border-top: 1px solid #c1c1c1">
                            <button type="submit" class="btn btn-success">{{$edit? 'Update':'Save'}}</button>
                            <a href="{{route('publication.index')}}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </section>


@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(function () {
            $('#userForm').validate({
                rules:{

                    title:{
                        required:true,

                    }
                }

            });

            tinymce.init({
                selector: 'textarea.bsb-tinymce',
                height:300,
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();//for taking value from textarea

                    });
                },
                menu    : {
                    file  : {title: 'File', items: 'newdocument'},
                    insert: {title: 'Insert', items: 'link media image | template'},
                    view  : {title: 'View', items: 'visualaid'},
                    format: {
                        title: 'Format',
                        items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'
                    },
                    table : {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
                    tools : {title: 'Tools', items: 'spellchecker code'}
                },
                plugins : "link image advlist lists charmap print preview anchor autosave code codesample textcolor colorpicker table searchreplace media print hr preview",
                toolbar : [
                    'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist link unlink charmap code', // image media indent outdent
                    'formatselect fontselect fontsizeselect | forecolor backcolor | print'
                ]
            });










        });
    </script>
@endpush
