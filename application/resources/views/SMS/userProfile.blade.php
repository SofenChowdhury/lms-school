@extends('layouts.SMS-APP')
@section('content')
        <div class="container-fluid">           
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    @if(Auth::user()->role == 'STUDENT')
                    @foreach($manage_user as $user)
                        <div class="card profile-header">
                            <div class="body text-center">
                                <div class="profile-image mb-3"><img src="{{asset('uploads').'/'.$user->student_photo}}" class="rounded-circle" alt="" style="width:100%"></div>
                                <div>
                                    <h4 class="mb-0"><strong></strong></h4>
                                    <span></span><br>
                                    <span>Registeration : {{$user->student_register_no}}</span><br>
                                    <span>Role number : {{$user->student_roll_no}}</span>
                                </div>                            
                            </div>
                        </div>
                    @endforeach
                    @elseif(Auth::user()->role == 'TEACHER')
                    @foreach($manage_user as $user)
                        <div class="card profile-header">
                            <div class="body text-center">
                                <div class="profile-image mb-3"><img src="{{asset('uploads').'/'.$user->teacher_photo}}" class="rounded-circle" alt="" style="width:100%"></div>
                                <div>
                                    <h4 class="mb-0"><strong></strong></h4>
                                    <span></span><br>
                                    <span>Designation : {{$user->teacher_designation}}</span><br>
                                    <span>Email : {{$user->teacher_email}}</span>
                                </div>                            
                            </div>
                        </div>
                    @endforeach
                @elseif(Auth::user()->role == 'PARENTS')
                    @foreach($manage_user as $user)
                        <div class="card profile-header">
                            <div class="body text-center">
                                <div class="profile-image mb-3"><img src="{{ asset('uploads/'.$user->guardian_photo) }}" style="width: 100%" class="rounded-circle" alt=""></div>
                                <div>
                                    <h4 class="mb-0"><strong></strong></h4>
                                    <span></span><br>
                                    <span>Email : {{$user->guardian_email}}</span><br>
                                </div>                            
                            </div>
                        </div>
                    @endforeach
                @elseif(Auth::user()->role == 'Admin')
                    @foreach($manage_user as $user)
                        <div class="card profile-header">
                            <div class="body text-center">
                                <div class="profile-image mb-3"><img src="{{asset('uploads').'/'.$user->user_image}}" class="rounded-circle" alt="" style="width:100%"></div>
                                <div>
                                    <h4 class="mb-0"><strong></strong></h4>
                                    <span></span><br>
                                    <span>Designation: {{$user->user_designation}}</span>
                                </div>                           
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($manage_user as $user)
                        <div class="card profile-header">
                            <div class="body text-center">
                                <div class="profile-image mb-3"><img src="{{asset('uploads').'/'.$user->user_image}}" class="rounded-circle" alt="" style="width:100%"></div>
                                <div>
                                    <h4 class="mb-0"><strong></strong></h4>
                                    <span></span><br>
                                    <span>Designation: {{$user->user_designation}}</span>
                                </div>                           
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="col-lg-8 col-md-12">
                    <div class="tab-content padding-0">
                        <div class="tab-pane blog-page active" id="Profile">
                            <div class="row clearfix text-center">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="body">
                                           <div class="row">
                                            @if(Auth::user()->role == 'STUDENT')
                                            @foreach($manage_user as $user)
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Student Name </span>: {{$user->student_name}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Date of Birth </span>: {{$user->student_birthday}}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Gender </span>: {{$user->student_gender}}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Class </span>: {{$user->class_name}}</p> 
                                                </div>
                                                 <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Registeration </span>: {{$user->student_register_no}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Role number </span>: {{$user->student_roll_no}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Section </span>: {{$user->section_name}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Blood Group </span>: {{$user->student_blood_group}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Religion </span>: {{$user->student_religion}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Email </span>: {{$user->student_email}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Phone </span>: {{$user->student_phone}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>State </span>: {{$user->student_state}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Country </span>: {{$user->student_country}}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Remarks </span>: {{$user->student_remarks}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Extra Activities </span>: {{$user->student_extra_curricular_activities}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Address </span>: {{$user->student_address}}</p>
                                                </div>
                                            @endforeach
                                            @elseif(Auth::user()->role == 'TEACHER')
                                            @foreach($manage_user as $user)
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Group </span>: {{$user->teacher_name}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Date of Birth </span>: {{$user->teacher_birthday}}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Gender </span>: {{$user->teacher_gender}}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Blood Group </span>: {{$user->teacher_blood_group}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Religion </span>: {{$user->teacher_religion}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Email </span>: {{$user->teacher_email}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Phone </span>: {{$user->teacher_phone}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>State </span>: {{$user->teacher_state}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Country </span>: {{$user->teacher_country}}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="text-align:left"> <span>Address </span>: {{$user->teacher_address}}</p>
                                                </div>
                                            @endforeach
                                            @elseif(Auth::user()->role == 'PARENTS')
                                                @foreach($manage_user as $user)
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Name </span>: {{$user->guardian_name}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Father`s Name </span>: {{$user->guardian_fathers_name}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Mother`s Name </span>: {{$user->guardian_mothers_name}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Address</span>: {{$user->guardian_address}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Email </span>: {{$user->guardian_email}}</p>
                                                    </div>
                                                    
                                                @endforeach
                                            @elseif(Auth::user()->role == 'Admin')
                                                @foreach($manage_user as $user)
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Group </span>: {{$user->user_name}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Date of Birth </span>: {{$user->user_birthday}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Gender </span>: {{$user->user_gender}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Blood Group </span>: {{$user->user_blood_group}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Religion </span>: {{$user->user_religion}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Email </span>: {{$user->user_email}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Phone </span>: {{$user->user_phone}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Address </span>: {{$user->user_address}}</p>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach($manage_user as $user)
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Group </span>: {{$user->user_name}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Date of Birth </span>: {{$user->user_birthday}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Gender </span>: {{$user->user_gender}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Blood Group </span>: {{$user->user_blood_group}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Religion </span>: {{$user->user_religion}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Email </span>: {{$user->user_email}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Phone </span>: {{$user->user_phone}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align:left"> <span>Address </span>: {{$user->user_address}}</p>
                                                    </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>                    
                </div>
            <div class="col-lg-12">
                    <div class="card">
                        
                        <div class="header">
                                <h2 style="text-align: center;">Info</h2>
                        </div>
                    @if(Auth::user()->role == 'STUDENT')
                    @foreach($manage_user as $user)
                        <div class="body">
                            <div>
                                <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $user->student_address }}&output=embed"></iframe>
                            </div>
                            <hr>
                            <small class="text-muted">Address: {{ $user->student_address }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                            <small class="text-muted">Email address: {{ $user->student_email }}</small>
                            <p style="text-align:left"></p>                            
                            <hr>
                            <small class="text-muted">Mobile: {{ $user->student_phone }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                        </div>
                    @endforeach
                    @elseif(Auth::user()->role == 'TEACHER')
                    @foreach($manage_user as $user)
                        <div class="body">
                            <div>
                                <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $user->teacher_address }}&output=embed"></iframe>
                            </div>
                            <hr>
                            <small class="text-muted">Address: {{ $user->teacher_address }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                            <small class="text-muted">Email address: {{ $user->teacher_email }}</small>
                            <p style="text-align:left"></p>                            
                            <hr>
                            <small class="text-muted">Mobile: {{ $user->teacher_phone }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                        </div>
                @endforeach
                @elseif(Auth::user()->role == 'PARENTS')
                    @foreach($manage_user as $user)
                        <div class="body">
                            <div>
                                <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $user->guardian_address }}&output=embed"></iframe>
                            </div>
                            <hr>
                            <small class="text-muted">Address: {{ $user->guardian_address }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                            <small class="text-muted">Email address: {{ $user->guardian_email }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                        </div>
                    @endforeach
                @elseif(Auth::user()->role == 'Admin')
                    @foreach($manage_user as $user)
                        <div class="body">
                            <div>
                                <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $user->user_address }}&output=embed"></iframe>
                            </div>
                            <hr>
                            <small class="text-muted">Address: {{ $user->user_address }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                            <small class="text-muted">Email address: {{ $user->user_email }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                            <small class="text-muted">Phone: {{ $user->user_phone }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                        </div>
                    @endforeach
                @else
                    @foreach($manage_user as $user)
                        <div class="body">
                            <div>
                                <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ $user->user_address }}&output=embed"></iframe>
                            </div>
                            <hr>
                            <small class="text-muted">Address: {{ $user->user_address }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                            <small class="text-muted">Email address: {{ $user->user_email }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                            <small class="text-muted">Phone: {{ $user->user_phone }}</small>
                            <p style="text-align:left"></p>
                            <hr>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>      
        </div>
    </div>
@endsection