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
                                <h2>Book List & Syllabus</h2>
                                @foreach($manage_books as $book)
                                <div class="col-md-4">
                                    <table class="table" style="text-align: center;">
                                        <tr>
                                            <th style="text-align: center; color: white; background-color: #3a7698;">{{$book->class_name}}</th>
                                        </tr>
                                        @php
                                            $manage_subject = DB::table('subjects')
                                                    ->where('school_id',$school_id)
                                                    ->where('subject_class_id',$book->class_id)
                                                    ->get();
                                            $manage_syllabus = DB::table('syllabi')
                                                        ->where('school_id',$school_id)
                                                        ->where('sellabus_class_id',$book->class_id)
                                                        ->get();        
                                        @endphp            
                                        @foreach($manage_subject as $subjects)
                                        <tr><td>{{$subjects->subject_subject_name}}</td></tr>
                                        @endforeach

                                        @foreach($manage_syllabus as $syllabus)
                                        <tr><td></td></tr>
                                        <tr><td style="color: white; background-color: #3a7698;"><a href="{{asset('uploads').'/'.$syllabus->sellabus_file}}" target="_blank" style="text-decoration: none; color: white;">Download Syllabus here</a></td></tr>
                                        @endforeach

                                    </table>
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
                                        <li><a class="{{ request()->is('teachers-and-staffs') ? 'ctg_active ' : '' }}" href="{{ route('teachers-and-staffs-page') }}">Teachers and Staffs</a></li>
                                    </ul>              
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main End --> 
@endsection