@extends('admin.layouts.app')
@section('title','अपडेट')
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

        <form action="{{$edit? route('update.update',$notice->id):route('update.store')}}" class="form-horizontal"
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
                                <label class="col-md-3" for="Name">शिर्षक*</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-file"></i></span>
                                        <input class="form-control" id="Title" name="title" type="text"
                                               value="{{$edit?$notice->update_title:old('title')}}"
                                               placeholder="शिर्षक">
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if($edit)
                                <div class="row">
                                    <label class="col-md-3" for="Name">सक्रिय निस्क्रिय*</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="radio" id="male" name="status" value="1" @if($notice->status == 1) checked="checked" @endif>
                                            <label for="male">सक्रिय</label><br>
                                            <input type="radio" id="female" name="status" value="0" @if($notice->status == 0) checked="checked" @endif>
                                            <label for="female">निस्क्रिय</label><br>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-footer" style="margin-top:-10px; border-top: 1px solid #c1c1c1">
                        <button type="submit" class="btn btn-success">{{$edit? 'Update':'Save'}}</button>
                        <a href="{{route('notice.index')}}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>

        </form>
    </section>

@endsection
@push('scripts')
    <script>
        import Index from "../../../../public/bower_components/Flot/examples/zooming/index.html";

        export default {
            components: {Index}
        }
    </script>
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
@endpush
