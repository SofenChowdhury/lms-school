@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Add {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('teacher-attendance') }}" class="btn btn-primary pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form id="basic-form" action="{{route('saveteacherForm')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6"><label>Date </label>
                                    <input type="date" name="date" value="{{$date}}" class="form-control" >
                                </div>
                                <div class="col-md-6">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-block btn-primary m-t-10 pull-right">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Add {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('teacher-attendance') }}" class="btn btn-primary  pull-right">{{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div style="background-color: #d9e0e6; border-radius: 5px; margin: 0px auto; height: 110%;">
                                    <h4 style="text-align: center; padding-top: 10px; font-family: cursive;">Attendance Details</h4>
                                    <hr>
                                    <table class="table" style="width: 100%; position: relative;">
                                        <tr style="line-height: 8px;">
                                            <td>Day</td>
                                            <td>:</td>
                                            <td>{{$date}}</td>
                                        </tr>
                                        <tr style="line-height: 8px;">
                                            <td>Date</td>
                                            <td>:</td>
                                            <td>{{date('D', strtotime($date))}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @include('includes.messages')
                            <form action="{{route('save_teacherAttendanceForm')}}"  method="post">
                            @csrf()
                                <table id="" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>name</th>
                                            <th>photo</th>
                                            <th>email</th>
                                            <th>Attndance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teacher_attendance as $attendance)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$attendance->teacher_name}}</td>
                                            <input type="hidden" name="date[]" value="{{$date}}">
                                            <td><img src="{{asset('uploads').'/'.$attendance->teacher_photo}}" style="width: 50px;"></td>
                                            <td><input type="hidden" name="teacher_email" value="name">{{$attendance->teacher_email}}</td>
                                            <td>
                                                <input type="checkbox" class="btn present" value="{{$attendance->teacher_id}}" name="teacher_id[]">
                                                <label style="vertical-align:  middle;display: inline;">Present
                                                </label>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button style="margin-top: 20px;" class="btn btn-success pull-right save_attendance">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection