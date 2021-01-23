@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4">
            <div class="card profile-header">
                @foreach($teachers as $key)
                <div class="body text-center">
                    <div class="profile-image mb-3"><img src="{{ asset('uploads/'.$key->teacher_photo) }}" style="width: 100%" class="rounded-circle" alt=""></div>
                    <div>
                        <h4 class="mb-0"><strong>{{ $key->teacher_name }}</strong></h4>
                        <p>{{ $key->teacher_designation }}</p>
                        <p style="margin-top: -12px;">99999{{ $key->teacher_id }}</p>
                        <p><center>{!! DNS1D::getBarcodeHTML($key->teacher_id, "C39",2,20,"#344857") !!}</center></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="card">
                <div class="body">
                    <h1 style="font-family: cursive;">Teacher's Profile</h1>
                </div>
            </div>
            <div class="tab-content padding-0">
                <div class="tab-pane blog-page active" id="Profile">
                    <div class="row clearfix text-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">
                                    @foreach($teachers as $key)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Date of Birth </span>:
                                        {{ $key->teacher_birthday }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Joining Date </span>:
                                            {{ $key->teacher_joining_date }}</p>
                                         </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Gender </span>:
                                        {{ $key->teacher_gender }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Blood Group </span>: {{ $key->teacher_blood_group }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Religion </span>: {{ $key->teacher_religion }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Email </span>: {{ $key->teacher_email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>ID Card </span>: {{ $key->teacher_card_id }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Phone </span>: {{ $key->teacher_phone }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>State </span>: {{ $key->teacher_state }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Country </span>:
                                            {{ $key->teacher_country }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Address </span>: {{ $key->teacher_address }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card">
                @foreach($teachers as $key)
                <div class="header">
                    <h2>Info</h2>
                </div>
                <div class="body">
                    <small class="text-muted">Address: </small>
                    <p style="text-align:left"> {{ $key->teacher_address }}</p>
                    <div>
                        <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $key->teacher_address }}&output=embed"></iframe>
                    </div>
                    <hr>
                    <small class="text-muted">Email address: </small>
                    <p style="text-align:left"> {{ $key->teacher_email }}</p>
                    <hr>
                    <small class="text-muted">Mobile: </small>
                    <p style="text-align:left"> {{ $key->teacher_phone }}</p>
                    <hr>
                    <small class="text-muted">Birth Date: </small>
                    <p class="m-b-0">{{ $key->teacher_birthday }}</p>
                    <hr>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>                
@endsection