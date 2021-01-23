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
                                @foreach($manage_teacher as $teacher)
                                    <div class="box_">
                                        <br>
                                        <div class="col-md-3">
                                            <img class="" src="{{asset('uploads').'/'.$teacher->teacher_photo}}" alt=""  style="height: 200px; width: 200px; border:5px solid white;box-shadow: 1px 0px 5px 0px rgba(0,0,0,0.75);" />

                                            <address style="margin-top: 20px;">
                                                <strong>{{$teacher->teacher_name}}</strong>
                                                <br>
                                                {{$teacher->teacher_designation}}
                                                <br>
                                                {{$teacher->teacher_address}}
                                                <br>
                                                {{$teacher->teacher_birthday}}
                                            </address>
                                        </div>
                                        <div class="col-md-9">
                                            <table class="table">
                                                <tr>
                                                    <th>Teacher Name</th>
                                                    <th>:</th>
                                                    <th>{{$teacher->teacher_name}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Teacher Email</th>
                                                    <th>:</th>
                                                    <th>{{$teacher->teacher_email}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Teacher Phone</th>
                                                    <th>:</th>
                                                    <th>{{$teacher->teacher_phone}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Teacher Gender</th>
                                                    <th>:</th>
                                                    <th>{{$teacher->teacher_gender}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Teacher Blood</th>
                                                    <th>:</th>
                                                    <th>{{$teacher->teacher_blood_group}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Teacher Religion</th>
                                                    <th>:</th>
                                                    <th>{{$teacher->teacher_religion}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Teacher Birthday</th>
                                                    <th>:</th>
                                                    <th style="color: #3a7698;">{{date('d-M-Y', strtotime($teacher->teacher_joining_date))}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Teacher Country</th>
                                                    <th>:</th>
                                                    <th>{{$teacher->teacher_country}}</th>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <h4 class="quick-navigation">Quick Navigation</h4>
                                <div class="widget cs-widget-links">
                                    <ul>
                                        <li><a class="{{ request()->is('dress-code') ? 'ctg_active ' : '' }}" href="{{ route('dress-code-page') }}">Dress Code</a></li>
                                        <li><a class="{{ request()->is('academic-calendar') ? 'ctg_active ' : '' }}" href="{{ route('academic-calendar-page') }}">Academic Calendar</a></li>
                                        <li><a class="{{ request()->is('book-list-and-syllabust') ? 'ctg_active ' : '' }}" href="{{ route('book-list-and-syllabus-page') }}">Book List & Syllabus</a></li>
                                        <li><a class="{{ request()->is('class-routine') ? 'ctg_active ' : '' }}" href="{{ route('class-routine-page') }}">Class Routine</a></li>
                                        <li><a class="{{ request()->is('exam-routine') ? 'ctg_active ' : '' }}" href="{{ route('exam-routine-page') }}">Exam Routine</a></li>
                                        <li><a class="{{ request()->is('teachers-and-staffs') ? 'ctg_active ' : '' }} || {{ request()->is('teacher-details-page/*') ? 'ctg_active ' : '' }}" href="{{ route('teachers-and-staffs-page') }}">Teachers and Staffs</a></li>
                                    </ul>              
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main End --> 
@endsection