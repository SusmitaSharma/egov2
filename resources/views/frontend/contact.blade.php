@extends('frontend.layouts.app')
@section('title','सम्पर्क')
@section('body')
<section style="width:80%;margin:10px auto">
    <div class="d-flex  flex-column shadow-sm p-3 mb-5 bg-white rounded">
        <div class="post-view mt-2 mb-2">
            <div class="post-header">
                <div class="post-head text-center">
                    <h1 class="post-title entry-title"><a href="#">सम्पर्क</a>
                    </h1>
                </div>
            </div>
            <article>
                <div class="post-body entry-content" id="post-body-@get_post_id">

                    <p>{{$company->name}}<br>प्रदेश नं. {{$company->get_province()}}, {{$company->address}}</p>
                    <p>Email. {{$company->email}}</p>
                     <p>फो.नं. {{$company->phone}}</p>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
