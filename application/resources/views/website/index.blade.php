@extends('layouts.WEB-APP')
@section('content')
        <script>
            function panelControlBtn(){
            document.getElementById('panel-box').classList.toggle('panel-control-btn-active');
                }
        </script>
        <!-- Company Name -->
        {{-- <div class="panel-box" id="panel-box">
            <div class="panel-control-btn" onclick="panelControlBtn()"><i class="fa fa-cog fa-spin"></i></div>
            <div class="panel-content">
                <a href="http://baiworldltd.com" target="_blank"><img src="{{asset('website/assets/images/baiWorld.png')}}" alt=""></a>
                <h3><a href="http://baiworldltd.com" target="_blank">WhitePaper (Pvt.) Ltd</a></h3>
                <p>Powered by: <a href="https://sssgloballink.com" target="_blank">SSS Global Link.</a></p>
            </div>
        </div> --}}
        <!-- Company Name Ends -->

            <!-- Slider Start --> 
            <div class="ct-header ct-header--slider ct-slick-custom-dots" id="home">
                <div class="ct-slick-homepage" data-arrows="true" data-autoplay="true" style="height:400px;">
                    @foreach($sliders as $key)
                    <div class="ct-header tablex item" data-background="{{ asset('uploads/'.$key->image) }}" style="background-size: cover;height:400px;">
                        <div class="ct-u-display-tablex">
                            <div class="inner">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 col-lg-6 slider-inner" style="background: rgb(136, 194, 56, 0.7); padding: 20px;border-radius: 12px;">
                                            <h1 class="big animated"  >{{ $key->title }}</h1>
                                            <p class="animated">{{ $key->short_description }}</p>
                                            <a class="btn btn-transparent btn-lg text-uppercase animated" style="font-size: 12px" href="{{ route('slider-page',['id'=>$key->id]) }}">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div><!-- .ct-slick-homepage -->
            </div><!-- .ct-header -->      
            <!-- Banner End --> 

            <!-- News Start --> 
            <div class="news">
                <div class="news-headline">
                    <marquee onMouseOver="this.stop()" onMouseOut="this.start()" scrollamount="3" onmouseover="this.scrollAmount = 0" onmouseout="this.scrollAmount = 3">
                        @foreach($news as $key)
                            <a href="{{ route('news-description-page',['id'=>$key->id]) }}">{{ $key->title }}</a>
                       @endforeach
                    </marquee>
                </div>
            </div>
            <!-- News End --> 

            <!-- Main Start -->
            <div class="main-section">
                <!--
                <div class="page-section" style="margin-top:-30px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="cs-top-categories">
                                    <li><a href="#" style="background:#8a9045;"><i class="icon-uniF1032"></i>Science</a></li>
                                    <li><a href="#" style="background:#a88b60;"><i class="icon-uniF1022"></i>EconomicS</a></li>
                                    <li><a href="#" style="background:#3e769a;"><i class="icon-uniF1052"></i>cOMPUTING</a></li>
                                    <li><a href="#" style="background:#c16622;"><i class="icon-uniF1012"></i>MATHMATICS</a></li>
                                    <li><a href="#" style="background:#896ca9;"><i class="icon-uniF1042"></i>Web Design</a></li>
                                    <li><a href="#" style="background:#dd9d13;"><i class="icon-uniF1002"></i>Business</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <div class="page-section" style="margin-bottom: 25px;">
                    <div class="container">
                        <div class="row">
                            <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                             <h3 style="text-align: center;background: #88c238;color:#fff !important;padding: 10px">Important Links</h3>
                              <div class="widget cs-widget-links">
                                  <ul>
                                        @foreach($manage_links as $links)
											<li><a href="{{$links->links}}" target="_blank">{{$links->title}}</a></li>
										@endforeach
                                    </ul>              
                                </div>
                                 <div class="box">
                                    <div class="row mp">
                                        <div class="col-md-12 padding-top10 txt-g">
                                            @foreach($principal_message as $key)
                                            <h1 class="title">{{ $key->title }}</h1>
                                            <img src="{{ asset('uploads/'.$key->image) }}" class="img-responsive cm" alt="" style="width:100%;margin-bottom:10px">
                                            <p style="text-align: center; margin: 0">{{ $key->name }}</p>
                                            <p style="text-align: center; margin: 0">{{ $key->designation }}</p>
                                            <hr style="margin: 5px 0; border: 1px solid #ccc;" />
                                            <p style="text-align: justify">{!! $key->short_description !!}<br><a href="{{ route('principal-message-page') }}" style="color:#207DBA">read more...</a></p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <div class="col-sm-6 col-xs-12">
                                <div class="box">
                                    <div class="row mp">
                                        <div class="col-md-12 padding-top10 txt-g">
                                            @foreach($history as $key)
                                            <h1 class="title">{{ $key->title }}</h1>
                                            <img src="{{ asset('uploads/'.$key->image) }}" class="img-responsive cm" alt="">
                                            <p>{!!  $key->short_description  !!}</p>
                                            <a href="{{ route('about-history-page') }}" style="color:#207DBA">read more...</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="box">
                                    <h1 class="title">Upcomming Events</h1>
                                    <div class="owl-carousel owl-theme">
                                        @foreach($event as $key)
                                        <div class="item">
                                            <div class="event">
                                                <div class="img-box">
                                                    <img src="{{ asset('uploads/'.$key->image) }}" alt=""  style="width: 100%;height: 150px;" />
                                                </div>
                                                <div class="shadow"></div>
                                            </div>
                                            <div class="cs-event left">
                                                <div class="cs-media">
                                                    <span><strong>{{ $day = date('M', strtotime($key->date)) }}</strong>{{ $day = date('d', strtotime($key->date)) }}</span>
                                                </div>
                                                <div class="cs-text">
                                                    <em>{{ $key->event_time }}</em>
                                                    <h5 style="margin: 0"><a href="{{ route('event-description-page',['id'=>$key->id]) }}" style="font-size: 12px !important; line-height: 12px !important">{{ $key->title }}</a></h5>
                                                    <span><i class="icon-map-marker"></i>{{ $key->location }}</span>
                                                </div>
                                            </div>                                            
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="box">
                                    <h1 class="title">Facilities</h1>
                                    <div class="col-md-12" style="padding: 0px">
                                        @foreach($facility as $key)              
                                            <img src="{{ asset('uploads/'.$key->image) }}" style="width: 50%;margin-bottom: 15px;float: left;margin-right: 15px">
                                            <h5 style="text-align: center;">{{ $key->title }}</h5>
                                            {!! $key->short_description !!}
                                            <a href="{{ route('facilities-page') }}" style="color: #3E769A">Read more...</a>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="student-portal">
                                    <div class="cs-element-title">
                                        <a href="http://faisalsarker.com/blog/" target="_balank"><h2 class="title" style="margin: 0">Discussion forum</h2></a>
                                    </div>
                                </div>
                                <div class="latest-notice">
                                    <div class="cs-element-title">
                                        <h2 class="title">Latest Notice</h2>
                                    </div>
                                    <div class="cs-quick-faqs">
                                        <ul class="row">
                                            <marquee onMouseOver="this.stop()" onMouseOut="this.start()" direction="up"   onmouseover="this.scrollAmount = 0" onmouseout="this.scrollAmount = 3">
                                                @foreach($notice as $key)
                                                <li>
                                                    <a href="{{ route('notice-description-page',['id'=>$key->id]) }}"><i class="icon-circle-right"></i>{{ $key->title }}</a>
                                                </li>
                                                @endforeach
                                            </marquee>
                                        </ul>
                                    </div>
                                </div>

                                <div class="latest-notice">
                                    <div class="cs-element-title">
                                        <h2 class="title">Latest News</h2>
                                    </div>
                                    <div class="cs-quick-faqs">
                                        <ul class="row">
                                            <marquee onMouseOver="this.stop()" onMouseOut="this.start()" direction="up"   onmouseover="this.scrollAmount = 0" onmouseout="this.scrollAmount = 3">
                                                @foreach($news as $key)
                                                <li>
                                                    <a href="{{ route('news-description-page',['id'=>$key->id]) }}"><i class="icon-circle-right"></i>{{ $key->title }}</a>
                                                </li>
                                                @endforeach
                                            </marquee>
                                        </ul>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
@endsection