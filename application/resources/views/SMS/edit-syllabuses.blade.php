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
                            <a href="{{ route('syllabuses') }}" class="btn btn-primary pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    @foreach($manage_syllabuses as $syllabuses)
                    <form id="basic-form" action="{{route('updateSyllabusesForm')}}" method="post" validate enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Title* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="sellabus_title" value="{{$syllabuses->sellabus_title}}" class="form-control" >
                                    <input type="hidden" name="syllabi_id" value="{{$syllabuses->syllabi_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Description </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="sellabus_description" class="form-control" style="height: 200px;">{{$syllabuses->sellabus_description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>File* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="sellabus_file" value="{{$syllabuses->sellabus_file}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="sellabus_class_id" class="form-control">
                                        <option value="{{$syllabuses->class_id}}">{{$syllabuses->class_name}}</option>
                                        @foreach($classes as $key)
                                        <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                        @endforeach
                                    </select>
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
@endsection