@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3">
            @foreach($manage_syllabuses as $v_syllabuses)
            <div class="card profile-header">
                <div class="body text-center">
                    <div class="profile-image mb-3"></div>
                    <div>
                        <h4 class="mb-0">
                        <strong>Class : {{$v_syllabuses->class_name}}</strong>
                        </h4>
                    </div>
                    <div class="mt-3">
                        <a href="{{asset('uploads').'/'.$v_syllabuses->sellabus_file}}" style="color: #b30451; text-align: center; font-size: 36px;" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </div>
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
                                        @foreach($manage_syllabuses as $v_syllabuses)
                                        <div class="col-md-12">
                                            <p style="text-align:left"> <span style="font-size: 20px;font-weight: bold;">Title </span>: {{$v_syllabuses->sellabus_title}}</p>
                                        </div>
                                        <div class="col-md-12">
                                            <p style="text-align:left"> <span style="font-size: 20px;font-weight: bold;">Description </span>: {{$v_syllabuses->sellabus_description}}</p>
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