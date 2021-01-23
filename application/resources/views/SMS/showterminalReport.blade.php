@extends('layouts.SMS-APP')
@section('content')
<style>
  @media print{
    .logo_banner img{
      display: none;
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
          <h5><b> Show {{$title}}</b></h5>
          
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
            <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true" >
              <div class="container" style="border:1px solid lightgray;">
                @foreach($manage_settings as $settings)
                @if($settings->logo_banner)
                <div class="row logo_banner" style="background-image: url('{{asset('uploads').'/'.$settings->logo_banner}}'); height: 170px; margin-bottom: 50px; background-position: center; background-size: cover;">
                  
                </div>
                @else
                <div class="row logo_banner" style="background-image: url('{{asset('uploads').'/'.$settings->logo_banner}}'); height: 200px;">
                  <div class="col-lg-12">
                    <center><h2><img src="{{asset('uploads').'/'.$settings->image}}" style="width: 100px;">{{$settings->name}}</h2></center>
                  </div>
                </div>
                <hr>
                @endif
                @endforeach
                <div class="row">

                  @foreach($manage_student as $student)

                    <div class="col-md-3" style="margin-top: 30px;">
                      <img src="{{asset('uploads').'/'.$student->student_photo}}" style="width: 120px;">
                    </div>
                    <div class="col-md-5 text-center">
                      <h3>{{$settings->name}}</h3>
                      <p>{{$settings->address}}</p>
                      <img src="{{asset('uploads').'/'.$settings->image}}" style="margin: 0px auto; width: 120px;">
                      <p style="font-size: 20px;"><u>{{$title}}</u></p>
                    </div>
                    <div class="col-md-4">
                      <table class="table-bordered text-center" style="width: 100%;">
                        <tr>
                          <th style="padding-left:10px; padding-right:15px;">Range</th>
                          <th style="padding-left:10px; padding-right:15px;">Grade</th>
                          <th style="padding-left:10px; padding-right:15px;">GPA</th>
                        </tr>
                        @foreach($gradeings as $gradeings)
                        <tr>
                          <td style="padding-left:10px; padding-right:15px;">{{$gradeings->mark}} - {{$gradeings->min_mark}}</td>
                          <td style="padding-left:10px; padding-right:15px;">{{$gradeings->grade_name}}</td>
                          <td style="padding-left:10px; padding-right:15px;">{{number_format($gradeings->grade_point,2)}}</td>
                        </tr>
                        @endforeach
                      </table>
                    </div>  

                    <div class="col-md-5">
                      <table class="table" style="border:1px solid lightgray">
                        <tr style="border:hidden; line-height: 10px;">
                          <td>Name</td>
                          <td>:</td>
                          <td>{{$student->student_name}}</td>
                        </tr>
                        <tr style="border:hidden; line-height: 10px;">
                          <td>Gurdian's Name</td>
                          <td>:</td>
                          <td>{{$student->guardian_name}}</td>
                        </tr>
                        <tr style="border:hidden; line-height: 10px;">
                          <td>ID Card</td>
                          <td>:</td>
                          <td>{{$student->student_card_id}}</td>
                        </tr>
                        <tr style="border:hidden; line-height: 10px;">
                          <td>Address</td>
                          <td>:</td>
                          <td>{{$student->student_address}}</td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-4 pull-right">
                      <table class="table" style="border:1px solid lightgray">
                        <tr style="border:hidden; line-height: 7px;">
                          <td>Roll</td>
                          <td>:</td>
                          <td>{{$student->student_roll_no}}</td>
                        </tr>
                        <tr style="border:hidden; line-height: 7px;">
                          <td>Class</td>
                          <td>:</td>
                          <td>{{$student->class_name}}</td>
                        </tr>
                        <tr style="border:hidden; line-height: 7px;">
                          <td>Group</td>
                          <td>:</td>
                          <td>{{$student->student_group}}</td>
                        </tr>
                        <tr style="border:hidden; line-height: 7px;">
                          <td>Student ID</td>
                          <td>:</td>
                          <td>{!! DNS1D::getBarcodeHTML($student->student_id, "C39",2,20,"#344857") !!}</td>
                        </tr>
                      </table>
                    </div>
                  @endforeach
                </div>
                <div class="row">
                  <table class="table table-bordered" style="margin-left: 15px;margin-right: 15px;">
                    <tr>
                      <td>Subject</td>
                      <td>Pass Marks</td>
                      <td>Final Marks</td>
                      <td>CQ</td>
                      <td>MCQ</td>
                      <td>PR</td>
                      <td>CA</td>
                      <td>Total</td>
                      <td>Letter Grade</td>
                      <td>GPA</td>
                      <td>Remarks</td>
                    </tr>
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
                          $grade_name= $key->grade_name;
                        }
                        echo $grade_name;
                    
                      }
                    ?>
                    <?php
                    $total_marks;
                    function grade_note ($total_marks){
                     $school_id =  Session::get('school_id');
                      $grading_system = DB::table('grages')
                        ->where('school_id',$school_id)
                        ->where('min_mark','>=',$total_marks)
                        ->where('mark','<=',$total_marks)
                        ->get();
                      $grade_note='';
                      foreach ($grading_system as $key) {
                          $grade_note = $key->grade_note;
                      }
                      echo $grade_note;
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
                              $grade_point=$key->grade_point;
                        }
                        return $grade_point;
                      }
                      
                    ?>
                    @php
                      $totalgrade =0;
                    @endphp
                    @foreach($manage_terminal as $terminal)
                    <tr>
                      <td>{{$terminal->subject_subject_name}}</td>
                      <td>{{$terminal->subject_pass_mark}}</td>
                      <td>{{$terminal->subject_final_mark}}</td>
                      <td>{{$terminal->theory_marks}}</td>
                      <td>{{$terminal->mcq_marks}}</td>
                      <td>{{$terminal->pr_marks}}</td>
                      <td>{{$terminal->ca_marks}}</td>
                      <td>{{$total_marks = $terminal->theory_marks + 
                                           $terminal->mcq_marks+ 
                                           $terminal->pr_marks+ 
                                           $terminal->ca_marks
                                        }}</td>
                      <td>{{ $grade = gradings($total_marks)}}</td>
                      <td>{{ $letter_grade = number_format(letter_grade($total_marks),2)}} </td>
                      <td>{{ $grade_note = grade_note($total_marks)}}</td>
                    </tr>
                    @php
                      $totalgrade +=$letter_grade;
                    @endphp
                    @endforeach
                    <tr>
                      <th colspan="3"><span style="float: right;">Full Exam Marks: {{$Total_final}}</span></th>
                      <th colspan="5"><span style="float: right;">Total Exam Marks : {{$sub_total}}</span></th>

                      <?php
                        $final_grade = DB::table('grages')->where('school_id',$school_id)
                                        ->where('grade_point','<=',$totalgrade/$count_sub)
                                        ->orderBy('mark','DSC')
                                        ->first();
                      ?>
                      @if($final_grade)
                      <th>Grade : {{ $final_grade->grade_name}}</th> 
                      @else
                      <th>Grade : </th>
                      @endif
                      <th colspan="2">GPA : {{ number_format($totalgrade/$count_sub, 2)}}</th>
                    </tr>
                  </table>
                  <div class="col-md-4">
                    <table class="table table-bordered">
                      <tr>
                        <th colspan="3">Short Maks Description</th>
                        
                      </tr>
                      <tr>
                        <td>Full Exam Marks</td>
                        <td>:</th>
                        <td>{{$Total_final}}</td>
                      </tr>
                      <tr>
                        <td>Total Exam Marks</td>
                        <td>:</th>
                        <td>{{$sub_total}}</td>
                      </tr>
                      <tr>
                        <td>AVG Exam Marks</td>
                        <td>:</td>
                        <td>{{$sub_total/$count_sub}}</td>
                      </tr>
                      @php
                        $optional_marks = DB::table('exam_marks')
                            ->where('subject_id',$optional_sub->student_optional_subject)
                            ->where('student_id',$optional_sub->student_id)
                            ->first();

                        $count_optional_marks = DB::table('exam_marks')
                            ->where('subject_id',$optional_sub->student_optional_subject)
                            ->where('student_id',$optional_sub->student_id)
                            ->count();

                        if($count_optional_marks>0) {   
                        $optional_mark = $optional_marks->mcq_marks+
                                         $optional_marks->theory_marks+
                                         $optional_marks->pr_marks +
                                         $optional_marks->ca_marks;    
                            
                        }else{
                        $optional_mark=0;
                      }
                      $optional_grade = DB::table('grages')->where('school_id',$school_id)
                                ->where('min_mark','>=',$optional_mark)
                                ->where('mark','<=',$optional_mark)
                                ->first();
                      @endphp
                      <tr>
                        <td>4th CGPA </td>
                        <td>:</td>
                        @if($optional_grade)
                        <td>{{number_format($optional_grade->grade_point,2)}}</td>
                        @else
                        <td>0</td>
                        @endif
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-4">
                    <table class="table table-bordered">
                      <tr>
                        <th colspan="3">Extra Curricular Activities</th>
                        
                      </tr>
                      <tr>
                        <td>Optional Subject</td>
                        <td>:</td>
                        <td>{{$optional_sub->subject_subject_name}}</td>
                      </tr>
                      <tr>
                        <td>Co-curricular Activities</td>
                        <td>:</th>
                        <td>{{$student->student_extra_curricular_activities}}</td>
                      </tr>
                      
                    </table>
                  </div>
                  <div class="col-md-4">
                    <table class="table table-bordered">
                      <tr>
                        <th colspan="2">Moral & Behavior Evaluation</th>
                      </tr>
                      <tr>
                        <td>Best</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Better</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Good</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Need To Improve</td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-9">
                    <table class="table table-bordered">
                      <tr>
                        <td style="width: 2%; font-weight: bold;">Comments</p></td>
                        <td><textarea class="form-control" cols="10" rows="5" style="border:0px;"></textarea></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-3">
                    {!! DNS2D::getBarcodeHTML("Total Marks:{{$sub_total}} || AVG Exam Marks:{{$sub_total/$count_sub}} || GPA : {{ number_format($totalgrade/$count_sub, 2)}}", "QRCODE",3,3,"#344857"); !!}
                  </div>
                  <div class="col-md-12" style="margin-top: 100px;">
                    <div class="col-md-4"><p style="border-top: 1px dashed; padding: 5px; width: 100px; text-align: center;">Gurdian</p></div>
                    <div class="col-md-4"><p style="border-top: 1px dashed; padding: 5px; width: 120px; text-align: center;">Class Teacher</u></div>
                    <div class="col-md-4"><p style="border-top: 1px dashed; padding: 5px; width: 150px; text-align: center;">Head Teacher</u></div>
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