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
                            <a href="{{ route('library_members') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateLibraryStudentMemberFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_library_member as $key)
                        <div class="row">
                            <div class="col-md-12" id="StudentID">
                                <div class="col-md-2">
                                    <p>Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="student_id" class="form-control">
                                        <option value="{{$key->user_id}}">{{$key->student_name}}</option>
                                        @foreach($manage_student as $student)
                                        <option value="{{$student->user_id}}">{{$student->student_name}}, Roll : {{$student->student_roll_no}}, Class :{{$student->class_name}}, Section: {{$student->section_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Fees* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="member_fee" value="{{$key->member_fee}}" class="form-control" >
                                    <input type="hidden" name="member_id" value="{{$key->member_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="note" class="form-control">{{$key->note}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
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