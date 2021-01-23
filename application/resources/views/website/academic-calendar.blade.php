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
                    @foreach($academic_calender as $key)
                        <h2>{{ $key->title }}</h2> 
                        <p>{!! $key->description !!}</p>
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