@extends('layouts.WEB-APP')
@section('content')
            <!-- Banner Start --> 
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
            <!-- Banner End --> 
            <!-- Main Start -->
            <div class="main-section">
                <div class="page-section" style="margin:0 0 70px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-shop-wrap row">
                                    <ul class="products">
                                        @foreach($gallery as $key)
                                        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="gallery-box">
                                                <h4>{{  $key->title }}</h4>
                                                <hr>
                                                <figure>                                                    
                                                    <a href="{{ asset('uploads/'.$key->image) }}" data-lightbox="roadtrip"><img src="{{ asset('uploads/'.$key->image) }}" style="width: 100%;height: 200px" alt="Image" /></a>
                                                </figure>
                                            </div>
                                        </li>     
                                        @endforeach                                   
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main End --> 

    @endsection