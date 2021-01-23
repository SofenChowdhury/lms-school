@extends('layouts.WEB-APP')
@section('content')
            
            <!-- Slider Start --> 
            @foreach($banner as $key)
                <div style="background-image: url('{{asset('uploads').'/'.$key->banner}}'); background-attachment: fixed; background-size: cover;" class="page-section">
                    <div style="background:rgb(49,49,49,0.5); padding:200px 0 50px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-page-title">
                                        <h1 style="color: white !important; font-weight: bold;">{{$title}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Main Start -->
            <div class="main-section"> 
                <!--Page Section Wide With Right SideBar-->
                <div class="page-section" style=" padding-top:10px; padding-bottom:50px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">                                
                                <div class="row">
                                    <div class="events-block">
                                        @foreach($news as $key)
                                        <div class="col-sm-6">
                                            <div class="event-single">
                                                <div class="event-image">
                                                    <!-- <img src="images/blog-m1.jpg" alt="" class="img-responsive"> -->
                                                    <table class="table" style="margin-top: 22px;">
                                                        <tbody>
                                                            <tr>
                                                                <th class="month">{{ $key->created_at->format('M') }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="day">{{ $key->created_at->format('d') }}</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="event-details">
                                                    <img src="{{ asset('uploads/'.$key->image) }}" style="width: 100%;height:150px;">
                                                    <h3>{{ $key->title }}</h3>
                                                    <!--<ul class="list-unstyled">
                                                        <li><i class="fa fa-calendar"></i> 1st Jan, 2018</li>
                                                        <li><i class="fa fa-clock-o"></i> 8.00am - 5.00pm</li>
                                                        <li><i class="fa fa-map-marker"></i> Newyork</li>
                                                    </ul>-->
                                                    <p>{!! $key->short_description !!}</p>
                                                    <a href="{{ route('news-description-page',['id'=>$key->id]) }}">Read More <i class="fa fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div><!-- ends: .event-single -->
                                        @endforeach
                                    </div><!-- Ends: .col-md-12 -->
                                </div>
                            </div>
                            <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <h4 class="quick-navigation">Quick Navigation</h4>
                                <div class="widget cs-widget-links">
                                    <ul>
                                        <li"><a class="{{ request()->is('news') ? 'ctg_active': '' }} || {{ request()->is('news-description/*') ? 'ctg_active': '' }}" href="{{ route('news-page') }}" >News</a></li>
                                        <li ><a class="{{ request()->is('notice') ? 'ctg_active': '' }} || {{ request()->is('notice-description/*') ? 'ctg_active': '' }}" href="{{ route('notice-page') }}">Notice</a></li>
                                        <li ><a class="{{ request()->is('event') ? 'ctg_active': '' }} || {{ request()->is('event-description/*') ? 'ctg_active': '' }}" href="{{ route('event-page') }}">Events</a></li>
                                        <li ><a class="{{ request()->is('policies-and-guidelines') ? 'ctg_active': '' }}" href="{{ route('policies-and-guidelines-page') }}">Policies and Guidelines</a></li>
                                        <li ><a class="{{ request()->is('facilities') ? 'ctg_active': '' }}" href="{{ route('facilities-page') }}">Facilities</a></li>
                                        <li ><a class="{{ request()->is('library') ? 'ctg_active': '' }}"href="{{ route('library-page') }}">Library</a></li>
                                        <li ><a class="{{ request()->is('it') ? 'ctg_active': '' }}" href="{{ route('it-page') }}">IT</a></li>
                                    </ul>              
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main End --> 
@endsection