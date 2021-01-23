@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
            @foreach($view_student as $v_student)
            <div class="card profile-header">
                <div class="body text-center">
                    <div class="profile-image mb-3"><img src="{{asset('uploads').'/'.$v_student->student_photo}}" class="rounded-circle" alt="" style="width:100%"></div>
                    <div>
                        <h4 class="mb-0"><strong>{{$v_student->student_name}}</strong></h4>
                        <h4 class="mb-0"><strong>{{$v_student->student_id}}</strong></h4>
                        <span>{{$v_student->student_address}}</span><br>
                        <span>Registeration : {{$v_student->student_register_no}}</span><br>
                        <span>Role number: {{$v_student->student_roll_no}}</span>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="card">
                @foreach($view_student as $v_student)
                <div class="header">
                    <h2 style="text-align: center;">Info</h2>
                </div>
                <div class="body">
                    <div>
                        <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $v_student->student_address }}&output=embed"></iframe>
                    </div>
                    <hr>
                    <small class="text-muted">Address: </small>
                    <p style="text-align:left">{{$v_student->student_address}}</p>
                    <hr>
                    <small class="text-muted">Email address: </small>
                    <p style="text-align:left"> {{$v_student->student_email}}</p>
                    <hr>
                    <small class="text-muted">Mobile: </small>
                    <p style="text-align:left">{{$v_student->student_phone}}</p>
                    <hr>
                    <small class="text-muted">Birth Date: </small>
                    <p class="m-b-0">{{$v_student->student_birthday}}</p>
                    <hr>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="body">
                    <h1 style="font-family: cursive;">Student's Profile</h1>
                </div>
            </div>
            <div class="tab-content padding-0">
                <div class="tab-pane blog-page active" id="Profile">
                    <div class="row clearfix text-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">
                                    <div class="row">
                                        @foreach($view_student as $v_student)
                                            
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Class </span>: {{$v_student->class_name}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Section </span>: {{$v_student->section_name}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Role number </span>: {{$v_student->student_roll_no}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Registeration </span>: {{$v_student->student_register_no}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Card no. </span>: {{$v_student->student_card_id}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Blood Group </span>: {{$v_student->student_blood_group}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Phone </span>: {{$v_student->student_phone}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Username </span>: {{$v_student->student_email}}</p>
                                            </div>
											<div class="col-md-6">
                                            
											<p style="text-align:left"> <span style="font-weight:bold;">Guardian </span>:
                                            {{$v_student->guardian_name}}</p>
                                            </div>
											<div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Guardian email </span>:
                                            {{$v_student->guardian_email}}</p>
                                            </div>
											<div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Father </span>:
                                            {{$v_student->guardian_fathers_name}}</p>
                                            </div>
											<div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Mother </span>:
                                            {{$v_student->guardian_mothers_name}}</p>
                                            </div>


                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Group </span>: {{$v_student->student_group}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Optional Subject </span>: {{$v_student->student_optional_subject}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Date of Birth </span>:
                                            {{$v_student->student_birthday}}</p>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Gender </span>:
                                            {{$v_student->student_gender}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Religion </span>: {{$v_student->student_religion}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">State </span>: {{$v_student->student_state}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Country </span>:
                                            {{$v_student->student_country}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Remarks </span>: {{$v_student->student_remarks}}</p>
                                            </div>
                                            
                                            
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Extra Activities </span>: {{$v_student->student_extra_curricular_activities}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="text-align:left"> <span style="font-weight:bold;">Address </span>: {{$v_student->student_address}}</p>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-lg-9">
                                                    <p style="text-align:left"> <span style="font-weight:bold;">Barcode </span>: {!! DNS1D::getBarcodeHTML($v_student->student_id, "C39",2,30,"#344857") !!}</p>
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
        </div>
    </div>
</div>
@endsection