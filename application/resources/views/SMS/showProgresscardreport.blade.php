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
                <div class="row">
                  <div class="col-md-12 text-center noPrint">
                    <h5><b>{{$title}}</b></h5>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    @foreach($manage_student as $key)
                    <table class="table-bordered"  style="border:1px solid lightgray; width: 100%;">
                      <tr>
                        <th colspan="3" style="padding:10px; ">{{$key->student_name}}</th>
                      </tr>
                      <tr>
                        <td style="padding:10px; "><img src="{{asset('uploads').'/'.$key->student_photo}}" style="width: 100px;"></td>
                        <td style="padding:10px; ">{{$key->student_address}}</td>
                      </tr>
                      <tr>
                        <td style="padding:10px; ">Phone</td>
                        <td style="padding:10px; ">{{$key->student_phone}}</td>
                      </tr>
                      <tr>
                        <td style="padding:10px; ">Email</td>
                        <td style="padding:10px; ">{{$key->student_email}}</td>
                      </tr>
                    </table>
                    @endforeach
                  </div>
                  <div class="col-md-2"></div>
                  
                </div>
                <div class="row">
                  <table class="table table-bordered">
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
                          $grade_name    = $key->grade_name;
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
                          $grade_point= $key->grade_point;
                        }
                        return $grade_point;
                      }
                    ?>
                    @php
                      $totalgrade =0;
                    @endphp
                    @foreach($manage_exam as $exam)
                    <tr>
                      <table class="table table-bordered">
                        <tr>
                          <td>{{$exam->exam_name}}</td>
                          <td>
                            <table style="width: 100%">
                              <tr>
                                <th>Subjects</th>
                                <th>MCQ</th>
                                <th>CQ</th>
                                <th>PR</th>
                                <th>CA</th>
                                <th>Total</th>
                                <th>CGPA</th>
                                <th>Latter Grade</th>
                              </tr>
                              @php
                                $manage_progress = DB::table('exam_marks')
                                  ->join('subjects','subjects.subject_id','exam_marks.subject_id')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->get();
                                $total_marks_mcq = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->sum('mcq_marks');
                                $total_marks_theory = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->sum('theory_marks');
                                $total_marks_pr = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->sum('pr_marks');
                                $total_marks_ca = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->sum('ca_marks');

                                $total_semister_marks = $total_marks_mcq + $total_marks_theory + $total_marks_pr + $total_marks_ca;

                                $avg_marks_mcq = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->avg('mcq_marks');
                                $avg_marks_theory = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->avg('theory_marks');
                                $avg_marks_pr = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->avg('pr_marks');
                                $avg_marks_ca = DB::table('exam_marks')
                                  ->where('exam_marks.student_id',$student)
                                  ->where('exam_marks.class_id',$class)
                                  ->where('exam_marks.exam_id',$exam->exam_id)
                                  ->whereYear('exam_marks.created_at',$academic_year)
                                  ->where('exam_marks.school_id',$school_id)
                                  ->avg('ca_marks');

                                $avg_semister_marks = $avg_marks_mcq + $avg_marks_theory + $avg_marks_pr + $avg_marks_ca;
                                $avg_marks_formet = number_format($avg_semister_marks, 2);

                                @endphp
                                  @foreach($manage_progress as $progress)
                                    @php
                                    $total_marks = $progress->mcq_marks + $progress->theory_marks + $progress->pr_marks + $progress->ca_marks;
                                    @endphp
                              <tr>
                                <td>{{ $progress->subject_subject_name }}</td>
                                <td>{{ $progress->mcq_marks }}</td>
                                <td>{{ $progress->theory_marks }}</td>
                                <td>{{ $progress->pr_marks }}</td>
                                <td>{{ $progress->ca_marks }}</td>
                                <td>{{ $total_marks }}</td>
                                <td>{{ $grade = gradings($total_marks) }}</td>
                                <td>{{ $letter_grade = number_format(letter_grade($total_marks),2) }}</td>
                              </tr>
                              @php
                              $totalgrade +=$letter_grade;
                              @endphp
                              @endforeach
                              <tr>
                                <th colspan="3"><p class="pull-right">Total Marks</p></th>
                                <th colspan="2">{{$total_semister_marks}}</th>
                              </tr>
                              <tr>
                                <th colspan="3"><p class="pull-right">Avarage Marks</p></th>
                                <th colspan="2">{{$avg_marks_formet}}</th>
                              </tr>
                              @php
                              $schedule = DB::table('exam_schedules')->where('school_id',$school_id)
                                ->where('exam_id',$exam->exam_id)
                                ->where('class_id',$class)
                                ->where('section_id',$section)
                                ->count();
                              @endphp
                              @if($schedule)
                              <?php
                                $count_sub = DB::table('exam_schedules')->where('school_id',$school_id)
                                  ->where('exam_id',$exam->exam_id)
                                  ->where('class_id',$class)
                                  ->where('section_id',$section)
                                  ->count();
                                $final_grade = DB::table('grages')->where('school_id',$school_id)
                                  ->where('grade_point','<=',$totalgrade/$count_sub)
                                  ->orderBy('mark','DSC')
                                  ->first();
                              ?>
                              <tr>
                                <th colspan="3"><p class="pull-right">Final GPA </p></th>
                                <th colspan="2">{{ number_format($totalgrade/$count_sub, 2)}}</th>
                              </tr>
                              @endif
                            </table>
                          </td>
                        </tr>
                      </table>
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