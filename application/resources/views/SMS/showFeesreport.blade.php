@extends('layouts.SMS-APP')
@section('content')
<style>
    .noPrint{
        display: none;

    }
    .tableHead{
        background-color: #4391b1; 
        color: white;
    }
    @media print {
        @page { 
            size: auto; 
            margin: 0mm;
        }       
        .table_head{
            background-color: #4391b1!important; 
            color: white;
        }
        .noPrint{
            display: block !important;
            padding-bottom: 35px !important;
            text-align: center !important;
        }
        .tableHead{
            background-color: #4391b1 !important; 
            color: white;
        }
    }
</style>

<div class="container-fluid">
  <div style="margin-bottom: 20px;">
    <button class="btn btn-default" id='btn' onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
  </div>
  <div class="row clearfix">
    <div class="col-lg-12">
      <div class="card">
        <div class="header">
          
          <h5><b>{{$title}}</b></h5>
          
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
        <div class="body" id="printableArea">
          <div class="tab-content mt-3">
            <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
              <div class="container">
                @foreach($manage_settings as $settings)
                @if($settings->logo_banner)
                <div class="row" style="background-image: url('{{asset('uploads').'/'.$settings->logo_banner}}'); height: 170px; margin-bottom: 50px; background-position: center; background-size: cover;">
                  
                </div>
                @else
                <div class="row" style="background-image: url('{{asset('uploads').'/'.$settings->logo_banner}}'); height: 200px;">
                  <div class="col-lg-12">
                    <center><h2><img src="{{asset('uploads').'/'.$settings->image}}" style="width: 100px;">{{$settings->name}}</h2></center>
                  </div>
                </div>
                <hr>
                @endif
                @endforeach
                <div class="text-center noPrint">
                  <h5><b>{{$title}} </b></h5>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-8" style="margin-left: -15px;">
                    @foreach($manage_student as $student)
                    <table class="table-bordered"  style="border:1px solid lightgray; width: 100%;">
                      <tr>
                        <th style="padding:10px; "><img src="{{asset('uploads').'/'.$student->student_photo}}" style="width: 100px;"></th>
                        <th style="padding:10px; ">{!! DNS1D::getBarcodeHTML($student->student_card_id, "C39",2,30,"#344857") !!}</th>
                      </tr>
                      <tr>
                        <td style="padding:10px; ">Name</td>
                        <td style="padding:10px; ">{{$student->student_name}}</td>
                      </tr>
                      <tr>
                        <td style="padding:10px; ">Phone</td>
                        <td style="padding:10px; ">{{$student->student_phone}}</td>
                      </tr>
                      <tr>
                        <td style="padding:10px; ">Email</td>
                        <td style="padding:10px; ">{{$student->student_email}}</td>
                      </tr>
                    </table>
                    @endforeach
                  </div>
                  <div class="col-md-4">
                    <table class="table" style="border:1px solid lightgray; width: 100%; margin-left: 30px;">
                      <tr>
                        <th colspan="3">Basic Info</th>
                      </tr>
                      <tr>
                        <td>Academic Year</td>
                        <td>:</td>
                        <td>{{'2017-2018'}}</td>
                      </tr>
                      <tr>
                        <td>Class</td>
                        <td>:</td>
                        <td>{{$student->class_name}}</td>
                      </tr>
                      <tr>
                        <td>Section</td>
                        <td>:</td>
                        <td>{{$student->section_name}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <br>
                <div class="row">
                  <table class="table table-bordered">
                    <tr>
                      <td>#</td>
                      <td>Payment Type</td>
                      <td>Paid</td>
                      <td>Date</td>
                    </tr>
                    @foreach($fees_report as $report)
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      @php
                      $fees_type = DB::table('payment_histories')
                        ->where('payment_histories.school_id',$school_id)
                        ->where('payment_histories.random_id',$report->fee_type_id)
                        ->where('payment_histories.school_id',$school_id)
                        ->join('fee_types','fee_types.fee_type_id','payment_histories.fee_type_id')
                        ->get();
                      @endphp
                      <td>
                        <table>
                          @foreach($fees_type as $key)
                          <tr>
                            <td>{{$key->fee_type}}</td>
                          </tr>
                          @endforeach
                        </table>
                      </td>
                      <td>{{$report->paid}}</td>
                      <td>{{$report->created_at->format('d-M-Y')}}</td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
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