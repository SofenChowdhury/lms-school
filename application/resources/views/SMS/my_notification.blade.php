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
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table">
                                <tr>
                                    <th>From</th>
                                    <th>:</th>
                                    <td>{{$get_notification->teacher_name}}</td>
                                </tr>
                                <tr>
                                    <th>Sent Date</th>
                                    <th>:</th>
                                    <td>{{$get_notification->created_at}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 pull-right">
                            <table class="table">
                                <tr>
                                    <th>Class</th>
                                    <th>:</th>
                                    <td>{{$get_notification->class_name}}</td>
                                </tr>
                                <tr>
                                    <th>Deadline</th>
                                    <th>:</th>
                                    <td>{{$get_notification->assignment_deadline}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-center">{{$get_notification->assignment_title}}</h3>
                            <p>{{$get_notification->assignment_description}}</p>
                            <a href="{{asset('uploads'.'/'.$get_notification->assignment_file)}}" style="float: right;"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 50px;color: red;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection