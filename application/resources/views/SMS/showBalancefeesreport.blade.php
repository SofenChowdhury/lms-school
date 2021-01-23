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
                  <h5><b>Balance Fees Report</b></h5>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-8" style="margin-left: -13px;">
                    @foreach($manage_student as $student)
                    <table class="table-bordered"  style="border:1px solid lightgray; width: 100%; margin-bottom: 30px;">
                      <tr>
                        <th colspan="3" style="padding:10px; ">{{$settings->name}}</th>
                      </tr>
                      <tr>
                        <td style="padding:10px; "><img src="{{asset('uploads').'/'.$student->student_photo}}" style="width: 100px;"></td>
                        <td style="padding-left:10px; ">{!! DNS1D::getBarcodeHTML($student->student_card_id, "C39",2,30,"#344857") !!}</td>
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
                  </div>
                </div>
                <div class="row">
                  <table class="table table-bordered">
                    <tr>
                      <td>#</td>
                      <td>Name</td>
                      <td>Register NO</td>
                      <td>Roll</td>
                      <td>Fees Amount</td>
                      <td>Discount</td>
                      <td>Paid</td>
                    </tr>
                    @foreach($manage_student as $student)
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{{$student->student_name}}</td>
                      <td>{{$student->student_register_no}}</td>
                      <td>{{$student->student_roll_no}}</td>
                      <td>{{$manage_total_fee}}</td>
                      <td>{{$manage_discount}}</td>
                      <td>{{$manage_paid}}</td>
                    </tr>
                    @endforeach
                    <tr>
                      <th colspan="3">
                        <p class="pull-right">Grand Total (USD)</p>
                      </th>
                      <th colspan="4">
                        @if(($manage_total_fee-$manage_discount)>$manage_paid)
                        Balance = <span style="color: red;">{{$manage_paid-($manage_total_fee-$manage_discount)}}</span>
                        @else
                        Balance = <span style="color: green;">{{$manage_paid-($manage_total_fee-$manage_discount)}}</span>
                        @endif
                      </th>
                    </tr>
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