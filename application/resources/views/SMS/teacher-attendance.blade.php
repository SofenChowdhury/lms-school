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
                            <a href="{{ route('add-teacher-attendance') }}" class="btn btn-primary  pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}
                            </a>
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
                                    <th>Attendence</th>
                                    <th>Date</th>
                                    @if(Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_teacher_attn as $attn)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset('uploads').'/'.$attn->teacher_photo}}" style="width: 100px;"></td>
                                    <td>{{$attn->teacher_name}}</td>
                                    <td>{{$attn->attndence}}</td>
                                    <td>{{date('d-M-Y', strtotime($attn->attn_date))}}</td>
                                    @if(Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        <a href="{{ route('delete_teacher_attn',['id'=>$attn->attn_id]) }}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
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