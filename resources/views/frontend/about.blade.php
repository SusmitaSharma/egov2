@extends('frontend.layouts.app')
@section('title','पृष्ठभूमी')
@section('body')
    <div class="row" style="margin: 0; padding: 0;margin-top: 40px">
        <div class="col-md-9" style="margin-left: 13px;margin-bottom: 30px;">
            <div class="card">
                <div class="post-view mt-2 mb-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="">
                                <a href="{{route('home')}}"> <i class="fa fa-home fa-lg"
                                                                style="font-size: 40px"></i></a>
                            </div>
                            <div class="col-md-2">
                                <h4>'पृष्ठभूमी'</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 31px;box-shadow: 1px 0px 16px 0px #88888863;padding: 25px;">
                        <div class="col-md-12">
                            <div style="margin-bottom: 10px">
                                <div style="margin:10px auto;padding:10px">
                                    <div class="about-desc" style="line-height: 33px">
                                        {!! $company->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Front Staff-->
        <div style="text-align:center" class="col-md-2">
            <div class="card" style="width: 360px">
                <div class="card-header custome-card">
                    <h4>कर्मचारी</h4>
                </div>
                @foreach($staffs as $staff)
                    <div class="media shadow-sm p-2 mb-2 bg-white rounded" style="margin-top: 32px">
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>>


@endsection
