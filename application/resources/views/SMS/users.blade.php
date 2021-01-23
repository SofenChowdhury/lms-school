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
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add-user') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Dasignation</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Roll</th>
                                    <th>Joining Date</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Dasignation</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Roll</th>
                                    <th>Joining Date</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($manage_user as $users)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset('uploads').'/'.$users->user_image}}" style="width: 100px;"></td>
                                    <td>{{$users->user_name}}</td>
                                    <td>{{$users->user_designation}}</td>
                                    <td>{{$users->user_email}}</td>
                                    <td>{{$users->user_phone}}</td>
                                    <td>{{$users->user_role}}</td>
                                    <td>{{date('d-M-Y', strtotime($users->user_join_date))}}</td>
                                    @if(Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        <a href="{{route('edit_user_profile',['id'=>$users->user_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                        
                                        <a href="{{route('delete_user',['id'=>$users->user_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Remove" id="delete"><i class="icon-trash" aria-hidden="true"></i></button></a>
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