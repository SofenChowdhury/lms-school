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
                            <a href="{{ route('add_company_paid') }}" class="btn btn-primary  pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
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
                                    <th>User_name</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Recived</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_payment as $payment)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$payment->user_name}}</td>
                                    <td>{{$payment->title}}</td>
                                    <td>{{$payment->amount}}</td>
                                    @php
                                    $manage_mm = DB::connection('mysql2')
                                    ->table('mms')
                                    ->where('id',$payment->mm_id)
                                    ->get();
                                    @endphp
                                    @foreach($manage_mm as $mm_name)
                                    <td>{{$mm_name->name}}</td>
                                    @endforeach
                                    <td>{{$payment->description}}</td>
                                    @if($payment->status == 0)
                                    <td><button class="btn btn-danger">{{'Not Paid'}}</button></td>
                                    @else($payment->status == 1)
                                    <td><button class="btn btn-success">{{'Paid'}}</button></td>
                                    @endif
                                    <td>{{$payment->created_at->format('d-M-Y')}}</td>
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