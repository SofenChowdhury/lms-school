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
                            <a href="{{ route('admission-policy-web') }}" class="btn btn-primary  pull-right"> <i class="fa fa-list-alt"></i> {{ $title }} </a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitUpdateAdmissionPolicyInfo') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($admission_policy_info as $admission_policy_info)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Title  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title"  value="{{ $admission_policy_info->title }}" placeholder="Title" class="form-control" >
                                    <input type="hidden" name="id"  value="{{ $admission_policy_info->id }}" placeholder="Title" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p> Image  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="file" id="dropify-event"  data-default-file="{{ asset('uploads/'.$admission_policy_info->image) }}"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Short Description  </p>
                                </div>
                                <div class="col-md-6">
                                 <textarea name="short_description" class="summernote">{{ $admission_policy_info->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Description  </p>
                                </div>
                                <div class="col-md-10">
                                   <textarea name="description" class="summernote">{{ $admission_policy_info->description }}</textarea>
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