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
                            <a href="{{ route('add_invoice') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-square"></i> Add {{ $title }}</a>
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
                                    <th>Class</th>
                                    <th>Student</th>
                                    <th>Paid</th>
                                    <th>Payable</th>
                                    <th>Due</th>
                                    <th>Date</th>
                                    <th>Payment Status</th>
                                    
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_invoice as $invoice)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$invoice->class_name}}</td>
                                    <td>{{$invoice->student_name}}</td>
                                    <td>{{$invoice->paid}}</td>
                                    @php
                                    $total = $invoice->total_fee;
                                    $discount = $total*($invoice->discount/100) ;
                                    $payable = $total-$discount;
                                    @endphp
                                    <td>{{$payable}}</td>
                                    <td>{{($payable-$invoice->paid)}}</td>
                                    <td>{{date('d-M-Y', strtotime($invoice->invoice_date))}}</td>
                                    <td>
                                        @if($payable-$invoice->paid <= '0')
                                        <button class="btn btn-info">Full Paid</button>
                                        @else
                                        <button class="btn btn-danger">Partially Paid</button>
                                        @endif
                                    </td>
                                    <td class="actions">
                                        <a href="{{route('view_invoice',['id'=>$invoice->fee_type_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-view"
                                        data-toggle="tooltip" data-original-title="View"><i class="icon-eye" aria-hidden="true"></i></button></a>
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <!--  <a href="{{route('edit_invoice',['id'=>$invoice->invoice_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a> -->
                                        @if(Auth::user()->role == 'SUPPERADMIN')
                                        <a href="{{route('delete_invoice',['id'=>$invoice->fee_type_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
                                        @endif
                                        @endif
                                    </td>
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