@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Invoice</h2>
                    <ul class="header-dropdown dropdown dropdown-animated scale-left">
                        <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                        <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);">Print Invoices</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="javascript:void(0);">Export to XLS</a></li>
                                <li><a href="javascript:void(0);">Export to CSV</a></li>
                                <li><a href="javascript:void(0);">Export to XML</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @foreach($manage_invoice as $invoice)
                @php
                    $total = $invoice->total_fee;
                    $discount = $total*($invoice->discount/100) ;
                    $payable = $total-$discount;
                    $paid = $invoice->paid;
                    $due = $payable-$paid;
                @endphp
                <div class="body" id="printableArea">
                    <h3>Invoice Details </h3>
                    <div class="tab-content mt-3">
                        <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <address>
                                        <strong>{{$invoice->student_name}}</strong><br>
                                        Class : {{$invoice->class_name}}<br>
                                        phone : {{$invoice->student_phone}}<br>
                                    <abbr>email:</abbr> {{$invoice->student_email}}
                                </address>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                                <p class="m-b-0"><strong>Date: </strong> {{date('d-M-Y', strtotime($invoice->invoice_date))}}</p>
                                <p><strong>Bill ID: </strong> {{$invoice->fee_type_id}}</p>
                                <p class="m-b-0"><strong>Status: </strong><span class="badge badge-success m-b-0">
                                    @if($payable-$invoice->paid <= '0')
                                    <button class="btn btn-info">Full Paid</button>
                                    @else
                                    <button class="btn btn-danger">Partially Paid</button>
                                    @endif
                                </span></p>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Item</th>
                                                <!-- <th>Paid</th> -->
                                                <th>Unit Cost</th>
                                                @if( Auth::user()->role == 'SUPPERADMIN')
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($manage_fee_type as $fees)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$fees->fee_type}}</td>
                                                <!-- <td>{{$fees->amount}} tk</td> -->
                                                <td>{{$fees->amount}} tk</td>
                                                @if( Auth::user()->role == 'SUPPERADMIN')
                                                <td class="actions">
                                                    
                                                    <a href="{{route('delete_single_invoice',['id'=>$fees->pay_id,'random'=>$fees->random_id,'fee_type'=>$fees->fee_type_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button>
                                                    </a>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-md-9">
                                <h5>Note</h5>
                                <p>{{$invoice->note}}</p>
                            </div>
                            
                            <div class="col-md-3">
                                <p class="m-b-0"><b>Payable:</b> {{ $payable}}</p>
                                <p class="m-b-0">Discout: {{$invoice->discount}}%</p>
                                <p class="m-b-0"><b>Paid:</b> {{$paid}}</h5></p>
                                <hr>
                                <p class="m-b-0"><b>Due:</b> {{$due}}</h5></p>
                            </div>
                            <div class="hidden-print col-md-12 text-right">
                                <hr>
                                <button class="btn btn-outline-secondary" onclick="printDiv('printableArea')"><i class="icon-printer"></i></button>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection