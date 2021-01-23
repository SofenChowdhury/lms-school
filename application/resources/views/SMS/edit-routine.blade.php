@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Edit {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('routine') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    @foreach($manage_routine as $routine)
                    <form id="basic-form" action="{{route('updateRoutineForm')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>School Year * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="ac_year" value="{{$routine->ac_year}}" class="form-control" >
                                    <input type="hidden" name="routine_id" value="{{$routine->routine_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class_id" class="form-control" id="class_id">
                                        <option value="{{$routine->class_id}}">{{$routine->class_name}}</option>
                                        @foreach($classes as $key)
                                        <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Section  *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="section_id" class="form-control" id="section_id">
                                        <option value="{{$routine->section_id}}"> {{$routine->section_name}}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Subject *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="subject_id" class="form-control" id="subject_id">
                                        <option value="{{$routine->subject_id}}">{{$routine->subject_subject_name}}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Day  *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="day" class="form-control">
                                        <option value="{{$routine->day}}">{{$routine->day}}</option>
                                        <option value="Sat">SATURDAY</option>
                                        <option value="Sun">SUNDAY</option>
                                        <option value="Mon">MONDAY</option>
                                        <option value="Tue">TUESDAY</option>
                                        <option value="Wed">WEDNESDAY</option>
                                        <option value="Thu">THURSDAY</option>
                                        <option value="Fri">FRIDAY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Teacher * </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="subject_teacher_id" class="form-control" id="teacher_id">
                                        <option value="{{$routine->teacher_id}}">{{$routine->teacher_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Starting Time * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" name="start_time" value="{{$routine->start_time}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Ending Time * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" name="end_time" value="{{$routine->end_time}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Room * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="room" value="{{$routine->room}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="class_note" class="form-control">{{$routine->class_note}}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                    @endforeach
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
    $('#subject_id').change(function(){
        var subject_id = $('#subject_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ url('find-routine-teacher') }}"+'/'+subject_id,
                method: 'get',
                success: function(result){
                    $('#teacher_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Teacher</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#teacher_id").append(new Option(result[i].teacher_name, result[i].teacher_id));
                    }
                  }
              });
           });
</script>

@endsection