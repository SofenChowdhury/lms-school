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
                            <a href="{{ route('grade') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateGradeFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_grade as $grade)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Grade Name * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="grade_name" value="{{$grade->grade_name}}" class="form-control" >
                                    <input type="hidden" name="grade_id" value="{{$grade->grade_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Grade Point * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="grade_point" value="{{$grade->grade_point}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Mark From </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="mark" value="{{$grade->mark}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Mark Upto </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="min_mark" value="{{$grade->min_mark}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="grade_note" class="form-control">{{$grade->grade_note}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Update Grade</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection