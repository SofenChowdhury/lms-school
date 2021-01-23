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
                            <a href="{{ route('examschedule') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateExamScheduleFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_exam_schedule as $exam_schedule)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Exam Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="exam_id" class="form-control">
                                        <option value="{{$exam_schedule->exam_id}}">{{$exam_schedule->exam_name}}</option>
                                        @foreach($manage_exam as $exam)
                                        <option value="{{$exam->exam_id}}">{{$exam->exam_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class_id" class="form-control" id="class_id">
                                        <option value="{{$exam_schedule->class_id}}">{{$exam_schedule->class_name}}</option>
                                        @foreach($manage_class as $class)
                                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Section * </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="section_id" class="form-control" id="section_id">
                                        <option value="{{$exam_schedule->section_id}}" >{{$exam_schedule->section_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Subject * </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="subject_id" class="form-control" id="subject_id">
                                        <option value="{{$exam_schedule->subject_id}}">{{$exam_schedule->subject_subject_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Date* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="schedule_date" value="{{$exam_schedule->schedule_date}}" class="form-control" >
                                    <input type="hidden" name="schedule_id" value="{{$exam_schedule->schedule_id}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Start Time* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" name="start_time" value="{{$exam_schedule->start_time}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>End Time* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" name="end_time" value="{{$exam_schedule->end_time}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Room No.* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="room" value="{{$exam_schedule->room}}" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Update Schedule</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>
    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find-routine-section') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#section_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Section</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#section_id").append(new Option(result[i].section_name, result[i].saction_id));
                    }
                  }
              });
           });

    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ url('find-routine-subject') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#subject_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Subject</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#subject_id").append(new Option(result[i].subject_subject_name, result[i].subject_id));
                    }
                  }
              });
           });
</script>        
@endsection