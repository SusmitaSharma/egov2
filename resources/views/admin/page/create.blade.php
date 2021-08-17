@extends('admin.layouts.app')
@section('title','Page-create')
@push('style')
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

        <form action="{{$edit? route('page.update',$page->id):route('page.store')}}" class="form-horizontal"
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
                                <label class="col-md-3" for="Title">पेज टाइटल नेपालि</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-file"></i>
                            </span>
                                        <input class="form-control" id="title" name="title_nepali" type="text"
                                               value="{{ $edit ? $page->title:old('title')}}"
                                               placeholder="Enter Page Title Here ">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-md-3" for="Title">पेज टाइटल अङ्ग्रेजी</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-file"></i>
                            </span>
                                        <input class="form-control" id="title" name="title_english" type="text"
                                               value="{{ $edit ? $page->title_english:old('title_english')}}"
                                               placeholder="Enter Page Title Here ">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-md-3" for="PageType">पेज टाईप</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-file-o"></i>
                                        </span>
                                        <select name="page_type" id="page_type"
                                                class="form-control @error('page_type')">
                                            <option value="">--------Select Page Type---------</option>
                                            <option value="1"
                                                    @if($edit) @if($page->page_type == 1) selected @endif @endif>परिचय
                                            </option>
                                            <option value="7"
                                                    @if($edit) @if($page->page_type == 1) selected @endif @endif>कर्मचारी विवरण
                                            </option>
                                            <option value="2" @if($edit) @if($page->page_type == 2) selected @endif @endif>नोटिस</option>
                                            <option value="3" @if($edit) @if($page->page_type == 3) selected @endif @endif>न्युज</option>
                                            <option value="4" @if($edit) @if($page->page_type == 4) selected @endif @endif>पब्लिकेशन</option>
                                            <option value="5" @if($edit) @if($page->page_type == 5) selected @endif @endif>ग्यालरी</option>
                                            <option value="6" @if($edit) @if($page->page_type == 6) selected @endif @endif>डाउनलोड</option>
                                            <option value="0" @if($edit) @if($page->page_type == 0) selected @endif @endif>Others</option>
                                        </select>
                                        {{--                                        <input class="form-control" id="parent_id" name="parent_id" type="number" value="{{ $edit ? $menu->parent_id:old('parent_id')}}" placeholder="Enter Parent Id here ">--}}
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div id="others">
                                <div class="row">
                                    <label class="col-md-3" for="Description">संक्षिप्त विवरण*</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                        <textarea class="form-control bsb-tinymce"
                                                  name="description">{{$edit?$page->description:old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4" style="    margin-left: 240px;">
                                        <div class="fileupload fileupload-exists" data-provides="fileupload"
                                             data-name="myimage">
                                            <input type="hidden" name="myimage" value="1"/>
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                @if(!$edit)
{{--                                                    <img src="{{$page->image()}}" style="width: 150px"/>--}}
                                                @else
{{--                                                    <img src="{{$page->image()}}" style="width: 150px"/>--}}
                                                @endif
                                            </div>
                                            <div>
                                                <input type="file" name="file" accept="file_extension"/>
                                            </div>
                                        </div>
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
                        <a href="{{route('page.index')}}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </section>


@endsection
@push('scripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(function () {
            $('#userForm').validate({
                rules: {

                    title: {
                        required: true,

                    }
                }

            });

            tinymce.init({
                selector: 'textarea.bsb-tinymce',
                height: 300,
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();//for taking value from textarea

                    });
                },
                menu: {
                    file: {title: 'File', items: 'newdocument'},
                    insert: {title: 'Insert', items: 'link media image | template'},
                    view: {title: 'View', items: 'visualaid'},
                    format: {
                        title: 'Format',
                        items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'
                    },
                    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
                    tools: {title: 'Tools', items: 'spellchecker code'}
                },
                plugins: "link image advlist lists charmap print preview anchor autosave code codesample textcolor colorpicker table searchreplace media print hr preview",
                toolbar: [
                    'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist link unlink charmap code', // image media indent outdent
                    'formatselect fontselect fontsizeselect | forecolor backcolor | print'
                ]
            });


        });
    </script>

    <script>
        $(document).ready(function () {
                $('#others').hide()
                $('#page_type').on('change', function () {
                    let pageTypeId = $('#page_type').val()
                    if (pageTypeId == 0) {
                        $('#others').show();
                    } else {
                        $('#others').hide();
                    }
                })
        })
    </script>

    <script>
        $(document).ready(function () {
            let edit = '{!! $edit !!}'
            if(edit == 1) {
                let page = []
                page = '{!! $page !!}'
                if(page != null){
                    let parseData =$.parseJSON(page)
                    $('#others').hide()
                    if(parseData['page_type'] == 6){
                        $('#others').show();
                    }
                }
            }
        })
    </script>
@endpush
