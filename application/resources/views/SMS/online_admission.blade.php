@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Class</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_application as $application)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset('uploads').'/'.$application->student_photo}}" style="width: 80px; height: 80px;"></td>
                                    <td>{{$application->student_name}}</td>
                                    <td>{{$application->student_email}}</td>
                                    <td>{{$application->class_name}}</td>
                                    <td>{{$application->student_phone}}</td>
                                    <td>{{$application->student_address}}</td>
                                    <td><a href=""><button class="btn btn-info">Process ...</button></a></td>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        <a href="{{route('view_application',['id'=>$application->admission_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="View"><i class="icon-eye" aria-hidden="true"></i></button></a>
                                        @if(Auth::user()->role == 'SUPPERADMIN')
                                        <a href="{{route('delete_application',['id'=>$application->admission_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
                                        @endif
                                    </td>
                                    @endif
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