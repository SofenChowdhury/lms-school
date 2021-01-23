@extends('layouts.SMS-APP')
@section('content')
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
                <div class="row">
                  @foreach($manage_settings as $settings)
                  <div class="col-lg-12">
                    <center><h2><img src="{{asset('uploads').'/'.$settings->image}}" style="width: 100px;">{{$settings->name}}</h2></center>
                  </div>
                  @endforeach
                </div>
                <hr>
                <div class="row" style="overflow-x: scroll;">
                  <div class="col-md-6">
                    <table class="table table-bordered">
                      <tr>
                        <td>Incomes</td>
                        <td>
                          <table>
                            <tr>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Amount</th>
                            </tr>
                            @foreach($income as $incomes)
                            <tr>
                              <td>{{$incomes->income_date}}</td>
                              <td>{{$incomes->income_name}}</td>
                              <td>{{$incomes->income_amount}}</td>
                            </tr>
                            @endforeach
                            <tr>
                              <th colspan="2">Total Income</th>
                              <th>{{$manage_income}}</th>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-bordered">
                      <tr>
                        <td>Expense</td>
                        <td>
                          <table>
                            <tr>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Amount</th>
                            </tr>
                            @foreach($expense as $expense)
                            <tr>
                              <td>{{$expense->exp_date}}</td>
                              <td>{{$expense->exp_name}}</td>
                              <td>{{$expense->exp_amount}}</td>
                            </tr>
                            @endforeach
                            <tr>
                              <th colspan="2">Total Expances</th>
                              <th>{{$manage_expense}}</th>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-bordered">
                      <tr>
                        <td>Student Fees</td>
                        <td>
                          <table style="width: 100%;">
                            <tr>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Amount</th>
                            </tr>
                            @foreach($invoice as $invoice)
                            <tr>
                              <td>{{$invoice->created_at->format('d-M-Y')}}</td>
                              <td>{{$invoice->student_name}}</td>
                              <td>{{$invoice->paid}}</td>
                            </tr>
                            @endforeach
                            <tr>
                              <th colspan="2">Total Student Fees</th>
                              <th>{{$manage_invoice}}</th>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6" style="margin: 0px auto;">
                    <table class="table table-bordered">
                      <tr>
                        <th>Total Profit</th>
                        <th>{{$total_profit}}</th>
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