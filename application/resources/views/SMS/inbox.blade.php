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
                            <a href="{{ route('add_inbox') }}" class="btn btn-primary  pull-right"><i class="fa fa-plus-square"></i> Add {{ $title }}</a>
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
                                    <th>Title</th>
                                    <th>Class</th>
                                    <th>Short_description</th>
                                    <th>Description</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_inbox as $inbox)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$inbox->inbox_title}}</td>
                                    @if($inbox->class_id == 0)
                                    <td>{{" All "}}</td>
                                    @else
                                    <td>{{$inbox->class_name}}</td>
                                    @endif
                                    <td>{{$inbox->inbox_short_description}}</td>
                                    <td>{!!$inbox->inbox_message!!}</td>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        
                                        @if(Auth::user()->role == 'SUPPERADMIN')
                                        <a href="{{route('delete_inbox',['id'=>$inbox->id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
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