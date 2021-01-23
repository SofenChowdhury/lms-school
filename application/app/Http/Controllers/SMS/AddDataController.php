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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Teacher;use App\User;use App\SchoolClass;use App\Subject;use App\Section;use App\Student;use App\userInfo;
use App\StudentParent;use App\SchoolInfo;use App\ClassRoutine;use App\Assignment;use App\Syllabus;use App\Book;
use App\attendance;use App\TeacherAttendence;use App\Exam;use App\ExamSchedule;use App\Grage;use App\Transport;
use App\TransportMember;use App\ExamAttendence;use App\ExamMarks;use App\MarkPercentage;use App\Hostel;
use App\HostelMember;use App\LibraryMember;use App\BookIssued;use App\FeeType;use App\Invoice;use App\Expense;
use App\PaymentHistory;use App\Income;use App\AdmissionForm;use App\CompanyPayment;use App\Inbox;use App\Message;use App\Notifications\Attendance_notify;use App\QuizInfo;
use App\QuizQuestion;use App\QuizAnswer;
use App\AppsDevice;use App\AndroidNotification;
/* notification */
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM; 


class AddDataController  extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

    public function submitUserInfoForm(Request $request){        

        $school_id =  $this->school_info();

        $rules = array(         
            'user_name'                 => 'required|max:255',
            'user_designation'          => 'required',
            'user_gender'               => 'required',
            'user_image'                => 'required',
            'user_birthday'             => 'required',
            'user_religion'             => 'required',            
            'user_join_date'            => 'required',            
            'user_phone'                => 'required|numeric',            
            'user_address'              => 'required',            
            'user_state'                => 'required',
            'email'                     => 'required|unique:users',  
            'password'                  => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'     => 'min:6'
        );
        $this->validate($request, $rules);
        if($request->user_image){
            $this->validate($request, ['user_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
       
        $user = new User;

        $user->school_id      =   $school_id;  
        $user->email          =   $request->email;  
        $user->password       =   bcrypt($request->password);  
        $user->role           =   $request->user_role;  
        $user->save();    

        $last_insert_id       =   $user->id;

        $user_info = new userInfo; 

        $user_info->school_id          =   $school_id;          
        $user_info->user_id            =   $last_insert_id ;          
        $user_info->user_name          =   $request->user_name ;          
        $user_info->user_email         =   $request->email;          
        $user_info->user_designation   =   $request->user_designation;          
        $user_info->user_gender        =   $request->user_gender;          
        $user_info->user_blood_group   =   $request->user_blood_group;          
        $user_info->user_birthday      =   $request->user_birthday;  
        $user_info->user_religion      =   $request->user_religion;  
        $user_info->user_join_date     =   $request->user_join_date;  
        $user_info->user_phone         =   $request->user_phone;  
        $user_info->user_address       =   $request->user_address;  
        $user_info->user_state         =   $request->user_state;  
        $user_info->user_country       =   $request->user_country;  
        $user_info->user_role          =   $request->user_role;  
        $image = $request->file('user_image');
        if($image){
            $photo = rand().$request->file('user_image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('user_image')->move($destination, $photo);

             $user_info->user_image     = $photo;
        }       
        $user_info->save();
        
        Session::flash('success','Added Successfully Done !');
        return back();
    }

    public function submitteacherFrom(Request $request){        

        $school_id =  $this->school_info();

        $rules = array(         
            'name'                  => 'required|max:255',
            'designation'           => 'required',
            'gender'                => 'required',
            'file'                  => 'required',
            'birthday'              => 'required',
            'religion'              => 'required',            
            'joining_date'          => 'required',            
            'phone'                 => 'required|numeric',            
            'address'               => 'required',            
            'teacher_card_id'       => 'required',            
            'state'                 => 'required',            
            'country'               => 'required',  
            'email'                 => 'required|unique:users',  
            'password'              => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'             
        );
        $this->validate($request, $rules);
        if(substr($request->teacher_card_id,0,1) == 0){
            Session::flash('error','teacher_card_id can`t be Start by 0 !');
            return redirect()->back();
        }
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
       
        $user = new User;

        $user->school_id      =   $school_id;  
        $user->email          =   $request->email;  
        $user->password       =   bcrypt($request->password);  
        $user->role           =   "TEACHER";  
        $user->save();    

        $last_insert_id       =   $user->id;

        $teacher = new Teacher; 

        $teacher->school_id             =   $school_id;          
        $teacher->user_id               =   $last_insert_id ;          
        $teacher->teacher_name          =   $request->name ;          
        $teacher->teacher_email         =   $request->email;          
        $teacher->teacher_designation   =   $request->designation;          
        $teacher->teacher_gender        =   $request->gender;          
        $teacher->teacher_blood_group   =   $request->blood_group;          
        $teacher->teacher_birthday      =   $request->birthday;  
        $teacher->teacher_religion      =   $request->religion;  
        $teacher->teacher_joining_date  =   $request->joining_date;  
        $teacher->teacher_phone         =   $request->phone;  
        $teacher->teacher_address       =   $request->address;  
        $teacher->teacher_state         =   $request->state;  
        $teacher->teacher_country       =   $request->country;  
        $teacher->teacher_card_id       =   $request->teacher_card_id;  
        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

             $teacher->teacher_photo     = $photo;
        }       
        $teacher->save();
        // database 3

        // $teacher = DB::connection('mysql3')->table('members')->insert([
        //         'name'                  =>   $request->name,
        //         'email'                 =>   $request->email,
        //         'password'              =>   bcrypt($request->password),
        //         'phone'                 =>   $request->phone,
        //         'address'               =>   $request->address,
        //         'state'                 =>   $request->state,
        //         'country'               =>   $request->country,
        //         'image'                 =>   $request->file,
        //         ]);



        Session::flash('success','Added Successfully Done !');
        return back();
    }
    public function submitParentForm(Request $request){        

        $school_id =  $this->school_info();

        $rules = array(         
            'guardian_name'             => 'required|max:255',
            'guardian_fathers_name'     => 'required',
            'guardian_mothers_name'     => 'required',
            'guardian_address'          => 'required',
            'guardian_country'          => 'required',            
            'guardian_phone'            => 'required|numeric',           
            'email'                     => 'required|unique:users',            
            'password'                  => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'     => 'min:6',
            'image'                     => 'required'
        );

        $this->validate($request, $rules);
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
       
        $user = new User;

        $user->school_id      =   $school_id;  
        $user->email          =   $request->email;
        $user->password       =   bcrypt($request->password);  
        $user->role           =   "PARENTS";  
        $user->save();    

        $last_insert_id       =   $user->id;

        $parents = new StudentParent; 

        $parents->school_id                     =   $school_id;          
        $parents->user_id                       =   $last_insert_id ;          
        $parents->guardian_name                 =   $request->guardian_name ;          
        $parents->guardian_fathers_name         =   $request->guardian_fathers_name;          
        $parents->guardian_mothers_name         =   $request->guardian_mothers_name;          
        $parents->guardian_fathers_profession   =   $request->guardian_fathers_profession;          
        $parents->guardian_mothers_profession   =   $request->guardian_mothers_profession;          
        $parents->guardian_address              =   $request->guardian_address;  
        $parents->guardian_phone                =   "880".$request->guardian_phone;  
        $parents->guardian_country              =   $request->guardian_country;  
        $parents->guardian_email                =   $request->email;  

        $image = $request->file('image');
        if($image){
            $photo = rand().$request->file('image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('image')->move($destination, $photo);
            $parents->guardian_photo     = $photo;
        }       
        $parents->save();
        
        Session::flash('success','Added Successfully Done !');
        return back();
    }
    public function submitClassFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'name'            => 'required|max:255',
            'numeric_name'    => 'numeric|required',
            'teacher_id'      => 'required'
        );
        $this->validate($request, $rules);

        $classes = new SchoolClass;
        $classes->school_id           =   $school_id;  
        $classes->class_teacher_id    =   $request->teacher_id;  
        $classes->class_name          =   $request->name;  
        $classes->class_numeric       =   $request->numeric_name;  
        $classes->class_note          =   $request->note; 
        $classes->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function submitSubjectFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'class_id'       => 'required',
            'teacher_id'     => 'required',
            'subject_type'   => 'required',
            'subject_name'   => 'required',
            'pass_mark'      => 'required',
            'full_mark'      => 'required',
        );
        $this->validate($request, $rules);


        $subjects = new Subject;

        $subjects->school_id                =   $school_id;  
        $subjects->subject_class_id         =   $request->class_id;  
        $subjects->subject_teacher_id       =   $request->teacher_id;  
        $subjects->subject_type             =   $request->subject_type;  
        $subjects->subject_subject_name     =   $request->subject_name; 
        $subjects->subject_pass_mark        =   $request->pass_mark; 
        $subjects->subject_final_mark       =   $request->full_mark; 
        $subjects->subject_author_name      =   $request->subject_author; 
        $subjects->subject_code             =   $request->subject_code; 
        $subjects->subject_note             =   $request->subject_note; 
        $subjects->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }

    public function submitSectionFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'section_name'        => 'required',
            'class_id'            => 'required',
            'section_category'    => 'required',
            'section_capacity'    => 'required',
            'teacher_id'          => 'required'
        );
        $this->validate($request, $rules);


        $sections = new Section; 
        $sections->school_id            =   $school_id;  
        $sections->class_id             =   $request->class_id;  
        $sections->section_name         =   $request->section_name;  
        $sections->section_capacity     =   $request->section_capacity;  
        $sections->section_category     =   $request->section_category;  
        $sections->section_teacher_id   =   $request->teacher_id; 
        $sections->subject_note         =   $request->section_note; 
        $sections->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function savestudent(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'name'                  => 'required|max:255',
            'gaurdian'              => 'required|max:255',
            'gender'                => 'required',
            'birthday'              => 'required',            
            'religion'              => 'required',            
            'phone'                 => 'required|numeric',            
            'address'               => 'required',            
            'state'                 => 'required',            
            'country'               => 'required',
            'class'                 => 'required|max:255',
            // 'section'                   => 'required',
            'student_card_id'       => 'required|max:10|',
            'group'                 => 'required',
            'resgister_no'          => 'required',
            'roll'                  => 'required',
            'image'                 => 'required',           
            'remarks'               => 'required',            
            'email'                 => 'required|unique:users',            
            'password'              => 'min:6|
                                        required_with:password_confirmation|
                                        same:password_confirmation',            
            'password_confirmation' => 'min:6',            
        );

        $this->validate($request, $rules);

        if(substr($request->student_card_id,0,1) == 0){
            Session::flash('error','teacher_card_id can`t be Start by 0 !');
            return redirect()->back();
        }
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }

        $user = new User;

        $user->school_id      =   $school_id;  
        $user->email          =   $request->email;  
        $user->password       =   bcrypt($request->password);  
        $user->role           =   "STUDENT";  
        $user->save();  

        $last_insert_id       =   $user->id;

        $student = new Student; 
        $student->school_id   =  $school_id ; 

        $student->user_id                               =   $last_insert_id ;  
        $student->student_name                          =   $request->name ;          
        $student->student_guardian_id                   =   $request->gaurdian;          
        $student->student_gender                        =   $request->gender;          
        $student->student_blood_group                   =   $request->blood_group;          
        $student->student_birthday                      =   $request->birthday;          
        $student->student_religion                      =   $request->religion;  
        $student->student_phone                         =   $request->phone;  
        $student->student_address                       =   $request->address;  
        $student->student_state                         =   $request->state;  
        $student->student_country                       =   $request->country;  
        $student->student_class_id                      =   $request->class;  
        $student->student_section_id                    =   $request->section;  
        $student->student_group                         =   $request->group;  
        $student->student_optional_subject              =   $request->op_subject; 
        $student->student_register_no                   =   $request->resgister_no;  
        $student->student_card_id                       =   $request->student_card_id; 
        $student->student_roll_no                       =   $request->roll;  
        $student->student_extra_curricular_activities   =   $request->extracaricular;  
        $student->student_remarks                       =   $request->remarks;  
        $student->student_email                         =   $request->email;  
        
        $image = $request->file('image');
        if($image){
            $photo = rand().$request->file('image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('image')->move($destination, $photo);
            $student->student_photo     = $photo;
        }        
        $student->save();
        
        Session::flash('success','Added Successfully Done !');
        return back();
    
    }  

    public function submitRoutineForm(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'ac_year'               => 'required',
            'class_id'              => 'required',
            'subject_id'            => 'required',
            'day'                   => 'required',
            'subject_teacher_id'    => 'required',
            'start_time'            => 'required',
            'end_time'              => 'required',
            'room'                  => 'required',
        );
        $this->validate($request, $rules);


        $routine = new ClassRoutine; 
        $routine->school_id            =   $school_id; 

        $routine->ac_year              =   $request->ac_year;  
        $routine->class_id             =   $request->class_id;  
        $routine->section_id           =   $request->section_id;  
        $routine->subject_id           =   $request->subject_id; 
        $routine->day                  =   $request->day; 
        $routine->subject_teacher_id   =   $request->subject_teacher_id; 
        $routine->start_time           =   $request->start_time; 
        $routine->end_time             =   $request->end_time; 
        $routine->room                 =   $request->room;
        $routine->class_note           =   $request->class_note;

        $routine->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function submitAssignmentForm(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'assignment_title'          => 'required|max:255',
            'assignment_description'    => 'required',
            'assignment_deadline'       => 'required',
            'assignment_class_id'       => 'required',
            'assignment_section_id'     => 'required',            
            'assignment_subject_id'     => 'required',            
            'file'                      => 'required',           
        );

        $this->validate($request, $rules);
        // if($request->file){
        //     $this->validate($request, ['file' => "required|mimes:pdf,x-pdf,acrobat,vnd.pdf, text/pdf, text/x-pdf, mp4, mov, ogg,qt |max:200000",]);
        // }
        
        $user_id = Auth::user()->id;

        $assignment = new Assignment; 
        $assignment->school_id   =  $school_id ; 

        $assignment->user_id                 =    $user_id ;          
        $assignment->assignment_title         =   $request->assignment_title ;          
        $assignment->assignment_description   =   $request->assignment_description;          
        $assignment->assignment_deadline      =   $request->assignment_deadline;          
        $assignment->assignment_class_id      =   $request->assignment_class_id;          
        $assignment->assignment_section_id    =   $request->assignment_section_id;          
        $assignment->assignment_subject_id    =   $request->assignment_subject_id;  

        
        $pdf = $request->file('file');
        if($pdf){
            $pdf_doc = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $pdf_doc);

             $assignment->assignment_file     = $pdf_doc;
        }        
        $assignment->save();
        // Notification
        $uniqid = Str::random(9);

        $get_student = Student::where('student_class_id',$request->assignment_class_id)
            ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
            ->select('student_parents.user_id as parent_user_id','student_parents.guardian_email','students.user_id','students.student_email')
            ->get();
        foreach ($get_student as $key) {
            
            $send_notification = DB::table('notifications')
                ->insert( [ 'notifiable_id' => $key->user_id,
                            'id'=> Str::random(9),            
                            'notifiable_type'=> 'Auth/User',            
                            'type'           => 'assignment',            
                            'data'          => $request['assignment_title'],            
                            'student_id'    => $assignment->id,            
                            'school_id'  => $school_id,            
            ]);

            // $data = array(
            //     'name'      => Auth::user()->name,
            //     'message'   => $request->assignment_description
            // );
            // Mail::to($key->student_email)->send(new SendMailable($data));
            

        }
        foreach ($get_student as $key) {

            $send_notification = DB::table('notifications')
                ->insert( [ 'id'            => Str::random(9),
                            'notifiable_id' => $key->parent_user_id,
                            'notifiable_type'=> 'Auth/User',            
                            'type'           => 'assignment',            
                            'data'          => $request['assignment_title'],
                            'student_id'    => $assignment->id,            
                            'school_id'  => $school_id,            
            ]);

            // $data = array(
            //     'name'      => Auth::user()->name,
            //     'message'   => $request->assignment_description
            // );
            // Mail::to($key->student_email)->send(new SendMailable($data));
        }



        // Session::flash('success','Email has been sent to !');    
        Session::flash('success','Added Successfully Done !');
        return back();
    }
    public function submit_assignment_marks(Request $request){        
        $school_id =  $this->school_info();
        
        return $request;
        Session::flash('success','Added Successfully Done !');
        return back();
    }
    public function submitSyllabusesForm(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'sellabus_title'          => 'required|max:255',
            'sellabus_file'           => 'required',
            'sellabus_class_id'       => 'required',         
        );

        $this->validate($request, $rules);
        if($request->sellabus_file){
            $this->validate($request, ['sellabus_file' => "required|mimes:pdf,x-pdf,acrobat,vnd.pdf, text/pdf, text/x-pdf|max:10000",]);
        }


        $syllabus = new Syllabus; 
        $syllabus->school_id   =  $school_id ; 

        $syllabus->sellabus_title         =   $request->sellabus_title ;          
        $syllabus->sellabus_description   =   $request->sellabus_description;          
        $syllabus->sellabus_class_id      =   $request->sellabus_class_id;

        
        $pdf = $request->file('sellabus_file');
        if($pdf){
            $pdf_doc = rand().$request->file('sellabus_file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('sellabus_file')->move($destination, $pdf_doc);

            $syllabus->sellabus_file = $pdf_doc;
        }        
        $syllabus->save();
        
        Session::flash('success','Added Successfully Done !');
        return back();
    }
    // Android Notification
    
    public function fcmNotificationSend($title,$body,$devices)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder($title);

        $notificationBuilder->setBody($body)
        ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        // You must change it to get your tokens
        // $tokens = MYDATABASE::pluck('fcm_token')->toArray();
        $downstreamResponse = FCM::sendTo($devices, $option, $notification, $data);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        //return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();
        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();
        //return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();
        // return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();

    }

    public function save_attendanceForm(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'student_id'    => 'required',
            'date'          => 'required',     
        );

        $this->validate($request, $rules);

        $input = $request->all();
        for ($i= 0; $i< count(Input::get('student_id')); $i++){

            if($input['student_id'][$i] && $input['date'][$i]){

                $attendance = new attendance;

                $attendance->school_id         =  $school_id ;
                $attendance->student_id        =  $input['student_id'][$i] ;          
                $attendance->date              =  $input['date'][$i];
                $attendance->machinestype      =  "SCHOOLROOM";  
                $attendance->attndence         =  "P";  
                $attendance->save();

             }
            $user = Auth::user();
            $user->notify(new Attendance_notify(User::findOrFail(Auth::user()->id)));

            $user_id = Student::leftjoin('users','users.id','students.user_id')
                        ->where('student_id',$input['student_id'][$i] )
                        ->first(); 
            
            $parents_user_id = StudentParent::leftjoin('users','users.id','student_parents.user_id')
                        ->where('parents_id',$user_id->student_guardian_id )
                        ->first();

            $update = DB::table('notifications') 
                ->where('notifiable_id', Auth::user()->id)
                ->update( [ 'notifiable_id' => $parents_user_id->user_id,
                            'status'     => 1,            
                            'student_id' => $input['student_id'][$i],            
                            'school_id'  => $school_id,            
            ]);
                    
            $get_time = DB::table('notifications')->where('school_id',$school_id)->where('student_id',$user_id->student_id)->orderBy('updated_at','DESC')->first();       
            $check_device =  AppsDevice::where('user_id',$parents_user_id->user_id)->first();   
 
            $title = $user_id->student_name. " just entered into class !!";
            $body = 'Entered at '.date('d-M-Y h:i A', strtotime($get_time->updated_at));

            if ($check_device) {

                $android_noti = new AndroidNotification;
                $android_noti->user_id     =  $parents_user_id->user_id;          
                $android_noti->title       =  $title;
                $android_noti->body        =  $body;
                $android_noti->description =  '';  
                $android_noti->save();

                $this->fcmNotificationSend($title,$body,$check_device->device_id);
            }
                    
        }

        Session::flash('success','Added Successfully Done !');
        return redirect()->route('add-student-attendance');
    }
    public function save_teacherAttendanceForm(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'teacher_id'    => 'required',
            'date'          => 'required',        
        );

        $this->validate($request, $rules);

        $input = $request->all();
        for ($i= 0; $i< count(Input::get('teacher_id')); $i++){
            if($input['teacher_id'][$i]  && $input['date'][$i]){

                $attendance = new TeacherAttendence; 
                $attendance->school_id   =  $school_id ;

                $attendance->teacher_id     =   $input['teacher_id'][$i] ;          
                $attendance->attn_date      =   $input['date'][$i];          
                $attendance->attndence      =   "P";
  
                $attendance->save();
             }
          }
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->route('add-teacher-attendance');
    } 

    public function submitExamFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'exam_name'       => 'required',
            'exam_date'       => 'required',
        );
        $this->validate($request, $rules);


        $exam = new Exam; 
        $exam->school_id    =   $school_id; 
         
        $exam->exam_name    =   $request->exam_name;  
        $exam->exam_date    =   $request->exam_date;  
        $exam->exam_note    =   $request->exam_note;  

        $exam->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function submitExamScheduleFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'exam_id'        => 'required',
            'class_id'       => 'required',
            'section_id'     => 'required',
            'subject_id'     => 'required',
            'schedule_date'  => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required',
            'room'           => 'required',
        );
        $this->validate($request, $rules);


        $exam = new ExamSchedule; 
        $exam->school_id    =   $school_id; 
         
        $exam->exam_id          =   $request->exam_id;  
        $exam->class_id         =   $request->class_id;  
        $exam->section_id       =   $request->section_id;  
        $exam->subject_id       =   $request->subject_id;  
        $exam->schedule_date    =   $request->schedule_date;  
        $exam->start_time       =   $request->start_time;  
        $exam->end_time         =   $request->end_time;  
        $exam->room             =   $request->room;  

        $exam->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }

    public function save_exam_attendanceForm(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'student_id'    => 'required',
            'class_id'      => 'required',
            'section_id'      => 'required',
            'subject_id'    => 'required',         
            'exam_id'       => 'required',         
        
        );

        $this->validate($request, $rules);

        $input = $request->all();

        for ($i= 0; $i< count(Input::get('student_id')); $i++){
            if($input['student_id'][$i]  && $input['class_id'][$i] && $input['subject_id'][$i] && $input['exam_id'][$i]){

                $attendance = new ExamAttendence; 
                $attendance->school_id   =  $school_id ;

                $attendance->student_id     =   $input['student_id'][$i] ;          
                $attendance->class_id       =   $input['class_id'][$i];          
                $attendance->section_id     =   $input['section_id'][$i];          
                $attendance->subject_id     =   $input['subject_id'][$i];
                $attendance->exam_id        =   $input['exam_id'][$i];
                $attendance->attendence     =   "P";
  
                $attendance->save();
             }
          }
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->route('exam_attendence');
    }
    public function save_marksForm(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'student_id'    => 'required',
            'exam_id'       => 'required',
            'class_id'      => 'required',         
            'subject_id'    => 'required',                 
            'theory_marks'  => 'required',         
        );

        $this->validate($request, $rules);

        $input = $request->all();
        for ($i= 0; $i< count(Input::get('theory_marks')); $i++){

            if($input['student_id'][$i] !="" & $input['exam_id'][$i] !="" & $input['class_id'][$i] !="" & $input['subject_id'][$i] !="" & $input['theory_marks'][$i] !=""){

                $exam_marks = new ExamMarks; 
                $exam_marks->school_id   =  $school_id ;

                $exam_marks->student_id     =   $request->student_id[$i] ;          
                $exam_marks->exam_id        =   $request->exam_id[$i];          
                $exam_marks->class_id       =   $request->class_id[$i];
                $exam_marks->subject_id     =   $request->subject_id[$i];
                $exam_marks->mcq_marks      =   $request->mcq_marks[$i];
                $exam_marks->theory_marks   =   $request->theory_marks[$i];
                $exam_marks->pr_marks       =   $request->pr_marks[$i];
                $exam_marks->ca_marks       =   $request->ca_marks[$i];

                $exam_marks->save();
             }
          }
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->route('add_marks');
    }
    public function submitMarkPercentageFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'distribution_type'    => 'required',
            'distribution_value'   => 'required',
        );
        $this->validate($request, $rules);


        $markpercentage = new MarkPercentage; 
        $markpercentage->school_id    =   $school_id; 
         
        $markpercentage->distribution_type       =   $request->distribution_type;  
        $markpercentage->distribution_value      =   $request->distribution_value;  

        $markpercentage->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function submitGradeFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'grade_name'    => 'required',
            'grade_point'   => 'required',
            'mark'          => 'required',
            'min_mark'      => 'required',
        );
        $this->validate($request, $rules);


        $grade = new Grage; 
        $grade->school_id    =   $school_id; 
         
        $grade->grade_name       =   $request->grade_name;  
        $grade->grade_point      =   $request->grade_point;  
        $grade->mark             =   $request->mark;  
        $grade->min_mark         =   $request->min_mark;  
        $grade->grade_note       =   $request->grade_note;  
 

        $grade->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function submitTransportFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'route_name'    => 'required',
            'no_vehicle'    => 'required',
            'route_fare'    => 'required',
        );
        $this->validate($request, $rules);


        $grade = new Transport; 
        $grade->school_id    =   $school_id; 
         
        $grade->route_name   =   $request->route_name;  
        $grade->no_vehicle   =   $request->no_vehicle;  
        $grade->route_fare   =   $request->route_fare;  
        $grade->note         =   $request->note;
 
        $grade->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function submitTransportMemberFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'student_id'        => 'required',
            'class_id'          => 'required',
            'section_id'        => 'required',
            'transport_id'      => 'required',
            'transport_fees'    => 'required',
           
           
        );
        $this->validate($request, $rules);


        $transport_member = new TransportMember; 
        $transport_member->school_id    =   $school_id; 
         
        $transport_member->student_id      =   $request->student_id;  
        $transport_member->class_id        =   $request->class_id;  
        $transport_member->section_id      =   $request->section_id;  
        $transport_member->transport_id    =   $request->transport_id;
        $transport_member->transport_fees  =   $request->transport_fees;
 
        $transport_member->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }

    public function submitHostelFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'hostel_name'       => 'required',
            'hostel_type'       => 'required',
            'hostel_address'    => 'required|max:255',
            'hostel_fee'        => 'required|max:255'
        );
        $this->validate($request, $rules);


        $hostel = new Hostel; 
        $hostel->school_id    =   $school_id; 
         
        $hostel->hostel_name      =   $request->hostel_name;  
        $hostel->hostel_type      =   $request->hostel_type;  
        $hostel->hostel_address   =   $request->hostel_address;  
        $hostel->hostel_fee       =   $request->hostel_fee;  
        $hostel->note             =   $request->note;

 
        $hostel->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    }
    public function submitHostelMemberFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'member_name'  => 'required|max:200',
            'class_id'     => 'required',
            'hostel_id'    => 'required',
            'room'         => 'required',
          
        );
        $this->validate($request, $rules);


        $members = new HostelMember; 
        $members->school_id    =   $school_id; 
         
        $members->member_name =   $request->member_name;  
        $members->class_id    =   $request->class_id;  
        $members->hostel_id   =   $request->hostel_id;
        $members->room        =   $request->room;

 
        $members->save(); 
        Session::flash('success','Added Successfully Done !');
        return back();   
    } 
    public function submitLibraryMemberFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'role'       => 'required',
            'member_fee' => 'required',
        );
        $this->validate($request, $rules);
        if ($request->teacher_id) {
            $user_id = $request->teacher_id;
        }else if($request->student_id){
             $user_id = $request->student_id;
        }else{
            Session::flash('error','Please Select Member');  
            return back();  
        }

        $members = new LibraryMember; 
        $members->school_id    =   $school_id; 
         
        $members->role          =   $request->role;  
        $members->user_id       =   $user_id;  
        $members->member_fee    =   $request->member_fee;
        $members->note          =   $request->note;

 
        $members->save(); 
        Session::flash('success','Added Successfully Done !');    
        
        return back();   
    }
    public function submitBooksFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'book_name'     => 'required',
            'author'        => 'required',
            'serial_id'     => 'required|max:200'
        );
        $this->validate($request, $rules);

        $book = new Book; 
        $book->school_id    =   $school_id; 
         
        $book->book_name    =   $request->book_name;  
        $book->author       =   $request->author;  
        $book->serial_id    =   $request->serial_id;
        $book->note         =   $request->note;

        $book_image = $request->file('book_image');
        if($book_image){
            $photo = rand().$request->file('book_image')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('book_image')->move($destination, $photo);
            $book->book_image     = $photo;
        }
 
        $book->save(); 
        Session::flash('success','Added Successfully Done !');    
        
        return back();   
    }
    public function submitBooksIssueFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'book_id'     => 'required',
            'due_date'    => 'required',
        );
        $this->validate($request, $rules);

       if ($request->check=="teacher") {
            $user_id = $request->teacher_id;
        }else if($request->check=="student"){
             $user_id = $request->student_id;
        }else{
            Session::flash('error','Please Select Member');  
            return back();  
        }

        $issue = new BookIssued; 
        $issue->school_id    =   $school_id; 
         
        $issue->book_id     =   $request->book_id;  
        $issue->user_id     =   $user_id;  
        $issue->due_date    =   $request->due_date;

 
        $issue->save(); 
        Session::flash('success','Added Successfully Done !');    
        
        return back();      
    }
    public function submitFeeTypeFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'fee_type'          => 'required',
            'fee_type_category' => 'required',
            'amount'            => 'required',
            'class_id'          => 'required',

          
        );
        $this->validate($request, $rules);

        $fee_type = new FeeType; 
        $fee_type->school_id    =   $school_id; 
         
        $fee_type->fee_type            =   $request->fee_type;  
        $fee_type->class_id            =   $request->class_id;  
        $fee_type->fee_type_category   =   $request->fee_type_category;  
        $fee_type->amount              =   $request->amount;  
        $fee_type->note                =   $request->note;

 
        $fee_type->save(); 
        Session::flash('success','Added Successfully Done !');    
        
        return back();      
    }
    public function submitInvoiceFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'class_id'          => 'required',
            'student_id'        => 'required',
            'fee_type_id'       => 'required',
            'paid'              => 'required',
            'discount'          => 'required'
        );
        $this->validate($request, $rules);

        $input = $request->all();
        
        $rand = Str::random(8);

        for ($i= 0; $i< count(Input::get('fee_type_id')); $i++){
            if($input['fee_type_id'][$i] !="" ){

                $pay = new PaymentHistory; 
                

                $pay->school_id   =  $school_id ;

                $pay->student_id    =   $request->student_id;          
                $pay->random_id     =   $rand;          
                $pay->class_id      =   $request->class_id;
                $pay->fee_type_id   =   $request->fee_type_id[$i];          

                $pay->save();
             }
          }

        // $last_insert_id       =   $user->id;

        $invoice = new Invoice; 
        $invoice->school_id    =   $school_id; 
                 
        $invoice->class_id         =   $request->class_id;  
        $invoice->student_id       =   $request->student_id;  
        $invoice->fee_type_id      =   $rand;
        $invoice->paid             =   $request->paid;  
        $invoice->total_fee        =   $request->totalfee;  
        $invoice->discount         =   $request->discount;
        $invoice->note             =   $request->note;
        $invoice->invoice_date     =   $request->invoice_date;

 
        $invoice->save(); 
        Session::flash('success','Added Successfully Done !');    
        
        return back();      
    }
    public function submitexpenseFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'exp_name'      => 'required',
            'exp_date'      => 'required',
            'exp_amount'    => 'required'

        );
        $this->validate($request, $rules);


        $expense = new Expense; 
        $expense->school_id    =   $school_id; 
                 
        $expense->exp_name      =   $request->exp_name;  
        $expense->exp_date      =   $request->exp_date;  
        $expense->exp_amount    =   $request->exp_amount;
        $expense->exp_note      =   $request->exp_note;  
       
        $expense->save(); 
        Session::flash('success','Added Successfully Done !');    
        
        return back();      
    } 

    public function submitincomeFrom(Request $request){        
        $school_id =  $this->school_info();
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
        $income->school_id    =   $school_id; 
                 
        $income->income_name      =   $request->income_name;  
        $income->income_date      =   $request->income_date;  
        $income->income_amount    =   $request->income_amount;
        $income->income_note      =   $request->income_note;  

       $pdf = $request->file('pdf');
            if($pdf){
                $pdf_doc = rand().$request->file('pdf')->getClientOriginalName();
                $destination = 'uploads';
                $request->file('pdf')->move($destination, $pdf_doc);

                 $income->pdf     = $pdf_doc;
            }

        $income->save(); 
        Session::flash('success','Added Successfully Done !');    
        
        return back();      
    } 
    public function submitPaymentFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'mm_id'       => 'required',
            'title'       => 'required',
            'amount'      => 'required',
            'description' => 'required',

        );
        $this->validate($request, $rules);
        
        $transection_id = uniqid();
        $payment = new CompanyPayment; 
        $payment->school_name           =   $request->school_name; 
        $payment->school_domain_name    =   $request->domain_name; 
     
        $payment->user_name     =   $request->user_name;  
        $payment->mm_id         =   $request->mm_id;  
        $payment->title         =   $request->title;  
        $payment->amount        =   $request->amount;
        $payment->transection_id =  $transection_id;

        $payment->description   =   $request->description;  

        $payment->save(); 

        $school_payment = DB::connection('mysql2')->table('school_payments')->insert([
                'school_name'           =>   $request->school_name,
                'school_domain_name'    =>   $request->domain_name,
                'user_name'             =>   $request->user_name,
                'mm_id'                 =>   $request->mm_id,
                'title'                 =>   $request->title,
                'amount'                =>   $request->amount,
                'transection_id'        =>   $transection_id,
                'description'           =>   $request->description,
                ]);


        Session::flash('success','Added Successfully Done !');    
        
        return back();      
    }

    public function submitInboxFrom(Request $request){        
        $school_id =  $this->school_info();
        $rules = array(         
            'inbox_title'       => 'required',
            'role'              => 'required',
            'short_description' => 'required',
            'message'           => 'required',

        );
        $this->validate($request, $rules);
        
        $message = new Inbox; 
        $message->school_id                 =  $school_id ; 
        $message->inbox_title               =  $request->inbox_title; 
        $message->role                      =  $request->role; 
        $message->inbox_short_description   =  $request->short_description; 
        $message->inbox_message             =  $request->message; 
         
        $message->save();

        $last_insert_id    = $message->id;

        if ($request->role == 'Parent') {

            if ($request->class_id == 0) {

                $parents = StudentParent::where('school_id',$school_id)->get();

                foreach ($parents as $parent_id) {
                    $notifiable_id[] = $parent_id->parents_id;
                    $user_id[] = $parent_id->user_id;
                }

                for ($i= 0; $i< count($notifiable_id); $i++){
                    $notify = new Message; 
                    $notify->school_id     =  $school_id ; 
                    $notify->notifiable_id =  $notifiable_id[$i];  
                    $notify->inbox_id      =  $last_insert_id; 

                    $notify->save();

                    //android notification data
                    $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$notifiable_id[$i])->orderBy('updated_at','DESC')->first();             
                     $check_device =  AppsDevice::where('user_id',$user_id[$i])->first();   
 
                    $title          = $request->inbox_title;
                    $body           = $request->short_description;
                    $description    = $request->message;
                    
                    if ($check_device) {

                        $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                    }
                }
            }else{

                if ($request->parents_id == 0) {
                    $parents = StudentParent::leftjoin('students','students.student_guardian_id','student_parents.parents_id')
                                    ->where('student_parents.school_id',$school_id)
                                    ->where('students.student_class_id',$request->class_id)
                                    ->get();

                    foreach ($parents as $parent_id) {
                        $notifiable_id[] = $parent_id->parents_id;
                        $user_id[] = $parent_id->user_id;
                    }

                    for ($i= 0; $i< count($notifiable_id); $i++){
                        $notify = new Message; 
                        $notify->school_id     =  $school_id ; 
                        $notify->notifiable_id =  $notifiable_id[$i];  
                        $notify->inbox_id      =  $last_insert_id; 
                        $notify->save();

                        //android notification data

                        $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$notifiable_id[$i])->orderBy('updated_at','DESC')->first();             
                         $check_device =  AppsDevice::where('user_id',$user_id[$i])->first();   
     
                        $title          = $request->inbox_title;
                        $body           = $request->short_description;
                        $description    = $request->message;
                        
                        if ($check_device) {

                            $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                        }    

                    }
                }else{

                    $notify = new Message; 
                    $notify->school_id     =  $school_id ; 
                    $notify->notifiable_id =  $request->parents_id;  
                    $notify->inbox_id      =  $last_insert_id; 
                    $notify->save();

                    //android notification data
                    $get_parents = StudentParent::where('school_id',$school_id)
                        ->where('parents_id',$request->parents_id)
                        ->first();
                    $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$request->parents_id)->orderBy('updated_at','DESC')->first();             
                    $check_device =  AppsDevice::where('user_id',$get_parents->user_id)->first(); 

                    $title          = $request->inbox_title;
                    $body           = $request->short_description;
                    $description    = $request->message;
                        
                    if ($check_device) {

                        $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                    }

                }

            }

        }elseif($request->role == 'Student'){
            if ($request->class_id == 0) {

                $students = Student::where('school_id',$school_id)->get();

                foreach ($students as $students_id) {
                    $notifiable_id[]    = $students_id->student_id;
                    $user_id[]          = $students_id->user_id;
                }

                for ($i= 0; $i< count($notifiable_id); $i++){
                    $notify = new Message; 
                    $notify->school_id     =  $school_id ; 
                    $notify->notifiable_id =  $notifiable_id[$i];  
                    $notify->inbox_id      =  $last_insert_id; 

                    $notify->save();

                    //android notification data
                    
                    $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$notifiable_id[$i])->orderBy('updated_at','DESC')->first();             
                    $check_device =  AppsDevice::where('user_id',$user_id[$i])->first();   
     
                    $title          = $request->inbox_title;
                    $body           = $request->short_description;
                    $description    = $request->message;
                        
                    if ($check_device) {

                        $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                    }

                }

            }else{

                if ($request->student_id == 0) {
                    $students = Student::where('students.school_id',$school_id)
                        ->where('students.student_class_id',$request->class_id)
                        ->get();

                    foreach ($students as $students_id) {
                        $notifiable_id[] = $students_id->student_id;
                        $user_id[] = $students_id->user_id;
                    }

                    for ($i= 0; $i< count($notifiable_id); $i++){
                        $notify = new Message; 
                        $notify->school_id     =  $school_id ; 
                        $notify->notifiable_id =  $notifiable_id[$i];  
                        $notify->inbox_id      =  $last_insert_id; 
                        $notify->save();

                        //android notification data
                    
                        $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$notifiable_id[$i])->orderBy('updated_at','DESC')->first();             
                        $check_device =  AppsDevice::where('user_id',$user_id[$i])->first();   
         
                        $title          = $request->inbox_title;
                        $body           = $request->short_description;
                        $description    = $request->message;
                            
                        if ($check_device) {

                            $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                        }
                    }
                }else{

                    $notify = new Message; 
                    $notify->school_id     =  $school_id ; 
                    $notify->notifiable_id =  $request->student_id;  
                    $notify->inbox_id      =  $last_insert_id; 
                    $notify->save();

                    $get_student = Student::where('school_id',$school_id)
                        ->where('student_id',$request->student_id)
                        ->first();

                    $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$request->student_id)->orderBy('updated_at','DESC')->first();             
                    $check_device =  AppsDevice::where('user_id',$get_student->user_id)->first();   
                    $title          = $request->inbox_title;
                    $body           = $request->short_description;
                    $description    = $request->message;
                            
                    if ($check_device) {

                        $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                    }    
                }

            }
        }else{
            if ($request->teacher_id == 0) {
                    $teachers = Teacher::where('teachers.school_id',$school_id)
                        ->get();

                    foreach ($teachers as $teachers_id) {
                        $notifiable_id[] = $teachers_id->teacher_id;
                        $user_id[] = $teachers_id->user_id;
                    }

                    for ($i= 0; $i< count($notifiable_id); $i++){
                        $notify = new Message; 
                        $notify->school_id     =  $school_id ; 
                        $notify->notifiable_id =  $notifiable_id[$i];  
                        $notify->inbox_id      =  $last_insert_id; 
                        $notify->save();

                        //android notification data
                    
                        $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$notifiable_id[$i])->orderBy('updated_at','DESC')->first();             
                        $check_device =  AppsDevice::where('user_id',$user_id[$i])->first();   
         
                        $title          = $request->inbox_title;
                        $body           = $request->short_description;
                        $description    = $request->message;
                            
                        if ($check_device) {

                            $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                        }
                    }
                }else{

                    $notify = new Message; 
                    $notify->school_id     =  $school_id ; 
                    $notify->notifiable_id =  $request->teacher_id;  
                    $notify->inbox_id      =  $last_insert_id; 
                    $notify->save();

                    $get_teacher = Teacher::where('school_id',$school_id)
                        ->where('teacher_id',$request->teacher_id)
                        ->first();

                    $get_time = DB::table('messages')->where('school_id',$school_id)->where('notifiable_id',$request->teacher_id)->orderBy('updated_at','DESC')->first();             
                    $check_device =  AppsDevice::where('user_id',$get_teacher->user_id)->first();   
                    $title          = $request->inbox_title;
                    $body           = $request->short_description;
                    $description    = $request->message;
                            
                    if ($check_device) {

                        $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                    }
                }

            }

        Session::flash('success','Added Successfully Done !');    
        return back();      

    }

    public function processAdmissionForm(Request $request){        
        $school_id =  $this->school_info();

        $rules = array(         
            'student_name'                              => 'required|max:255',
            'student_birthday'                          => 'required',
            'student_group'                             => 'required',
            'student_gender'                            => 'required',
            'student_class_id'                          => 'required',
            // 'student_section_id'                        => 'required',             
            'student_religion'                          => 'required',       
            'student_phone'                             => 'required',            
            'student_email'                             => 'required|email|unique:users,email',            
            'student_address'                           => 'required',
            'student_country'                           => 'required',  
            'student_gurdian'                           => 'required',
            'student_gurdian_profession'                => 'required',            
            'student_gurdian_address'                   => 'required|max:255',             
            'student_gurdian_country'                   => 'required|max:255',             
            'student_register_no'                       => 'required' ,            
            'student_roll_no'                           => 'required',             
            'student_extra_curricular_activities'       => 'required',             
            'student_optional_subject'                  => 'required',             
            'student_remarks'                           => 'required|max:255',             
            'password'                                  => 'required|min:6',          
            'gurdian_password'                          => 'required|min:6',            
        );
        $this->validate($request, $rules);
 
        $user = new User;
        $user->school_id            =   $school_id;  
        $user->email                =   $request->student_gurdian_email;  
        $user->password             =   bcrypt($request->gurdian_password);  
        $user->role                 =   "PARENTS";  
        $user->save();  
        $last_insert_id             =   $user->id;

        $parents = new StudentParent;
        $parents->school_id                =   $school_id;          
        $parents->user_id                  =   $last_insert_id ; 
        $parents->guardian_name                 =   $request->student_gurdian;
        $parents->guardian_fathers_profession   =   $request->student_gurdian_profession;
        $parents->guardian_country              =   $request->student_gurdian_country;
        $parents->guardian_address              =   $request->student_gurdian_address;
        $parents->guardian_email                =   $request->student_gurdian_email;
        $parents->guardian_photo                =   $request->student_gurdian_photo;

        $image = $request->file('student_gurdian_photo');
        if($image){
            $photo = rand().$request->file('student_gurdian_photo')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('student_gurdian_photo')->move($destination, $photo);

             $parents->guardian_photo     = $photo;
        }      
        $parents->save();

        // $prents_last_id =   $parents->parents_id;

        $prents_last_id = StudentParent::where('school_id',$school_id)
                                    ->orderBy('parents_id','desc')
                                    ->first();


        $user2 = new User;

        $user2->school_id      =   $school_id;  
        $user2->email          =   $request->student_email;  
        $user2->password       =   bcrypt($request->password);  
        $user2->role           =   "STUDENT";  
        $user2->save();    

        $student_last_insert_id     =   $user2->id;

        $student = new Student; 

        $student->school_id                             =   $school_id;          
        $student->user_id                               =   $student_last_insert_id ;          
        $student->student_guardian_id                   =   $prents_last_id->parents_id ;          
        $student->student_name                          =   $request->student_name ;          
        $student->student_birthday                      =   $request->student_birthday;          
        $student->student_group                         =   $request->student_group;          
        $student->student_gender                        =   $request->student_gender;          
        $student->student_class_id                      =   $request->student_class_id;
        $student->student_section_id                    =   $request->student_section_id;
        $student->student_religion                      =   $request->student_religion;  
        $student->student_blood_group                   =   $request->student_blood_group;  
        $student->student_phone                         =   $request->student_phone;  
        $student->student_email                         =   $request->student_email;  
        $student->student_address                       =   $request->student_address;  
        $student->student_country                       =   $request->student_country;          
        $student->student_state                         =   $request->student_country;          
        $student->student_register_no                   =   $request->student_register_no;  
        $student->student_roll_no                       =   $request->student_roll_no;  
        $student->student_extra_curricular_activities   =   $request->student_extra_curricular_activities;  
        $student->student_optional_subject              =   $request->student_optional_subject;  
        $student->student_remarks                       =   $request->student_remarks;  
        $student->student_photo                         =   $request->student_photo;  

        $image = $request->file('student_photo');
        if($image){
            $photo = rand().$request->file('student_photo')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('student_photo')->move($destination, $photo);

             $student->student_photo     = $photo;
        }
        $student->save();

        $admission_id = $request->admission_id;
        $delete_application = AdmissionForm::where('school_id',$school_id)
            ->where('admission_id',$admission_id)
            ->delete();

    Session::flash('success','Added Successfully Done !');
    return back();
       
    }
    public function savequiz(Request $request){
        $rules = array(         
            'quiz_title'  => 'required',
            'quiz_marks'  => 'required',
            'quiz_date'  => 'required',
          
        );
        $this->validate($request, $rules);

        $input = $request->all();

        $quiz_info = new QuizInfo;

        $quiz_info->quiz_title       =   $request->quiz_title;
        $quiz_info->host_id          =   Auth::user()->id;
        $quiz_info->quiz_type        =   $request->quiz_type;
        $quiz_info->quiz_marks       =   $request->quiz_marks;
        $quiz_info->class_id         =   $request->class_id;
        $quiz_info->section_id       =   $request->section_id;
        $quiz_info->quiz_note        =   $request->quiz_note;
        $quiz_info->quiz_date        =   $request->quiz_date;
        $quiz_info->quiz_start_time  =   $request->quiz_start_time;
        $quiz_info->quiz_end_time    =   $request->quiz_end_time;

        $quiz_info->save();

        $last_insert_id       =   $quiz_info->id;

        for ($i= 0; $i< count(Input::get('question_title')); $i++){

            if($input['question_title'][$i]){

                $quiz_question = new QuizQuestion;

                $quiz_question->quiz_info_id    =  $last_insert_id;
                $quiz_question->question_title  =  $input['question_title'][$i];
                $quiz_question->option1         =  $input['optiona'][$i];
                $quiz_question->option2         =  $input['optionb'][$i];
                $quiz_question->option3         =  $input['optionc'][$i];
                $quiz_question->option4         =  $input['optiond'][$i];
                $quiz_question->answer          =  $input['answer'][$i];
                $quiz_question->marker          =  $input['markes'][$i];

                $quiz_question->save();

             }
         }

        return redirect()->back();
    }
    public function answerquiz(Request $request){

        $rules = array(         
            'question_id'  => 'required|unique:quiz_answers',
          
        );
        $this->validate($request, $rules);

        $get_question = QuizQuestion::where('quiz_info_id',$request->quiz_info_id)->get();

        $input = $request->all();
        for ($i= 0; $i<count($get_question); $i++){

                $quiz_answer = new QuizAnswer;

                $quiz_answer->student_id    =  Auth::user()->id;
                $quiz_answer->quiz_info_id  =  $request->quiz_info_id;
                $quiz_answer->question_id   =  $input['question_id'][$i];
                $quiz_answer->answer        =  $request->$i;

                $quiz_answer->save();

         }
        return redirect()->back();
    }
}
