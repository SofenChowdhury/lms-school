@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                 <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Update {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('chairman-message-web') }}" class="btn btn-primary  pull-right"> <i class="fa fa-list-alt"></i> {{ $title }} </a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitUpdateChairmanMessage') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($chairman_message as $chairman_message)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Title  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title"  value="{{ $chairman_message->title }}" placeholder="Title" class="form-control" >
                                    <input type="hidden" name="id"  value="{{ $chairman_message->id }}" placeholder="Title" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Short Description  </p>
                                </div>
                                <div class="col-md-10">
                                   <textarea name="short_description" class="summernote">{{ $chairman_message->short_description }}</textarea>
                                </div>
                            </div>   
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Description  </p>
                                </div>
                                <div class="col-md-10">
                                   <textarea name="description" class="summernote">{{ $chairman_message->description }}</textarea>
                                </div>
                            </div>                                    
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Chairman Image  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="file" id="dropify-event"  data-default-file="{{ asset('uploads/'.$chairman_message->image) }}"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Chairman Name  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="name"  value="{{ $chairman_message->name }}" placeholder="Chairman Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Designation  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="designation"  value="{{ $chairman_message->designation }}" placeholder="Designation" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Institute Name  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="institute_name"  value="{{ $chairman_message->institute_name }}" placeholder="Institute Name" class="form-control" required>
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
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection