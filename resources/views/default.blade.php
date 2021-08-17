@extends('frontend.layouts.app')

@section('body')
    <div class="container" style="margin-left: 10px !important; margin: 40px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if($page)
                        <div class="card-header">
                            <div class="row">
                                <div class="">
                                    <a href="{{route('home')}}"> <i class="fa fa-home fa-lg"
                                                                    style="font-size: 40px"></i></a>
                                </div>
                                <div class="col-md-2">
                                    <h4>@if($page and $page->title){{$page->title}}@endif</h4>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            {!! $page->description !!}
                        </div>
                        @if($page->file != null)
                            <div class="col-md-12" style="display: flex; justify-content: center">
                                @if(pathinfo(storage_path('uploads/pagesFiles'.$page->file))['extension'] == "jpg")
                                    <a href="{{asset(('uploads/pagesFiles/'.$page->file))}}">
                                        <img id="myImg" src="{{asset(('uploads/pagesFiles/'.$page->file))}}"
                                             height="200px"
                                             width="200px"></a>
                                    <a style="margin-left: 10px"
                                       href="{{route('defaultFile.download',$page->file)}}"
                                       class="btn btn-dark btn-sm" download="">Download</a>
                                @endif
                                    @if(pathinfo(storage_path('uploads/pagesFiles'.$page->file))['extension'] == "pdf")
                                        <a href="{{asset(('uploads/pagesFiles/'.$page->file))}}" target="_blank"
                                           style="font-size: 25px;">{{$page->title}}{{pathinfo(storage_path('uploads/pagesFiles'.$page->file))['extension']}} </a>
                                        <div class="" style="margin-left: 18px">
                                            <a class="btn btn-dark btn-sm"
                                               href="{{asset(('uploads/pagesFiles/'.$page->file))}}"
                                               target="_blank"> View</a>
                                            <a style="margin-left: 10px"
                                               href="{{route('defaultFile.download',$page->file)}}"
                                               class="btn btn-dark btn-sm" download="">Download</a>
                                        </div>
                                    @endif
                            </div>
                        @endif
                        @else
                            <div class="col-md-12">
                                <h2>Page not found</h2>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
