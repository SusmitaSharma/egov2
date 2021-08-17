@extends('frontend.layouts.app')
@section('title','प्रकाशन')

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
                            <h4>प्रकाशन</h4>
                        </div>
                    </div>
                </div>
                @foreach($publications as $publication)
                    <div class="row" style="margin: 31px;box-shadow: 1px 0px 16px 0px #88888863;padding: 25px;">
                        <div class="col-md-12">
                            <div style="margin-bottom: 10px">
                                <div style="width: 80%;margin:10px auto;padding:10px">
                                    <h3 style="align-items: center;display: flex;justify-content: center;">
                                        <a href="#">{{$publication->title}}</a></h3>
                                    @if($publication->description!=="" && !is_null($publication->description))
                                        <div>
                                            {!!$publication->description !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($publication->file != null)
                            <div class="col-md-12" style="display: flex; justify-content: center">
                                @if(pathinfo(storage_path('uploads/publication'.$publication->file))['extension'] == "jpg")
                                    <a href="{{asset(('uploads/publication/'.$publication->file))}}">
                                        <img id="myImg" src="{{asset(('uploads/publication/'.$publication->file))}}"
                                             height="200px"
                                             width="200px"></a>
                                    <a style="margin-left: 10px"
                                       href="{{route('publication.download',$publication->file)}}"
                                       class="btn btn-dark btn-sm" download="">Download</a>
                                @endif
                                @if(pathinfo(storage_path('uploads/publication'.$publication->file))['extension'] == "pdf")
                                    <a href="{{asset(('uploads/publication/'.$publication->file))}}" target="_blank"
                                       style="font-size: 25px;">{{$publication->title}}{{pathinfo(storage_path('uploads/publication'.$publication->file))['extension']}} </a>
                                    <div class="" style="margin-left: 18px">
                                        <a class="btn btn-dark btn-sm"
                                           href="{{asset(('uploads/publication/'.$publication->file))}}"
                                           target="_blank"> View</a>
                                        <a style="margin-left: 10px"
                                           href="{{route('publication.download',$publication->file)}}"
                                           class="btn btn-dark btn-sm" download="">Download</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
                <nav aria-label="Page navigation example" style="margin-top: 20px">
                    <ul class="pagination">
                        {{$notices->links()}}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card" style="width: 360px">
                <div class="card-header custome-card">
                    <h4>थप प्रकाशन</h4>
                </div>
                <div class="side-notice" style="margin-top: 32px;">
                    <ul>
                        @foreach($publications as $notice)
                            <a href="" style="text-decoration: none">
                                <li class="news-section">{{$notice->title}}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
