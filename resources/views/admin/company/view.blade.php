@extends('admin.layouts.app')
@section('title','कार्यालयको विवरण')
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

        <form action="{{route('company.update',$company->id)}}" class="form-horizontal"  method="post" id="companyForm">
            @csrf
            @method('PUT')

            <div class="box box-solid">
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-9">


                            <div class="row">
                                <label class="col-md-3" for="Name">कार्यालयको नाम*</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                            </span>
                                        <input class="form-control" id="Name" name="name" type="text" value="{{$company->name}}">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row" id="province">
                                <label class="col-md-3" for="Name">प्रदेश नाम </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                            </span>
                                        <input class="form-control" placeholder="Province No" name="province_no" type="text" value="{{$company->province_no}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="padding-top: 20px">
                                <label class="col-md-3" for="Name">कार्यालय प्रकार</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                            </span>
                                        <select name="company_type" id="company_type" class="form-control" >
                                            <option value="0" {{ old('company_type',$company->company_type) == 0 ? 'selected' : '' }}>प्रदेश</option>
                                            <option value="1" {{ old('company_type',$company->company_type) == 1 ? 'selected' : '' }}>संघ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>


                            <div class="row">
                                <label class="col-md-3" for="Address">कार्यालयको ठेगाना *</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                 <span class="input-group-addon">
                            <i class="fa fa-book"></i>
                            </span>
                                        <input class="form-control" id="Address" name="address" type="text" value="{{$company->address}}">
                                    </div>

                                </div>
                            </div>
                            <br>



                            <div class="row">
                                <label class="col-md-3" for="Phone">फोन नम्बर *</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                            </span>
                                        <input class="form-control" id="Phone" name="phone" type="text" value="{{$company->phone}}">
                                    </div>

                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label class="col-md-3" for="Email">इमेल</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                            </span>
                                        <input class="form-control" id="Email" name="email" type="text" value="{{$company->email}}">
                                    </div>

                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label class="col-md-3" for="Website">वेबसाइट*</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-file"></i>
                            </span>
                                        <input class="form-control" id="Website" name="website" type="text" value="{{$company->website}}">
                                    </div>

                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label class="col-md-3" for="Facebook">Facebook Link*</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-facebook"></i>
                            </span>
                                        <input class="form-control" id="Facebook" name="facebook_link" type="text" value="{{$company->facebook_link}}">
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-md-3" for="Twitter">Twitter Link*</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-twitter"></i>
                            </span>
                                        <input class="form-control" id="Twitter" name="twitter_link" type="text" value="{{$company->twitter_link}}">
                                    </div>

                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="col-md-3" for="Description">संक्षिप्त परिचय*</label>
                                <div class="col-md-9">
                                    <textarea class="form-control bsb-tinymce" name="description">{{$company->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-footer" style="margin-top:-10; border-top: 1px solid #c1c1c1">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{URL('/admin')}}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </section>


@endsection
@push('scripts')
    <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(function () {
            $('#companyForm').validate({
                rules:{
                    phone:{
                        required:true,
                        number:false,

                    },
                    email: {
                        required:true,
                        email: true,

                    },
                    name:{
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

            // tinymce.activeEditor.execCommand('mcePrint');






        });
    </script>
    <script>

        $("#company_type").change(function() {
            if ($(this).val() == 0) {
                $('#province').show();
            } else {
                $('#province').hide();
            }
        });
        $("#company_type").trigger("change");
    </script>
@endpush
