@extends('frontend.layouts.app')
@section('title','सुचना')

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
                            <h4>सुचना</h4>
                        </div>
                    </div>
                </div>
                @foreach($notices as $notice)
                    <div class="row" style="margin: 31px;box-shadow: 1px 0px 16px 0px #88888863;padding: 25px;">
                        <div class="col-md-12">
                            <div style="margin-bottom: 10px">
                                <div style="width: 80%;margin:10px auto;padding:10px">
                                    <h3 style="align-items: center;display: flex;justify-content: center;">
                                        <a href="#">{{$notice->title}}</a></h3>
                                    @if($notice->description!=="" && !is_null($notice->description))
                                        <div>
                                            {!!$notice->description !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($notice->image != null)
                            <div class="col-md-12" style="display: flex; justify-content: center">
                                @if(pathinfo(storage_path('uploads/notice'.$notice->image))['extension'] == "jpg")
                                    <a href="{{asset(('uploads/notice/'.$notice->image))}}">
                                        <img id="myImg" src="{{asset(('uploads/notice/'.$notice->image))}}"
                                             height="200px"
                                             width="200px"></a>
                                    <a style="margin-left: 10px"
                                       href="{{route('notice.download',$notice->image)}}"
                                       class="btn btn-dark btn-sm" download="">Download</a>
                                @endif
                                @if(pathinfo(storage_path('uploads/notice'.$notice->image))['extension'] == "pdf")
                                    <a href="{{asset(('uploads/notice/'.$notice->image))}}" target="_blank"
                                       style="font-size: 25px;">{{$notice->title}}{{pathinfo(storage_path('uploads/notice'.$notice->image))['extension']}} </a>
                                    <div class="" style="margin-left: 18px">
                                        <a class="btn btn-dark btn-sm"
                                           href="{{asset(('uploads/notice/'.$notice->image))}}"
                                           target="_blank"> View</a>
                                        <a style="margin-left: 10px"
                                           href="{{route('notice.download',$notice->image)}}"
                                           class="btn btn-dark btn-sm" download="">Download</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2">
            <div class="card" style="width: 360px">
                <div class="card-header custome-card">
                    <h4>थप सूचना</h4>
                </div>
                <div class="side-notice" style="margin-top: 32px;">
                    <ul>
                        @foreach($notices as $notice)
                            <a href="" style="text-decoration: none">
                                <li class="news-section">{{$notice->title}}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
