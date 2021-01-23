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
                            <a href="{{ route('book_issue_students') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateBooksIssuestudentFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_issue_student as $issue)
                        <div class="row">
                            <div class="col-md-12" id="StudentID">
                                <div class="col-md-2">
                                    <p>Name* </p>
                                </div>
                                <div class="col-md-6" >
                                    <select  name="user_id" class="form-control">
                                        <option value="{{$issue->user_id}}">{{$issue->student_name}}</option>
                                        @foreach($manage_student as $student)
                                        <option value="{{$student->user_id}}">{{$student->student_name}}, <spen>Class: {{$student->class_name}}</spen>, <spen>Section: {{$student->section_name}}</spen>, <spen>Roll: {{$student->student_roll_no}}</spen></option>
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
                                        <option value="{{$issue->book_id}}">{{$issue->book_name}}</option>
                                        @foreach($manage_books as $books)
                                        <option value="{{$books->book_id}}">{{$books->book_name}}, {{$books->serial_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Due Date* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="due_date" class="form-control" value="{{$issue->due_date}}" >
                                    <input type="hidden" name="issu_id" class="form-control" value="{{$issue->issu_id}}" >
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection