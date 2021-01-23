@extends('layouts.SMS-APP')
@section('content')
<style>
  .certificate{
    padding-top: 40px;
  }
  .info{
    float: left;
    padding-left: 30px;
    padding-top: 100px;
  }
</style>
<div class="container-fluid">
    <div style="margin-bottom: 20px;">
        <button class="btn btn-default" id='btn' onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button><button class="btn btn-default"><i class="fa fa-file"></i> PDF Preview</button><button class="btn btn-default"><i class="fa fa-envelope"></i> Send PDF to Mail</button>
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
                <div class="body" >
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
                              <div class="row">
                                <div class="col-md-4">
                                  <table class="table-bordered"  style="border:1px solid lightgray;">
                                    <tr>
                                      <th colspan="3" style="padding:10px; ">{{$settings->name}}</th>
                                    </tr>
                                    <tr>
                                      <td style="padding:10px; ">Address</td>
                                      <td style="padding:10px; ">{{$settings->address}}</td>
                                    </tr>
                                    <tr>
                                      <td style="padding:10px; ">Phone</td>
                                      <td style="padding:10px; ">{{$settings->phone}}</td>
                                    </tr>
                                    <tr>
                                      <td style="padding:10px; ">Email</td>
                                      <td style="padding:10px; ">{{$settings->email}}</td>
                                    </tr>
                                  </table>
                                </div>
                                <div class="col-md-4">
                                  <!-- <table class="table table-bordered">
                                    <tr>
                                      <th colspan="3"></th>
                                    </tr>
                                    
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    
                                  </table> -->
                                </div>
                                <div class="col-md-4">
                                  @foreach($manage_certificate as $certificate)
                                    <table class="table" style="border:1px solid lightgray;">
                                      <tr>
                                        <th colspan="3">Merit Report</th>
                                      </tr>
                                      <tr>
                                        <td>Academic Year</td>
                                        <td>:</td>
                                        <td>{{$academic_year}}</td>
                                      </tr>
                                      <!-- <tr>
                                        <td>Exam</td>
                                        <td>:</td>
                                        <td></td>
                                      </tr> -->
                                      <tr>
                                        <td>Class</td>
                                        <td>:</td>
                                        <td>{{$certificate->class_name}}</td>
                                      </tr>
                                      <tr>
                                        <td>Section</td>
                                        <td>:</td>
                                        <td>{{$certificate->section_name}}</td>
                                      </tr>
                                    </table>
                                  @endforeach
                                </div>
                              </div>
                              <div class="row" id="printableArea">
                                <div class="col-md-12" style="background-color: #00555e; height: 8in;">
                                  
                                    <div style="height: 7.4in; margin-top: 30px; background-image: url('{{asset('uploads/Certificate_Template_PNG_Clip_Art_Image.png')}}');background-size: cover;">
                                    @foreach($manage_certificate as $certificate) 
                                      <div class="info" style="margin-top: 270px; padding-left: 150px;">
                                        <table class="table">
                                          <tr style="border-top:hidden; position:relative;">
                                            <span style="position: absolute; margin-top: 6px; margin-left: 100px;">{{$certificate->student_name}}</span>
                                            <td >Name............................................................................</td>
                                            <span style="position: absolute; margin-top: 6px; margin-left: 470px;">{{$certificate->class_name}}</span>
                                            <td >class...........................</td>
                                            <td >Section...............................</td>
                                          </tr>
                                          <tr style="border-top:hidden;border-top:hidden; position:relative;">
                                            <span style="position: absolute; margin-top: 6px; margin-left: 650px;">{{$certificate->section_name}}</span>
                                            <td >certifide for...............................................................................</td>
                                            <span style="position: absolute; margin-top: 6px; margin-left: 100px;">{{$certificate->student_name}}</span>
                                            <td colspan="2">Assisment..........................................................................</td>
                                          </tr>
                                        </table>
                                        <div class="row" style="margin-top: 100px; border-top:hidden; position:relative;">
                                          <div class="col-md-6">
                                            <p style="padding-left: 100px;">Coordinator</p>
                                          </div>
                                          <div class="col-md-6">
                                            <p class="pull-right" style="padding-right: 200px;">Date</p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  @endforeach
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