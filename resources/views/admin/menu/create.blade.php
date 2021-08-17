@extends('admin.layouts.app')
@section('title','Menu-create')
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

        <form action="{{$edit? route('menu.update',$menu->id):route('menu.store')}}" class="form-horizontal"
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
                                <label class="col-md-3" for="Name">मेनु नाम</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-file"></i>
                            </span>
                                        <input class="form-control" id="name" name="name" type="text"
                                               value="{{ $edit ? $menu->name:old('name')}}"
                                               placeholder="Enter Menu Name here " required>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label class="col-md-3" for="ParentId">Parent मेनु</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                        <select name="parent_id" id="parent_id" required
                                                class="form-control @error('parent_id')">
                                            <option value="">-----Parent मेनु छान्नुहोस्-----</option>
                                            <option value="0">Self Parent</option>
                                            @foreach($menus as $key => $menuData)
                                                @if($menuData->parent_id == 0)
                                                    @if($edit)
                                                        @if($menuData->id != $menu->id)
                                                            <option value=
                                                                    @if($menuData->id == $menu->parent_id)
                                                                        "{{ $menuData->id }}" selected
                                                                    @else "{{ $menuData->id }}"
                                                                @endif>
                                                                @if($menuData->id != $menu->id)
                                                                    {{ $menuData->name }}
                                                                @endif
                                                            </option>
                                                        @endif
                                                        @else
                                                            <option value="{{ $menuData->id }}">{{ $menuData->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="" id="page_section">
                                    <label class="col-md-3" for="PageType">पेज छान्नुहोस्</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                <i class="fa fa-file-o"></i>
                                </span>

                                            <select name="page_id" id="page_type"
                                                    class="form-control @error('page_type')">
                                                <option value="">-----पेज छान्नुहोस्-----</option>
                                                @foreach($pages as $page)
                                                    @if($page->menu == null or $edit == 1)
                                                        <option
                                                            value=@if($edit) @if($page->id == $menu->page_id) "{{ $page->id }}"
                                                            selected @else "{{ $page->id }}"  @endif @else
                                                        "{{ $page->id }}" @endif>{{ $page->title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
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
                                                <option
                                                    value="1" @if($edit){{(($menu->status=='1')? 'selected' : '')}} @endif>
                                                    Active
                                                </option>
                                                <option
                                                    value="0" @if($edit){{(($menu->status=='0')? 'selected' : '')}} @endif>
                                                    Inactive
                                                </option>
                                            </select>
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
                        <a href="{{route('menu.index')}}" class="btn btn-default">Cancel</a>
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

    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('#parent_id').on('change', function () {--}}
    {{--                var parentId = $('#parent_id').val();--}}
    {{--                if(parentId == 0) {--}}
    {{--                    $('#page_section').hide();--}}
    {{--                }  else {--}}
    {{--                    $('#page_section').show()   ;--}}
    {{--                }--}}
    {{--            })--}}
    {{--        })--}}
    {{--    </script>--}}
@endpush
