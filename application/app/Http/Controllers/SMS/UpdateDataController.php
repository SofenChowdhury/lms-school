<?php

namespace App\Http\Controllers\SMS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Input;
use App\Teacher;use App\User;use App\SchoolClass;use App\Subject;use App\Section;use App\StudentParent;use App\Expense;
use App\Student;use App\SchoolInfo;use App\ClassRoutine;use App\Assignment;use App\MarkPercentage;use App\Invoice;
use App\Syllabus;use App\Exam;use App\userInfo;use App\ExamSchedule;use App\Grage;use App\Transport;use App\Book;use App\Income;
use App\Hostel;use App\HostelMember;use App\LibraryMember;use App\BookIssued;use App\ExamMarks;use App\FeeType;
use App\PaymentHistory;use App\TransportMember;

class UpdateDataController extends Controller
{
    //
	public function school_info(){   
        // $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        // $parsedUrl = parse_url($url);
        // $host = explode('.', $parsedUrl['host']);
        // $domain_name = $host[0];
        // $manage_school_info = SchoolInfo::where('domain_name',$domain_name)->get();
        // foreach ($manage_school_info as $key) {
        //     $school_id = $key->school_id;
        // }
        $school_id=1;
         return $school_id;    
    }
    public function updateAdmin(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'user_name'          => 'required|max:255',
            'user_designation'   => 'required',
            'user_gender'        => 'required',           
            'user_birthday'      => 'required',            
            'user_religion'      => 'required',            
            'user_join_date'     => 'required',            
            'user_phone'         => 'required|numeric',            
            'user_address'       => 'required',
            'user_state'         => 'required|max:255',
            'user_country'       => 'required',
            'email'              => 'required',
                   
        );

        $this->validate($request, $rules);

        if($request->password){
            $this->validate($request, ['password'=> 'min:6|required_with:password_confirmation|same:password_confirmation',]);
        }
        if($request->user_image){
            $this->validate($request, ['user_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }

        $user = new User;
            if ($request->password) {
                $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

                $user->update(['email'      =>$request['email'],
                                'password'  => bcrypt($request['password'])
                    ]);
            }
            if ($request->email) {

                $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

                $user->update(['email'      =>$request['email'],
                    ]);
            }

        $user_info = new userInfo; 
        $user_info->school_id   =  $school_id ; 
        $user_info = $user_info->where('user_id',$request->user_id);
       
        $image = $request->file('user_image');
        if($image){
            $photo = rand().$request->file('user_image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('user_image')->move($destination, $photo);

            $user_info->user_image = $photo;
             
        $user_info->update(['user_name'          => $request['user_name'],
                          'user_email'           => $request['email'],
                          'user_designation'     => $request['user_designation'],
                          'user_gender'          => $request['user_gender'],
                          'user_blood_group'     => $request['user_blood_group'],
                          'user_birthday'        => $request['user_birthday'],
                          'user_religion'        => $request['user_religion'],
                          'user_join_date'       => $request['user_join_date'],
                          'user_phone'           => $request['user_phone'],
                          'user_address'         => $request['user_address'],
                          'user_state'           => $request['user_state'],
                          'user_country'         => $request['user_country'],
                          'user_email'           => $request['email'],
                          'user_image'           => $photo
                        ]);
                    }else{

        $user_info->update(['user_name'          => $request['user_name'],
                            'user_email'         => $request['email'],
                          'user_designation'     => $request['user_designation'],
                          'user_gender'          => $request['user_gender'],
                          'user_blood_group'     => $request['user_blood_group'],
                          'user_birthday'        => $request['user_birthday'],
                          'user_religion'        => $request['user_religion'],
                          'user_join_date'       => $request['user_join_date'],
                          'user_phone'           => $request['user_phone'],
                          'user_address'         => $request['user_address'],
                          'user_state'           => $request['user_state'],
                          'user_country'         => $request['user_country'],
                          'user_email'           => $request['email'],
                        ]);         
                    }
        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }


    public function updatestudent(Request $request){
    	$school_id =  $this->school_info();
        $rules = array(         
            'name'              => 'required|max:255',
            'gender'            => 'required',
            'birthday'          => 'required',            
            'religion'          => 'required',            
            'phone'             => 'required|numeric',            
            'address'           => 'required',            
            'state'             => 'required',            
            'country'           => 'required',
            'class'             => 'required|max:255',
            'group'             => 'required',           
            'student_card_id'   => 'required|unique:students,student_id',
            'resgister_no'      => 'required',
            'roll'              => 'required',           
            'remarks'           => 'required',      
        );

        $this->validate($request, $rules);

        if(substr($request->student_card_id,0,1) == 0){

            Session::flash('error','teacher_card_id can`t be Start by 0 !');
            return redirect()->back();
        }
        if($request->password){
            $this->validate($request, ['password'=> 'min:6|required_with:password_confirmation|same:password_confirmation',]);
        }
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }

        $user = new User;

        if ($request->password) {
            $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

            $user->update(['email'      =>$request['email'],
                            'password'  => bcrypt($request['password'])
                ]);

        }
        if ($request->email) {

            $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

            $user->update(['email'      =>$request['email'],
                ]);

        }
        $student = new Student; 
        $student->school_id   =  $school_id ; 
		$student = $student->where('student_id',$request->student_id);


        $image = $request->file('image');
        if($image){
            $photo = rand().$request->file('image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('image')->move($destination, $photo);

            $student->student_photo = $photo;
             
        $student->update(['student_name' 							=> $request['name'],
        				  'student_guardian_id' 					=> $request['gaurdian'],
        				  'student_gender' 							=> $request['gender'],
        				  'student_blood_group' 					=> $request['blood_group'],
        				  'student_birthday' 						=> $request['birthday'],
        				  'student_religion' 						=> $request['religion'],
        				  'student_phone' 							=> $request['phone'],
                          'student_email'                           => $request['email'],
        				  'student_address' 						=> $request['address'],
        				  'student_state' 							=> $request['state'],
        				  'student_country' 						=> $request['country'],
        				  'student_class_id' 						=> $request['class'],
        				  'student_section_id' 						=> $request['section'],
        				  'student_group' 							=> $request['group'],
        				  'student_optional_subject' 				=> $request['op_subject'],
                          'student_card_id'                         => $request['student_card_id'],
        				  'student_register_no' 					=> $request['resgister_no'],
        				  'student_roll_no' 						=> $request['roll'],
        				  'student_extra_curricular_activities' 	=> $request['extracaricular'],
        				  'student_remarks' 						=> $request['remarks'],
        				  'student_photo' 							=> $photo
        				]);
					}

		$student->update(['student_name' 							=> $request['name'],
        				  'student_guardian_id' 					=> $request['gaurdian'],
        				  'student_gender' 							=> $request['gender'],
        				  'student_blood_group' 					=> $request['blood_group'],
        				  'student_birthday' 						=> $request['birthday'],
        				  'student_religion' 						=> $request['religion'],
        				  'student_phone' 							=> $request['phone'],
                          'student_email'                           => $request['email'],
        				  'student_address' 						=> $request['address'],
        				  'student_state' 							=> $request['state'],
        				  'student_country' 						=> $request['country'],
        				  'student_class_id' 						=> $request['class'],
        				  'student_section_id' 						=> $request['section'],
        				  'student_group' 							=> $request['group'],
        				  'student_optional_subject' 				=> $request['op_subject'],
                          'student_card_id'                         => $request['student_card_id'],
        				  'student_register_no' 					=> $request['resgister_no'],
        				  'student_roll_no' 						=> $request['roll'],
        				  'student_extra_curricular_activities' 	=> $request['extracaricular'],
        				  'student_remarks' 						=> $request['remarks']
        				]);			

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updatestudentProfile(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'name'                      => 'required|max:255',
            'birthday'                  => 'required',            
            'religion'                  => 'required',            
            'phone'                     => 'required|numeric',            
            'address'                   => 'required',            
            'state'                     => 'required',            
            'country'                   => 'required',         
            'extracaricular'            => 'required',            

                   
        );

        $this->validate($request, $rules);

        if($request->password){
            $this->validate($request, ['password'=> 'min:6|required_with:password_confirmation|same:password_confirmation',]);
        }
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }

        $user = new User;

        $user->school_id      =   $school_id;  

        if ($request->password) {
            $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

            $user->update(['email'      =>$request['email'],
                            'password'  => bcrypt($request['password'])
                ]);

        }
        if ($request->email) {

            $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

            $user->update(['email'      =>$request['email'],
                ]);

        }

        $student = new Student; 
        $student->school_id   =  $school_id ; 
        $student = $student->where('student_id',$request->id);


        $image = $request->file('image');
        if($image){
            $photo = rand().$request->file('image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('image')->move($destination, $photo);

             $student->student_photo = $photo;
             
        $student->update(['student_name'                            => $request['name'],
                          'student_guardian_id'                     => $request['gaurdian'],
                          'student_blood_group'                     => $request['blood_group'],
                          'student_birthday'                        => $request['birthday'],
                          'student_religion'                        => $request['religion'],
                          'student_email'                           => $request['email'],
                          'student_phone'                           => $request['phone'],
                          'student_address'                         => $request['address'],
                          'student_state'                           => $request['state'],
                          'student_country'                         => $request['country'],
                          'student_extra_curricular_activities'     => $request['extracaricular'],
                          'student_photo'                           => $photo
                        ]);
                    }

        $student->update(['student_name'                            => $request['name'],
                          'student_guardian_id'                     => $request['gaurdian'],
                          'student_blood_group'                     => $request['blood_group'],
                          'student_birthday'                        => $request['birthday'],
                          'student_religion'                        => $request['religion'],
                          'student_email'                           => $request['email'],
                          'student_phone'                           => $request['phone'],
                          'student_address'                         => $request['address'],
                          'student_state'                           => $request['state'],
                          'student_country'                         => $request['country'],
                          'student_extra_curricular_activities'     => $request['extracaricular'],
                        ]);         

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateTeacherFrom(Request $request){
    	$school_id =  $this->school_info();
        
        $rules = array(         
            'name'                  =>  'required|max:255',
            'designation'           =>  'required',
            'gender'                =>  'required',
            'birthday'              =>  'required',
            'religion'              =>  'required',            
            'joining_date'          =>  'required',
            'teacher_card_id'       =>  'required|min:1',            
            'phone'                 =>  'required|numeric',            
            'address'               =>  'required',            
            'state'                 =>  'required',            
            'country'               =>  'required',       
        );

        $this->validate($request, $rules);

        if(substr($request->teacher_card_id,0,1) == 0){
            Session::flash('error','teacher_card_id can`t be Start by 0 !');
            return redirect()->back();
        }
        
        if($request->teacher_card_id == 0){
            $this->validate($request, ['teacher_card_id' => 'required|min:1',]);
        }
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }

        $user = new User;
            if ($request->password) {
                $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

                $user->update(['email'      =>$request['email'],
                                'password'  => bcrypt($request['password'])
                    ]);
            }
            if ($request->email) {

                $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

                $user->update(['email'      =>$request['email'],
                    ]);
            }

        $teacher = new Teacher; 
        $teacher->school_id   =  $school_id ;
        $teacher = $teacher->where('teacher_id',$request->teacher_id);

        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

            $teacher->teacher_photo     = $photo;
            $teacher->update(['teacher_name' 		=> $request['name'],
                          'teacher_email'           => $request['email'],
        				  'teacher_designation' 	=> $request['designation'],
        				  'teacher_gender' 			=> $request['gender'],
        				  'teacher_blood_group' 	=> $request['blood_group'],
        				  'teacher_birthday' 		=> $request['birthday'],
        				  'teacher_religion' 		=> $request['religion'],
        				  'teacher_joining_date' 	=> $request['joining_date'],
        				  'teacher_phone' 			=> $request['phone'],
        				  'teacher_address' 		=> $request['address'],
        				  'teacher_state' 			=> $request['state'],
                          'teacher_country'         => $request['country'],
        				  'teacher_card_id' 		=> $request['teacher_card_id'],
        				  'teacher_photo' 			=> $photo
        				  
        				]);
        }
        $teacher->update(['teacher_name' 			=> $request['name'],
                          'teacher_email'           => $request['email'],
        				  'teacher_designation' 	=> $request['designation'],
        				  'teacher_gender' 			=> $request['gender'],
        				  'teacher_blood_group' 	=> $request['blood_group'],
        				  'teacher_birthday' 		=> $request['birthday'],
        				  'teacher_religion' 		=> $request['religion'],
        				  'teacher_joining_date' 	=> $request['joining_date'],
        				  'teacher_phone' 			=> $request['phone'],
        				  'teacher_address' 		=> $request['address'],
        				  'teacher_state' 			=> $request['state'],
                          'teacher_country'         => $request['country'],
        				  'teacher_card_id' 		=> $request['teacher_card_id']
        				  
        				]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateClassFrom(Request $request){
    	$school_id =  $this->school_info();
        $rules = array(         
            'name'            => 'required|max:255',
            'numeric_name'    => 'numeric|required',
            'teacher_id'      => 'required'
        );
        $this->validate($request, $rules);
        
        $class = new SchoolClass; 
        $class->school_id   =  $school_id ;
        $class = $class->where('class_id',$request->class_id);
          
        $class->class_name          =   $request->name ;         
        $class->class_numeric       =   $request->numeric_name;          
        $class->class_teacher_id    =   $request->teacher_id;          
        $class->class_note          =   $request->note;          
 


        $class->update(['class_name'            => $request['name'],
                          'class_numeric'       => $request['numeric_name'],
                          'class_teacher_id'    => $request['teacher_id'],
                          'class_note'          => $request['note'],
                          
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateSubjectFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'class_id'             => 'required',
            'teacher_id'           => 'required',
            'subject_type'         => 'required',
            'subject_name'         => 'required',
            'pass_mark'            => 'required',
            'full_mark'            => 'required',           
            'subject_code'         => 'required'        
        );

        $this->validate($request, $rules);
       
        $subject = new Subject; 
        $subject->school_id   =  $school_id ;
        $subject = $subject->where('subject_id',$request->subject_id);
          
        $subject->subject_class_id          =   $request->class_id ;         
        $subject->subject_teacher_id        =   $request->teacher_id;          
        $subject->subject_type              =   $request->subject_type;          
        $subject->subject_subject_name      =   $request->subject_name;          
        $subject->subject_pass_mark         =   $request->pass_mark;  
        $subject->subject_final_mark        =   $request->full_mark;  
        $subject->subject_author_name       =   $request->subject_author;  
        $subject->subject_code              =   $request->subject_code;  
        $subject->subject_note              =   $request->subject_note;  


        $subject->update(['subject_class_id'        => $request['class_id'],
                          'subject_teacher_id'      => $request['teacher_id'],
                          'subject_type'            => $request['subject_type'],
                          'subject_subject_name'    => $request['subject_name'],
                          'subject_pass_mark'       => $request['pass_mark'],
                          'subject_final_mark'      => $request['full_mark'],
                          'subject_author_name'     => $request['subject_author'],
                          'subject_code'            => $request['subject_code'],
                          'subject_note'            => $request['subject_note'],
                          
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateSectionFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'section_name'       => 'required',
            'class_id'           => 'required',
            'section_category'   => 'required',
            'teacher_id'         => 'required'
        );

        $this->validate($request, $rules);
       
        $section = new Section; 
        $section->school_id   =  $school_id ;
        $section = $section->where('saction_id',$request->saction_id);
          
        $section->section_name          =   $request->section_name ;         
        $section->class_id              =   $request->class_id ;         
        $section->section_category      =   $request->section_category;          
        $section->section_capacity      =   $request->section_capacity;          
        $section->section_teacher_id    =   $request->teacher_id;          
        $section->subject_note          =   $request->section_note;  


        $section->update(['section_name'        => $request['section_name'],
                          'class_id'            => $request['class_id'],
                          'section_category'    => $request['section_category'],
                          'section_capacity'    => $request['section_capacity'],
                          'section_teacher_id'  => $request['teacher_id'],
                          'subject_note'        => $request['section_note'],
                          
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateRoutineForm(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'ac_year'               => 'required',
            'routine_id'            => 'required',
            'class_id'              => 'required',
            'section_id'            => 'required',
            'subject_id'            => 'required',
            'day'                   => 'required',
            'subject_teacher_id'    => 'required',
            'start_time'            => 'required',
            'end_time'              => 'required',
            'room'                  => 'required'
       
        );

        $this->validate($request, $rules);
       
        $routine = new ClassRoutine; 
        $routine->school_id   =  $school_id ;
        $routine = $routine->where('routine_id',$request->routine_id);
          
        $routine->ac_year               =   $request->ac_year ;    
        $routine->class_id              =   $request->class_id;          
        $routine->section_id            =   $request->section_id;          
        $routine->subject_id            =   $request->subject_id;  
        $routine->day                   =   $request->day;  
        $routine->subject_teacher_id    =   $request->subject_teacher_id;  
        $routine->start_time            =   $request->start_time;  
        $routine->end_time              =   $request->end_time;  
        $routine->room                  =   $request->room;  
        $routine->class_note            =   $request->class_note;  


        $routine->update(['ac_year'             => $request['ac_year'],
                          'class_id'            => $request['class_id'],
                          'section_id'          => $request['section_id'],
                          'subject_id'          => $request['subject_id'],
                          'day'                 => $request['day'],
                          'subject_teacher_id'  => $request['subject_teacher_id'],
                          'start_time'          => $request['start_time'],
                          'end_time'            => $request['end_time'],
                          'room'                => $request['room'],
                          'class_note'          => $request['class_note'],
                          
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateParentForm(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'guardian_name'                 => 'required',
            'guardian_fathers_name'         => 'required',
            'guardian_mothers_name'         => 'required',
            'guardian_fathers_profession'   => 'required',
            'guardian_mothers_profession'   => 'required',
            'guardian_address'              => 'required',
            'guardian_country'              => 'required',
            'guardian_phone'                => 'required|numeric',
            'password'                      => 'same:password_confirmation',
        );

        $this->validate($request, $rules);

        $user = new User;
            if ($request->password) {
                $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

                $user->update(['email'      =>$request['email'],
                                'password'  => bcrypt($request['password'])
                    ]);
            }
            if ($request->email) {

                $user = $user->where('users.school_id', $school_id)->where('users.id',$request->user_id);

                $user->update(['email'      =>$request['email'],
                    ]);
            }
        $routine = new StudentParent; 
        $routine->school_id   =  $school_id ;
        $routine = $routine->where('parents_id',$request->parents_id);
           
        $image = $request->file('image');
        if($image){
            $photo = rand().$request->file('image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('image')->move($destination, $photo);

            $routine->guardian_photo     = $photo;

        $routine->update(['guardian_name'               => $request['guardian_name'],
                          'guardian_fathers_name'       => $request['guardian_fathers_name'],
                          'guardian_mothers_name'       => $request['guardian_mothers_name'],
                          'guardian_fathers_profession' => $request['guardian_fathers_profession'],
                          'guardian_mothers_profession' => $request['guardian_mothers_profession'],
                          'guardian_address'            => $request['guardian_address'],
                          'guardian_country'            => $request['guardian_country'],
                          'guardian_email'              => $request['email'],
                          'guardian_phone'              => $request['guardian_phone'],
                          'guardian_photo'              => $photo
                        ]);
        }
        $routine->update(['guardian_name'               => $request['guardian_name'],
                          'guardian_fathers_name'       => $request['guardian_fathers_name'],
                          'guardian_mothers_name'       => $request['guardian_mothers_name'],
                          'guardian_fathers_profession' => $request['guardian_fathers_profession'],
                          'guardian_mothers_profession' => $request['guardian_mothers_profession'],
                          'guardian_address'            => $request['guardian_address'],
                          'guardian_country'            => $request['guardian_country'],
                          'guardian_email'              => $request['email'],
                          'guardian_phone'              => $request['guardian_phone'],

                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateAssignmentForm(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'assignment_title'          => 'required|max:255',
            'assignment_deadline'       => 'required',
            'assignment_class_id'       => 'required',
            'assignment_section_id'     => 'required',            
            'assignment_subject_id'     => 'required',
        );

        $this->validate($request, $rules);
        if($request->file){
            $this->validate($request, ['file' => "required|mimes:pdf,x-pdf,acrobat,vnd.pdf, text/pdf, text/x-pdf|max:10000",]);
        }

        $assignment = new Assignment; 
        $assignment->school_id   =  $school_id ;

        $assignment = $assignment->where('assignment_id',$request->assignment_id);
          
        $assignment->assignment_title           =   $request->assignment_title ;    
        $assignment->assignment_description     =   $request->assignment_description;          
        $assignment->assignment_deadline        =   $request->assignment_deadline;          
        $assignment->assignment_class_id        =   $request->assignment_class_id;  
        $assignment->assignment_section_id      =   $request->assignment_section_id;  
        $assignment->assignment_subject_id      =   $request->assignment_subject_id;  
 
        $pdf = $request->file('file');
            if($pdf){
                $pdf_doc = rand().$request->file('file')->getClientOriginalName();
                $destination = 'uploads';
                $request->file('file')->move($destination, $pdf_doc);

                $assignment->assignment_file     = $pdf_doc;
                $assignment->update(['assignment_title'     => $request['assignment_title'],
                          'assignment_description'  => $request['assignment_description'],
                          'assignment_deadline'     => $request['assignment_deadline'],
                          'assignment_class_id'     => $request['assignment_class_id'],
                          'assignment_section_id'   => $request['assignment_section_id'],
                          'assignment_subject_id'   => $request['assignment_subject_id'],
                          'assignment_file'         => $pdf_doc,
                        ]);
            }

        $assignment->update(['assignment_title'     => $request['assignment_title'],
                          'assignment_description'  => $request['assignment_description'],
                          'assignment_deadline'     => $request['assignment_deadline'],
                          'assignment_class_id'     => $request['assignment_class_id'],
                          'assignment_section_id'   => $request['assignment_section_id'],
                          'assignment_subject_id'   => $request['assignment_subject_id'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateSyllabusesForm(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'sellabus_title'        => 'required|max:255',
            'sellabus_class_id'     => 'required',
        );

        $this->validate($request, $rules);
        if($request->sellabus_file){
            $this->validate($request, ['sellabus_file' => "required|mimes:pdf,x-pdf,acrobat,vnd.pdf, text/pdf, text/x-pdf|max:10000",]);
        }

        $sellabus = new Syllabus; 
        $sellabus->school_id   =  $school_id ;

        $sellabus = $sellabus->where('syllabi_id',$request->syllabi_id);
          
        $sellabus->sellabus_title           =   $request->sellabus_title ;    
        $sellabus->sellabus_description     =   $request->sellabus_description;          
        $sellabus->sellabus_class_id        =   $request->sellabus_class_id;          
 
        $pdf = $request->file('sellabus_file');
            if($pdf){
                $pdf_doc = rand().$request->file('sellabus_file')->getClientOriginalName();
                $destination = 'uploads';
                $request->file('sellabus_file')->move($destination, $pdf_doc);

                $sellabus->sellabus_file     = $pdf_doc;
                $sellabus->update(['sellabus_title' => $request['sellabus_title'],
                          'sellabus_description'    => $request['sellabus_description'],
                          'sellabus_class_id'       => $request['sellabus_class_id'],
                          'sellabus_file'           => $pdf_doc,
                        ]);
            }

        $sellabus->update(['sellabus_title'       => $request['sellabus_title'],
                          'sellabus_description'  => $request['sellabus_description'],
                          'sellabus_class_id'     => $request['sellabus_class_id'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateExamFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'exam_name'  => 'required|max:255',
            'exam_date'  => 'required'
        );

        $this->validate($request, $rules);

        $exam = new Exam; 
        $exam->school_id   =  $school_id ;

        $exam = $exam->where('exam_id',$request->exam_id);
          
        $exam->exam_name     =   $request->exam_name ;    
        $exam->exam_date     =   $request->exam_date;          
        $exam->exam_note     =   $request->exam_note;          


        $exam->update(['exam_name'     => $request['exam_name'],
                          'exam_date'  => $request['exam_date'],
                          'exam_note'  => $request['exam_note'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateExamScheduleFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'exam_id'       => 'required|max:255',
            'class_id'      => 'required',
            'section_id'    => 'required',
            'subject_id'    => 'required',
            'schedule_date' => 'required',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'room'          => 'required',
        );

        $this->validate($request, $rules);

        $schedule = new ExamSchedule; 
        $schedule->school_id   =  $school_id ;

        $schedule = $schedule->where('schedule_id',$request->schedule_id);
          
        $schedule->exam_id          =   $request->exam_id ;    
        $schedule->class_id         =   $request->class_id;          
        $schedule->section_id       =   $request->section_id;          
        $schedule->subject_id       =   $request->subject_id;          
        $schedule->schedule_date    =   $request->schedule_date;          
        $schedule->start_time       =   $request->start_time;          
        $schedule->end_time         =   $request->end_time;          
        $schedule->room             =   $request->room;          


        $schedule->update(['exam_id'        => $request['exam_id'],
                          'class_id'        => $request['class_id'],
                          'section_id'      => $request['section_id'],
                          'subject_id'      => $request['subject_id'],
                          'schedule_date'   => $request['schedule_date'],
                          'start_time'      => $request['start_time'],
                          'end_time'        => $request['end_time'],
                          'room'            => $request['room'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateMarkPercentageFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'distribution_type'       => 'required|max:255',
            'distribution_value'      => 'required',
        );

        $this->validate($request, $rules);

        $marks_per = new MarkPercentage; 
        $marks_per->school_id   =  $school_id ;

        $marks_per = $marks_per->where('mark_per_id',$request->mark_per_id);
          
        $marks_per->distribution_type          =   $request->distribution_type ;    
        $marks_per->distribution_value         =   $request->distribution_value;        


        $marks_per->update(['distribution_type'       => $request['distribution_type'],
                          'distribution_value'        => $request['distribution_value'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateGradeFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'grade_name'    => 'required|max:255',
            'grade_point'   => 'required',
            'mark'          => 'required',
            'min_mark'      => 'required'
        );

        $this->validate($request, $rules);

        $grade = new Grage; 
        $grade->school_id   =  $school_id ;

        $grade = $grade->where('grade_id',$request->grade_id);
          
        $grade->grade_name     =   $request->grade_name ;    
        $grade->grade_point    =   $request->grade_point;          
        $grade->mark           =   $request->mark;          
        $grade->min_mark       =   $request->min_mark;          
        $grade->grade_note     =   $request->grade_note;        


        $grade->update(['grade_name'     => $request['grade_name'],
                          'grade_point'     => $request['grade_point'],
                          'mark'            => $request['mark'],
                          'min_mark'        => $request['min_mark'],
                          'grade_note'      => $request['grade_note'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateTransportFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'route_name'    => 'required|max:255',
            'no_vehicle'    => 'required',
            'route_fare'    => 'required'          
        );

        $this->validate($request, $rules);

        $transport = new Transport; 
        $transport->school_id   =  $school_id ;

        $transport = $transport->where('transport_id',$request->transport_id);
          
        $transport->route_name  =   $request->route_name ;    
        $transport->no_vehicle  =   $request->no_vehicle;          
        $transport->route_fare  =   $request->route_fare;          
        $transport->note        =   $request->note;

        $transport->update(['route_name'    => $request['route_name'],
                          'no_vehicle'      => $request['no_vehicle'],
                          'route_fare'      => $request['route_fare'],
                          'note'            => $request['note'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateTransportMemberFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'class_id'          => 'required|max:255',
            'section_id'        => 'required',
            'student_id'        => 'required',
            'transport_id'      => 'required',
            'transport_fees'    => 'required',
          
        );

        $this->validate($request, $rules);

        $transport_member = new TransportMember; 
        $transport_member->school_id   =  $school_id ;

        $transport_member = $transport_member->where('transport_member_id',$request->transport_member_id);
          
        $transport_member->class_id        =   $request->class_id ;    
        $transport_member->section_id      =   $request->section_id;          
        $transport_member->student_id      =   $request->student_id;          
        $transport_member->transport_id    =   $request->transport_id;
        $transport_member->transport_fees  =   $request->transport_fees;

        $transport_member->update(['class_id'   => $request['class_id'],
                          'section_id'          => $request['section_id'],
                          'student_id'          => $request['student_id'],
                          'transport_id'        => $request['transport_id'],
                          'transport_fees'      => $request['transport_fees'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }

    public function updateHostelFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'hostel_name'       => 'required|max:255',
            'hostel_type'       => 'required',
            'hostel_address'    => 'required',
            'hostel_fee'        => 'required'
        );

        $this->validate($request, $rules);

        $hostel = new Hostel; 
        $hostel->school_id   =  $school_id ;

        $hostel = $hostel->where('hostel_id',$request->hostel_id);
          
        $hostel->hostel_name     =   $request->hostel_name ;    
        $hostel->hostel_type     =   $request->hostel_type;          
        $hostel->hostel_address  =   $request->hostel_address;          
        $hostel->hostel_fee      =   $request->hostel_fee;
        $hostel->note            =   $request->note;

        $hostel->update(['hostel_name'       => $request['hostel_name'],
                          'hostel_type'         => $request['hostel_type'],
                          'hostel_address'      => $request['hostel_address'],
                          'hostel_fee'          => $request['hostel_fee'],
                          'note'                => $request['note'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateHostelMemberFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'class_id'      => 'required|max:255',
            'member_name'   => 'required',
            'hostel_id'     => 'required',
            'room'          => 'required',
        );

        $this->validate($request, $rules);

        $member = new HostelMember; 
        $member->school_id   =  $school_id ;

        $member = $member->where('host_member_id',$request->host_member_id);
          
        $member->class_id       =   $request->class_id ;    
        $member->member_name    =   $request->member_name;          
        $member->hostel_id      =   $request->hostel_id;          
        $member->room           =   $request->room;

        $member->update(['class_id'       => $request['class_id'],
                          'member_name'   => $request['member_name'],
                          'hostel_id'     => $request['hostel_id'],
                          'room'          => $request['room'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateLibraryTeacherMemberFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'member_fee'    => 'required',
            'member_id'     => 'required'
        );

        $this->validate($request, $rules);

        $member = new LibraryMember; 
        $member->school_id   =  $school_id ;

        $member = $member->where('member_id',$request->member_id);
  
        $member->user_id        =   $request->teacher_id;
        $member->member_fee     =   $request->member_fee;          
        $member->member_id      =   $request->member_id;
        $member->note           =   $request->note;

           $member->update(['user_id'     => $request['teacher_id'],
                          'member_fee'  => $request['member_fee'],
                          'note'        => $request['note'],
                        ]);
 
        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateLibraryStudentMemberFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'student_id'     => 'required',
            'member_fee'     => 'required',
            'member_id'      => 'required'
        );

        $this->validate($request, $rules);

        $member = new LibraryMember; 
        $member->school_id   =  $school_id ;

        $member = $member->where('member_id',$request->member_id);
  
        $member->student_id     =   $request->student_id;
        $member->member_fee     =   $request->member_fee;          
        $member->note           =   $request->note;

           $member->update(['user_id'    => $request['student_id'],
                          'member_fee'  => $request['member_fee'],
                          'note'        => $request['note'],
                        ]);
 
        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateBooksFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'book_name'     => 'required',
            'book_id'       => 'required',
            'serial_id'     => 'required'
        );

        $this->validate($request, $rules);

        $book = new Book; 
        $book->school_id   =  $school_id ;

        $book = $book->where('book_id',$request->book_id);
  
        $book->book_name      =   $request->book_name;
        $book->author         =   $request->author;
        $book->serial_id      =   $request->serial_id;
        $book->note           =   $request->note;

         $book_image = $request->file('book_image');
        if($book_image){
            $photo = rand().$request->file('book_image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('book_image')->move($destination, $photo);

            $book->book_image     = $photo;

           $book->update(['book_name'   => $request['book_name'],
                          'author'      => $request['author'],
                          'serial_id'   => $request['serial_id'],
                          'note'        => $request['note'],
                          'book_image'  => $photo,
                        ]);
        }else{
            $book->update(['book_name'   => $request['book_name'],
                          'author'      => $request['author'],
                          'serial_id'   => $request['serial_id'],
                          'note'        => $request['note'],
                        ]);
        }


        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateBooksIssuestudentFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'user_id'  => 'required',
            'book_id'     => 'required',
            'due_date'    => 'required',
            'issu_id'     => 'required',
        );

        $this->validate($request, $rules);

        $book = new BookIssued; 
        $book->school_id   =  $school_id ;

        $book = $book->where('issu_id',$request->issu_id);
  
        $book->user_id    =   $request->user_id;
        $book->book_id    =   $request->book_id;
        $book->due_date   =   $request->due_date;

         $book_image = $request->file('book_image');

            $book->update(['user_id'  => $request['user_id'],
                          'book_id'      => $request['book_id'],
                          'due_date'     => $request['due_date'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }

    public function return_book($id){
        $school_id =  $this->school_info();

        $book = new BookIssued; 
        $book->school_id   =  $school_id ;
        $return_date = date('Y-m-d H:i:s');
        $book = $book->where('issu_id',$id);
  
        // $book->return_book = $return_date;


        $book->update(['return_book'  => $return_date,
                          
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }

    public function submitBooksIssueTeacherFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'user_id'     => 'required',
            'book_id'     => 'required',
            'due_date'    => 'required',
            'issu_id'     => 'required',
        );

        $this->validate($request, $rules);

        $book = new BookIssued; 
        $book->school_id   =  $school_id ;

        $book = $book->where('issu_id',$request->issu_id);
  
        $book->user_id    =   $request->user_id;
        $book->book_id    =   $request->book_id;
        $book->due_date   =   $request->due_date;

         $book_image = $request->file('book_image');

            $book->update(['user_id'     => $request['user_id'],
                          'book_id'      => $request['book_id'],
                          'due_date'     => $request['due_date'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function mcq_marks_update_form($id,$marks){
        $school_id =  $this->school_info();

        $mark = new ExamMarks;     
        $mark = $mark->where('marks_id',$id);

        $mark->mcq_marks  =   $marks ;       
        $mark->update([
            'mcq_marks'   => $mark->mcq_marks, 
        ]);

            
        Session::flash('success','Update Successfully Done !');
        return response()->json(['success'=>'Update Successfully Done !']);
    }
    public function theory_marks_update_form($id,$theory_marks){
        $school_id =  $this->school_info();
       
        $mark = new ExamMarks;     
        $mark = $mark->where('marks_id',$id);

        $mark->theory_marks        =   $theory_marks ;       
        $mark->update([
            'theory_marks'   => $mark->theory_marks, 
        ]);

            
        Session::flash('success','Update Successfully Done !');
        return response()->json(['success'=>'Update Successfully Done !']);
    }
    public function pr_marks_update_form($id,$pr_marks){
        $school_id =  $this->school_info();
       
        $mark = new ExamMarks;     
        $mark = $mark->where('marks_id',$id);

        $mark->pr_marks  =   $pr_marks ;       
        $mark->update([
            'pr_marks'   => $mark->pr_marks, 
        ]);

            
        Session::flash('success','Update Successfully Done !');
        return response()->json(['success'=>'Update Successfully Done !']);
    }
    public function ca_marks_update_form($id,$ca_marks){
        $school_id =  $this->school_info();
       
        $mark = new ExamMarks;     
        $mark = $mark->where('marks_id',$id);

        $mark->ca_marks  =   $ca_marks ;       
        $mark->update([
            'ca_marks'   => $mark->ca_marks, 
        ]);

            
        Session::flash('success','Update Successfully Done !');
        return response()->json(['success'=>'Update Successfully Done !']);
    }
    public function updateFeeTypeFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'fee_type'          => 'required',
            'class_id'          => 'required',
            'fee_type_id'       => 'required',
            'fee_type_category' => 'required',
            'amount'            => 'required'
        );

        $this->validate($request, $rules);

        $fee_type = new FeeType; 
        $fee_type->school_id   =  $school_id ;

        $fee_type = $fee_type->where('fee_type_id',$request->fee_type_id);
  
        $fee_type->fee_type             =   $request->fee_type;
        $fee_type->class_id             =   $request->class_id;
        $fee_type->fee_type_id          =   $request->fee_type_id;
        $fee_type->fee_type_category    =   $request->fee_type_category;
        $fee_type->amount               =   $request->amount;
        $fee_type->note                 =   $request->note;

            $fee_type->update(['fee_type'       => $request['fee_type'],
                          'class_id'            => $request['class_id'],
                          'fee_type_category'   => $request['fee_type_category'],
                          'amount'              => $request['amount'],
                          'note'                => $request['note'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateInvoiceFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'class_id'      => 'required',
            'student_id'    => 'required',
            'fee_type_id'   => 'required',
            'paid'          => 'required',
            'invoice_id'    => 'required',
            'discount'      => 'required'
        );

        $this->validate($request, $rules);

        $input = $request->all();

        for ($i= 0; $i< count(Input::get('fee_type_id')); $i++){
            if($input['fee_type_id'][$i] !="" ){

                $pay = new PaymentHistory; 
                
                $pay->school_id   =  $school_id ;

                $pay->student_id    =   $request->student_id;    
                $pay->class_id      =   $request->class_id;
                $pay->fee_type_id   =   $request->fee_type_id[$i];          

                $pay->update(['student_id'  => $request['student_id'],
                          'class_id'        => $request['class_id'],
                          'fee_type_id'     => $request['fee_type_id'],
                         
                        ]);
             }
          }
        $invoice = new Invoice; 
        $invoice->school_id   =  $school_id ;

        $invoice = $invoice->where('invoice_id',$request->invoice_id);
  
        $invoice->class_id       =   $request->class_id;
        $invoice->student_id     =   $request->student_id;
        $invoice->fee_type_id    =   $request->fee_type_id;
        $invoice->paid           =   $request->paid;
        $invoice->discount       =   $request->discount;
        $invoice->note           =   $request->note;

            $invoice->update(['class_id'   => $request['class_id'],
                          'student_id'     => $request['student_id'],
                          'fee_type_id'    => $request['fee_type_id'],
                          'paid'           => $request['paid'],
                          'discount'       => $request['discount'],
                          'note'           => $request['note'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateexpenseFrom(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'exp_name'      => 'required',
            'exp_date'      => 'required',
            'exp_amount'    => 'required',
            'exp_id'        => 'required',
        );

        $this->validate($request, $rules);

        $expense = new Expense; 
        $expense->school_id   =  $school_id ;

        $expense = $expense->where('exp_id',$request->exp_id);
  
        $expense->exp_name     =   $request->exp_name;
        $expense->exp_date     =   $request->exp_date;
        $expense->exp_amount   =   $request->exp_amount;
        $expense->exp_note     =   $request->exp_note;


            $expense->update(['exp_name'    => $request['exp_name'],
                          'exp_date'        => $request['exp_date'],
                          'exp_amount'      => $request['exp_amount'],
                          'exp_note'        => $request['exp_note'],
                        ]);

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function updateincomeFrom(Request $request){
        $school_id =  $this->school_info();
        $title = "Edit Promotion";
        $rules = array(         
            'income_name'      => 'required',
            'income_date'      => 'required',
            'income_amount'    => 'required'
        );

        $this->validate($request, $rules);

        if($request->file){
            $this->validate($request, ['file' => "required|mimes:pdf,x-pdf,acrobat,vnd.pdf, text/pdf, text/x-pdf|max:10000",]);
        }


        $income = new Income; 
        $income->school_id   =  $school_id ;

        $income = $income->where('income_id',$request->income_id);
  
        $income->income_name     =   $request->income_name;
        $income->income_date     =   $request->income_date;
        $income->income_amount   =   $request->income_amount;
        $income->income_note     =   $request->income_note;


        $pdf = $request->file('pdf');
            if($pdf){
                $pdf_doc = rand().$request->file('pdf')->getClientOriginalName();
                $destination = 'uploads';
                $request->file('pdf')->move($destination, $pdf_doc);

                $income->pdf     = $pdf_doc;
                $income->update(['income_name'     => $request['income_name'],
                                    'income_date'      => $request['income_date'],
                                    'income_amount'    => $request['income_amount'],
                                    'pdf'              => $pdf_doc,
                                    'income_note'      => $request['income_note'],

                        ]);
            } else{
                $income->update(['income_name'  => $request['income_name'],
                                'income_date'   => $request['income_date'],
                                'income_amount' => $request['income_amount'],
                                'income_note'   => $request['income_note'],
                                ]);
            }

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function save_promotionForm(Request $request){
        $rules = array(         
            'promoted_class'              => 'required',          
        );
        $this->validate($request, $rules);

        $school_id =  $this->school_info();

        $input = $request->all();

        for ($i= 0; $i< count(Input::get('student_id')); $i++){

            if($input['student_id'][$i]){

                $stu = Student::where('student_id',$input['student_id'][$i])->first();
                $old_student = new OldStudent;

                $old_student->school_id      =  $school_id ;
        
                $old_student->student_id                            =  $stu->student_id;
                $old_student->student_name                          =  $stu->student_name;
                $old_student->user_id                               =  $stu->user_id;
                $old_student->student_guardian_id                   =  $stu->student_guardian_id; 
                $old_student->student_gender                        =  $stu->student_gender; 
                $old_student->student_blood_group                   =  $stu->student_blood_group; 
                $old_student->student_birthday                      =  $stu->student_birthday; 
                $old_student->student_religion                      =  $stu->student_religion; 
                $old_student->student_phone                         =  $stu->student_phone; 
                $old_student->student_email                         =  $stu->student_email; 
                $old_student->student_photo                         =  $stu->student_photo; 
                $old_student->student_address                       =  $stu->student_address; 
                $old_student->student_state                         =  $stu->student_state; 
                $old_student->student_country                       =  $stu->student_country; 
                $old_student->student_class_id                      =  $stu->student_class_id; 
                $old_student->student_section_id                    =  $stu->student_section_id; 
                $old_student->student_group                         =  $stu->student_group; 
                $old_student->student_optional_subject              =  $stu->student_optional_subject; 
                $old_student->student_register_no                   =  $stu->student_register_no; 
                $old_student->student_roll_no                       =  $stu->student_roll_no; 
                $old_student->student_extra_curricular_activities   =  $stu->student_extra_curricular_activities; 
                $old_student->student_remarks                       =  $stu->student_remarks;
                $old_student->student_academic_year                 =  date('Y-m-d H:i:s'); 

                $old_student->save();
            }
        }
        // Promotion Part 
        for ($i= 0; $i< count(Input::get('student_id')); $i++){

                if($input['student_id'][$i]){
                    $student_promotion = new Student;
                    $student_promotion->school_id   =  $school_id ;

                    $student_promotion = $student_promotion->where('student_id',$input['student_id'][$i]);
                    $student_promotion->update([
                    
                                            'student_class_id'      => $request->promoted_class,         
                                            'created_at'            => $request->up_student,                              
                                        ]);
            }
        

        }
    $title = "Show Promotion";
    $manage_class = SchoolClass::where('school_id',$school_id)->get();
    $stu = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                ->whereIn('students.student_id',$input['student_id'])
                ->get();

        // Session::flash('success','Update Successfully Done !');
        // return redirect()->route('edit_promotion');
        return view ('SMS.edit_promotion',compact('stu','title','manage_class'));
}

public function edit_promotionForm(Request $request){
    $rules = array(         
            'role'              => 'required',           
            'student_id'        => 'required',           
            'promoted_section'  => 'required',           
        );
    $this->validate($request, $rules);
    
    $school_id =  $this->school_info();
    $input = $request->all();
    $student = $input['student_id'];
    $n = count($student);
    for ($i= 0; $i< $n; $i++){
        $student_promotion = new Student;
        $student_promotion->school_id   =  $school_id ;

        $student_promotion = $student_promotion->where('student_id',$input['student_id'][$i]);

        $student_promotion->update([
                        
                        'student_section_id'   => $input['promoted_section'][$i],         
                         'student_roll_no'      => $input['role'][$i],         
                                                                         
                        ]);
    }
    Session::flash('success','Update Successfully Done !');
    return redirect()->route('promotion');    
    }
}
