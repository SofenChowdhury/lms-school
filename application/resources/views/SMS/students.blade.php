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
                            <a href="{{ route('add-student') }}" class="btn btn-primary  pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        @include('includes.messages')
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Roll</th>
                                    <th>ID</th>
                                    <th>Card no.</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Birthday</th>
                                    <th>Email</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_students as $students)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img src="{{asset('uploads').'/'.$students->student_photo}}" style="width: 75px; height: 90px;"></td>
                                    <td>{{$students->student_name}}</td>
                                    <td>{{$students->student_roll_no}}</td>
                                    <td>{{$students->student_id}}</td>
                                    <td>{{$students->student_card_id}}</td>
                                    <td>{{$students->class_name}}</td>
                                    <td>{{$students->section_name}}</td>
                                    <td>{{date('d-M-Y', strtotime($students->student_birthday))}}</td>
                                    <td>{{$students->student_email}}</td>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        <a href="{{ route('student-details',['id'=>$students->student_id]) }}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                        data-toggle="tooltip" data-original-title="View" ><i class="icon-eye" aria-hidden="true"></i></a>
                                        <a href="{{route('edit_student',['id'=>$students->user_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                        @if(Auth::user()->role == 'SUPPERADMIN')
                                        <a href="{{ route('delete_student',['id'=>$students->user_id]) }}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
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