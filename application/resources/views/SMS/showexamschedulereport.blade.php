@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Exam Name</th>
                                    <th>Subject</th>
                                    <th>Exam Date</th>
                                    <th>Exam Duration</th>
                                    <th>Room</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_exam_schedule as $exam_schedule)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$exam_schedule->exam_name}}</td>
                                    <td>{{$exam_schedule->subject_subject_name}}</td>
                                    <td>{{date('d-M-Y', strtotime($exam_schedule->schedule_date))}}</td>
                                    <td>{{date('h:m', strtotime($exam_schedule->start_time))}} To {{date('h:m', strtotime($exam_schedule->end_time))}}</td>
                                    <td>{{$exam_schedule->room}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection