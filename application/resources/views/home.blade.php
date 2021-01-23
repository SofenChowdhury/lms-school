@extends('layouts.SMS-APP')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-12">
        <div class=" top_report">
            <div class="row clearfix">
                @if(Auth::user()->role == "SUPPERADMIN" || Auth::user()->role == "Admin")
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('students') }}">

                        <!--<div class="card" style="background: #FF8A65;">-->
                        <div class="card" style="background: #5caa19;">
                            <div class="body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <i class="fas fa-user-graduate fa-4x" style="color: #fff"></i>
                                        <h6 style="margin-top: 10px;color: #fff">Student </h6>
                                    </div>
                                    <div class="number float-right text-right">
                                        <span class="font700" style="font-size: 60px;    line-height: 1;color: #fff">{{$total_student}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if(Auth::user()->role == "SUPPERADMIN" || Auth::user()->role == "Admin")
                <div class="col-lg-3 col-md-6 col-sm-6">
                @else
                <div class="col-lg-4 col-md-6 col-sm-6">    
                @endif    
                    <a href="{{ route('teachers') }}"><div class="card">
                        <!--<div class="body" style="background: #4991B3;">-->
                        <div class="body" style="background: #a3da57;">
                            <div class="clearfix">
                                <div class="float-left">
                                    <i class="fas fa-chalkboard-teacher fa-4x" style="color: #fff"></i>
                                    <h6 style="margin-top: 10px;color: #fff">Teacher </h6>
                                </div>
                                <div class="number float-right text-right">
                                    <span class="font700" style="font-size: 60px;line-height: 1;color: #fff">{{$total_teacher}}</span>
                                </div>
                            </div>
                            
                        </div>
                    </div></a>
                </div>
                
                @if(Auth::user()->role == "SUPPERADMIN" || Auth::user()->role == "Admin")
                <div class="col-lg-3 col-md-6 col-sm-6">
                @else
                <div class="col-lg-4 col-md-6 col-sm-6">    
                @endif
                    <a href="{{ route('classes') }}"><div class="card" style="background: #6da521;">
                        <div class="body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <i class="fab fa-accusoft fa-4x" style="color: #fff"></i>
                                    <h6 style="margin-top: 10px;color: #fff">Class </h6>
                                </div>
                                <div class="number float-right text-right">
                                    <span class="font700" style="font-size: 60px;line-height: 1;color: #fff">{{$total_class}}</span>
                                </div>
                            </div>
                            
                        </div>
                    </div></a>
                </div>
                
                @if(Auth::user()->role == "SUPPERADMIN" || Auth::user()->role == "Admin")
                <div class="col-lg-3 col-md-6 col-sm-6">
                @else
                <div class="col-lg-4 col-md-6 col-sm-6">    
                @endif
                    <a href="{{ route('books') }}"><div class="card" style="background: #a3da57;">
                        <div class="body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <i class="icon-book-open fa-4x" style="color: #fff"></i>
                                    <h6 style="margin-top: 10px;color: #fff">Books </h6>
                                </div>
                                <div class="number float-right text-right">
                                    <span class="font700" style="font-size: 60px;line-height: 1;color: #fff">{{$total_books}}</span>
                                </div>
                            </div>
                            
                        </div>
                    </div></a>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->role == 'STUDENT')
<div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Student Profile</h2>
            </div>
            <div class="body">
                
                @foreach($student_info as $info)
                <table class="table">
                    <tr>
                        <th colspan="3" class="text-center"><img src="{{asset('uploads').'/'.$info->student_photo}}" style="width:100px; height: 100px; border-radius: 50px;"></th>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$info->student_name}}</td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>:</td>
                        <td>{{$info->class_name}}</td>
                    </tr>
                    <tr>
                        <td>Section</td>
                        <td>:</td>
                        <td>{{$info->section_name}}</td>
                    </tr>
                    <tr>
                        <td>Roll</td>
                        <td>:</td>
                        <td>{{$info->student_roll_no}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$info->student_email}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{$info->student_phone}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{$info->student_address}}</td>
                    </tr>
                </table>
                @endforeach
                
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Subjects</h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Code</td>
                        <td>Author </td>
                        <td>Pass Mark</td>
                        <td>Final Mark</td>
                        <td>Counseling</td>
                    </tr>
                    @foreach($students_subject as $info)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$info->subject_subject_name}}</td>
                        <td>{{$info->subject_code}}</td>
                        <td>{{$info->subject_author_name}}</td>
                        <td>{{$info->subject_pass_mark}}</td>
                        <td>{{$info->subject_final_mark}}</td>
                        <td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#counseling{{$info->id}}"  title="Counseling"> <i class="fa fa-tasks"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- Counseling Modal -->
            @foreach($students_subject as $key_subject)
            <div class="modal fade" id="counseling{{$key_subject->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal_header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal_body">
                            <div class="container">
                                <form method="POST" action="" enctype="multipart/form-data">
                        			@csrf()
                                    <div class="">
                                        <div class="">
                                            <h4 class="text-center">Counseling With teacher</h4>
                                        </div>
                                        <div class="body">
                            			    <div class="row">
                            			        <div class="col-md-12" style="margin-bottom:-10px;">
                                                    <div class="form-group">
                                						<label>Teacher</label>
                                						<select class="form-control" name="teacher_id">
                                						    <option value="{{$key_subject->subject_teacher_id}}">{{$key_subject->teacher_name}}</option>
                                						</select>
                                					</div>
                            					</div>
                            					<div class="col-md-12" style="margin-bottom:-10px;">
                                                    <div class="form-group">
                                						<label>Subject</label>
                                						<input type="text" class="form-control" name="counseling_subject" placeholder="Contact Reason" required="">
                                					</div>
                            					</div>
                            					<div class="col-md-12" style="margin-bottom:-10px;">
                                                    <div class="form-group">
                                						<label>Message</label>
                                						<textarea class="form-control" name="counseling_message" placeholder="Your Message " required=""></textarea>
                                					</div>
                            					</div>
                            				</div>
                                        </div>
                                        <div class="modal-footer">
                            				<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                            				<button type="submit" class="btn btn-primary">Send</button>
                            			</div>
                                    </div>
                                </form>
                           </div>
                        </div>    
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Assignments</h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Subject Name</td>
                        <td>Title</td>
                        <td>Description </td>
                        <td>File </td>
                        <td>Deadline </td>
                    </tr>
                    @foreach($students_assignment as $assignment)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$assignment->subject_subject_name}}</td>
                        <td>{{$assignment->assignment_title}}</td>
                        <td>{!!$assignment->assignment_description!!}</td>
                        <td><a href="{{asset('uploads').'/'.$assignment->assignment_file}}" style="color: #b30451; text-align: center; font-size: 20px;" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
                        <td>{{$assignment->assignment_deadline}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <!-- Contact to Teacher -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <form method="POST" action="" enctype="multipart/form-data">
			@csrf()
            <div class="card">
                <div class="header">
                    <h2 class="text-center">Contact With teacher</h2>
                </div>
                <div class="body">
    			    <div class="row">
    			        <div class="col-md-12" style="margin-bottom:-10px;">
                            <div class="form-group">
        						<label>Teacher</label>
        						<select class="form-control" name="teacher_id">
        						    <option value="">Select Teacher</option>
        						    @foreach($all_teacher as $teachers)
        						    <option value="{{$teachers->teacher_id}}">{{$teachers->teacher_name}}</option>
        						    @endforeach
        						</select>
        					</div>
    					</div>
    					<div class="col-md-12" style="margin-bottom:-10px;">
                            <div class="form-group">
        						<label>Subject</label>
        						<input type="text" class="form-control" name="subject" placeholder="Contact Reason" required="">
        					</div>
    					</div>
    					<div class="col-md-12" style="margin-bottom:-10px;">
                            <div class="form-group">
        						<label>Message</label>
        						<textarea class="form-control" name="message" placeholder="Your Message " required=""></textarea>
        					</div>
    					</div>
    				</div>
                </div>
                <div class="modal-footer">
    				<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
    				<button type="submit" class="btn btn-primary">Send</button>
    			</div>
            </div>
        </form>
        
        <div class="card">
            <div class="header">
                <h2 class="text-center">Messages</h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Sender</td>
                        <td>Replay For</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>Action</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
    <!-- Games  Part -->
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Game</h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th style="width:55px;"><img src="https://image.freepik.com/free-photo/medium-shot-blurred-man-playing-billiard_23-2148299227.jpg" style="width:50px;"></th>
                            <th><a href="https://www.miniclip.com/games/quickfire-pool-instant/" target="_blank">Quick Fire Pool</a></th>
                        </tr>
                        <tr>
                            <th style="width:55px;"><img src="https://static2.miniclipcdn.com/content/game-icons/medium/monkey_150x110.jpg" style="width:50px;"></th>
                            <th><a href="https://www.miniclip.com/games/monkey-kick/" target="_blank">Monkey Kick</a></th>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th style="width:55px;"><img src="https://static3.miniclipcdn.com/content/game-icons/medium/cube.jpg" style="width:50px;"></th>
                            <th><a href="https://www.miniclip.com/games/cube-buster/" target="_blank">Cube Buster</a></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->role == 'PARENTS')
