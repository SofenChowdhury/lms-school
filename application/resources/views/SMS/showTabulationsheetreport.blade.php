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
              <div class="container" style="border:1px solid lightgray;">
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
                @foreach($manage_student as $student)
                <div class="row">
                  <div class="" style="margin-left: 15px;">
                    <img src="{{asset('uploads').'/'.$student->student_photo}}" style="width: 200px; height: 200px;">
                  </div>
                  <div class="col-md-9">
                    <table class="table table-bordered">
                      <tr>
                        <td>Student Name</td>
                        <td>{{$student->student_name}}</td>
                      </tr>
                      <tr>
                        <td>Student Roll</td>
                        <td>{{$student->student_roll_no}}</td>
                      </tr>
                      <tr>
                        <td>Class</td>
                        <td>{{$student->class_name}}</td>
                      </tr>
                      <tr>
                        <td>Section</td>
                        <td>{{$student->section_name}}</td>
                      </tr>
                      <tr>
                        <td>BarCode</td>
                        <td>{!! DNS1D::getBarcodeHTML($student->student_id, "C39",2,30,"#344857") !!}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <?php                
                $total_marks;
                function gradings ($total_marks){
                  $school_id =  Session::get('school_id');
                  $grading_system = DB::table('grages')
                    ->where('school_id',$school_id)
                    ->where('min_mark','>=',$total_marks)
                    ->where('mark','<=',$total_marks)
                    ->get();
                    $grade_name='';
                  foreach ($grading_system as $key) {
                      $grade_name = $key->grade_name;
                  }
                    echo $grade_name;
                
                }

                function letter_grade ($total_marks){
                  $school_id =  Session::get('school_id');
                  $grading_system = DB::table('grages')
                    ->where('school_id',$school_id)
                    ->where('min_mark','>=',$total_marks)
                    ->where('mark','<=',$total_marks)
                    ->get();
                  $grade_point=0;
                  foreach ($grading_system as $key) {
                      $grade_point = $key->grade_point;
                  }
                  return $grade_point;
                }
                ?>
                @endforeach
                <div class="row">
                  <table class="table table-bordered" style="margin-left: 15px;margin-right: 15px;">
                    <tr>
                      <td>#</td>
                      <td>Subject Code</td>
                      <td>Subject Name</td>
                      <td>Full Marks</td>
                      <td>Pass Marks</td>
                      <td>Total Marks</td>
                      <td>CGP</td>
                      <td>Latter Grade</td>
                    </tr>
                    @foreach($manage_tabulation as $tabulation)
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{{$tabulation->subject_code}}</td>
                      <td>{{$tabulation->subject_subject_name}}</td>
                      <td>{{$tabulation->subject_final_mark}}</td>
                      <td>{{$tabulation->subject_pass_mark}}</td>
                      <td>{{$total_marks = $tabulation->mcq_marks + $tabulation->theory_marks + $tabulation->pr_marks + $tabulation->ca_marks}}</td>
                      <td>{{ $grade = gradings($total_marks) }}</td>
                      <td>{{ $letter_grade = number_format(letter_grade($total_marks),2)}}</td>
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