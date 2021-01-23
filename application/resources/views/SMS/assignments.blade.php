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
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add-assignment') }}" class="btn btn-primary  pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Teacher</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>File</th>
                                    <th>Deadline</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_assignment as $assignment)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$assignment->teacher_name}}</td>
                                    <td>{{$assignment->assignment_title}}</td>
                                    <td>{{substr($assignment->assignment_description,0,50)}}....</td>
                                    <td>{{$assignment->class_name}}</td>
                                    <td>{{$assignment->section_name}}</td>
                                    <td><a href="{{asset('uploads').'/'.$assignment->assignment_file}}" style="color: #b30451; text-align: center; font-size: 20px;" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
                                    <td>{{$assignment->assignment_deadline}}</td>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')
                                    <td class="actions">
                                        @if(Auth::user()->role == 'TEACHER')
                                        <a href="{{route('submited-assignment',['id'=>$assignment->assignment_id])}}" id="check_assignment"><button class="btn btn-sm btn-icon btn-pure btn-info on-default button-check"
                                        data-toggle="tooltip" data-original-title="Check Assignment"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
                                        @endif
                                        <a href="{{route('view_assignment',['id'=>$assignment->assignment_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="View"><i class="icon-eye" aria-hidden="true"></i></button></a>
                                        <a href="{{route('edit_assignment',['id'=>$assignment->assignment_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                        <a href="{{route('delete_assignment',['id'=>$assignment->assignment_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
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