@extends('frontend.layouts.app')
@section('title',$detail->title)
@section('body')
<section style="width:80%;margin:10px auto">
    <div class="d-flex  flex-column shadow-sm p-3 mb-5 bg-white rounded">
        <div class="post-view mt-2 mb-2">
            <div class="post-header">
                <div class="post-head text-center">
                    <h1 class="post-title entry-title"><a href="{{route('news.detail',$detail->id)}}">{{$detail->title}}</a>
                    </h1>
                </div>
            </div>
            <article>
                <div class="post-body entry-content" id="post-body-@get_post_id">
                    <div class="col-md-12" style="margin-bottom: 30px">
                        <div class="thumbnail">
                              <img src="{{$detail->image()}}" alt="Lights" style="width:100%">
                               <div class="caption" style="margin-top: 20px">
                                {!! $detail->description !!}
                              </div>
                          </div>
                        </div>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
