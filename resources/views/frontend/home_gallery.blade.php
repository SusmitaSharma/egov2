@extends('frontend.layouts.app')
@section('title','ग्यालरी')
@section('body')
    <div class="row" style="margin: 0; padding: 0;margin-top: 40px">
        <div class="col-md-12" style="margin-left: 13px;margin-bottom: 30px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="">
                            <a href="{{route('home')}}"> <i class="fa fa-home fa-lg"
                                                            style="font-size: 40px"></i></a>
                        </div>
                        <div class="col-md-2">
                            <h4>{{$gallery->name}}</h4>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 31px;box-shadow: 1px 0px 16px 0px #88888863;padding: 25px;">
                        @foreach($gallery->images as $ga)
                            <div class="col-sm-6 col-md-4 col-lg-3"
                                 style="">
                                <div class="thumbnail">
                                    <a href="{{asset('uploads/gallery/'.$ga->image)}}"
                                       class="fancybox" data-lightbox="image" rel="ligthbox">
                                        <img src="{{asset('uploads/gallery/'.$ga->image)}}" class="img-thumbnail" alt=""
                                             style="width: 100%;height: 216px;">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
