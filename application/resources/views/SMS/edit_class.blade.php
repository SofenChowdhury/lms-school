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
                            <a href="{{ route('classes') }}" class="btn btn-primary pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateClassFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($edit_class as $class)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" value="{{$class->class_name}}" name="name" class="form-control" >
                                    <input type="hidden" value="{{$class->class_id}}" name="class_id" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class Numeric* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="numeric_name" value="{{$class->class_numeric}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class Teacher *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="teacher_id" class="form-control">
                                        <option value="{{ $class->class_teacher_id }}">{{ $class->teacher_name}}</option>
                                        @foreach($manage_teachers as $key)
                                        <option value="{{ $key->teacher_id }}">{{ $key->teacher_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="note" class="form-control" rows="5">{{$class->class_note}}</textarea>
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