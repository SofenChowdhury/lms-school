@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('marks') }}" class="btn btn-primary  pull-right">  <i class="fa fa fa-list-alt"></i>  {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form id="basic-form" action="{{route('give_marks')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Exam *</label>
                                    <select  name="exam_id" class="form-control" id="exam_id">
                                        @foreach($manage_exam as $current_exam)
                                        <option value="{{$current_exam->exam_id}}">{{$current_exam->exam_name}}</option>
                                        @endforeach
                                        @foreach($exam as $key)
                                        <option value="{{$key->exam_id}}">{{$key->exam_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Class *</label>
                                    <select  name="class_id" class="form-control" id="class_id">
                                        @foreach($manage_class as $current_class)
                                        <option value="{{$current_class->class_id}}">{{$current_class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Subject *</label>
                                    <select  name="subject_id" class="form-control" id="subject_id">
                                        @foreach($manage_subject as $current_subject)
                                        <option value="{{$current_subject->subject_id}}">{{$current_subject->subject_subject_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 pull-right">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default m-t-10 pull-right">Show</button>
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
                            <a href="{{ route('marks') }}" class="btn btn-primary pull-right">{{ $title }} List</a>
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
                                    <h4 style="text-align: center; padding-top: 10px; font-family: cursive;">Marks Details</h4>
                                    <hr>
                                    <table class="table" style="width: 100%; position: relative;">
                                        @foreach($manage_class as $class)
                                        <tr style="line-height: 8px;">
                                            <td>Class</td>
                                            <td>:</td>
                                            <td>{{$class->class_name}}</td>
                                        </tr>
                                        @endforeach
                                        @foreach($manage_exam as $exam)
                                        <tr style="line-height: 8px;">
                                            <td>Exam</td>
                                            <td>:</td>
                                            <td>{{$exam->exam_name}}</td>
                                        </tr>
                                        @endforeach
                                        @foreach($manage_subject as $subject)
                                        <tr style="line-height: 8px;">
                                            <td>Subject</td>
                                            <td>:</td>
                                            <td>{{$subject->subject_subject_name}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            @include('includes.messages')
                            <form action="{{route('save_marksForm')}}"  method="post">
                                @csrf()
                                <table id="" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>name</th>
                                            <th>Exam</th>
                                            <th>photo</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($give_marks as $marks)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td><input type="hidden" name="student_id[]" value="{{$marks->student_id}}">{{$marks->student_name}}</td>
                                            <td><input type="hidden" name="exam_id[]" value="{{$marks->exam_id}}">{{$marks->exam_name}}</td>
                                            <td><img src="{{asset('uploads').'/'.$marks->student_photo}}" style="width: 50px;"></td>
                                            <td><input type="hidden" name="class_id[]" value="{{$marks->class_id}}">{{$marks->class_name}}</td>
                                            <td><input type="hidden" name="subject_id[]" value="{{$marks->subject_id}}">{{$marks->subject_subject_name}}</td>
                                            <td>
                                                <div class=" col-md-6">
                                                    <label style="vertical-align:  middle;display: inline;">MCQ
                                                    </label>
                                                    <input type="number" class="form-control"  name="mcq_marks[]" value="0">
                                                </div>
                                                <div class=" col-md-6">
                                                    <label style="vertical-align:  middle;display: inline;">CQ
                                                    </label>
                                                    <input type="number" class="form-control" name="theory_marks[]" value="0">
                                                </div>
                                                <div class=" col-md-6">
                                                    <label style="vertical-align:  middle;display: inline;">PR
                                                    </label>
                                                    <input type="number" class="form-control" name="pr_marks[]" value="0">
                                                </div>
                                                <div class=" col-md-6">
                                                    <label style="vertical-align:  middle;display: inline;">CA
                                                    </label>
                                                    <input type="number" class="form-control" name="ca_marks[]" value="0">
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button style="margin-top: 20px;" class="btn btn-default pull-right save_attendance">Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>
    $('#exam_id').change(function(){
        var exam_id = $('#exam_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ url('find-exam-schedule') }}"+'/'+exam_id,
                method: 'get',
                success: function(result){
                    $('#class_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Class</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#class_id").append(new Option(result[i].class_name, result[i].class_id));
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

                url: "{{ url('find-exam-subject') }}"+'/'+class_id,
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