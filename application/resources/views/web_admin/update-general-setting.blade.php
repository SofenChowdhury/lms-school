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
                            <a href="{{ route('general-setting-web') }}" class="btn btn-primary pull-right"> <i class="fa fa-list-alt"></i> {{ $title }}</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitUpdateGeneralSetting') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($setting as $setting)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Name  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="name"  value="{{ $setting->name }}" placeholder="Name" class="form-control" >
                                    <input type="hidden" name="id"  value="{{ $setting->id }}" placeholder="Title" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p> Logo  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="file" id="dropify-event"  data-default-file="{{ asset('uploads/'.$setting->image) }}"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p> Top Logo Banner </p>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset('uploads/'.$setting->logo_banner) }}" style="width: 40%;">
                                    <input type="file" name="logo_banner" id="dropify-event"  data-default-file="{{ asset('uploads/'.$setting->logo_banner) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p> Banner  </p>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset('uploads/'.$setting->banner) }}" style="width: 40%;">
                                    <input type="file" name="banner" id="dropify-event"  data-default-file="{{ asset('uploads/'.$setting->banner) }}"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Address  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="address"  value="{{ $setting->address }}" placeholder="Address" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Phone  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone"  value="{{ $setting->phone }}" placeholder="Phone" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Email  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="email"  value="{{ $setting->email }}" placeholder="Email" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Facebook Page Link  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="fb_link"  value="{{ $setting->fb_link }}" placeholder="Facebook Page Link" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Twitter Page Link  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="twitter_link"  value="{{ $setting->twitter_link }}" placeholder="Twitter Page Link" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Google Plus Page Link  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="google_plus_link"  value="{{ $setting->google_plus_link }}" placeholder="Google Plus Page Link" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Linkedin page Link </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="linkedin_link"  value="{{ $setting->linkedin_link }}" placeholder="Google Plus Page Link" class="form-control" >
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