<div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Parent`s Profile</h2>
            </div>
            <div class="body">
                
                @foreach($parents_info as $pinfo)
                <table class="table">
                    <tr>
                        <th colspan="3" class="text-center"><img src="{{asset('uploads').'/'.$pinfo->guardian_photo}}" style="width:100px; height: 100px; border-radius: 50px;"></th>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$pinfo->guardian_name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$pinfo->guardian_email}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{$pinfo->guardian_phone}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{$pinfo->guardian_address}}</td>
                    </tr>
                </table>
                @endforeach
                
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Children</h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Photo</td>
                        <td>Name</td>
                        <td>Class </td>
                        <td>Section</td>
                        <td>Roll</td>
                    </tr>
                    @foreach($students as $students)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td><img src="{{asset('uploads').'/'.$students->student_photo}}" style="width: 100px;"></td>
                        <td>{{$students->student_name}}</td>
                        <td>{{$students->class_name}}</td>
                        <td>{{$students->section_name}}</td>
                        <td>{{$students->student_roll_no}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Workshop </h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Sender</td>
                        <td>Title</td>
                        <td>File</td>
                        <td>Message</td>
                        <td>Action</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Messages</h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Sender</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>Action</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->role == 'TEACHER')
<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Teaher`s Profile</h2>
            </div>
            <div class="body">
                <table class="table">
                    <tr>
                        <th colspan="3" class="text-center"><img src="{{asset('uploads').'/'.$teacher_info->teacher_photo}}" style="width:100px; height: 100px; border-radius: 50px;"></th>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$teacher_info->teacher_name}}</td>
                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td>:</td>
                        <td>{{$teacher_info->teacher_designation}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$teacher_info->teacher_email}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{$teacher_info->teacher_phone}}</td>
                    </tr>
                    <tr>
                        <td>Joining Date</td>
                        <td>:</td>
                        <td>{{$teacher_info->teacher_joining_date}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{$teacher_info->teacher_address}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Class</h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Class Name</td>
                        <td>Section</td>
                        <td>Subject</td>
                    </tr>
                    @foreach($teacher_cls as $cls)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$cls->class_name}}</td>
                        <td>{{$cls->section_name}}</td>
                        <td>{{$cls->subject_subject_name}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h2 class="text-center">Messages</h2>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Sender</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>Action</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->role == "Admin" or Auth::user()->role == "SUPPERADMIN")
<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Students Attendance</h2>
            </div>
            <div class="body">
                <table id="tableid" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Photo</th>
                            <th>Date</th>
                            <th>Attn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($manage_attendance as $attendance)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$attendance->student_name}}</td>
                            <td><img src="{{ asset('uploads').'/'.$attendance->student_photo}}" style="width: 50px; height: 50px;"></td>
                            <td>{{date('d-M-Y', strtotime($attendance->date))}}</td>
                            <td>{{$attendance->attndence}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">Teacher Attendance</h2>
            </div>
            <div class="body">
                <table id="example1" class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Teacher Name</th>
                            <th>Photo</th>
                            <th>Date</th>
                            <th>Attn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($manage_teachter_attendance as $teachter_attendance)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$teachter_attendance->teacher_name}}</td>
                            <td><img src="{{ asset('uploads').'/'.$teachter_attendance->teacher_photo}}" style="width: 50px; height: 50px;"></td>
                            <td>{{date('d-M-Y', strtotime($teachter_attendance->attn_date))}}</td>
                            <td>{{$teachter_attendance->attndence}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="text-center">Workshop</h2>
                    </div>
                    <div class="col-md-5">
                        <center>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_workshop"  title="Create Workshop">
                                <i class="fa fa-plus-square"></i> 
                                Create Workshop 
                            </a>
                        </center>
                    </div>
                </div>
            </div>
            <div class="body">
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Sender</td>
                        <td>Title</td>
                        <td>File</td>
                        <td>Message</td>
                        <td>Deadline</td>
                        <td>Action</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_workshop" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal_body">
                    <div class="container">
                        <form method="POST" action="" enctype="multipart/form-data">
                			@csrf()
                            <div class="">
                                <div class="">
                                    <h4 class="text-center">workshop With Parents</h4>
                                </div>
                                <div class="body">
                    			    <div class="row">
                    			        <div class="col-md-12" style="margin-bottom:-10px;">
                                            <div class="form-group">
                        						<label>Parents</label>
                        						<select class="form-control" name="teacher_id">
                        						    <option value="">Select Parents</option>
                        						</select>
                        					</div>
                    					</div>
                    					<div class="col-md-12" style="margin-bottom:-10px;">
                                            <div class="form-group">
                        						<label>Title</label>
                        						<input type="text" class="form-control" name="title" placeholder="workshop Title" required="">
                        					</div>
                    					</div>
                    					<div class="col-md-12" style="margin-bottom:-10px;">
                                            <div class="form-group">
                        						<label>File</label>
                        						<input type="file" class="form-control" name="file" placeholder="" required="">
                        					</div>
                    					</div>
                    					<div class="col-md-12" style="margin-bottom:-10px;">
                                            <div class="form-group">
                        						<label>Deadline</label>
                        						<input type="date" class="form-control" name="deadline" placeholder="Deadline" required="">
                        					</div>
                    					</div>
                    					<div class="col-md-12" style="margin-bottom:-10px;">
                                            <div class="form-group">
                        						<label>Message</label>
                        						<textarea class="form-control" name="counseling_message" placeholder="Your Message " required=""></textarea>
                        					</div>
                    					</div>
                    				</div>
                                </div>
                                <div class="modal-footer">
                    				<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    				<button type="submit" class="btn btn-primary">Send</button>
                    			</div>
                            </div>
                        </form>
                   </div>
                </div>    
            </div>
        </div>
    </div>
</div>
@else
<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">User`s Profile</h2>
            </div>
            <div class="body">
                
                @foreach($user_info as $userInfo)
                <table class="table">
                    <tr>
                        <th colspan="3" class="text-center"><img src="{{asset('uploads').'/'.$userInfo->user_image}}" style="width:100px; height: 100px; border-radius: 50px;"></th>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$userInfo->user_name}}</td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>:</td>
                        <td style="color: red; font-weight: bold;">{{$userInfo->user_role}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$userInfo->user_email}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{$userInfo->user_phone}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{$userInfo->user_address}}</td>
                    </tr>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
</div>
<script>
    $(document).ready(function() {
    $('#example1').DataTable(
        
         {     

      "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 5
       } 
        );
} );


function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}
</script>
@endsection
