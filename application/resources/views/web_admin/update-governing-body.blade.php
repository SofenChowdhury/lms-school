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
                            <a href="{{ route('governing-body-web') }}" class="btn btn-primary pull-right"> <i class="fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitUpdateGoverningBody') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($governing_body as $governing_body)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Name  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="name"  value="{{ $governing_body->name }}" placeholder="Title" class="form-control" >
                                    <input type="hidden" name="id"  value="{{ $governing_body->id }}" placeholder="Title" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Photo  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="file" id="dropify-event"  data-default-file="{{ asset('uploads/'.$governing_body->image) }}"  >
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Designation  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="designation"  value="{{ $governing_body->designation }}" placeholder="Title" class="form-control" >
                                    
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