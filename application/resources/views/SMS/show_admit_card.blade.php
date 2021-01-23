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
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>{{$title}} &nbsp;<button class="btn btn-default" id='btn' onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button></h2>
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
                <div class="body">
                    <h3 class="noPrint">{{$title}} Details </h3>
                    <div class="tab-content mt-3">
                        <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
                            <div class="row clearfix"  style="margin-left: 7%;">
                                <div class="col-md-11"  id="printableArea" >
                                    <div class="container" style="border:1px solid black; background-color: #eff5f5;">
                                        <div class="row" style="padding-top: 20px; padding-bottom: 50px;">
                                            @foreach($manage_settings as $setting)
                                            <div class="col-md-2"><img src="{{asset('uploads').'/'.$setting->image}}" style="width: 100%;"></div>
                                            <div class="col-md-8" style="text-align: center; padding-top: 20px;">
                                                <h3>{{$setting->name}}</h3>
                                                <p style="line-height: 9px;">{{$setting->address}}</p>
                                                <p style="line-height: 9px;">First Semister Exam Admit Card - ( 2018-2019 )</p>
                                            </div>
                                            @endforeach
                                            @foreach($manage_student as $student)
                                            <div class="col-md-2"><img src="{{asset('uploads').'/'.$student->student_photo}}" style="width: 100%;"></div>
                                            @endforeach
                                        </div>
                                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                            <div class="col-md-4">
                                                <table class="table">
                                                    <tr>
                                                        <th style="line-height: 15px;">Name</th>
                                                        <td style="line-height: 15px;">:</td>
                                                        <td style="line-height: 15px;">{{$student->student_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="line-height: 15px;">Phone</th>
                                                        <td style="line-height: 15px;">:</td>
                                                        <td style="line-height: 15px;">{{$student->student_phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="line-height: 15px;">Class</th>
                                                        <td style="line-height: 15px;">:</td>
                                                        <td style="line-height: 15px;">{{$student->class_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="line-height: 15px;">Roll</th>
                                                        <td style="line-height: 15px;">:</td>
                                                        <td style="line-height: 15px;">{{$student->student_roll_no}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="line-height: 15px;">Reg.NO</th>
                                                        <td style="line-height: 15px;">:</td>
                                                        <td style="line-height: 15px;">{{$student->student_register_no}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 style="text-align: center; padding-top: 100px;">Subject in which Appearing</h6>
                                            </div>
                                            <div class="col-md-4 pull-right">
                                                <table class="table">
                                                    
                                                    <tr>
                                                        <th style="line-height: 15px;">Section </th>
                                                        <td style="line-height: 15px;">:</td>
                                                        <td style="line-height: 15px;">{{$student->section_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="line-height: 15px;">Group</th>
                                                        <td style="line-height: 15px;">:</td>
                                                        <td style="line-height: 15px;">{{$student->student_group}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="line-height: 9px;">Session</th>
                                                        <td style="line-height: 9px;">:</td>
                                                        <td style="line-height: 9px;">{{$exam_info->created_at->format('Y')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="line-height: 9px;">Exam</th>
                                                        <td style="line-height: 9px;">:</td>
                                                        <td style="line-height: 9px;">{{$exam_info->exam_name}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <table class="table table-bordered" style="font-size: 14px; ">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Subject Code</th>
                                                    <th>Subject Name</th>
                                                    <th>Subject Mark</th>
                                                    <th>Signature</th>
                                                </tr>
                                                @foreach($manage_subject as $subject)
                                                <tr>
                                                    <td class="text-center">{{$loop->index+1}}</td>
                                                    <td>{{$subject->subject_code}}</td>
                                                    <td>{{$subject->subject_subject_name}}</td>
                                                    <td>{{$subject->subject_final_mark}}</td>
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            <div class="col-lg-12" style="height: 100px;">
                                                <div class="col-md-7"></div>
                                                <div class="col-md-5">
                                                    <span style=" line-height: 30px; border-bottom: 1px solid gray; font-weight: bold;">Class Teacher</span>
                                                    <span style="line-height: 30px; border-bottom: 1px solid gray; margin-left: 50px; font-weight: bold;">Head Teacher</span>
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