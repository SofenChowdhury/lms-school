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
                            <a href="{{ route('add_markpercentage') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-square"></i> Add {{ $title }}</a>
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
                                    <th>Mark Distribution Type</th>
                                    <th>Mark value</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_marks_per as $marks_per)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$marks_per->distribution_type}}</td>
                                    <td>{{$marks_per->distribution_value}}</td>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        <a href="{{route('edit_per',['id'=>$marks_per->mark_per_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                        @if(Auth::user()->role == 'SUPPERADMIN')
                                        <a href="{{route('delete_per',['id'=>$marks_per->mark_per_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
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