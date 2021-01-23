@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Search {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('hostel_members') }}" class="btn btn-primary  pull-right">  <i class="fa fa fa-list-alt"></i>  {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form id="basic-form" action="{{route('ShowHostelMembers')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Hostel Name </label>
                                    <select  name="hostel_id" class="form-control">
                                        @foreach($manage_hostel as $curent_hostel)
                                        <option value="{{$curent_hostel->hostel_id}}">{{$curent_hostel->hostel_name}}</option>
                                        @endforeach
                                        @foreach($hostel as $key)
                                        <option value="{{$key->hostel_id}}">{{$key->hostel_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Class </label>
                                    <select  name="class_id" class="form-control">
                                        @foreach($manage_class as $curent_class)
                                        <option value="{{$curent_class->class_id}}">{{$curent_class->class_name}}</option>
                                        @endforeach
                                        @foreach($class as $key)
                                        <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('hostel_members') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                
                                <div style="background-color: #d9e0e6; border-radius: 5px; margin: 0px auto; height: 110%;">
                                    <h4 style="text-align: center; padding-top: 10px; font-family: cursive;">Hostel Members</h4>
                                    <hr>
                                    <table class="table" style="width: 100%; position: relative;">
                                        @foreach($manage_class as $class)
                                        <tr style="line-height: 8px;">
                                            <td>Class</td>
                                            <td>:</td>
                                            <td>{{$class->class_name}}</td>
                                        </tr>
                                        @endforeach
                                        @foreach($manage_hostel as $hostel)
                                        <tr style="line-height: 8px;">
                                            <td>Hostel</td>
                                            <td>:</td>
                                            <td>{{$hostel->hostel_name}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            @include('includes.messages')
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>photo</th>
                                        <th>Class</th>
                                        <th>Room</th>
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($manage_members as $members)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$members->student_name}}</td>
                                        <td><img src="{{asset('uploads').'/'.$members->student_photo}}" style="width: 50px;"></td>
                                        <td>{{$members->class_name}}</td>
                                        <td>{{$members->room}}</td>
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <td class="actions">
                                            <a href="{{route('edit_member',['id'=>$members->host_member_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                            data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_member',['id'=>$members->host_member_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
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
</div>
@endsection