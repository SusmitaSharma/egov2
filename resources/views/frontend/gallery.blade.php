@extends('frontend.layouts.app')
@section('title','सम्पर्क')
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
                            <h4>ग्यालरी</h4>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px; margin-bottom: 25px">
                    @foreach($gallery as $gal)

                        <div class="col-md-12" style="margin-top: 22px;margin-left: 18px;">
                            <h3>{{$gal->name}}</h3>
                        </div>
                        @foreach($gal->images as $ga)
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb"
                                 style="box-shadow: 0px 8px 6px 2px #8888885e; margin: 13px;">
                                <div class="thumbnail">
                                    <a href="{{asset('uploads/gallery/'.$ga->image)}}"
                                       class="fancybox" data-lightbox="image" rel="ligthbox">
                                        <img src="{{asset('uploads/gallery/'.$ga->image)}}" class="img-thumbnail" alt=""
                                             style="width: 100%;">
                                    </a>
                                </div>
                            </div>

                        @endforeach

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
