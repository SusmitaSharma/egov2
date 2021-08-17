<body style="padding: 30px">

<section>

    <header>
        <div class="main-header">
            <div class="np-logo">
                <img src="{{front_url('img/nplogo.png')}}"/>
            </div>
            <div class="title">
                <div class="col-md-10" style="max-width: 102.333333%">
                    <p style="color: #2e2794;font-weight: 600;">प्रदेश सरकार</p>
                    <p style="color: #2e2794;font-weight: 600;">लुम्बिनी प्रदेश</p>
                    <h1 style="color: #2e2794;font-size: 24px">{{$office->name}}</h1>
                    <h6 style="color: #2e2794;font-weight: 600;">{{$office->address}}</h6>
                </div>

            </div>
            <div class="side-image">
                <img class="img-responsive" src="{{front_url('img/nf.gif')}}"/>
            </div>
        </div>
        <div class="today-date">
            मितिः <span id="date"></span>
        </div>
    </header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container menu-cont">
            <a class="navbar-brand" href="{{route('home')}}" style="font-size: 25px">
                <i class="fa fa-home fa-lg"
                   style="font-size: 40px; margin-inline: 38px"></i>  गृह पृष्ठ
            </a>
            <div id="mega-menu-wrap-primary" class="mega-menu-wrap">
                <div class="mega-menu-toggle">
                    <div class="mega-toggle-blocks-left"></div>
                    <div class="mega-toggle-blocks-center"></div>
                    <div class="mega-toggle-blocks-right">
                        <div class='mega-toggle-block mega-menu-toggle-block mega-toggle-block-1'
                             id='mega-toggle-block-1' tabindex='0'><span class='mega-toggle-label' role='button'
                                                                         aria-expanded='false'><span
                                    class='mega-toggle-label-closed'>Menu</span><span class='mega-toggle-label-open'>Close</span></span>
                        </div>
                    </div>
                </div>
                <ul id="mega-menu-primary" class="mega-menu max-mega-menu mega-menu-horizontal mega-no-js"
                    data-event="hover_intent" data-effect="fade_up" data-effect-speed="200"
                    data-effect-mobile="disabled" data-effect-speed-mobile="0" data-mobile-force-width="body"
                    data-second-click="go" data-document-click="collapse" data-vertical-behaviour="standard"
                    data-breakpoint="900" data-unbind="true" data-hover-intent-timeout="300"
                    data-hover-intent-interval="100">
                    @foreach($menus as $menuItem)
                        @if( $menuItem->parent_id == 0 )
                            <li class='mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-align-bottom-left mega-menu-flyout mega-menu-item-254'
                                id='mega-menu-item-254' style="font-size: 22px;padding-left: 10px;">
                                <a class="mega-menu-link" style="font-size: 22px;padding-left: 10px;"
                                   href="{{ ($menuItem->page == null)  ? "#" : $menuItem->page->slug }}"{{ $menuItem->children->isEmpty() ? '' : "class=dropdown-toggle data-toggle=dropdown role=button aria-expanded=false" }}
                                " tabindex="0">{{ $menuItem->name }}</a>
                                @endif

                                @if( ! $menuItem->children->isEmpty() )
                                    <ul class="dropdown-menu" role="menu" style="width: 212px">
                                        @foreach($menuItem->children as $subMenuItem)
                                            <li>
                                                <a href="@if($subMenuItem->page && $subMenuItem->page->slug){{ $subMenuItem->page->slug }}@endif"
                                                   style="font-size: 20px;padding-left: 11px;text-decoration: none">{{ $subMenuItem->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
                </ul>

            </div>
        </div>
    </nav>
    @if($update)
        <div class="row" style="background-color: #1000ff14;width: 99.8%; margin-left: 0">
            <div class="update" style="padding-left: 0;">
                <h4 class="update-text">हाइलाइट:</h4>
            </div>
            <div class="col-md-10">
                <marquee width="100%" direction="left" style="font-size: 20px">
                    {{$update->update_title}}
                </marquee>
            </div>
    @endif
</section>

<script>
    var currentDate = new Date();
    var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
    var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
    $("#date").text(formatedNepaliDate);
</script>
