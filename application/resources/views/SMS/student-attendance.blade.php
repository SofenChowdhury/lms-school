@extends('layouts.SMS-APP')
@section('content')
<?php
    use App\attendance;
?>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    
                    <form id="basic-form" action="{{route('student_attendanceForm')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-3" style="margin-top: 6px;">
                                <label> Role* </label>
                                <div class="">
                                    <select  name="role" id="usertype" class="form-control">
                                        <option value="">Select Member</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3" id="TeacherID">
                                <p>Teacher Name* </p>
                                <div class="" >
                                    <select  name="teacher_id" class="form-control">
                                        <option value="">Select Teacher</option>
                                        @foreach($teacher as $teach)
                                        <option value="{{$teach->teacher_id}}">{{$teach->teacher_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-6" id="StudentID">
                                <div class="col-md-6" >
                                    <div class="">
                                        <p>Class * </p>
                                    </div>
                                    <div class="">
                                        <select  name="class_id" id="class_id" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach($class as $key)
                                            <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <p>Section* </p>
                                    </div>
                                    <div class="">
                                        <select  name="section_id" id="section_id" class="form-control">
                                            <option value="">Select Section</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <p>Year* </p>
                                </div>
                                <select name="year" class="form-control" required="">
                                    <option value="">Select Year</option>
                                    <?php for($i=2019;$i<=date('Y');$i++){?>
                                    <option value="{{ $i }}">{{ $i}}</option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <p>Month Name* </p>
                                </div>
                                <div class="">
                                    <select name="month" class="form-control" required="">
                                        <option value="">Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 pull-right">
                                <label> </label><br>
                                <button type="submit" class="btn btn-primary btn-block m-t-10 pull-right">Show</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@if($class_id != ''  or $section_id != '' or $year != ''or $month != ''or $teacher_id != '' )
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                        <div class="col-lg-6" style="float: right;">
                            @if($role == 'Student')
                            <a href="{{ route('add-student-attendance') }}" class="btn btn-primary  pull-right">Add {{ $title }}</a>
                            @endif
                            @if($role == 'Teacher')
                            <a href="{{ route('add-teacher-attendance') }}" class="btn btn-primary  pull-right">Add {{ $title }}</a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        @include('includes.messages')
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            @if($user_role == 'TEACHER')
                                @if($role == 'Teacher')
                                <tbody>
                                    @foreach($teacher as $attn)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        @if($role == 'Teacher')
                                        <td><img src="{{asset('uploads').'/'.$attn->teacher_photo}}" style="width: 50px;"></td>
                                        <td>{{$attn->teacher_name}}</td>
                                        <td>
                                            <?php
                                                $str=0;
                                                $ser_date=[];
                                                for ($i=01; $i<=$month_day; $i++){
                                                    foreach ($manage_attendence as $attn) {
                                                        if($month == date('m') && date('d')==$i){
                                                            $month_day=date('d');
                                                        }

                                                        $ser_date[] = date('Y-m-d',strtotime($attn->attn_date));
                                                    }    
                                                    if($i<10){
                                                        $str = $year.'-'.$month.'-0'.$i;
                                                    }else{
                                                        $str = $year.'-'.$month.'-'.$i;
                                                    }
                                                    $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));
                                                    if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p  class="holiday" style="font-size: 10px;margin: 0px">Holiday</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: green;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="present" style="font-size: 10px;margin: 0px">Present</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                    } else {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="holiday" style="font-size: 10px;margin: 0px">Holiday</p> <!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white; background-color: #4390b1;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="absent" style="font-size: 10px;margin: 0px ">Absent</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                        <?php }
                                                    } ?>
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        @endif
                                        @if($role == 'Student')
                                        <td><img src="{{asset('uploads').'/'.$attn->student_photo}}" style="width: 50px;"></td>
                                        <td>{{$attn->student_name}}</td>
                                        <td>                        
                                            <?php
                                                $str=0;
                                                $ser_date=[];
                                                for ($i=01; $i<=$month_day; $i++){
                                                    foreach ($manage_attendence as $attn) {
                                                        if($month == date('m') && date('d')==$i){
                                                            $month_day=date('d');
                                                        }

                                                        $ser_date[] = date('Y-m-d',strtotime($attn->date));
                                                    }    
                                                    if($i<10){
                                                        $str = $year.'-'.$month.'-0'.$i;
                                                    }else{
                                                        $str = $year.'-'.$month.'-'.$i;
                                                    }
                                                    $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));
                                                    if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p  class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: green;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="present" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                    } else {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white; background-color: #f5b120;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="absent" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                        <?php }
                                                    } ?>
                                                <?php
                                                }
                                            ?>

                                        </td>
                                        @endif
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                <tbody>
                                    @foreach($class_students as $std)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td><img src="{{asset('uploads').'/'.$std->student_photo}}" style="width: 50px;"></td>
                                        <td>{{$std->student_name}}</td>
                                        <td>
                                            <?php
                                                $str=0;
                                                $ser_date=[];
                                                for ($i=01; $i<=$month_day; $i++){
                                                    $manage_attendence = attendance::leftJoin('students','students.student_id','attendances.student_id')
                                                        ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                                        ->where('students.school_id',$school_id)
                                                        ->where('students.student_id',$std->student_id)
                                                        ->whereYear('attendances.created_at',$year)
                                                        ->whereMonth('attendances.created_at',$month)
                                                        ->orderBy('date','DESC')
                                                        ->get();
                                                    foreach ($manage_attendence as $attn1) {
                                                        if($month == date('m') && date('d')==$i){
                                                            $month_day=date('d');
                                                        }

                                                        $ser_date[] = date('Y-m-d',strtotime($attn1->date));
                                                        $attn_student_id = $attn1->student_id;

                                                    }    
                                                    if($i<10){
                                                        $str = $year.'-'.$month.'-0'.$i;
                                                    }else{
                                                        $str = $year.'-'.$month.'-'.$i;
                                                    }
                                                    $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));

                                                    if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p  class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: green;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="present" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                    } else {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white; background-color: #f5b120;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="absent" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                        <?php }
                                                    } ?>
                                                <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            @else
                                @if($role == "Teacher")
                                <tbody>
                                    @foreach($teacher as $attn)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        @if($role == 'Teacher')
                                        <td><img src="{{asset('uploads').'/'.$attn->teacher_photo}}" style="width: 50px;"></td>
                                        <td>{{$attn->teacher_name}}</td>
                                        <td>
                                            <?php
                                                $str=0;
                                                $ser_date=[];
                                                for ($i=01; $i<=$month_day; $i++){
                                                    $manage_attendence = attendance::leftJoin('students','students.student_id','attendances.student_id')
                                                        ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                                        ->where('students.school_id',$school_id)
                                                        ->where('students.student_id',$attn->student_id)
                                                        ->whereYear('attendances.created_at',$year)
                                                        ->whereMonth('attendances.created_at',$month)
                                                        ->orderBy('date','DESC')
                                                        ->get();
                                                    foreach ($manage_attendence as $attn1) {
                                                        if($month == date('m') && date('d')==$i){
                                                            $month_day=date('d');
                                                        }

                                                        $ser_date[] = date('Y-m-d',strtotime($attn1->date));
                                                        $attn_student_id = $attn1->student_id;

                                                    }    
                                                    if($i<10){
                                                        $str = $year.'-'.$month.'-0'.$i;
                                                    }else{
                                                        $str = $year.'-'.$month.'-'.$i;
                                                    }
                                                    $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));
                                                    if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p  class="holiday" style="font-size: 10px;margin: 0px">Holiday</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: green;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="present" style="font-size: 10px;margin: 0px">Present</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                    }else {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="holiday" style="font-size: 10px;margin: 0px">Holiday</p> <!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white; background-color: #4390b1;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="absent" style="font-size: 10px;margin: 0px ">Absent</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                        <?php }
                                                    } ?>
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        @endif
                                        @if($role == 'Student')
                                        <td><img src="{{asset('uploads').'/'.$attn->student_photo}}" style="width: 50px;"></td>
                                        <td>{{$attn->student_name}}</td>
                                        <td>                        
                                            <?php
                                                $str=0;
                                                $ser_date=[];
                                                for ($i=01; $i<=$month_day; $i++){
                                                    foreach ($manage_attendence as $attn) {
                                                        if($month == date('m') && date('d')==$i){
                                                            $month_day=date('d');
                                                        }
                                                        $ser_date[] = date('Y-m-d',strtotime($attn->date));
                                                    }    
                                                    if($i<10){
                                                        $str = $year.'-'.$month.'-0'.$i;
                                                    }else{
                                                        $str = $year.'-'.$month.'-'.$i;
                                                    }
                                                    $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));
                                                    if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p  class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: green;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="present" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                    } else {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white; background-color: #f5b120;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="absent" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                        <?php }
                                                    } ?>
                                                <?php
                                                }
                                            ?>

                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                <tbody>

                                    @foreach($class_students as $attn)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        @if($role == 'Teacher')
                                        <td><img src="{{asset('uploads').'/'.$attn->teacher_photo}}" style="width: 50px;"></td>
                                        <td>{{$attn->teacher_name}}</td>
                                        <td>
                                            <?php
                                                $str=0;
                                                $ser_date=[];
                                                for ($i=01; $i<=$month_day; $i++){
                                                    foreach ($manage_attendence as $attn) {
                                                        if($month == date('m') && date('d')==$i){
                                                            $month_day=date('d');
                                                        }

                                                        $ser_date[] = date('Y-m-d',strtotime($attn->attn_date));

                                                    }    
                                                    if($i<10){
                                                        $str = $year.'-'.$month.'-0'.$i;
                                                    }else{
                                                        $str = $year.'-'.$month.'-'.$i;
                                                    }
                                                    $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));
                                                    if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p  class="holiday" style="font-size: 10px;margin: 0px">Holiday</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: green;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="present" style="font-size: 10px;margin: 0px">Present</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                    } else {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="holiday" style="font-size: 10px;margin: 0px">Holiday</p> <!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white; background-color: #4390b1;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important; border-radius: 2px;"><span>{{$i}} / {{$res_day}}<p class="absent" style="font-size: 10px;margin: 0px ">Absent</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                        <?php }
                                                    } ?>
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        @endif
                                        @if($role == 'Student')
                                        <td><img src="{{asset('uploads').'/'.$attn->student_photo}}" style="width: 50px;"></td>
                                        <td>{{$attn->student_name}}</td>
                                        <td>                        
                                            <?php
                                                $str=0;
                                                $ser_date=[];
                                                $attn_student_id = '';
                                                for ($i=01; $i<=$month_day; $i++){

                                                    $manage_attendence = attendance::leftJoin('students','students.student_id','attendances.student_id')
                                                        ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                                        ->where('students.school_id',$school_id)
                                                        ->where('students.student_id',$attn->student_id)
                                                        ->whereYear('attendances.created_at',$year)
                                                        ->whereMonth('attendances.created_at',$month)
                                                        ->orderBy('date','DESC')
                                                        ->get();
                                                    foreach ($manage_attendence as $attn1) {
                                                        if($month == date('m') && date('d')==$i){
                                                            $month_day=date('d');
                                                        }

                                                        $ser_date[] = date('Y-m-d',strtotime($attn1->date));
                                                        $attn_student_id = $attn1->student_id;

                                                    }
                                                    if($i<10){
                                                        $str = $year.'-'.$month.'-0'.$i;
                                                    }else{
                                                        $str = $year.'-'.$month.'-'.$i;
                                                    }
                                                    $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));
                                                    if ($attn_student_id == $attn->student_id) {
                                                        
                                                        if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p  class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: green;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="present" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                        }else {
                                                            if($res_day == "Fri"){?>
                                                                <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                            <?php }else{?>
                                                                <div class="attn" style="text-align: center; color: white; background-color: #f5b120;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="absent" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                            <?php }
                                                        } 
                                                    }else{
                                                        if(in_array($str, $ser_date)) {
                                                        if($res_day == "Fri"){?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p  class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                        <?php }else{?>
                                                            <div class="attn" style="text-align: center; color: white;  background-color: #f5b120;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="present" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="present" style="font-size: 15px;margin: 0px">Present</p> --></span></div>
                                                        <?php }
                                                        }else {
                                                            if($res_day == "Fri"){?>
                                                                <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p> --></span></div>
                                                            <?php }else{?>
                                                                <div class="attn" style="text-align: center; color: white; background-color: #f5b120;height: 40px;width: 50px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="absent" style="font-size: 10px;margin: 0px">{{$res_day}}</p><!-- <p class="absent" style="font-size: 15px;margin: 0px">Absent</p> --></span></div>
                                                            <?php }
                                                        }
                                                      }
                                                    ?>
                                                <?php
                                                }
                                            ?>

                                        </td>
                                        @endif
                                        <!-- <td>{{date('d-M-Y', strtotime($attn->date))}}</td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
</script>
<script>  
    $('#StudentID').hide();   
    $('#TeacherID').hide();   
    $('#usertype').change(function(){
        var usertype = $('#usertype option:selected').val();

        if(usertype == 'Teacher'){
                $('#StudentID').hide();    
                $('#TeacherID').show();    
        }else{
            $('#TeacherID').hide();
            $('#StudentID').show();
        }

    });  
     
</script>

<script>
    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();             
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ url('find-section') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#section_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Section</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#section_id").append(new Option(result[i].section_name, result[i].saction_id));
                    }
                  }
              });
        $.ajax({
                url: "{{ url('find-student-class') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#student_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Student</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#student_id").append(new Option(result[i].student_name +", section: "+ result[i].section_name+", Roll: "+ result[i].student_roll_no, result[i].student_id));
                    }
                  }
              });

        });
</script>
@endsection