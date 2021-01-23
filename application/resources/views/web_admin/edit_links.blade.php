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
                            <a href="{{ route('manage_links') }}" class="btn btn-primary pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateLinks') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($edit_links as $links)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2" >
                                        <p>Title  </p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="title" value="{{$links->title}}" placeholder="Title" class="form-control" >
                                        <input type="hidden" name="id" value="{{$links->id}}" placeholder="Title" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2" >
                                        <p>Links </p>
                                    </div>
                                    <div class="col-md-6">
                                         <input type="text" name="links" value="{{$links->links}}" placeholder="Short Description" class="form-control" >
                                    </div>
                                </div>
                            <br>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Update</button>
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