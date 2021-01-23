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
                                <h2>{{ $events->title }}</h2>
                                <img class="about-bg" src="{{ asset('uploads/'.$events->image) }}" alt="" />
                                <p><i class="fa fa-calendar"></i> {!! $events->date !!}</p>
                                <p><i class="fas fa-clock"></i> {!! $events->event_time !!}</p>
                                <p><i class="fa fa-map-marker"></i> {{ $events->location }}</p><br>
                                <p>{!! $events->short_description !!}</p>
                                <p>{!! $events->description !!}</p>
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