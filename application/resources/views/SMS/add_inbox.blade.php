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
                            <a href="{{ route('inbox') }}" class="btn btn-primary  pull-right"> <i class="fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitInboxFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Type* </p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="type">
                                        <option value="0">Ofline Message</option>
                                        <option value="1">Online Message</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>TO* </p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="role" id="messagetype">
                                        <option value="">Select whome to Message</option>
                                        <option value="Parent">Parent</option>
                                        <option value="Student">Student</option>
                                        <option value="Teacher">Teacher</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="ClassID">
                                <div class="col-md-2">
                                    <p>Class* </p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="class_id" id="clsas_id">
                                        <option value="0">All Class</option>
                                        @foreach($manage_class as $class)
                                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="ParentsID">
                                <div class="col-md-2">
                                    <p>Parents* </p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="parents_id" id="parents_id">
                                        <option value="">Select Parents</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="StudentID">
                                <div class="col-md-2">
                                    <p>Students* </p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="student_id" id="student_id">
                                        <option value="">Select Students</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="TeacherID">
                                <div class="col-md-2">
                                    <p>Teachers* </p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="teacher_id">
                                        <option value="0">All Teachers</option>
                                        @foreach($manage_teacher as $teacher)
                                        <option value="{{$teacher->teacher_id}}">{{$teacher->teacher_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Title* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="inbox_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Short Description* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="short_description" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Message </p>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="message" class="summernote"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
</script>
<script>  
    $('#ParentsID').hide();   
    $('#StudentID').hide();   
    $('#TeacherID').hide();   
    $('#ClassID').hide();   
    $('#messagetype').change(function(){
        var message = $('#messagetype option:selected').val();
        if(message == 'Parent'){
            $('#StudentID').hide();    
            $('#TeacherID').hide();    
            $('#ClassID').show();    
            $('#ParentsID').show();    
        }else if(message == 'Student'){
            $('#ParentsID').hide();
            $('#TeacherID').hide();
            $('#ClassID').show();
            $('#StudentID').show();
        }else if(message == 'Teacher'){
            $('#ParentsID').hide();
            $('#StudentID').hide();
            $('#ClassID').hide();
            $('#TeacherID').show();
        }

    });     

    $('#clsas_id').change(function(){
        var clsas_id = $('#clsas_id option:selected').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({

            url: "{{ url('find-students') }}"+'/'+class_id,
            method: 'get',
            success: function(result){
                $('#student_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="0">All Student</option>');
                for ( var i = 0, l = result.length; i < l; i++ ) {
                    $("#student_id").append(new Option(result[i].student_name, result[i].student_id));
                }
            }
        });
    });
    $('#clsas_id').change(function(){
        var clsas_id = $('#clsas_id option:selected').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('find-parents') }}"+'/'+class_id,
            method: 'get',
            success: function(result){
                $('#parents_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="0">All Parents</option>');
                for ( var i = 0, l = result.length; i < l; i++ ) {
                    $("#parents_id").append(new Option(result[i].guardian_name, result[i].parents_id));
                }
            }
        });
    });
</script>
@endsection