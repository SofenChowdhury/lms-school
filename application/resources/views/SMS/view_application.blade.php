@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3">
            @foreach($manage_application as $v_application)
            <div class="card profile-header">
                <div class="body text-center">
                    <div class="profile-image mb-3"></div>
                    <div class="mt-3">
                        <img src="{{asset('uploads').'/'.$v_application->student_photo}}" style="width: 100%;">
                        <input type="hidden" name="student_photo" value="{{$v_application->student_photo}}">
                    </div>
                    <h5 style="padding-top: 10px;">Class : {{$v_application->class_name}} <input type="hidden" name="class_id" value="{{$v_application->class_id}}"></h5>
                    <p><b>Student Group :</b> {{$v_application->student_group}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-9 col-md-9">
            <div class="tab-content padding-0">
                <div class="tab-pane blog-page active" id="Profile">
                    <div class="row clearfix text-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">
                                    <div class="row">
                                        
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="border:1px solid lightgray; overflow-x: scroll;">
                                            <table class="table">
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Email</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_email}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Phone</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_phone}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Birthday</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_birthday}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Gender</th>
                                                    <th>:</th>
                                                    @if($v_application->student_gender == 'F')
                                                    <td>Female</td>
                                                    @elseif($v_application->student_gender == 'M')
                                                    <td>Male</td>
                                                    @else
                                                    <td>Other</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Student Blood Group</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_blood_group}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Religion</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_religion}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th>Student Group</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_group}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Country</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_country}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Address</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_address}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="border:1px solid lightgray; overflow-x: scroll;">
                                            <table class="table">
                                                <tr>
                                                    <th>Student Gurdian</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_gurdian}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Gurdian Country</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_gurdian_country}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Gurdian Email</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_gurdian_email}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Gurdian photo</th>
                                                    <th>:</th>
                                                    <td><img src="{{asset('uploads').'/'.$v_application->student_gurdian_photo}}" style="width: 80px; height: 80px;"></td>
                                                </tr>
                                                <tr>
                                                    <th>Student Gurdian Profession</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_gurdian_profession}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Student Gurdian Address</th>
                                                    <th>:</th>
                                                    <td>{{$v_application->student_gurdian_address}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{route('submitOnlineApplicationForm',['id'=>$v_application->admission_id])}}"><button class="btn btn-primary">Process Online Application</button></a>
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
</div>
@endsection