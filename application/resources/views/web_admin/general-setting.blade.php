@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">            
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} </h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        @include('includes.messages')
                        <table id="tableid" class="table table-bordered table-hover">                                                                  
                            <tbody>
                                @foreach($setting as $key)
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $key->name }}</td>
                                </tr>
                                <tr>
                                    <td>Logo</td>
                                    <td><img src="{{ asset('uploads/'.$key->image) }}" style="width:100px;"></td>
                                </tr>
                                <tr>
                                    <td>Logo Banner</td>
                                    <td><img src="{{ asset('uploads/'.$key->logo_banner) }}" style="width:100px;"></td>
                                </tr>
                                <tr>
                                    <td>Banner</td>
                                    <td><img src="{{ asset('uploads/'.$key->banner) }}" style="width:100px;"></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $key->name }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $key->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $key->email }}</td>
                                </tr>
                                <tr>
                                    <td>Facebook Page Link</td>
                                    <td>{{ $key->fb_link }}</td>
                                </tr>
                                <tr>
                                    <td>Twitter Page Link</td>
                                    <td>{{ $key->twitter_link }}</td>
                                </tr>
                                <tr>
                                    <td>Google Plus Page Link</td>
                                    <td>{{ $key->google_plus_link }}</td>
                                </tr>
                                <tr>
                                    <td>Linkedin  link</td>
                                    <td>{{ $key->linkedin_link }}</td>
                                </tr>
                                <tr>
                                    <td>Action</td>                                            
                                    <td class="actions"> 
                                        <a href="{{ route('update-general-setting-web',['id'=>$key->id]) }}"><button class="btn btn-sm btn-default"
                                        data-toggle="tooltip" data-original-title="Edit" style="background-color: #4991b3;border:none;"><i class="icon-pencil" aria-hidden="true"></i> Edit</button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection