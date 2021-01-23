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
                            <a href="{{ route('notice-web') }}" class="btn btn-primary  pull-right"> <i class="fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitUpdateNotice') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($notice as $notice)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Title  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title"  value="{{ $notice->title }}" placeholder="Title" class="form-control" >
                                    <input type="hidden" name="id"  value="{{ $notice->id }}" placeholder="Title" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p> Image  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="file" id="dropify-event"  data-default-file="{{ asset('uploads/'.$notice->image) }}"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Short Description  </p>
                                </div>
                                <div class="col-md-6">
                                 <textarea name="short_description" class="summernote">{{ $notice->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Description  </p>
                                </div>
                                <div class="col-md-10">
                                   <textarea name="description" class="summernote">{{ $notice->description }}</textarea>
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