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
                                <h2>Admission Result</h2>


                            </div>
                            <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <h4 class="quick-navigation">Quick Navigation</h4>
                                <div class="widget cs-widget-links">
                                    <ul>
                                        <li><a class="{{ request()->is('admission-circular') ? 'ctg_active ' : '' }}" href="{{ route('admission-circular-page') }}" >Admission Information</a></li>
                                        <li><a class="{{ request()->is('admission-form') ? 'ctg_active ' : '' }}" href="{{ route('admission-form-page') }}" >Admission Form</a></li>
                                        <li><a class="{{ request()->is('admission-result') ? 'ctg_active ' : '' }}" href="{{ route('admission-result-page') }}" >Admission Result</a></li>
                                        <li><a class="{{ request()->is('fees-and-payments') ? 'ctg_active ' : '' }}" href="{{ route('fees-and-payments-page') }}" >Fees and payments</a></li>
                                        <li><a class="{{ request()->is('prospectus') ? 'ctg_active ' : '' }}" href="{{ route('prospectus-page') }}" >Prospectus</a></li>
                                        <li><a class="{{ request()->is('scholarships') ? 'ctg_active ' : '' }}" href="{{ route('scholarships-page') }}" >Scholarships</a></li>
                                    </ul>              
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main End --> 
@endsection