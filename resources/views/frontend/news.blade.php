@extends('frontend.layouts.app')
@section('title','समाचार')
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
                            <h4>समाचार</h4>
                        </div>
                    </div>
                </div>
            @foreach($news as $n)
                <div class="row" style="margin: 31px;box-shadow: 1px 0px 16px 0px #88888863;padding: 25px;">
                    <div class="col-md-12">
                        <div style="margin-bottom: 10px">
                            <div style="width: 80%;margin:10px auto;padding:10px">
                                <h3 style="align-items: center;display: flex;justify-content: center;">
                                    <a href="#">{{str_limit(strip_tags($n->title),100) }}</a></h3>
                                @if($n->description!=="" && !is_null($n->description))
                                    <div>
                                        {{--                                        {{str_limit(strip_tags($n->description),100) }}--}}
                                        {!!$n->description !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($n->image != null)
                            @if(pathinfo(storage_path('uploads/news/'.$n->image))['extension'] == "jpg" || pathinfo(storage_path('uploads/news/'.$n->image))['extension'] == "png")
                                <div class="col-md-12" style="text-align: center">
                                    <a href="{{asset(('uploads/news/'.$n->image))}}">
                                        <img id="myImg" src="{{asset(('uploads/news/'.$n->image))}}"
                                             height="200px"
                                             width="200px"></a>
                                </div>
                                <div class="col-md-12" style="text-align: center">
                                    <a style="margin-left: 10px"
                                       href="{{route('news.download',$n->image)}}"
                                       class="btn btn-primary btn-sm" download="">Download</a>
                                </div>
                            @endif
                            @if(pathinfo(storage_path('uploads/news/'.$n->image))['extension'] == "pdf")
                                <div class="col-md-6" style="text-align: right">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{asset(('uploads/news/'.$n->image))}}"
                                       target="_blank">View</a>
                                </div>
                                <div class="col-md-6" style="text-align: left">
                                    <a style="margin-left: 10px"
                                       href="{{route('news.download',$n->image)}}"
                                       class="btn btn-primary btn-sm" download="">Download</a>
                                </div>
                            @endif
                    @endif
                </div>
            @endforeach
            </div>
        </div>
        <div class="col-md-2">
            <div class="card" style="width: 360px">
                <div class="card-header custome-card">
                    <h4>थप समाचार</h4>
                </div>
            <div class="side-notice" style="margin-top: 32px;">
                <ul>
                    @foreach($news as $n)
                        <a href="" style="text-decoration: none">
                            <li class="news-section">{{$n->title}}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
            </div>
        </div>
    </div>
@endsection
