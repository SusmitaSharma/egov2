@extends('frontend.layouts.app')
@section('title','कर्मचारी विवरण')
@section('body')
    <div class="row" style="margin: 0; padding: 0;margin-top: 40px">
        <div class="col-md-9" style="margin-left: 13px;margin-bottom: 30px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="">
                            <a href="{{route('home')}}"> <i class="fa fa-home fa-lg"
                                                            style="font-size: 40px"></i></a>
                        </div>
                        <div class="col-md-2">
                            <h4>कर्मचारी</h4>
                        </div>
                    </div>
                </div>
                <article>
                    <div class="post-body entry-content" id="post-body-@get_post_id">
                        <div style="text-align:center" class="col-md-12 mt-2">
                            @foreach($staffs as $staff)
                                <div class="media shadow-sm p-2 mb-2 bg-white rounded">
                                    <a class="mr-3 img-thumbnail rounded staff-flex-image img-effect"
                                       href=""
                                       style="background:url({{optional($staff->profile)->image()}}) no-repeat center top;background-size: cover"></a>
                                    <div class="media-body">
                                        <div class="wp-block-image">
                                            <figure class="aligncenter"></figure>
                                        </div>
                                        <p style="text-align:center">
                                            <strong> {{$staff->name}}</strong><br>{{optional($staff->profile->designation)->name}}
                                        </p>
                                        <div class="text-center"><a href=""
                                                                    class="btn btn-info btn-sm" role="button"
                                                                    aria-disabled="true">थप विवरण</a></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>

                <!--तस्वीर संग्रह-->
                <div class="col-md-12 mt-30" style="margin-top: 30px">
                    <div class="block-title-con">
                        <div class="block-title">
                            तस्वीर
                        </div>

                    </div>
                    <div class="d-flex flex-wrap">

                        @foreach($galleries as $gallery)
                            <div class="gallery-flex shadow-sm p-2 card m-2 rounded">
                                <a class="gallery-flex-image img-effect"
                                   href="{{route('gallery.images',$gallery)}}"
                                   style="background:url({{$gallery->first_image()}}) no-repeat center top;background-size: cover"></a>
                                <a
                                    href="{{route('gallery.images',$gallery)}}">
                                    <h5 class="m-3">{{$gallery->name}}</h5>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
