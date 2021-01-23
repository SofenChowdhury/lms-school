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
                            <a href="{{ route('mission-vision-web') }}" class="btn btn-primary pull-right"> <i class="fa fa-list-alt"></i> {{ $title }} </a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitUpdateMissionVision') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($mission_vision as $mission_vision)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Mission Title  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title" value="{{ $mission_vision->title }}" placeholder="Title" class="form-control" >
                                    <input type="hidden" name="id" value="{{ $mission_vision->id }}" placeholder="Title" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Mission Description  </p>
                                </div>
                                <div class="col-md-10">
                                   <textarea name="description" class="summernote">{{ $mission_vision->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Vision Title  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title2"  value="{{ $mission_vision->title2 }}" placeholder="Title" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Vision Description  </p>
                                </div>
                                <div class="col-md-10">
                                   <textarea name="description2" class="summernote">{{ $mission_vision->description2 }}</textarea>
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