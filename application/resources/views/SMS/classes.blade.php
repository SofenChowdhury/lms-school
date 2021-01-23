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
                            <a href="{{ route('add-class') }}" class="btn btn-primary  pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
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
                                    <th>Class Name</th>
                                    <th>Class Numeric</th>
                                    <th>Class Teacher</th>
                                    <th>Note</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classes as $key)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $key->class_name }}</td>
                                    <td>{{ $key->class_numeric }}</td>
                                    <td>{{ $key->teacher_name }}</td>
                                    <td>{{substr( $key->class_note, 0,50) }}</td>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        <a href="{{route('edit_class',['id'=>$key->class_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                        @if(Auth::user()->role == 'SUPPERADMIN')
                                        <a href="{{route('delete_class',['id'=>$key->class_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
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