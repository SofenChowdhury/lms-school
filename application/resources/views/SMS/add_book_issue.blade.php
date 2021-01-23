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
                            <a href="{{ route('book_issue_students') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                     @include('includes.messages')
                     <form  method="post" action="{{ route('submitBooksIssueFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Role* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="role" id="usertype" class="form-control">
                                        <option value="">Select Member</option>        
                                        <option value="Teacher">Teacher</option>        
                                        <option value="Student">Student</option>        
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="check" id="check">
                            <div class="col-md-12" id="TeacherID">
                               <div class="col-md-2">
                                    <p>Name* </p>
                                </div>
                                <div class="col-md-6" >
                                    <select  name="teacher_id" class="form-control">
                                        <option value="">Select Member</option>
                                    @foreach($manage_teacher as $teacher)
                                        <option value="{{$teacher->user_id}}">{{$teacher->teacher_name}}</option>
                                    @endforeach        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="StudentID">
                               <div class="col-md-2">
                                    <p>Name* </p>
                                </div>
                                <div class="col-md-6" >
                                    <select  name="student_id" class="form-control">
                                        <option value="">Select Member</option>
                                    @foreach($manage_student as $student)
                                        <option value="{{$student->user_id}}">{{$student->student_name}}, <span> Class: {{$student->class_name}},</span> <span> Section: {{$student->section_name}},</span><span> Roll: {{$student->student_roll_no}}</span></option>
                                    @endforeach        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Book Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="book_id" class="form-control">
                                        <option value="">Select Book</option>
                                        @foreach($manage_books as $books)
                                        <option value="{{$books->book_id}}">{{$books->book_name}}, {{$books->serial_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Category* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="section_category" class="form-control" >
                                </div>
                            </div> -->

                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Due Date* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="due_date" class="form-control" >
                                </div>
                            </div>

                            <!-- <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="note" class="form-control"></textarea>
                                </div>
                            </div> -->
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Issu Book</button>
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
            $('#StudentID').hide();   
            $('#TeacherID').hide();   
            $('#usertype').change(function(){
                var usertype = $('#usertype option:selected').val();

                if(usertype == 'Teacher'){
                     $('#StudentID').hide();    
                     $('#TeacherID').show();
                     $('#check').val("teacher");    
                }else{
                    $('#TeacherID').hide();
                    $('#StudentID').show();
                    $('#check').val("student");
                }

              });  
     
</script>
@endsection