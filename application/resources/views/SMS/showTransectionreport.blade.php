@extends('layouts.SMS-APP')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style >
  
.noPrint{
        display: none;
    }    
#tab-button {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}
#tab-button li {
  display: table-cell;
  
}
#tab-button li a {
  display: block;
  padding: .5em;
  background: #eee;
  border: 1px solid #ddd;
  text-align: center;
  color: #000;
  text-decoration: none;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  border-bottom-color: transparent;
  background: #fff;
}
.tab-contents {
  
  /*border: 1px solid #ddd;*/
  width: 100%;
}
.tab-button-outer {
  display: none;
}
.tab-contents {
  margin-top: 20px;
}
@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
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
          <style>
          @media print {
          @page {
          size: auto;
          margin: 0mm;
          }
          .noPrint{
          display: block !important;
          
          text-align: center !important;
          }
          .table{
          margin-left: 0px !important;
          width: 910px !important;
          }
          .banner{
          margin-top: 50px !important;
          margin-left: 35px !important;
          width: 890px !important;
          }
          }
          </style>
          <div class="tab-content mt-3">
            <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
              <div class="container">
                <div class="banner">
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
                </div>
                <div class="row">
                  <div class="tab-button-outer">
                    <ul id="tab-button">
                      <li><a href="#tab01">Fees Collection Details</a></li>
                      <li><a href="#tab02">Income Details</a></li>
                      <li><a href="#tab03">Expense Details</a></li>
                    </ul>
                  </div>
                  
                  <div id="tab01" class="tab-contents">
                    <div class="text-center noPrint">
                      <h5><b> Fees Collections </b></h5>
                      <br>
                    </div>
                    <table class="table table-bordered">
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Register NO</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Roll</th>
                        <th>Fee Type</th>
                        <th>Paid</th>
                        <th>Weaver</th>
                      </tr>
                      @foreach($manage_fees as $fee)
                      <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{date('d-M-Y', strtotime($fee->invoice_date))}}</td>
                        <td>{{$fee->student_name}}</td>
                        <td>{{$fee->student_register_no}}</td>
                        <td>{{$fee->class_name}}</td>
                        <td>{{$fee->section_name}}</td>
                        <td>{{$fee->student_roll_no}}</td>
                        <td>
                          @php
                          $manage_payment_history = DB::table('payment_histories')
                          ->join('fee_types','fee_types.fee_type_id','payment_histories.fee_type_id')
                          ->where('payment_histories.school_id',$school_id)
                          ->get();
                          @endphp
                          <table>
                            @foreach($manage_payment_history as $payment)
                            @if($payment->random_id == $fee->fee_type_id)
                            <tr>
                              <td>{{$payment->fee_type}}</td>
                            </tr>
                            @endif
                            @endforeach
                          </table>
                        </td>
                        <td>{{$fee->paid}}</td>
                        <td>{{$fee->discount}}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  <div id="tab02" class="tab-contents">
                    <div class="text-center noPrint">
                      <h5><b> Incomes Details </b></h5>
                      <br>
                    </div>
                    <table class="table table-bordered">
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Amount</th>
                      </tr>
                      @foreach($manage_income as $income)
                      <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{date('d-M-Y', strtotime($income->income_date))}}</td>
                        <td>{{$income->income_name}}</td>
                        <td>{{$income->income_amount}}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  <div id="tab03" class="tab-contents">
                    <div class="text-center noPrint">
                      <h5><b> Expance Details </b></h5>
                      <br>
                    </div>
                    <table class="table table-bordered">
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Amount</th>
                      </tr>
                      @foreach($manage_expence as $expence)
                      <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{date('d-M-Y', strtotime($expence->exp_date))}}</td>
                        <td>{{$expence->exp_name}}</td>
                        <td>{{$expence->exp_amount}}</td>
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
<script>
  $(function() {
    var $tabButtonItem = $('#tab-button li'),
    $tabSelect = $('#tab-select'),
    $tabContents = $('.tab-contents'),
    activeClass = 'is-active';
    $tabButtonItem.first().addClass(activeClass);
    $tabContents.not(':first').hide();
    $tabButtonItem.find('a').on('click', function(e) {
      var target = $(this).attr('href');
      $tabButtonItem.removeClass(activeClass);
      $(this).parent().addClass(activeClass);
      $tabSelect.val(target);
      $tabContents.hide();
      $(target).show();
      e.preventDefault();
    });
    $tabSelect.on('change', function() {
      var target = $(this).val(),
      targetSelectNum = $(this).prop('selectedIndex');
      $tabButtonItem.removeClass(activeClass);
      $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
      $tabContents.hide();
      $(target).show();
    });
  });
</script>

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