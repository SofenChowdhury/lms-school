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
                <div class="page-section" style=" padding-top:10px; padding-bottom:80px;">
                    <div class="container">
                        <div class="row">
                            <div class="section-content col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="row"> 
                                    <!--Element Section Start-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                        <!--Contact Form Element Start-->
                                        <div class="cs-contact-form view-two">
                                            <div class="cs-section-title">
                                                <h2>Contact Form</h2>
                                                <p>Your email address will not be published. Required fields are marked.</p>
                                            </div>
                                            <div class="form-holder">
                                                <div class="row">
                                                    <form>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="row">
                                                                <div class="cs-form-holder">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="input-holder">
                                                                            <input type="text" placeholder="First Name *">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="row">
                                                                <div class="cs-form-holder">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="input-holder">
                                                                            <input type="text" placeholder="Last Name *">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="row">
                                                                <div class="cs-form-holder">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="input-holder">
                                                                            <input type="text" placeholder="Email Address *">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="row">
                                                                <div class="cs-form-holder">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="input-holder">
                                                                            <input type="text" placeholder="Phone No.">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cs-form-holder">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="input-holder">
                                                                    <textarea placeholder="Text here..."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-md-12">
                                                            <div class="cs-field">
                                                                <div class="cs-btn-submit">
                                                                    <input class="cs-bgcolor" type="submit" value="Send Message" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Contact Form Element End--> 
                                    </div>
                                    <!--Element Section End--> 
                                </div>
                            </div>
                            <aside class="section-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="cs-contact-info view-two">
                                    <div class="cs-section-title">
                                        <h2>Contact Info</h2>
                                        <p>Welcome to our Website. We are glad to have you</p>
                                    </div>
                                    <ul>
									@foreach($contact as $key)
                                        <li>
                                            <div class="cs-media"> <i class="icon-home cs-color"></i> </div>
                                            <div class="cs-text"> <span>Address:</span>
                                                <p>{{$address = $key->address}}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cs-media"> <i class="icon-phone cs-color"></i> </div>
                                            <div class="cs-text"> <span>Phone No.</span>
                                                <p>{{$key->phone}}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cs-media"> <i class="icon-envelope cs-color"></i> </div>
                                            <div class="cs-text"> <span>Email Address</span>
                                                <p><a href="mailto:{{$key->email}}">{{$key->email}}</a></p>
                                            </div>
                                        </li>
										@endforeach
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="page-section" style="height:392px;">
                    <div class="cs-maps loader">
                        @foreach($contact as $contact)								
							<iframe width="100%" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $contact->address; ?>&output=embed"></iframe>
						@endforeach
                    </div>
                </div>
            </div>
            <!-- Main End --> 
            <!-- Main End --> 
@endsection