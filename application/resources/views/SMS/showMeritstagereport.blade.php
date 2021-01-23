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
                <div class="row">
                  <div class="col-md-4">
                    <table class="table-bordered"  style="border:1px solid lightgray;">
                      <tr>
                        <th colspan="3" style="padding:10px; " class="text-center"><img src="{{asset('uploads').'/'.$settings->image}}" style="width: 120px;"></th>
                      </tr>
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
                    <table class="table table-bordered">
                      <tr>
                        <th colspan="3" class="text-center">Mandatory Subjects</th>
                      </tr>
                      @foreach($manage_subjects as $subject)
                      <tr>
                        <td>{{$subject->subject_code}}</td>
                        <td>{{$subject->subject_type}}</td>
                        <td>{{$subject->subject_subject_name}}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  <div class="col-md-4">
                    
                    <table class="table" style="border:1px solid lightgray;">
                      <tr>
                        <th colspan="3" class="text-center">Merit Report</th>
                      </tr>
                      <tr>
                        <td>Academic Year</td>
                        <td>:</td>
                        <td>{{ $academic_year }}</td>
                      </tr>
                      @foreach($manage_exam as $exam)
                      <tr>
                        <td>Exam</td>
                        <td>:</td>
                        <td>{{$exam->exam_name}}</td>
                      </tr>
                      @endforeach
                      @foreach($manage_class as $class)
                      <tr>
                        <td>Class</td>
                        <td>:</td>
                        <td>{{$class->class_name}}</td>
                      </tr>
                      @endforeach
                      @foreach($manage_section as $section)
                      <tr>
                        <td>Section</td>
                        <td>:</td>
                        <td>{{$section->section_name}}</td>
                      </tr>
                      @endforeach
                    </table>
                    
                  </div>
                </div>
                <div class="row">
                  <table class="table table-bordered">
                    <tr>
                      <td>#</td>
                      <td>Name</td>
                      <td>Register NO</td>
                      <td>Roll</td>
                      <!-- <td>Position</td> -->
                      <td>Total Marks</td>
                      <td>Average</td>
                      <td colspan="5">Mandatory Subjects</td>
                    </tr>
                    @foreach($manage_student as $student)
                    @php
                      $avg_marks_mcq = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->avg('mcq_marks');
                      $avg_marks_theory = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->avg('theory_marks');
                      $avg_marks_pr = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->avg('pr_marks');
                      $avg_marks_ca = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->avg('ca_marks');

                      $avg_marks = $avg_marks_mcq + $avg_marks_theory + $avg_marks_pr + $avg_marks_ca ;
                      $avg_marks_formet = number_format($avg_marks, 2);

                      $sum_marks_mcq = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->sum('mcq_marks');
                      $sum_marks_theory = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->sum('theory_marks');
                      $sum_marks_pr = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->sum('pr_marks');
                      $sum_marks_ca = DB::table('exam_marks')
                        ->where('student_id',$student->student_id)
                        ->where('school_id',$school_id)
                        ->sum('ca_marks');

                      $sum_marks = $sum_marks_mcq + $sum_marks_theory + $sum_marks_pr + $sum_marks_ca ;
                    
                    @endphp
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{{$student->student_name}}</td>
                      <td>{{$student->student_register_no}}</td>
                      <td>{{$student->student_roll_no}}</td>
                      <!-- <td>3rd</td> -->
                      <td>{{$sum_marks}}</td>
                      <td>{{$avg_marks_formet}}</td>
                      <td colspan="5">
                        <table class="table table-bordered">
                          @foreach($manage_marks as $marks)
                          <tr>
                            @if($marks->student_id == $student->student_id)
                            
                            @php
                              $theory = $marks->theory_marks;
                              $MCQ = $marks->mcq_marks;
                              $ca = $marks->ca_marks;
                              $pr = $marks->pr_marks;
                              $total = $MCQ + $theory + $ca + $pr;
                            @endphp
                            <td>
                              <table>
                                <tr>
                                  <td>{{$marks->subject_subject_name}}</td>
                                  <td>{{$total}}</td>
                                </tr>
                              </table>
                            </td>
                            
                            @endif
                          </tr>
                          @endforeach
                        </table>
                      </td>
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