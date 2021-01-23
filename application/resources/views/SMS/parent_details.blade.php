@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4">
            <div class="card profile-header">
                @foreach($manage_parents as $key)
                <div class="body text-center">
                    <div class="profile-image mb-3"><img src="{{ asset('uploads/'.$key->guardian_photo) }}" style="width: 100%" class="rounded-circle" alt=""></div>
                    <div>
                        <h4 class="mb-0"><strong>{{ $key->guardian_name }}</strong></h4>
                        <span>{{ $key->guardian_email }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="body">
                    <h1 style="font-family: cursive;">Parent's Details</h1>
                </div>
            </div>
            <div class="tab-content padding-0">
                <div class="tab-pane blog-page active" id="Profile">
                    <div class="row clearfix text-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">
                                    @foreach($manage_parents as $key)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>father`s Name</span>:
                                        {{ $key->guardian_fathers_name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Guardian Mother`s Name</span>:
                                        {{ $key-> guardian_mothers_name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Father`s Profession</span>: {{ $key->guardian_fathers_profession }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Mother`s profession</span>: {{ $key->guardian_mothers_profession }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Address</span>: {{ $key->guardian_address }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Email </span>: {{ $key->guardian_email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Phone </span>: {{ $key->guardian_phone }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align:left"> <span>Country</span>: {{ $key->guardian_country }}</p>
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
                @foreach($manage_parents as $key)
                <div class="header">
                    <h2>Info</h2>
                </div>
                <div class="body">
                    <small class="text-muted">Address: </small>
                    <p style="text-align:left"> {{ $key->guardian_address }}</p>
                    <div>
                        <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $key->guardian_address }}&output=embed"></iframe>
                    </div>
                    <hr>
                    <small class="text-muted">Email address: </small>
                    <p style="text-align:left"> {{ $key->guardian_email }}</p>
                    <hr>
                    <small class="text-muted">Mobile: </small>
                    <p style="text-align:left"> </p>
                    <hr>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection