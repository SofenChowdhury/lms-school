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
                                <div class="box_">
                                    @foreach($chairman_message as $key)
                                    <h2>{{ $key->title }}</h2>
                                    <img class="about-bg" src="{{ asset('uploads/'.$key->image) }}" alt="" style="    border-radius: 12px;"  class="img-responsive" />
                                    <p>{!! $key->short_description !!}</p>
                                    <p>{!! $key->description !!}</p>
                                    <br>
                                    <br>
                                   <div class="col-md-4 pull-right">
                                    <h4>{{ $key->name }}</h4>
                                    <p>{{ $key->designation }}</p>
                                    <p>{{ $key->institute_name }}</p>
                                   </div> 
                                   @endforeach
                                </div>
                            </div>
                            <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <h4 class="quick-navigation">Quick Navigation</h4>
                                <div class="widget cs-widget-links">
                                    <ul>
                                        <li ><a class="{{ request()->is('about-history') ? 'ctg_active ' : '' }}"  href="{{ route('about-history-page') }}">History</a></li>
                                        <li><a class="{{ request()->is('chairman-message') ? 'ctg_active ' : '' }}"  href="{{ route('chairman-message-page') }}"> Chairman Message</a></li>
                                        <li><a class="{{ request()->is('principal-message') ? 'ctg_active ' : '' }}"  href="{{ route('principal-message-page') }}"> Principal Message </a></li>
                                        <li><a class="{{ request()->is('presidency-message') ? 'ctg_active ' : '' }}"  href="{{ route('presidency-message-page') }}">Presidency Message</a></li>
                                        <li><a class="{{ request()->is('mission-vision') ? 'ctg_active ' : '' }}"  href="{{ route('mission-vision-page') }}">Mission & Vision</a></li>
                                        <li><a class="{{ request()->is('governing-Body') ? 'ctg_active ' : '' }}"  href="{{ route('governing-Body-page') }}">Governing Body</a></li>
                                        <li><a class="{{ request()->is('infrastructure') ? 'ctg_active ' : '' }}"  href="{{ route('infrastructure-page') }}">Infrastructure</a></li>
                                    </ul>              
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main End --> 
@endsection