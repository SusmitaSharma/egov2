@extends('frontend.layouts.app')
@section('title','गृह पृष्ठ')
@section('body')
    <section class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <!--Scrolling News-->
                <div class="col-md-10  mt-2">
                    <div class="col-md-12 p-0 mt-2">
                        <div id="carouselExampleControls" class="carousel slide p-1 bg-white rounded"
                             data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($sliders as $k=>$v)
                                    <div class="carousel-item {{$k==0? 'active':''}} ">
                                        <a class="carousel-photo-news rounded" href="#"
                                           style="background:url({{$v->image()}}) no-repeat center center;background-size: cover">
                                            <span></span></a>
                                        <div class="photo-info rounded">
                                            <div class="text-center font-weight-bold text-dark pit-link-white">
                               <span><a
                                       href="https://ida.p5.gov.np/gallery/title/">{{$v->title}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="col-md-12 open-content">--}}
                    {{--                        <h4>पृष्ठभूमी</h4>--}}
                    {{--                        <p class="main-content">--}}
                    {{--                        <p></p>--}}
                    {{--                        <p><span class="has-inline-color has-very-dark-gray-color"><strong>--}}
                    {{--                    {!! $company->description !!}--}}
                    {{--                        </strong></span><strong> </strong></p>--}}
                    {{--                    </div>--}}
                </div>
                <!--Front Staff-->
                <div style="text-align:center" class="col-md-2 mt-2">
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
                                {{--                                <div class="text-center">--}}
                                {{--                                    <a href="#" class="btn btn-info btn-sm" role="button" aria-disabled="true">थप विवरण</a>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <!--सूचना / विज्ञप्ति-->
                <div class="col-md-4 mb-2 mt-2">
                    <div class="block-title-con">
                        <div class="block-title">सूचना / विज्ञप्ति</div>
                    </div>
                    <div class="news-list">
                        <ul>
                            @foreach($news as $new)
                                <a href="/notice">
                                    <li class="news-section">{{$new->title}}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-0 subcat-filter">
                        <ul class="subcat-list">
                            <li><a href="/notice">थप सूचना</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--विज्ञापन-->
                <div class="col-md-4 mb-2 mt-2">
                    <div class="block-title-con">
                        <div class="block-title">प्रकाशन</div>
                    </div>
                    <div class="news-list">
                        <ul>
                            @foreach($publication as $item)
                                <a href="/publication">
                                    <li> {{$item->title}}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-0 subcat-filter">
                        <ul class="subcat-list">
                            <li><a href="/publication">थप
                                    प्रकाशन</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--ऐन नियम-->
                <div class="col-md-4 mb-2 mt-2">
                    <div class="block-title-con">
                        <div class="block-title">ऐन नियम</div>
                    </div>
                    <table class="table table-hover">
                        <tbody>
                        </tbody>
                    </table>
                    <div class="mt-0 subcat-filter">
                        <ul class="subcat-list">
                            <li><a href="https://ida.p5.gov.np/category/niyam">थप
                                    नियम</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <!--सूचना अधिकारी-->
                <div class="col-md-4">
                    <div class="block-title-con">
                        <div class="block-title">
                            सूचना अधिकारी
                        </div>
                    </div>
                    @if(!is_null($suchana_adhikari))
                        <div class="row" style="box-shadow: 1px 3px 4px 5px #8888885e">
                            <div class="" style="margin: 63px;">
                                <a class="mr-3 img-thumbnail rounded parbakta-flex-image img-effect"
                                   href="https://ida.p5.gov.np/information-officer/"
                                   style="background:url('{{optional($suchana_adhikari->profile)->image()}}') no-repeat center top;background-size: cover; height: 210px;
                                       width: 226px;box-shadow: 1px 3px 4px 5px #8888885e"></a>
                            </div>
                            <div class="" style="margin-left: -93px;margin-top: 75px;">
                                <ul style="list-style: none">
                                    <li><strong>{{$suchana_adhikari->name}}</strong></li>
                                    <li>सम्पर्क नं. {{optional($suchana_adhikari->profile)->phone}}</li>
                                    <li>इमेलः {{$suchana_adhikari->email??'-'}}</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <!--तस्वीर संग्रह-->
                <div class="col-md-8 mt-2">
                    <div class="block-title-con">
                        <div class="block-title">
                            तस्वीर संग्रह
                        </div>
                        {{--                        <div class="subcat-filter">--}}
                        {{--                            <ul class="subcat-list">--}}
                        {{--                                <li><a--}}
                        {{--                                        href="#">सबै--}}
                        {{--                                        हेर्नुहोस्</a>--}}
                        {{--                                </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}
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
    </section>

@endsection


