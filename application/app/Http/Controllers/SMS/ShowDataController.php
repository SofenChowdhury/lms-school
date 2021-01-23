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
use App\Teacher;use App\User;use App\SchoolClass;use App\Subject;use App\Section;use App\StudentParent;use App\Student;
use App\SchoolInfo;use App\ClassRoutine;use App\Assignment;use App\Syllabus;use App\attendance;use App\Exam;use App\Grage;
use App\ExamSchedule;use App\Transport;use App\MarkPercentage;use App\ExamAttendence;use App\TransportMember;use App\Book;
use App\ExamMarks;use App\Hostel;use App\HostelMember;use App\LibraryMember;use App\TeacherAttendence;use App\userInfo;
use App\BookIssued;use App\Invoice;use App\FeeType;use App\Income;use App\PaymentHistory;use App\Expense;use App\Setting;
use App\AdmissionForm;use App\OldStudent;use App\CompanyPayment;use App\Notifications\Attendance_notify;use App\Inbox;use App\Message;use App\QuizInfo;use App\QuizQuestion;use App\QuizAnswer;
use App\AppsDevice;
/* notification */
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
class ShowDataController extends Controller
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

    public function fcmNotificationSend($title,$body,$devices){

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
    public function loginInfo(){  
        if (Auth::user()->role == "STUDENT") {
            $school_id =  $this->school_info();
            $login_info = Student::where('school_id',$school_id)->where('user_id',Auth::user()->id)->get();
             return $login_info;     
        }elseif (Auth::user()->role == "PARENTS") {
            $school_id =  $this->school_info();
            $login_info = StudentParent::where('school_id',$school_id)->where('user_id',Auth::user()->id)->get();
             return $login_info;
        }elseif (Auth::user()->role == "TEACHER") {
            $school_id =  $this->school_info();
            $login_info = Teacher::where('school_id',$school_id)->where('user_id',Auth::user()->id)->get();
             return $login_info;
        }
    }
    public function userProfile(){
        $school_id =  $this->school_info();
        $title = "User Profile";
        
        $user = Auth::user()->id; 
        $user_role = Auth::user()->role;

        if ($user_role=='STUDENT') {
            
            $manage_user = User::leftJoin('students','students.user_id','users.id')
                            ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('users.school_id',$school_id)
                            ->where('users.id',$user)
                            ->where('users.role',$user_role)
                            ->get();
        return view ('SMS.userProfile',compact('title','manage_user'));
        }elseif ($user_role=='TEACHER') {
            $manage_user = User::leftJoin('teachers','teachers.user_id','users.id')
                            ->where('users.id',$user)
                            ->where('users.role',$user_role)
                            ->where('users.school_id',$school_id)
                            ->get();
        return view ('SMS.userProfile',compact('title','manage_user'));
        }elseif ($user_role=='PARENTS') {
            $manage_user = User::leftJoin('student_parents','student_parents.user_id','users.id')
                            ->where('users.id',$user)
                            ->where('users.role',$user_role)
                            ->where('users.school_id',$school_id)
                            ->get();
        return view ('SMS.userProfile',compact('title','manage_user'));
        }elseif ($user_role=='Admin') {
            $manage_user = User::leftJoin('user_infos','user_infos.user_id','users.id')
                            ->where('users.id',$user)
                            ->where('users.role',$user_role)
                            ->where('users.school_id',$school_id)
                            ->get();
        return view ('SMS.userProfile',compact('title','manage_user'));
        }else{
            $manage_user = User::leftJoin('user_infos','user_infos.user_id','users.id')
                            ->where('users.id',$user)
                            ->where('users.role',$user_role)
                            ->where('users.school_id',$school_id)
                            ->get();
        return view ('SMS.userProfile',compact('title','manage_user'));
        }
    }

    public function students(){
        $school_id =  $this->school_info();
        $title = "Students";
        $manage_students = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftJoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->get();
        return view ('SMS.students',compact('title','manage_students'));
    }
    
    public function add_student(){
        $school_id =  $this->school_info();
        $title = "Student";
        $manage_parents     = StudentParent::where('school_id',$school_id)->get();
        $manage_class       = SchoolClass::where('school_id',$school_id)->get();
        $manage_school      = SchoolClass::where('school_id',$school_id)->get();
        $manage_section     = Section::where('school_id',$school_id)->get();
        $manage_subjects    = Subject::where('subject_type','Optional')
                                ->where('school_id',$school_id)
                                ->get();
        return view ('SMS.add-student',compact('title','manage_parents','manage_class','manage_section','manage_subjects'));
    } 
    
    public function student_details($id){
        $school_id =  $this->school_info();
        $title = "Student Details";
        
        $view_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                        ->leftJoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                        ->where('students.school_id',$school_id)
                        ->where('students.student_id',$id)
                        ->get();
        return view ('SMS.student-details',compact('title','view_student'));
    }
    
    public function parents(){
        $school_id =  $this->school_info();
        
        $title = "Parents";
        
        if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parent_id = $key->student_guardian_id;
            }
            $manage_parents = StudentParent::where('school_id', $school_id)
                                        ->where('parents_id',$parent_id)
                                        ->get();
            return view ('SMS.parents',compact('title','manage_parents','school_id'));
        }else{
            $manage_parents = StudentParent::where('school_id', $school_id)->get();
            
            return view ('SMS.parents',compact('title','manage_parents','school_id'));
        }
    }
    public function add_parent(){
        $school_id =  $this->school_info();
        $title = "Parent";
        return view ('SMS.add-parent',compact('title'));
    }
    public function parent_details($id){
        $school_id =  $this->school_info();
        $title = "Parent";
        $manage_parents = StudentParent::where('school_id', $school_id)->where('parents_id',$id)->get();
        return view ('SMS.parent_details',compact('title','manage_parents'));
    }
    public function teachers(){
        $school_id =  $this->school_info();
        $title = "Teachers";

        if (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }

            $teachers = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('students.student_guardian_id',$parents_id)
                            ->where('students.school_id',$school_id)
                            ->get();

            return view ('SMS.teachers',compact('title','teachers'));

        }else{
            $teachers = Teacher::leftJoin('users','users.id','teachers.user_id')->where('teachers.school_id',$school_id)->get();
            return view ('SMS.teachers',compact('title','teachers'));
        }
     
    }
    public function teacher_details($id){
        $school_id =  $this->school_info();
        $title = "Teachers Details";
        $teachers = Teacher::leftJoin('users','users.id','teachers.user_id')
                        ->where('teachers.school_id',$school_id)
                        ->where('teachers.teacher_id',$id)
                        ->get();

        return view ('SMS.teacher-details',compact('title','teachers'));
    }
    public function add_teacher(){
        $school_id =  $this->school_info();
        $title = "Teacher";
        return view ('SMS.add-teacher',compact('title'));
    }
    
    public function users(){
        $school_id =  $this->school_info();
        $title = "Users";

        $manage_user = userInfo::where('school_id',$school_id)->get();
        return view ('SMS.users',compact('title','manage_user'));
    }
    public function add_user(){
        $school_id =  $this->school_info();
        $title = "User";
        return view ('SMS.add-user',compact('title'));
    }
    public function classes(){
        $school_id =  $this->school_info();
        $title = "Classes";
        

         if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
            }
            $classes = SchoolClass::leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('school_classes.school_id', $school_id)
                            // ->where('school_classes.class_id',$class_id)
                            ->get();
            return view ('SMS.classes',compact('title','classes'));
        }else{
            $classes = SchoolClass::leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('school_classes.school_id', $school_id)
                            ->get();
            return view ('SMS.classes',compact('title','classes'));
        }
 
    }
    public function add_class(){
        $school_id =  $this->school_info();
        $title = "Class";
        $teachers = Teacher::where('school_id',$school_id)->get();
        return view ('SMS.add-class',compact('title','teachers'));
    }
    
    public function subjects(){
        $school_id =  $this->school_info();
        $title = "Subjects";
        
        if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
            }
            $subjects = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                        ->leftJoin('school_classes','school_classes.class_id','subjects.subject_class_id')
                        ->where('subjects.subject_class_id',$class_id)
                        ->where('subjects.school_id', $school_id)
                        ->get();
            return view ('SMS.subjects',compact('title','subjects'));
        }elseif (Auth::user()->role == "TEACHER") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->teacher_id;
            }

            $subjects = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                            ->leftJoin('school_classes','school_classes.class_id','subjects.subject_class_id')
                            ->where('subjects.subject_teacher_id',$parents_id)
                            ->where('subjects.school_id',$school_id)
                            ->get();

            return view ('SMS.subjects',compact('title','subjects'));

        }elseif (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }

            $subjects = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                            ->leftJoin('school_classes','school_classes.class_id','subjects.subject_class_id')
                            ->leftJoin('students','students.student_class_id','subjects.subject_class_id')
                            ->where('students.student_guardian_id',$parents_id)
                            ->where('subjects.school_id',$school_id)
                            ->get();

            return view ('SMS.subjects',compact('title','subjects'));

        }
        else{
           $subjects = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                        ->leftJoin('school_classes','school_classes.class_id','subjects.subject_class_id')
                        ->where('subjects.school_id',$school_id)
                        ->get();
            return view ('SMS.subjects',compact('title','subjects'));
        }            
    }
    public function add_subject(){
        $school_id =  $this->school_info();
        $title = "Subject";        
        $classes = SchoolClass::where('school_id',$school_id)->get();
        $teachers = Teacher::where('school_id',$school_id)->get();
        return view ('SMS.add-subject',compact('title','classes','teachers'));
    }
    public function sections(){
        $school_id =  $this->school_info();
        $title = "Sections";

        if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $section_id = $key->student_section_id;
            }
            $manage_sections = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                            ->leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('sections.saction_id',$section_id)
                            ->where('sections.school_id',$school_id)
                            ->get();
            return view ('SMS.sections',compact('title','manage_sections'));
        }else{
           $manage_sections = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                            ->leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('sections.school_id',$school_id)
                            ->get();
        return view ('SMS.sections',compact('title','manage_sections'));
        }
    }
    public function add_section(){
        $school_id =  $this->school_info();
        $title = "Section";
        $teachers = Teacher::where('school_id',$school_id)->get();
        $class = SchoolClass::where('school_id',$school_id)->get();
        return view ('SMS.add-section',compact('title','teachers','class'));
    }
    
    public function syllabuses(){
        $school_id =  $this->school_info();
        $title = "Syllabuses";

        if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
            }
            $manage_syllabuses = Syllabus::leftJoin('school_classes','school_classes.class_id','syllabi.sellabus_class_id')
                            ->where('syllabi.school_id', $school_id)
                            ->where('syllabi.sellabus_class_id', $class_id)
                            ->get();

            return view ('SMS.syllabuses',compact('title','manage_syllabuses'));
        }elseif (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }

            $manage_syllabuses = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('syllabi','syllabi.sellabus_class_id','school_classes.class_id')
                            ->where('students.student_guardian_id',$parents_id)
                            ->where('students.school_id',$school_id)
                            ->get();

            return view ('SMS.syllabuses',compact('title','manage_syllabuses'));

        }else{
            $manage_syllabuses = Syllabus::leftJoin('school_classes','school_classes.class_id','syllabi.sellabus_class_id')
                            ->where('syllabi.school_id', $school_id)
                            ->get();
            return view ('SMS.syllabuses',compact('title','manage_syllabuses'));
        } 

    }
    public function add_syllabus(){
        $school_id =  $this->school_info();
        $title = "Syllabus";
        $classes = SchoolClass::where('school_id',$school_id)->get();
        return view ('SMS.add-syllabus',compact('title','classes'));
    }
    public function view_syllabuses($id){
        $school_id =  $this->school_info();
        $title = "Syllabus";
        $manage_syllabuses = Syllabus::leftJoin('school_classes','school_classes.class_id','syllabi.sellabus_class_id')
                            ->where('syllabi.school_id', $school_id)
                            ->where('syllabi.syllabi_id', $id)
                            ->get();
        return view ('SMS.view_syllabus',compact('title','manage_syllabuses'));
    }

    public function assignments(){
        $school_id =  $this->school_info();
        $title = "Assignments";

        if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
            }
            $manage_assignment = Assignment::leftJoin('school_classes','school_classes.class_id','assignments.assignment_class_id')
                            ->leftJoin('sections','sections.saction_id','assignments.assignment_section_id')
                            ->where('assignments.school_id', $school_id)
                            ->where('assignments.assignment_class_id', $class_id)
                            ->get();

            return view ('SMS.assignments',compact('title','manage_assignment'));
        }elseif (Auth::user()->role == "TEACHER") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->teacher_id;
            }

            $manage_assignment = Assignment::leftJoin('school_classes','school_classes.class_id','assignments.assignment_class_id')
                            ->leftJoin('sections','sections.saction_id','assignments.assignment_section_id')
                            ->leftJoin('teachers','teachers.user_id','assignments.user_id')
                            ->where('assignments.school_id', $school_id)
                            ->where('assignments.user_id', Auth::user()->id)
                            ->get();              

            return view ('SMS.assignments',compact('title','manage_assignment'));

        }
        elseif (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }

            $manage_assignment = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('syllabi','syllabi.sellabus_class_id','school_classes.class_id')
                            ->leftJoin('assignments','assignments.assignment_class_id','school_classes.class_id')
                            ->leftJoin('sections','sections.saction_id','assignments.assignment_section_id')
                            ->where('students.student_guardian_id',$parents_id)
                            ->where('students.school_id',$school_id)
                            ->get();

            return view ('SMS.assignments',compact('title','manage_assignment'));

        }else{
            $manage_assignment = Assignment::leftJoin('school_classes','school_classes.class_id','assignments.assignment_class_id')
                            ->leftJoin('sections','sections.saction_id','assignments.assignment_section_id')
                            ->where('assignments.school_id', $school_id)
                            ->get();
        return view ('SMS.assignments',compact('title','manage_assignment'));
        }   
    }
    public function add_assignment(){
        $school_id =  $this->school_info();
        $title = "Assignment";
        $classes = SchoolClass::where('school_id',$school_id)->get();
        $section = Section::where('school_id', $school_id)->get();
        $subject = Subject::where('school_id',$school_id)->get();
        return view ('SMS.add-assignment',compact('title','classes','section','subject'));
    }
    public function submited_assignment($id){
        $school_id =  $this->school_info();
        $title = "Assignment";
        $assignment_details = Assignment::leftjoin('subjects','subjects.subject_id','assignments.assignment_subject_id')
            ->where('assignments.assignment_id',$id)
            ->first();
        
        $get_student        = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
            ->leftjoin('sections','sections.saction_id','students.student_section_id')
            ->where('students.student_class_id',$assignment_details->assignment_class_id)
            ->where('students.student_section_id',$assignment_details->assignment_section_id)
            ->select('school_classes.class_name','sections.section_name','students.student_name','students.student_id','students.student_roll_no')
            ->get();
        return view ('SMS.submited-assignment',compact('title','get_student','assignment_details'));
    }
    public function view_assignment($id){
        $school_id =  $this->school_info();
        $title = "Assignment";

        $manage_assignment = Assignment::leftJoin('school_classes','school_classes.class_id','assignments.assignment_class_id')
                            ->leftJoin('sections','sections.saction_id','assignments.assignment_section_id')
                            ->leftJoin('subjects','subjects.subject_id','assignments.assignment_subject_id')
                            ->where('assignments.school_id', $school_id)
                            ->where('assignments.assignment_id', $id)
                            ->get();
        return view ('SMS.view_assignment',compact('title','manage_assignment'));
    }

    public function routine(){
        $school_id =  $this->school_info();
        $title = "Routine";

        $sat = "Sat";
        $sun = "Sun";
        $mon = "Mon";
        $tus = "Tue";
        $wed = "Wed";
        $thu = "Thu";
        $fri = "Fri";

if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
                $section_id = $key->student_section_id;
            }
        $sat = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sat)
                        ->where('class_routines.class_id',$class_id)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $sun = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sun)
                        ->where('class_routines.class_id',$class_id)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $mon = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$mon)
                        ->where('class_routines.class_id',$class_id)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $tus = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$tus)
                        ->where('class_routines.class_id',$class_id)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $wed = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$wed)
                        ->where('class_routines.class_id',$class_id)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $thu = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$thu)
                        ->where('class_routines.class_id',$class_id)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $fri = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$fri)
                        ->where('class_routines.class_id',$class_id)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();
              
        $classes = Section::where('sections.school_id',$school_id)
                            ->where('sections.class_id',$class_id)
                            ->where('sections.saction_id',$section_id)
                            ->get();               
        return view ('SMS.routine',compact('title','sat','sun','mon','tus','wed','thu','fri','classes'));

            // return view ('SMS.assignments',compact('title','manage_assignment'));
        }elseif (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }


        $sat = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sat)                     
                        ->orderBy("start_time", "ASC")
                        ->get();

        $sun = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sun)                      
                        ->orderBy("start_time", "ASC")
                        ->get();

        $mon = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$mon)                     
                        ->orderBy("start_time", "ASC")
                        ->get();

        $tus = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$tus)                      
                        ->orderBy("start_time", "ASC")
                        ->get();

        $wed = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$wed)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $thu = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$thu)                     
                        ->orderBy("start_time", "ASC")
                        ->get();

        $fri = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$fri)                    
                        ->orderBy("start_time", "ASC")
                        ->get();
              

        $classes = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                        ->leftJoin('syllabi','syllabi.sellabus_class_id','school_classes.class_id')
                        ->leftJoin('assignments','assignments.assignment_class_id','school_classes.class_id')
                        ->leftJoin('sections','sections.saction_id','assignments.assignment_section_id')
                        ->where('students.student_guardian_id',$parents_id)
                        ->where('students.school_id',$school_id)
                        ->get();


            return view ('SMS.routine',compact('title','sat','sun','mon','tus','wed','thu','fri','classes'));

        }


        else{
            $sat = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sat)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $sun = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sun)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $mon = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$mon)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $tus = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$tus)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $wed = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$wed)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $thu = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$thu)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $fri = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$fri)
                        ->orderBy("start_time", "ASC")
                        ->get();
              
        $classes = Section::leftjoin('school_classes','school_classes.class_id','sections.class_id')
                    ->where('sections.school_id',$school_id)
                    ->get();               
        return view ('SMS.routine',compact('title','sat','sun','mon','tus','wed','thu','fri','classes'));
        }  
    }
    public function add_routine(){
        $school_id =  $this->school_info();
        $title = "Routine";
        $classes = SchoolClass::where('school_id',$school_id)->get();
        $section = Section::where('school_id',$school_id)->get();
        $subject = Subject::where('school_id',$school_id)->get();
        $teacher = Teacher::where('school_id',$school_id)->get();
        return view ('SMS.add-routine',compact('title','classes','section','subject','teacher'));
    }
    public function student_attendance(Request $request){
        $school_id =  $this->school_info();
        $title = "Student Attendance";

        $class = SchoolClass::where('school_id',$school_id)->get();

        $teacher = Teacher::where('school_id',$school_id)->get();
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;

            $class_id       = $request->class_id;
            $section_id     = $request->section_id;
            $year           = $request->year;
            $month          = $request->month;
            $teacher_id     = $request->teacher_id;

        if (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }

            $manage_attendence = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                        ->leftJoin('syllabi','syllabi.sellabus_class_id','school_classes.class_id')
                        ->leftJoin('attendances','attendances.student_id','students.student_id')
                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                        ->where('students.student_guardian_id',$parents_id)
                        ->where('students.school_id',$school_id)
                        ->get();

            return view ('SMS.student-attendance',compact('title','manage_attendence'));

        }elseif (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $student_id = $key->student_id;
            }

            $manage_attendence = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                        ->leftJoin('syllabi','syllabi.sellabus_class_id','school_classes.class_id')
                        ->leftJoin('attendances','attendances.student_id','students.student_id')
                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                        ->where('students.student_id',$student_id)
                        ->where('students.school_id',$school_id)
                        ->get();

            return view ('SMS.student-attendance',compact('title','manage_attendence'));

        }else{

            $manage_attendence = attendance::leftJoin('students','students.student_id','attendances.student_id')
                ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                ->leftJoin('sections','sections.saction_id','students.student_section_id')
                ->where('students.school_id',$school_id)
                ->orderBy('date','DESC')
                ->get();

            return view ('SMS.student-attendance',compact('title','manage_attendence','class','teacher','user_id','user_role','class_id','section_id','year','month','teacher_id'));    
        }
        Session::flash('error','No Data Found !');
        return back();
    }
    public function student_attendanceForm(Request $request){
        $rules = array(         
            'year'  => 'required',
            'month' => 'required',
            'role' => 'required',

        );
        $this->validate($request, $rules);
        $school_id =  $this->school_info();
        $class = SchoolClass::where('school_id',$school_id)->get();
        $teacher = Teacher::where('school_id',$school_id)->get();

        $user_role = Auth::user()->role;
        $user_id = Auth::user()->id;

            $class_id       = $request->class_id;
            $section_id     = $request->section_id;
            $year           = $request->year;
            $month          = $request->month;
            $teacher_id     = $request->teacher_id;

            $role = $request->role;
            $students[] = '';
            $teacher[] = '';
        
        if ($user_role == 'TEACHER') {        
            $teacher = Teacher::where('school_id',$school_id)
                ->where('user_id',$user_id)
                ->get();
        }else{
            $teacher = Teacher::where('school_id',$school_id)
                ->get();
        
        }    


        foreach ($teacher as $teacher_attn) {
                   
            $teachers[] = $teacher_attn->teacher_id;
        }
                
        if($user_role == "TEACHER"){

        if ($role == "Teacher" ) {
            $title = "Teacher Attendance";
            $month_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $manage_attendence = TeacherAttendence::leftJoin('teachers','teachers.teacher_id','teacher_attendences.teacher_id')
                ->where('teacher_attendences.school_id',$school_id)
                ->where('teachers.user_id',$user_id)
                ->whereIn('teacher_attendences.teacher_id',$teachers)
                ->whereYear('teacher_attendences.created_at',$year)
                ->whereMonth('teacher_attendences.created_at',$month)
                ->orderBy('attn_date','DESC')
                ->get();
                
            $class_students = 0;
            }else{
                $title = "Student Attendance";
                $class_students = Student::where('school_id',$school_id)
                        ->where('student_class_id',$class_id)
                        ->where('student_section_id',$section_id)
                        ->get();
                foreach ($class_students as $class_student) {
                   
                    $students[] = $class_student->student_id;
                }
                $month_day = cal_days_in_month(CAL_GREGORIAN, $month, $year); 

                $manage_attendence = attendance::leftJoin('students','students.student_id','attendances.student_id')
                    ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftJoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->whereIn('students.student_id',$students)
                    ->whereYear('attendances.created_at',$year)
                    ->whereMonth('attendances.created_at',$month)
                    ->orderBy('date','DESC')
                    ->get();
                }
                
        }else{
            if ($role == "Teacher" ) {
                $title = "Teacher Attendance";
                $month_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $manage_attendence = TeacherAttendence::leftJoin('teachers','teachers.teacher_id','teacher_attendences.teacher_id')
                    ->where('teacher_attendences.school_id',$school_id)
                    ->whereIn('teacher_attendences.teacher_id',$teachers)
                    ->whereYear('teacher_attendences.created_at',$year)
                    ->whereMonth('teacher_attendences.created_at',$month)
                    ->orderBy('attn_date','DESC')
                    ->get();  
                    
                    
                $class_students = 0;
            }else{

                $title = "Student Attendance";

                $month_day = cal_days_in_month(CAL_GREGORIAN, $month, $year); 

                $class_students = Student::where('school_id',$school_id)
                                        ->where('student_class_id',$class_id)
                                        ->where('student_section_id',$section_id)
                                        ->get();
                foreach ($class_students as $class_student) {
                   
                    $students[] = $class_student->student_id;
                }
                $manage_attendence = attendance::leftJoin('students','students.student_id','attendances.student_id')
                    ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftJoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->whereIn('students.student_id',$students)
                    ->whereYear('attendances.created_at',$year)
                    ->whereMonth('attendances.created_at',$month)
                    ->orderBy('date','DESC')
                    ->first();
                } 
        } 

        return view ('SMS.student-attendance',compact('title','class','teacher','user_id','user_role','class_id','section_id','year','month','teacher_id','role','month_day','class_students','manage_attendence','school_id'));

    }

    public function add_student_attendance(Request $request){
        $school_id =  $this->school_info();
        $title = "Student Attendance";
        $manage_class = SchoolClass::where('school_id', $school_id)->get();
        $manage_section = Section::where('school_id', $school_id)->get();
        return view ('SMS.add-student-attendance',compact('title','manage_class','manage_section'));
    }


    public function view_attn($id){
        $school_id =  $this->school_info();
        $title = "view Student Attendance";
        $manage_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('students.student_id',$id)
                            ->where('students.school_id', $school_id)
                            ->get();

        $manage_attn_present = Attendance::leftJoin('students','students.student_id','attendances.student_id')
                        ->where('attendances.school_id', $school_id)
                        ->where('attendances.student_id',$id)
                        ->where('attendances.attndence','P')
                        ->get();
        $manage_attn__abs = Attendance::leftJoin('students','students.student_id','attendances.student_id')
                        ->where('attendances.school_id', $school_id)
                        ->where('attendances.student_id',$id)
                        ->where('attendances.attndence','A')
                        ->get();
        return view ('SMS.view_attendance',compact('title','manage_attn__abs','manage_attn_present','manage_student'));
    }


    public function teacher_attendance(){
        $school_id =  $this->school_info();
        $title = "Teacher Attendance";
        $manage_teacher_attn = TeacherAttendence::leftJoin('teachers','teachers.teacher_id','teacher_attendences.teacher_id')
                                ->where('teacher_attendences.school_id', $school_id)
                                ->orderBy('attn_date','DESC')
                                ->get();
        return view ('SMS.teacher-attendance',compact('title','manage_teacher_attn'));
    }
    public function add_teacher_attendance(){
        $school_id =  $this->school_info();
        $title = "Teacher Attendance";
        $manage_class = SchoolClass::where('school_id', $school_id)->get();
        $manage_section = Section::where('school_id', $school_id)->get();
        return view ('SMS.add-teacher-attendance',compact('title'));
    }
    public function user_attendance(){
        $school_id =  $this->school_info();
        $title = "User Attendance";
        return view ('SMS.user-attendance',compact('title'));
    }
    public function add_user_attendance(){
        $school_id =  $this->school_info();
        $title = "User Attendance";
        return view ('SMS.add-user-attendance',compact('title'));
    }
    public function give_attendance(Request $request){
            $school_id =  $this->school_info();
            $title = "Give Attendance";

            $student = new Student;
            $class_id   =   $request->class_id ;
            $saction_id =   $request->saction_id ;
            $date       =   $request->date;    
            $day        =   $request->day;

            $manage_class = SchoolClass::where('school_id', $school_id)
                                        ->where('school_classes.class_id', $class_id)
                                        ->get();
            $manage_section = Section::where('school_id', $school_id)
                                        ->where('sections.saction_id', $saction_id)
                                        ->get();


            $class = SchoolClass::where('school_id', $school_id)
                                        ->get();
            $section = Section::where('school_id', $school_id)
                                        ->get();

            $give_attendance = student::leftJoin('sections','sections.saction_id','students.student_section_id')
                                        ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                        ->where('students.school_id', $school_id)
                                        ->where('students.student_class_id',$class_id)
                                        ->where('students.student_section_id',$saction_id)
                                        ->get();
            return view ('SMS.give_attendance',compact('title','give_attendance','manage_class','manage_section','class','section','date','day'));
        }
        public function give_marks(Request $request){
            $school_id =  $this->school_info();
            $title = "Give Marks";

            $student = new Student;
            $exam_id        =   $request->exam_id ;
            $class_id       =   $request->class_id ;    
            $subject_id     =   $request->subject_id;    

            $manage_class = SchoolClass::where('school_id', $school_id)
                                        ->where('school_classes.class_id', $class_id)
                                        ->get();

            $manage_subject = Subject::where('school_id', $school_id)
                                        ->where('subjects.subject_id', $subject_id)
                                        ->get();

            $manage_exam = Exam::where('school_id', $school_id)
                                        ->where('exams.exam_id', $exam_id)
                                        ->get();


            $class = SchoolClass::where('school_id', $school_id)
                                        ->get();
            $exam = Exam::where('school_id', $school_id)
                                        ->get();
            $subject = Subject::where('school_id', $school_id)
                                        ->get();

            $give_marks = ExamAttendence::leftJoin('students','students.student_id','exam_attendences.student_id')
                ->leftJoin('exams','exams.exam_id','exam_attendences.exam_id')
                ->leftJoin('school_classes','school_classes.class_id','exam_attendences.class_id')
                ->leftJoin('subjects','subjects.subject_id','exam_attendences.subject_id')
                ->where('exam_attendences.school_id', $school_id)
                ->where('exam_attendences.class_id',$class_id)
                ->where('exam_attendences.subject_id',$subject_id)
                ->where('exam_attendences.exam_id',$exam_id)
                ->where('exam_attendences.attendence','P')
                ->distinct('student_id')
                ->get();

            return view ('SMS.give_marks',compact('title','give_marks','manage_class','class','exam','subject','manage_exam','manage_subject'));
        }
        public function saveteacherForm(Request $request){
            $school_id =  $this->school_info();
            $title = "Teacher Attendance";

            $student = new Student;
            $date    =   $request->date;    

            $teacher_attendance = Teacher::where('teachers.school_id', $school_id)
                                        ->get();
            return view ('SMS.teacher_attendence',compact('title','teacher_attendance','date'));
        }

        // public function library_members(){
        //     $school_id =  $this->school_info();
        //     $title = "Student Members";
        //     $library_info = LibraryMember::all();
        //     $Manage_Library_student="";
        //     $Manage_Library_teacher="";
        //     foreach ($library_info as $key) {
        //         if($key->role=="Student"){
        //         $Manage_Library_student = LibraryMember::
        //               leftJoin('users','users.id','library_members.user_id')
        //             ->leftJoin('students','students.student_id','users.id')
        //             ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
        //             ->leftJoin('sections','sections.saction_id','students.student_section_id')
        //             ->get();
        //         }elseif ($key->role=="Teacher") {
        //         $Manage_Library_teacher = LibraryMember::
        //                                 leftJoin('users','users.id','library_members.user_id')
        //                                 ->leftJoin('teachers','teachers.teacher_id','users.id')
        //                                 ->get();
        //         }
        //     }
        //     $title2 = "Teacher Members";
        //     return view ('SMS.library_members',compact('title','Manage_Library_student','Manage_Library_teacher','title2'));
        // }

        public function library_members(){
            $school_id =  $this->school_info();
            $title = "Students Members";
            $title2 = "Teacher Members";

            $Manage_Library_student = LibraryMember::leftJoin('students','students.user_id','library_members.user_id')
                            ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('library_members.school_id', $school_id)
                            ->where('library_members.role','=','Student')
                            ->get(); 

            return view ('SMS.library_members',compact('title','Manage_Library_student'));
        }
        public function library_members_teachers(){
            $school_id =  $this->school_info();
            $title = "Teacher Members";

            $Manage_Library_teacher = LibraryMember::leftJoin('teachers','teachers.user_id','library_members.user_id')
                            ->where('library_members.school_id', $school_id)
                            ->where('library_members.role','=','Teacher')
                            ->get();

                        
            return view ('SMS.library_members_teachers',compact('title','Manage_Library_teacher'));
        }


        public function add_library_member_student(){
            $school_id =  $this->school_info();
            $title = "Library Members";
            $manage_teacher = User::leftJoin('teachers','teachers.user_id','users.id')
                            ->where('users.school_id', $school_id)
                            ->where('users.role','=','TEACHER')
                            ->get();

            $manage_student = User::leftJoin('students','students.user_id','users.id')
                            ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('users.school_id', $school_id)
                            ->where('users.role','=','STUDENT')
                            ->get();                

            return view ('SMS.add_library_member_student',compact('title','manage_teacher','manage_student'));
        }
        public function add_library_member_teacher(){
            $school_id =  $this->school_info();
            $title = "Library Members";
            $manage_teacher = Teacher::where('school_id', $school_id)->get();
            return view ('SMS.add_library_member_teacher',compact('title','manage_teacher'));
        }
        public function books(){
            $school_id =  $this->school_info();
            $title = "Books";
           
            $manage_books = Book::where('school_id', $school_id)->get();
            return view ('SMS.books',compact('title','manage_books'));
        }
        public function add_book(){
            $school_id =  $this->school_info();
            $title = "Books";
           
            return view ('SMS.add_book',compact('title'));
        }
        public function book_issue_students(){
            $school_id =  $this->school_info();
            $title = "Books Issue";
            
            if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
            }

            $student_id = Auth::user()->id;
            $manage_issue_student = BookIssued::leftJoin('users','users.id','book_issueds.user_id')
                                        ->leftJoin('students','students.user_id','users.id')
                                        ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                        ->leftJoin('books','books.book_id','book_issueds.book_id')
                                        ->where('book_issueds.school_id',$school_id)
                                        ->where('book_issueds.user_id',$student_id)
                                        ->get();
            return view ('SMS.book_issue_student',compact('title','manage_issue_student'));
        } 
        elseif (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }

            
            $manage_issue_student = BookIssued::leftJoin('students','students.user_id','book_issueds.user_id')
                            ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->leftJoin('books','books.book_id','book_issueds.book_id')
                            ->where('students.student_guardian_id',$parents_id)
                            ->where('book_issueds.school_id',$school_id)
                            ->get();
            return view ('SMS.book_issue_student',compact('title','manage_issue_student'));

        }
        else{
            $manage_issue_student = BookIssued::leftJoin('users','users.id','book_issueds.user_id')
                                        ->leftJoin('students','students.user_id','users.id')
                                        ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                        ->leftJoin('books','books.book_id','book_issueds.book_id')
                                        ->where('book_issueds.school_id',$school_id)
                                        ->get();


            return view ('SMS.book_issue_student',compact('title','manage_issue_student'));
        }

        }
        public function book_issue_teachers(){
            $school_id =  $this->school_info();
            $title = "Books Issue";
            
            $manage_issue_teacher = BookIssued::leftJoin('users','users.id','book_issueds.user_id')
                                        ->leftJoin('teachers','teachers.user_id','users.id')
                                        ->leftJoin('books','books.book_id','book_issueds.book_id')
                                        ->where('book_issueds.school_id',$school_id)
                                        ->get();


            return view ('SMS.book_issue_teacher',compact('title','manage_issue_teacher'));
        }
        public function add_book_issue(){
            $school_id =  $this->school_info();
            $title = "Book issue";

            $manage_teacher = LibraryMember::leftJoin('teachers','teachers.user_id','library_members.user_id')
                                            ->where('library_members.role','Teacher')
                                            ->where('library_members.school_id', $school_id)
                                            ->get();

            $manage_student = LibraryMember::leftJoin('students','students.user_id','library_members.user_id')
                                            ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                            ->where('library_members.role','Student')
                                            ->where('library_members.school_id', $school_id)
                                            ->get();

            $manage_books = Book::where('school_id', $school_id)->get();

            return view ('SMS.add_book_issue',compact('title','manage_teacher','manage_student','manage_books'));
        }

        // exam part
        public function exam(){
            $school_id =  $this->school_info();
            $title = "Exam";
            $manage_exam = Exam::where('school_id', $school_id)->get();
            return view ('SMS.exam',compact('title','manage_exam'));
        }
        public function add_exam(){
            $school_id =  $this->school_info();
            $title = "Exam";
            $manage_class = SchoolClass::where('school_id', $school_id)->get();
            return view ('SMS.add_exam',compact('title','manage_class'));
        }
        public function examschedule(){
            $school_id =  $this->school_info();
            $title = "Exam Schedule";


            if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
                $section_id = $key->student_section_id;
            }
            $manage_exam_schedule = ExamSchedule::leftJoin('school_classes','school_classes.class_id','exam_schedules.class_id')
                                ->leftJoin('sections','sections.saction_id','exam_schedules.section_id')
                                ->leftJoin('subjects','subjects.subject_id','exam_schedules.subject_id')
                                ->leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                ->where('exam_schedules.school_id', $school_id)
                                ->where('exam_schedules.class_id', $class_id)
                                ->where('exam_schedules.section_id', $section_id)
                                ->get();

            return view ('SMS.examschedule',compact('title','manage_exam_schedule'));
        }if (Auth::user()->role == "PARENTS") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $parents_id = $key->parents_id;
            }

            $manage_exam_schedule = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('exam_schedules','exam_schedules.class_id','school_classes.class_id')
                            ->leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                            ->leftJoin('subjects','subjects.subject_id','exam_schedules.subject_id')
                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('students.student_guardian_id',$parents_id)
                            ->where('students.school_id',$school_id)
                            ->get();

            return view ('SMS.examschedule',compact('title','manage_exam_schedule'));

        }

        else{
            $manage_exam_schedule = ExamSchedule::leftJoin('school_classes','school_classes.class_id','exam_schedules.class_id')
                                ->leftJoin('sections','sections.saction_id','exam_schedules.section_id')
                                ->leftJoin('subjects','subjects.subject_id','exam_schedules.subject_id')
                                ->leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                ->where('exam_schedules.school_id', $school_id)
                                ->get();
            return view ('SMS.examschedule',compact('title','manage_exam_schedule'));
        }

        }
        public function add_examschedule(){
            $school_id =  $this->school_info();
            $title = "Exam Schedule";

            $manage_class   = SchoolClass::where('school_id', $school_id)->get();
            $manage_section = Section::where('school_id', $school_id)->get();
            $manage_subject = Subject::where('school_id', $school_id)->get();
            $manage_exam    = Exam::where('exams.school_id', $school_id)->get();
            return view ('SMS.add_examschedule',compact('title','manage_class','manage_section','manage_subject','manage_exam'));
        }
        
        public function exam_attendence(){
            $school_id =  $this->school_info();
            $title = "Exam Attendance";
            $manage_exam    = Exam::where('school_id', $school_id)->get();
            $manage_class   = SchoolClass::where('school_id', $school_id)->get();
            $manage_subject = Subject::where('school_id', $school_id)->get();
            return view ('SMS.exam_attendence',compact('title','manage_exam','manage_class','manage_subject'));
        }
        public function ExamAttendenceFrom(Request $request){
            $rules = array(         
                'exam_id'        => 'required',
                'class_id'       => 'required',
                'section_id'     => 'required',
                'subject_id'     => 'required',           
            );
        $this->validate($request, $rules);
            $school_id =  $this->school_info();
            $title = "Exam Attendance";

            $student = new ExamSchedule;
            $exam_id        =   $request->exam_id ;
            $class_id       =   $request->class_id ;   
            $section_id     =   $request->section_id ;   
            $subject_id     =   $request->subject_id;    

            $manage_class = SchoolClass::where('school_id', $school_id)
                                        ->where('school_classes.class_id', $class_id)
                                        ->get();

            $manage_subject = Subject::where('school_id', $school_id)
                                        ->where('subjects.subject_id', $subject_id)
                                        ->get();

            $manage_exam = Exam::where('school_id', $school_id)
                                        ->where('exams.exam_id', $exam_id)
                                        ->get();

            $manage_section = Section::where('school_id', $school_id)
                                        ->where('saction_id', $section_id)
                                        ->get();

            $class = SchoolClass::where('school_id', $school_id)
                                        ->get();

            $exam = Exam::where('school_id', $school_id)
                                        ->get();

            $subject = Subject::where('school_id', $school_id)
                                        ->get();

            $give_attn = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftjoin('sections','sections.saction_id','students.student_section_id')
                                ->leftjoin('exam_schedules','exam_schedules.class_id','school_classes.class_id')
                                ->where('students.school_id',$school_id)    
                                ->where('students.student_class_id',$class_id)
                                ->where('students.student_section_id',$section_id)
                                ->get();                          

            return view ('SMS.give_exam_attn',compact('title','give_attn','manage_class','manage_section','class','exam','subject','manage_exam','manage_subject'));
        }



        public function grade(){
            $school_id =  $this->school_info();
            $title = "Grade";
            $manage_grade = Grage::where('school_id', $school_id)->get();
            return view ('SMS.grade',compact('title','manage_grade'));
        }
        public function add_grade(){
            $school_id =  $this->school_info();
            $title = "Grage";
            return view ('SMS.add_grade',compact('title'));
        }
        // marks
        public function marks(){
            $school_id =  $this->school_info();
            $title = "Marks";

            $manage_class = SchoolClass::where('school_id', $school_id)
                            ->get();
            $manage_exam = Exam::where('school_id', $school_id)
                            ->get();
            $manage_subject = Subject::where('school_id', $school_id)
                            ->get();

            return view ('SMS.marks',compact('title','manage_class','manage_exam','manage_subject'));
        }
        public function add_marks(){
            $school_id =  $this->school_info();
            $title = "Marks";
            $manage_class   = SchoolClass::where('school_id', $school_id)->get();
            $manage_section = Section::where('school_id', $school_id)->get();
            $manage_subject = Subject::where('school_id', $school_id)->get();
            $manage_exam    = Exam::where('exams.school_id', $school_id)->get();

            return view ('SMS.add_marks',compact('title','manage_class','manage_section','manage_subject','manage_exam'));
        }
        public function show_marks(Request $request){
            $school_id =  $this->school_info();
            $title = "Marks";

            $class_id   = $request->class_id;
            $exam_id    = $request->exam_id;
            $subject_id = $request->subject_id;

            $manage_class   = SchoolClass::where('school_id', $school_id)
                                    ->where('class_id', $class_id)
                                    ->get();
            $manage_exam    = Exam::where('school_id', $school_id)
                                    ->where('exam_id', $exam_id)
                                    ->get();
            $manage_subject = Subject::where('school_id', $school_id)
                                    ->where('subject_id', $subject_id)
                                    ->get();

            $class   = SchoolClass::where('school_id', $school_id)
                                    ->get();
            $exam    = Exam::where('school_id', $school_id)
                                    ->get();
            $subject = Subject::where('school_id', $school_id)
                                    ->get();
                            
            $manage_marks = ExamMarks::leftJoin('students','students.student_id','exam_marks.student_id')
                            ->leftJoin('school_classes','school_classes.class_id','exam_marks.class_id')
                            ->leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                            ->leftJoin('exams','exams.exam_id','exam_marks.exam_id')
                            ->where('exam_marks.school_id', $school_id)
                            ->where('exam_marks.class_id', $class_id)
                            ->where('exam_marks.subject_id', $subject_id)
                            ->where('exam_marks.exam_id', $exam_id)
                            ->get();

            return view ('SMS.show_marks',compact('title','manage_marks','manage_class','manage_exam','manage_subject','class','exam','subject'));
        }
        public function markpercentage(){
            $school_id =  $this->school_info();
            $title = "Mark Percentage";

            $manage_marks_per = MarkPercentage::where('school_id', $school_id)->get();
            return view ('SMS.markpercentage',compact('title','manage_marks_per'));
        }
        public function add_markpercentage(){
            $school_id =  $this->school_info();
            $title = "Mark Percentage";
            return view ('SMS.add_markpercentage',compact('title','exam_attendence'));
        }

        public function promotion(){
            $school_id =  $this->school_info();
            $title = "Promotion";

            $manage_class = SchoolClass::where('school_id',$school_id)
                                    ->get();
            return view ('SMS.promotion',compact('title','manage_class'));
        }
        public function show_students_promotion(Request $request){
            $school_id =  $this->school_info();
            $title = "Show Promotion";

            $class_id   = $request->class_id;
            $section_id = $request->section_id;
            $manage_class = SchoolClass::where('school_id',$school_id)->get();
            $show_student = Student::leftJoin('school_classes','class_id','students.student_class_id')
                                ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                ->where('students.student_class_id',$class_id)
                                ->where('students.student_section_id',$section_id)
                                ->where('students.school_id',$school_id)
                                ->get();

            $class_name         = SchoolClass::where('school_id',$school_id)->where('class_id',$class_id)->first();

            return view ('SMS.showPromotion',compact('title','show_student','manage_class','class_name'));
        }


        public function transport(){
            $school_id =  $this->school_info();
            $title = "Transport";
            $manage_transport = Transport::where('school_id', $school_id)->get();
            return view ('SMS.transport',compact('title','manage_transport'));
        }
        public function add_transport(){
            $school_id =  $this->school_info();
            $title = "Transport";
            return view ('SMS.add_transport',compact('title'));
        }
        public function transport_memeber(){
            $school_id =  $this->school_info();
            $title = "Transport Members";

            $manage_transport_member = TransportMember::leftJoin('students','students.student_id','transport_members.student_id')
                ->leftJoin('school_classes','school_classes.class_id','transport_members.class_id')
                ->leftJoin('sections','sections.saction_id','transport_members.section_id')
                ->leftJoin('transports','transports.transport_id','transport_members.transport_id')
                ->where('transport_members.school_id', $school_id)
                ->get();
            return view ('SMS.transport_memeber',compact('title','manage_transport_member'));
        }
        public function add_transport_member(){
            $school_id =  $this->school_info();
            $title = "Member";
            $manage_transport = Transport::where('school_id', $school_id)->get();
            $manage_student = Student::where('school_id', $school_id)->get();
            $manage_class = SchoolClass::where('school_id', $school_id)->get();
            $manage_section = Section::where('school_id', $school_id)->get();

            return view ('SMS.add_transport_member',compact('title','manage_transport','manage_student','manage_class','manage_section'));
        }

    // hostel part

    public function hostel(){
        $school_id =  $this->school_info();
        $title = "Hostel";

        $manage_hostel = Hostel::where('school_id', $school_id)->get();
        return view ('SMS.hostel',compact('title','manage_hostel'));
    }
    public function add_hostel(){
        $school_id =  $this->school_info();
        $title = "Hostel";
        return view ('SMS.add_hostel',compact('title'));
    }
    public function hostel_members(){
        $school_id =  $this->school_info();
        $title = "Hostel Members";

        $hostel = Hostel::where('school_id', $school_id)->get();
        $class = SchoolClass::where('school_id', $school_id)->get();

        return view ('SMS.hostel_members',compact('title','hostel','class'));
    }
    public function add_hostel_members(){
        $school_id =  $this->school_info();
        $title = "Hostel Members";

        $hostel = Hostel::where('school_id', $school_id)->get();
        $class = SchoolClass::where('school_id', $school_id)->get();
        $students = Student::where('school_id', $school_id)->get();
        return view ('SMS.add_hostel_members',compact('title','hostel','class','students'));
    }

    public function ShowHostelMembers(Request $request){
        $school_id =  $this->school_info();
        $title = "Hostel Members";

        $hostel_id  = $request->hostel_id;
        $class_id   = $request->class_id;

        $hostel = Hostel::where('school_id', $school_id)->get();
        $class = SchoolClass::where('school_id', $school_id)->get();

        $manage_class = SchoolClass::where('school_id', $school_id)
                    ->where('class_id', $class_id)
                    ->get();

        $manage_hostel = Hostel::where('school_id', $school_id)
                    ->where('hostel_id', $hostel_id)
                    ->get();


        $manage_members = HostelMember::leftJoin('students','students.student_id','hostel_members.member_name')
                                        ->leftJoin('school_classes','school_classes.class_id','hostel_members.class_id')
                                        ->where('hostel_members.school_id', $school_id)
                                        ->where('hostel_members.hostel_id', $hostel_id)
                                        ->where('hostel_members.class_id', $class_id)
                                        ->get();
        return view ('SMS.show_hostel_members',compact('title','manage_members','hostel','class','manage_class','manage_hostel'));
    } 

    // Account part
    public function fee_types(Request $request){
        $school_id =  $this->school_info();
        $title = "Fees Type";
        
        $manage_fee_type = FeeType::leftJoin('school_classes','school_classes.class_id','fee_types.class_id')
                        ->where('fee_types.school_id', $school_id)
                        ->get();
        return view ('SMS.fee_types',compact('title','manage_fee_type'));
    } 
    public function add_fee_types(){
        $school_id =  $this->school_info();
        $title = "Fees Type";
        $manage_class = SchoolClass::where('school_id', $school_id)->get();
        return view ('SMS.add_fee_type',compact('title','manage_class'));
        }


    public function invoice(){
        $school_id =  $this->school_info();

        $title = "Invoice";
        
        // $sum_history= PaymentHistory::leftJoin('fee_types','fee_types.fee_type_id','payment_histories.fee_type_id')
        //                             ->leftJoin('invoices','invoices.fee_type_id','payment_histories.random_id')
        //                             ->GROUPBY('payment_histories.random_id')
        //                             ->sum('fee_types.amount');



        if (Auth::user()->role == "STUDENT") {
            $login_info =  $this->loginInfo();
            foreach ($login_info as $key) {
                $class_id = $key->student_class_id;
                $section_id = $key->student_section_id;
                $student_id = $key->student_id;
            }
            $manage_invoice = Invoice::leftJoin('school_classes', 'school_classes.class_id', 'invoices.class_id')
                                ->leftJoin('students', 'students.student_id', 'invoices.student_id')
                                ->where('invoices.school_id', $school_id)
                                ->where('invoices.student_id', $student_id)
                                ->get();

            return view ('SMS.invoice',compact('title','manage_invoice'));
        }else{
            $manage_invoice = Invoice::leftJoin('school_classes', 'school_classes.class_id', 'invoices.class_id')
                                ->leftJoin('students', 'students.student_id', 'invoices.student_id')
                                ->where('invoices.school_id', $school_id)
                                ->get();

        return view ('SMS.invoice',compact('title','manage_invoice'));
        }
        }

    public function add_invoice(Request $request){
        $school_id =  $this->school_info();
        $title = "Invoice";
        $class = SchoolClass::where('school_id', $school_id)
                            ->get();
        $fee_type = FeeType::where('school_id', $school_id)
                            ->get();

        return view ('SMS.add_invoice',compact('title','class','fee_type'));
        } 

    public function payment_history(Request $request){
        $school_id =  $this->school_info();
        $title = "Payment History";
        $manage_class = SchoolClass::where('school_id',$school_id)->get();
        return view ('SMS.payment_history',compact('title','manage_class'));
        }

    public function add_company_paid(Request $request){
        $school_id =  $this->school_info();
        $title = "Company payment";

        $user_name = userInfo::where('school_id',$school_id)->where('user_id',Auth::user()->id)->get();

        $manage_class = SchoolClass::where('school_id',$school_id)->get();

        $manage_mm = DB::connection('mysql2')->table('mms')->get();

        $school_name = SchoolInfo::where('school_id',$school_id)->get();
        foreach ($school_name as $key) {
            $school_name = $key->name;
            $domain_name = $key->domain_name;
        }
        return view ('SMS.add_company_paid',compact('title','manage_class','school_name','domain_name','user_name','manage_mm'));
        }
    public function company_paid(Request $request){
        $school_id =  $this->school_info();
        $title = "Company payment";
        $school_info = SchoolInfo::where('school_id',$school_id)->first();

        $manage_payment = CompanyPayment::where('school_domain_name',$school_info->domain_name)->get();
        return view ('SMS.company_paid',compact('title','manage_payment'));
        }
        
    public function showpayment_history(Request $request){
        $school_id =  $this->school_info();
        $title = "Payment History";
        
        $class   = $request->class_id;
        $section = $request->section_id;
        $student = $request->student_id;

        $get_invoice = Invoice::leftJoin('students','students.student_id','invoices.student_id')
                                ->leftJoin('school_classes','school_classes.class_id','invoices.class_id')
                                ->where('invoices.school_id',$school_id)
                                ->where('invoices.student_id',$student)
                                ->get();


        $manage_payment_history = PaymentHistory::leftJoin('fee_types','fee_types.fee_type_id','payment_histories.fee_type_id')
                                                ->where('payment_histories.school_id', $school_id)
                                                ->get();
        return view ('SMS.showpayment_history',compact('title','manage_payment_history','get_invoice'));
        }

    public function expense(Request $request){
        $school_id =  $this->school_info();
        $title = "Expense";
        
        $manage_expense = Expense::where('school_id', $school_id)->get();
        return view ('SMS.expense',compact('title','manage_expense'));
        }
    public function add_expance(Request $request){
        $school_id =  $this->school_info();
        $title = "Expense";
        
        return view ('SMS.add_expance',compact('title','class','fee_type'));
        } 

    public function income(Request $request){
        $school_id =  $this->school_info();
        $title = "Income";
        
        $manage_income = Income::where('school_id', $school_id)->get();
        return view ('SMS.income',compact('title','manage_income'));
        }
    public function add_income(){
        $school_id =  $this->school_info();
        $title = "Income";
        
        return view ('SMS.add_income',compact('title'));
        }

    public function profit(){
        $school_id =  $this->school_info();
        $title = "Profite";
        
        return view ('SMS.profit',compact('title'));
        }

    public function show_profit(Request $request){
        $school_id =  $this->school_info();
        $title = "Profite";
        
        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $manage_income = Income::where('school_id',$school_id)
                            ->whereBetween('income_date',array($start_date,$end_date))
                            ->sum('income_amount');

        $manage_invoice = Invoice::where('school_id',$school_id)
                            ->whereBetween('created_at',array($start_date,$end_date))
                            ->sum('paid');

        $manage_expense = Expense::where('school_id',$school_id)
                            ->whereBetween('exp_date',array($start_date,$end_date))
                            ->sum('exp_amount');


        $income = Income::where('school_id',$school_id)
                            ->whereBetween('income_date',array($start_date,$end_date))
                            ->get();

        $invoice = Invoice::where('invoices.school_id',$school_id)
                            ->whereBetween('invoices.created_at',array($start_date,$end_date))
                            ->leftJoin('students','students.student_id','invoices.student_id')
                            ->get();

        $expense = Expense::where('school_id',$school_id)
                            ->whereBetween('exp_date',array($start_date,$end_date))
                            ->get();                    


        $total_profit = ($manage_income+$manage_invoice)-$manage_expense;

        $manage_settings = Setting::where('school_id',$school_id)->get();

        return view ('SMS.show_profit',compact('title','manage_settings','manage_income','manage_invoice','manage_expense','total_profit','income','invoice','expense'));
        } 

// Report part 
    public function class_report(){
        $school_id =  $this->school_info();
        $title = "Class Report";
        $manage_class = SchoolClass::where('school_id', $school_id)->get();       
        $get_class = [];
        $student_class_id = '';
        $class = '';
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        if ($user_role == 'STUDENT') {
            
        $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('students.user_id',$user_id) 
                    ->first();      
        }elseif($user_role == 'PARENTS'){

            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                                ->leftjoin('sections','sections.saction_id','students.student_section_id')
                                ->where('students.school_id',$school_id)
                                ->where('student_parents.user_id',$user_id) 
                                ->first();
        }


        if($get_class){

        $students_no = Student::leftjoin('users','users.id','students.user_id')
                            ->where('students.school_id',$school_id)
                            ->where('students.student_class_id',$get_class->student_class_id)
                            ->where('students.student_section_id',$get_class->student_section_id)
                            ->count('students.student_id');

        $subject_no = Subject::where('school_id',$school_id)
                            ->where('subject_class_id',$get_class->student_class_id)
                            ->count('subject_id');

        $subject_teacher = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                            ->where('subjects.school_id',$school_id)
                            ->where('subjects.subject_class_id',$get_class->student_class_id)
                            ->get();
        $class_teacher = SchoolClass::leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('school_classes.school_id',$school_id)
                            ->where('school_classes.class_id',$get_class->student_class_id)
                            ->get();
        $get_section = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                            ->where('sections.school_id', $school_id)
                            ->where('sections.saction_id', $get_class->student_section_id)
                            ->get();                    
        }else{
            $students_no = Student::leftjoin('users','users.id','students.user_id')
                            ->where('students.school_id',$school_id)
                            ->count('students.student_id');

            $subject_no = Subject::where('school_id',$school_id)
                            ->count('subject_id');
            $subject_teacher = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                            ->where('subjects.school_id',$school_id)
                            ->get();
            $class_teacher = SchoolClass::leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('school_classes.school_id',$school_id)
                            ->get();
            $get_section = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                            ->where('sections.school_id', $school_id)
                            ->get();
        $school_info = Setting::where('school_id', $school_id)->get();

        $count_student = $students_no;
        $count_subject = $subject_no;
    
        
        $manage_section = Section::where('school_id', $school_id)->get();
        return view ('SMS.class_report',compact('title','manage_class','manage_section','get_class','class','count_student','count_subject','subject_teacher','class_teacher','school_info','get_section'));
                                    
        }
        Session::flash('error','No Data Found !');
        return back();                         
    }



    public function show_class_report(Request $request){
        $school_id =  $this->school_info();
        $title = "Class Report";
        
        
        if (!$request->class_id) {
            $class      = [];
            $section    = [];

        }else{
            $class      = $request->class_id;
            $section    = $request->saction_id;
            
            $students_no = Student::where('school_id',$school_id)
                                ->where('student_class_id',$class)
                                ->where('student_section_id',$section)
                                ->count('student_id');
            $subject_no = Subject::where('school_id',$school_id)
                                ->where('subject_class_id',$class)
                                ->count('subject_id');
    
            $subject_teacher = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                                ->where('subjects.school_id',$school_id)
                                ->where('subjects.subject_class_id',$class)
                                ->get();
            $class_teacher = SchoolClass::leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                                ->where('school_classes.school_id',$school_id)
                                ->where('school_classes.class_id',$class)
                                ->get();
            if($section){
                $get_section = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                                ->where('sections.school_id', $school_id)
                                ->where('sections.saction_id', $section)
                                ->first();
            }else{
                $get_section = SchoolClass::where('school_classes.school_id', $school_id)
                                ->where('school_classes.class_id', $class)
                                ->first();
            }                    
                                
                                
            $school_info = Setting::where('school_id', $school_id)->get();
    
            $count_student = $students_no;
            $count_subject = $subject_no;
            // echo $count;
        return view ('SMS.show_class_report',compact('title','count_student','class','count_subject','subject_teacher','class_teacher','school_info','get_section'));
        }
        Session::flash('error','No Data Found !');
        return back(); 
    } 

    public function admit_card(){
        $school_id =  $this->school_info();
        $title = "Admit Card";

        $manage_exam = Exam::where('school_id', $school_id)->get();

        return view ('SMS.admit_card',compact('title','manage_exam'));
    }

    public function adminCardFrom(Request $request){
        $school_id =  $this->school_info();
        $title = "Admit Card";

        $exam      = $request->exam_id;
        $class     = $request->class_id;
        $student   = $request->student_id;

        if ($exam == '' or $class == '' or $student == '') {
            Session::flash('error','No Data Found !');
            return back();   
        }else{
            $manage_settings = Setting::where('school_id', $school_id)->get();

            $manage_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                        ->where('students.school_id', $school_id)
                        ->where('students.student_id',$student)
                        ->get();
            $manage_subject = Subject::where('school_id',$school_id)
                                ->where('subject_class_id',$class)
                                ->get();

            $exam_info = Exam::where('school_id',$school_id)->where('exam_id',$exam)->first();
            return view ('SMS.show_admit_card',compact('title','manage_settings','manage_student','manage_subject','exam_info'));
        }
        
    }



    public function inbox(){
        $school_id =  $this->school_info();
        $title = "Messages";

        $manage_inbox = Inbox::where('school_id',$school_id)->get();

        return view ('SMS.inbox',compact('title','manage_inbox'));
    }
    public function add_inbox(){
        $school_id =  $this->school_info();
        $title = "Messages";

        $manage_class   = SchoolClass::where('school_id',$school_id)->get();
        $manage_teacher = Teacher::where('school_id',$school_id)->get();

        return view ('SMS.add_inbox',compact('title','manage_class','manage_teacher'));
    }




    public function id_card(){
        $school_id =  $this->school_info();
        $title = "ID Card";

        $teacher = Teacher::where('school_id', $school_id)->get();

        $class = SchoolClass::where('school_id', $school_id)->get();

        return view ('SMS.id_card',compact('title','class','teacher'));
    }
    public function idCardFrom(Request $request){
        $school_id =  $this->school_info();
        $title = "ID Card";

        $teacher = $request->teacher_id;
        $class   = $request->class_id;
        $student = $request->student_id;

        $manage_settings = Setting::where('school_id',$school_id)->get();

        if ($request->teacher_id) {
            $manage_mambers = Teacher::where('school_id', $school_id)
                                    ->where('teacher_id',$teacher)
                                    ->get();
        return view ('SMS.idCardteacher',compact('title','class','manage_mambers','manage_settings'));                            
        }elseif(($request->student_id)){
            $manage_mambers = Student::leftJoin('school_classes', 'school_classes.class_id','students.student_class_id')
                                        ->leftJoin('student_parents', 'student_parents.parents_id','students.student_guardian_id')
                                        ->leftJoin('sections', 'sections.saction_id','students.student_section_id')
                                        ->where('students.school_id', $school_id)
                                        ->where('students.student_id',$student)
                                        ->get();
        return view ('SMS.idCardFrom',compact('title','class','manage_mambers','manage_settings'));
        }
        Session::flash('error','No Data Found !');
        return back(); 

    }

    public function routine_report(Request $request){
        $school_id =  $this->school_info();
        $title = "Class Routine";
        
        $teacher = Teacher::where('school_id', $school_id)->get();
        $class = SchoolClass::where('school_id', $school_id)->get();


        return view ('SMS.routine_report',compact('title','teacher','class'));
        }


    public function showRoutine(Request $request){
        $school_id =  $this->school_info();

        $teacher        = $request->teacher_id;
        $class          = $request->class_id;
        $section_id     = $request->section_id;
        $school_info    = Setting::where('school_id',$school_id)->get();
        
        $title = "Routine";
        $sat = "sat";
        $sun = "sun";
        $mon = "mon";
        $tus = "tus";
        $wed = "wed";
        $thu = "thu";
        $fri = "fri";

        $manage_settings = Setting::where('school_id',$school_id)->get();

        if ($request->teacher_id) {
            $sat = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                        ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sat)
                        ->orderBy("start_time", "ASC")
                        ->get();

            $sun = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                            ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                            ->where('class_routines.school_id',$school_id)
                            ->where('class_routines.day',$sun)
                            ->orderBy("start_time", "ASC")
                            ->get();

            $mon = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                            ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                            ->where('class_routines.school_id',$school_id)
                            ->where('class_routines.day',$mon)
                            ->orderBy("start_time", "ASC")
                            ->get();

            $tus = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                            ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                            ->where('class_routines.school_id',$school_id)
                            ->where('class_routines.day',$tus)
                            ->orderBy("start_time", "ASC")
                            ->get();

            $wed = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                            ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                            ->where('class_routines.school_id',$school_id)
                            ->where('class_routines.day',$wed)
                            ->orderBy("start_time", "ASC")
                            ->get();

            $thu = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                            ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                            ->where('class_routines.school_id',$school_id)
                            ->where('class_routines.day',$thu)
                            ->orderBy("start_time", "ASC")
                            ->get();

            $fri = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                            ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                            ->where('class_routines.school_id',$school_id)
                            ->where('class_routines.day',$fri)
                            ->orderBy("start_time", "ASC")
                            ->get();
            $subject = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                            ->where('subjects.school_id',$school_id)
                            ->where('subjects.subject_teacher_id',$teacher)
                            ->limit(1)
                            ->get();
        return view ('SMS.showTeacherRoutine',compact('title','class','manage_settings','subject','sat','sun','mon','tus','wed','thu','fri','school_info'));                            
        }elseif($request->role == 'Student'){
            $sat = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.class_id',$class)
                        ->where('class_routines.section_id',$section_id)
                        ->where('class_routines.day',$sat)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $sun = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sun)
                        ->where('class_routines.class_id',$class)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $mon = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$mon)
                        ->where('class_routines.class_id',$class)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $tus = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$tus)
                        ->where('class_routines.class_id',$class)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $wed = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$wed)
                        ->where('class_routines.class_id',$class)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $thu = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$thu)
                        ->where('class_routines.class_id',$class)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $fri = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$fri)
                        ->where('class_routines.class_id',$class)
                        ->where('class_routines.section_id',$section_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

            $classes = Section::leftjoin('school_classes','school_classes.class_id','sections.class_id')
                        ->where('sections.school_id',$school_id)
                        ->where('sections.class_id',$class)
                        ->where('sections.saction_id',$section_id)
                        ->get();
        return view ('SMS.showStudentRoutine',compact('title','class','manage_settings','classes','sat','sun','mon','tus','wed','thu','fri','school_info'));
        }
        Session::flash('error','No Data Found !');
        return back();
    }
    public function examschedulereport(Request $request){
        $school_id =  $this->school_info();
        $title = "Examschedule Report";
        
        $teacher = Teacher::where('school_id', $school_id)->get();
        $class = SchoolClass::where('school_id', $school_id)->get();
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        
        $manage_exam = ExamSchedule::leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                ->select('exams.exam_name','exam_schedules.exam_id')
                                ->where('exam_schedules.school_id',$school_id)
                                ->distinct('exam_id')
                                ->get();
                                
        if ($user_role == 'STUDENT') {
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('students.user_id',$user_id) 
                    ->first();
            return view ('SMS.examschedulereport',compact('title','teacher','class','manage_exam','get_class','user_id'));
        }elseif($user_role == 'PARENTS'){

            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                                ->leftjoin('sections','sections.saction_id','students.student_section_id')
                                ->where('students.school_id',$school_id)
                                ->where('student_parents.user_id',$user_id) 
                                ->first();
            return view ('SMS.examschedulereport',compact('title','teacher','class','manage_exam','get_class','user_id'));
        }

        

        return view ('SMS.examschedulereport',compact('title','teacher','class','manage_exam','user_id'));
        }
    public function showexamschedulereport(Request $request){
        $school_id =  $this->school_info();
        $title = "Exam Schedule";

        $exam   = $request->exam_id;
        $class  = $request->class_id;

        $manage_exam_schedule = ExamSchedule::leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                ->leftJoin('subjects','subjects.subject_id','exam_schedules.subject_id')
                                ->where('exam_schedules.school_id',$school_id)
                                ->where('exam_schedules.class_id',$class)
                                ->where('exam_schedules.exam_id',$exam)
                                ->get();

        return view ('SMS.showexamschedulereport',compact('title','class','manage_exam_schedule'));
    }
    public function terminalReport(){
        $school_id =  $this->school_info();
        $title = "Terminal";

        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        $manage_exam = ExamSchedule::leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                    ->select('exams.exam_name','exam_schedules.exam_id')
                    ->where('exam_schedules.school_id',$school_id)
                    ->distinct('exams.exam_name')
                    ->get();
        if ($user_role == 'STUDENT') {
            
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('students.user_id',$user_id) 
                    ->first();
            
        }elseif($user_role == 'PARENTS'){

            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('student_parents.user_id',$user_id) 
                    ->first();
        }else{
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->get();
        }

        
        return view ('SMS.terminalReport',compact('title','manage_exam','user_id','get_class'));
    }

    public function showterminalReport(Request $request){
        $school_id =  $this->school_info();
        $title = "Terminal Report";

        $rules = array(         
            'exam_id'           => 'required',
            'class_id'          => 'required',
            'section_id'        => 'required',
            'student_id'        => 'required',
            'academic_year'     => 'required',

        );
        $this->validate($request, $rules);

        $exam             = $request->exam_id;
        $class            = $request->class_id;
        $section          = $request->section_id;
        $student          = $request->student_id;
        $academic_year    = $request->academic_year;

        $manage_settings = Setting::where('school_id',$school_id)
                                    ->get();

        $students = Student::where('students.student_id', $student)
                        ->where('students.school_id',$school_id)
                        ->get();
        $count_sub = Examschedule::where('school_id',$school_id)
                        ->where('exam_id',$exam)
                        ->where('class_id',$class)
                        ->where('section_id',$section)
                        ->count();

        

        $sub_total = ExamMarks::where('school_id',$school_id)
                        ->where('exam_id',$exam)
                        ->where('class_id',$class)
                        ->where('student_id',$student)
                        ->sum(DB::raw('mcq_marks + 
                            theory_marks + 
                            pr_marks + 
                            ca_marks' 
                        ));             
        $manage_student     = [];
        $manage_terminal    = [];
        $Total_final        = 0;
        $optional_sub       = [];
        foreach ($students as $key) {

            if ($key->created_at->format('Y') == $academic_year) {

                $manage_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                            ->where('students.student_id', $student)
                            ->where('students.school_id',$school_id)
                            ->whereYear('students.created_at',$academic_year)
                            ->get();
                $manage_terminal = ExamMarks::leftJoin('students','students.student_id','exam_marks.student_id')
                                    ->leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                                    ->where('exam_marks.student_id',$student)
                                    ->where('exam_marks.school_id',$school_id)
                                    ->where('exam_marks.class_id',$class)
                                    ->whereYear('exam_marks.created_at',$academic_year)
                                    ->get();
                $Total_final = ExamMarks::leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                                    ->where('exam_marks.student_id',$student)
                                    ->where('exam_marks.school_id',$school_id)
                                    ->where('exam_marks.class_id',$class)
                                    ->sum('subjects.subject_final_mark'); 

                $optional_sub = Student::leftjoin('subjects','subjects.subject_id','students.student_optional_subject')
                        ->where('students.school_id',$school_id)
                        ->where('students.student_class_id',$class)
                        ->where('students.student_section_id',$section)
                        ->where('students.student_id',$student)
                        ->first();
                                               
                }else{
                    $manage_student = OldStudent::leftJoin('school_classes','school_classes.class_id','old_students.student_class_id')
                            ->where('old_students.student_id', $student)
                            ->leftJoin('student_parents','student_parents.parents_id','old_students.student_guardian_id')
                            ->where('old_students.school_id',$school_id)
                            ->whereYear('old_students.created_at',$academic_year)
                            ->get();
                    $manage_terminal = ExamMarks::leftJoin('old_students','old_students.student_id','exam_marks.student_id')
                                    ->leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                                    ->where('exam_marks.student_id',$student)
                                    ->where('exam_marks.school_id',$school_id)
                                    ->where('exam_marks.class_id',$class)
                                    ->whereYear('exam_marks.created_at',$academic_year)
                                    ->get();
                    $Total_final = ExamMarks::leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                                    ->where('exam_marks.student_id',$student)
                                    ->where('exam_marks.school_id',$school_id)
                                    ->where('exam_marks.class_id',$class)
                                    ->sum('subjects.subject_final_mark');

                    $optional_sub = OldStudent::leftjoin('subjects','subjects.subject_id','old_students.student_optional_subject')
                        ->where('school_id',$school_id)
                        ->where('old_students.student_class_id',$class)
                        ->where('old_students.student_section_id',$section)
                        ->where('old_students.student_id',$student)
                        ->first();
                } 
            }                                          

        $gradeings = Grage::where('school_id',$school_id)->get();    
        return view ('SMS.showterminalReport',compact('title','manage_terminal','manage_student','manage_settings','school_id','gradeings','count_sub','sub_total','Total_final','optional_sub'));
    }

    public function student_report(){
        $school_id =  $this->school_info();
        $title = "Student Report";

        $manage_class = SchoolClass::where('school_id', $school_id)->get();
        
        return view ('SMS.student_report',compact('title','manage_class'));
    }

    public function showStudentReport(Request $request){
        $school_id =  $this->school_info();
        $title = "Student Report";
        $rules = array(         

            'class_id'          => 'required',
            'section_id'        => 'required',
        );
        $this->validate($request, $rules);
        $class      = $request->class_id;
        $section    = $request->section_id;


        $manage_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                ->leftJoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                                ->where('students.student_class_id', $class)
                                ->where('students.student_section_id', $section)
                                ->where('students.school_id', $school_id)
                                ->get();
        $manage_sattings = Setting::where('school_id',$school_id)->first();
        return view ('SMS.showStudentReport',compact('title','manage_student','manage_sattings'));
    }

    public function meritstagereport(){
        $school_id =  $this->school_info();
        $title = "Meritstage Report";

        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        $manage_exam = ExamSchedule::leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                ->select('exams.exam_name','exam_schedules.exam_id')
                ->where('exam_schedules.school_id', $school_id)
                ->distinct('exam_id')
                ->get();
        if ($user_role == 'STUDENT') {
            
        $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('students.user_id',$user_id) 
                    ->first();
        }elseif($user_role == 'PARENTS'){

            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                                ->leftjoin('sections','sections.saction_id','students.student_section_id')
                                ->where('students.school_id',$school_id)
                                ->where('student_parents.user_id',$user_id) 
                                ->first();
        }else{
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                                ->leftjoin('sections','sections.saction_id','students.student_section_id')
                                ->where('students.school_id',$school_id)
                                ->get();
        }

        
        
        return view ('SMS.meritstagereport',compact('title','manage_exam','user_id','get_class'));
    }

    public function showMeritstagereport(Request $request){
        $school_id =  $this->school_info();
        $title = "Meritstage Report";
        
        $exam             = $request->exam_id;
        $class            = $request->class_id;
        $section          = $request->section_id;
        $student          = $request->student_id;
        $academic_year    = $request->academic_year;

        $manage_settings = Setting::where('school_id',$school_id)->get();

        $manage_subjects = Subject::where('subject_class_id',$class)
                            ->where('school_id',$school_id)
                            ->get();

        $manage_exam = Exam::where('exam_id', $exam)
                        ->where('school_id', $school_id)   
                        ->get();

        $manage_class = SchoolClass::where('class_id', $class)
                        ->where('school_id', $school_id)   
                        ->get();

        $manage_section = Section::where('saction_id', $section)
                        ->where('school_id', $school_id)   
                        ->get();

        $students = Student::where('students.student_class_id',$class)
                                        ->where('students.student_section_id',$section)
                                        ->where('students.school_id', $school_id)
                                        ->get();

        foreach ($students as $key) {
            if ($key->created_at->format('Y') == $academic_year) {
                    
                $manage_student = Student::where('students.student_class_id',$class)
                                            ->where('students.student_section_id',$section)
                                            ->where('students.school_id', $school_id)
                                            ->whereYear('students.created_at',$academic_year)
                                            ->get();
                $manage_marks = ExamMarks::leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                            ->where('exam_marks.class_id',$class)
                            ->where('exam_marks.school_id', $school_id)
                            ->whereYear('exam_marks.created_at', $academic_year)
                            ->get();
                $count_subject = Subject::where('subject_class_id',$class)
                            ->where('school_id',$school_id)
                            ->whereYear('created_at',$academic_year)
                            ->count();
                return view ('SMS.showMeritstagereport',compact('title','manage_settings','manage_subjects','manage_exam','manage_student','manage_marks','count_subject','school_id','manage_class','manage_section','academic_year'));                                           
            }else{

                $manage_student = OldStudent::where('old_students.student_class_id',$class)
                                                            ->where('old_students.student_section_id',$section)
                                                            ->where('old_students.school_id', $school_id)
                                                            ->whereYear('old_students.created_at',$academic_year)
                                                            ->get(); 
                $manage_marks = ExamMarks::leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                                ->where('exam_marks.class_id',$class)
                                ->where('exam_marks.school_id', $school_id)
                                ->whereYear('exam_marks.created_at', $academic_year)
                                ->get(); 

                $count_subject = Subject::where('subject_class_id',$class)
                            ->where('school_id',$school_id)
                            ->whereYear('created_at',$academic_year)
                            ->count(); 

            return view ('SMS.showMeritstagereport',compact('title','manage_settings','manage_subjects','manage_exam','manage_student','manage_marks','count_subject','school_id','manage_class','manage_section','academic_year'));                                          
            }    
        }                        

        Session::flash('error','No Data Found !');
        return back();
        
    }

    public function tabulationsheetreport(){
        $school_id =  $this->school_info();
        $title = "Tabulation Sheet";
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        if ($user_role == 'STUDENT') {
            
        $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('students.user_id',$user_id) 
                    ->first();
        }elseif($user_role == 'PARENTS'){

            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('student_parents.user_id',$user_id) 
                    ->first();
        }else{
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->get();
        }

        $manage_exam = ExamSchedule::leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                ->select('exams.exam_name','exam_schedules.exam_id')
                                ->where('exam_schedules.school_id', $school_id)
                                ->distinct('exam_id')
                                ->get();
                   
        
        return view ('SMS.tabulationsheetreport',compact('title','manage_exam','user_id','get_class'));
    }

    public function showTabulationsheetreport(Request $request){
        $school_id =  $this->school_info();
        $title = "Tabulationsheet Report";

        $exam               = $request->exam_id;
        $class              = $request->class_id;
        $section            = $request->section_id;
        $student            = $request->student_id;
        $academic_year      = $request->academic_year;
        
        $manage_settings = Setting::where('school_id',$school_id)->get();

        

        $manage_academic_year = ExamMarks::where('school_id',$school_id)
                                        ->get();

        foreach ($manage_academic_year as $key) {

            if($key->created_at->format('Y') == $academic_year){

                $manage_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                    ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                    ->where('students.student_id',$student)
                                    ->where('students.school_id',$school_id)
                                    ->whereYear('students.created_at',$academic_year)
                                    ->get();

                $manage_tabulation = ExamMarks::leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                                    ->leftJoin('students','students.student_id','exam_marks.student_id')
                                    ->leftJoin('school_classes','school_classes.class_id','exam_marks.class_id')
                                    ->where('exam_marks.exam_id',$exam)
                                    ->where('exam_marks.student_id',$student)
                                    ->where('exam_marks.class_id',$class)
                                    ->whereYear('exam_marks.created_at',$academic_year)
                                    ->where('exam_marks.school_id',$school_id)
                                    ->get();
                return view ('SMS.showTabulationsheetreport',compact('title','manage_settings','manage_student','manage_tabulation'));                    
                }

            else{

                $manage_student = OldStudent::leftJoin('school_classes','school_classes.class_id','old_students.student_class_id')
                                    ->leftJoin('sections','sections.saction_id','old_students.student_section_id')
                                    ->where('old_students.student_id',$student)
                                    ->where('old_students.school_id',$school_id)
                                    ->whereYear('old_students.created_at',$academic_year)
                                    ->get();
                $manage_tabulation = ExamMarks::leftJoin('subjects','subjects.subject_id','exam_marks.subject_id')
                                    ->leftJoin('old_students','old_students.student_id','exam_marks.student_id')
                                    ->leftJoin('school_classes','school_classes.class_id','exam_marks.class_id')
                                    ->where('exam_marks.exam_id',$exam)
                                    ->where('exam_marks.student_id',$student)
                                    ->where('exam_marks.class_id',$class)
                                    ->whereYear('exam_marks.created_at',$academic_year)
                                    ->where('exam_marks.school_id',$school_id)
                                    ->get();
        return view ('SMS.showTabulationsheetreport',compact('title','manage_settings','manage_student','manage_tabulation'));
            }                            
        }                             
        Session::flash('error','No Data Found !');
        return back();

    }


    public function certificate(){
        $school_id =  $this->school_info();
        $title = "Certificate";

        $manage_class = SchoolClass::where('school_id',$school_id)->get();

        
        $manage_exam = ExamSchedule::leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                ->select('exams.exam_name','exam_schedules.exam_id')
                                ->where('exam_schedules.school_id', $school_id)
                                ->distinct('exam_id')
                                ->get();
        
        return view ('SMS.certificate',compact('title','manage_class'));
    }
    public function showCertificatereport(Request $request){
        $school_id =  $this->school_info();
        $title = "Certificate Report";

        $class            = $request->class_id;
        $section          = $request->section_id;
        $student          = $request->student_id;
        $academic_year    = $request->academic_year;

        $manage_settings = Setting::where('school_id',$school_id)->get();

        $manage_academic_year = Student::where('school_id',$school_id)
                        ->get();

        foreach ($manage_academic_year as $key) {
            
            if ($key->created_at->format('Y') == $academic_year) {
            
                $manage_certificate = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                ->where('students.student_class_id',$class)
                                ->where('students.student_section_id',$section)
                                ->where('students.student_id',$student)
                                ->where('students.school_id', $school_id)
                                ->whereYear('students.created_at',$academic_year)
                                ->get();
                return view ('SMS.showCertificatereport',compact('title','manage_settings','manage_certificate','academic_year'));                
            }else{
                $manage_certificate = OldStudent::leftJoin('school_classes','school_classes.class_id','old_students.student_class_id')
                                ->leftJoin('sections','sections.saction_id','old_students.student_section_id')
                                ->where('old_students.student_class_id',$class)
                                ->where('old_students.student_section_id',$section)
                                ->where('old_students.student_id',$student)
                                ->where('old_students.school_id', $school_id)
                                ->whereYear('old_students.created_at',$academic_year)
                                ->get();
                              
        return view ('SMS.showCertificatereport',compact('title','manage_settings','manage_certificate','academic_year'));
            }
        }
        Session::flash('error','No Data Found !');
        return back();

    }
    public function transectionreport(){
        $school_id =  $this->school_info();
        $title = "Transection Report";
        
        return view ('SMS.transectionreport',compact('title'));
    }

    public function showTransectionreport(Request $request){
        $school_id =  $this->school_info();
        $title = "Transection Report";
        
        $start = $request->start_date;
        $end = $request->end_date;

        $manage_fees = Invoice::leftJoin('students','students.student_id','invoices.student_id')
                                ->leftJoin('school_classes','school_classes.class_id','invoices.class_id')
                                ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                ->whereBetween('invoices.created_at',array($start,$end))
                                ->where('invoices.school_id',$school_id)
                                ->get();

        $manage_income = Income::whereBetween('incomes.income_date',array($start,$end))
                            ->where('incomes.school_id', $school_id)
                            ->get();

        $manage_expence = Expense::whereBetween('expenses.exp_date',array($start,$end))
                            ->where('expenses.school_id', $school_id)
                            ->get();


        $manage_settings = Setting::where('school_id',$school_id)->get();
        return view ('SMS.showTransectionreport',compact('title','manage_settings','manage_fees','manage_income','manage_expence','school_id'));
    }
    public function balancefeesreport(){
        $school_id =  $this->school_info();
        $title = "Balancefees Report";
        $manage_class = SchoolClass::where('school_id',$school_id)->get();
        return view ('SMS.balancefeesreport',compact('title','manage_class'));
    }
    public function showBalancefeesreport(Request $request){
        $school_id =  $this->school_info();
        $title = "Show Balancefees Report";
        $manage_settings = Setting::where('school_id',$school_id)->get();

        $student = $request->student_id;
        $class   = $request->class_id;
        $section = $request->section_id;



        $manage_total_fee = Invoice::where('invoices.student_id',$student)->where('school_id', $school_id)->sum('total_fee');
        $manage_paid = Invoice::where('invoices.student_id',$student)->where('school_id', $school_id)->sum('paid');
        $manage_discount = Invoice::where('invoices.student_id',$student)->where('school_id', $school_id)->sum('discount');

        $manage_student = Student::where('students.student_id',$student)
                                // ->where('students.student_class_id',$class)
                                ->where('students.school_id',$school_id)
                                ->get();


        return view ('SMS.showBalancefeesreport',compact('title','manage_settings','manage_student','manage_total_fee','manage_paid','manage_discount'));


    }
    public function progresscardreport(){
        $school_id =  $this->school_info();
        $title = "Progress Report";
        $manage_class = SchoolClass::where('school_id',$school_id)->get();

        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        if ($user_role == 'STUDENT') {
            
        $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('students.user_id',$user_id) 
                    ->first();
        }elseif($user_role == 'PARENTS'){

            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->where('student_parents.user_id',$user_id) 
                    ->first();
        }else{
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                    ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                    ->leftjoin('sections','sections.saction_id','students.student_section_id')
                    ->where('students.school_id',$school_id)
                    ->get();
        }
        return view ('SMS.progresscardreport',compact('title','manage_class','user_id','get_class'));
        
    }

    public function showProgresscardreport(Request $request){
        $school_id =  $this->school_info();
        $title = "Progress Report";

        $student        = $request->student_id;
        $class          = $request->class_id;
        $section        = $request->section_id;
        $academic_year  = $request->academic_year;

        $manage_settings = Setting::where('school_id',$school_id)->get();



        $students = Student::where('students.school_id',$school_id)
                        ->get();
        

        foreach ($students as $key) {
            $current_academic = $key->created_at->format('Y');


            if ($current_academic == $academic_year) {
                
            $manage_student = Student::where('students.student_id',$student)
                                    ->where('students.student_class_id',$class)
                                    ->where('students.student_section_id',$section)
                                    ->where('students.created_at',$academic_year)
                                    ->where('students.school_id',$school_id)
                                    ->get();

            $manage_exam = Exam::where('school_id',$school_id)->get();

            return view ('SMS.showProgresscardreport',compact('title','manage_settings','manage_student','manage_exam','student','class','school_id','academic_year','class','section'));                        
            }else{

            $manage_student = OldStudent::where('old_students.student_id',$student)
                                    ->where('old_students.student_class_id',$class)
                                    ->where('old_students.student_section_id',$section)
                                    ->where('old_students.created_at',$academic_year)
                                    ->where('old_students.school_id',$school_id)
                                    ->get();                      

            $manage_exam = Exam::where('school_id',$school_id)->get();


            return view ('SMS.showProgresscardreport',compact('title','manage_settings','manage_student','manage_exam','student','class','school_id','academic_year','class','section'));                                      
            }
        }
    Session::flash('error','No Data Found !');
        return back();                             
    }

    public function feeReport(){
        $school_id =  $this->school_info();
        $title = "Fee Report";
        $manage_class = SchoolClass::where('school_id',$school_id)->get();
        return view ('SMS.feeReport',compact('title','manage_class'));
    }

    public function showFeesreport(Request $request){
        $school_id =  $this->school_info();
        $title = "Fees Report";

        $student            = $request->student_id;
        $class              = $request->class_id;
        $section            = $request->section_id;
        $academic_year      = $request->academic_year;

        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $manage_settings = Setting::where('school_id',$school_id)->get();

        $manage_year = Student::where('students.school_id',$school_id)
                        ->where('students.student_id',$student)
                        ->get();

        foreach ($manage_year as $key) {
            if($key->created_at->format('Y') == $academic_year){

                $manage_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                        ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                        ->where('students.school_id',$school_id)
                                        ->where('students.student_id',$student)
                                        ->where('students.student_class_id',$class)
                                        ->where('students.student_section_id',$section)
                                        ->get();

                $fees_report = Invoice::where('invoices.school_id',$school_id)
                        ->where('invoices.student_id',$student)
                        ->whereBetween('invoices.created_at',array($start_date,$end_date))
                        ->get();
                return view ('SMS.showFeesreport',compact('title','manage_settings','manage_student','student','class','fees_report','school_id'));        
            }else{
                $manage_student = OldStudent::leftJoin('school_classes','school_classes.class_id','old_students.student_class_id')
                                        ->leftJoin('sections','sections.saction_id','old_students.student_section_id')
                                        ->where('old_students.school_id',$school_id)
                                        ->where('old_students.student_id',$student)
                                        ->where('old_students.student_class_id',$class)
                                        ->where('old_students.student_section_id',$section)
                                        ->whereYear('old_students.created_at',$academic_year)
                                        ->get();
                        

                $fees_report = Invoice::where('invoices.school_id',$school_id)
                                        ->where('invoices.student_id',$student)
                                        ->whereBetween('invoices.created_at',array($start_date,$end_date))
                                        ->get();
            return view ('SMS.showFeesreport',compact('title','manage_settings','manage_student','student','class','fees_report','school_id'));
            }
        }
        Session::flash('error','No Data Found !');
        return back(); 
    }

    public function attendanceReport(){
        $school_id =  $this->school_info();
        $title = "Attendance Report";
        $class = SchoolClass::where('school_id',$school_id)->get();

        $teacher = Teacher::where('school_id',$school_id)->get();
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;

        if ($user_role == 'STUDENT') {
            
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                ->leftjoin('sections','sections.saction_id','students.student_section_id')
                ->where('students.school_id',$school_id)
                ->where('students.user_id',$user_id) 
                ->get();
                
        }elseif($user_role == 'PARENTS'){

            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                            ->leftjoin('sections','sections.saction_id','students.student_section_id')
                            ->where('students.school_id',$school_id)
                            ->where('student_parents.user_id',$user_id) 
                            ->get();
            
        }else{
            $get_class = Student::leftjoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftjoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                            ->leftjoin('sections','sections.saction_id','students.student_section_id')
                            ->where('students.school_id',$school_id)
                            ->get();
        }

        return view ('SMS.attendanceReport',compact('title','class','teacher','user_id','get_class'));
    }
    public function showAttendance(Request $request){
            $school_id =  $this->school_info();
            

            $teacher        = $request->teacher_id;
            $class          = $request->class_id;
            $student        = $request->student_id;
            $section        = $request->section_id;
            $year           = $request->year;
            $month          = $request->month;
            
            if ($student) {
                $title = "Student Attendance Report";
                $manage_attendence = attendance::leftjoin('students','students.student_id','attendances.student_id')
                        ->where('attendances.school_id',$school_id)
                        ->where('attendances.student_id',$student)
                        ->whereMonth('attendances.created_at', $month)
                        ->whereYear('attendances.created_at', $year)
                        ->select('attendances.*','students.*','attendances.created_at as att_created_at')
                        ->get();
                        
                $month_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);        
                return view ('SMS.showAttendance',compact('title','class','teacher','manage_attendence','month_day','year','month'));                                    
            }else{
                $title = "Teacher Attendance Report";
                $manage_attendence = TeacherAttendence::where('teacher_attendences.school_id',$school_id)       
                            ->where('teacher_attendences.school_id',$school_id)
                            ->where('teacher_attendences.teacher_id',$teacher)
                            ->whereMonth('teacher_attendences.created_at', $month)
                            ->whereYear('teacher_attendences.created_at', $year)
                            ->get();
                $month_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);  
                return view ('SMS.showTeacherAttendance',compact('title','class','teacher','manage_attendence','month_day','year','month'));                                        
            }
        Session::flash('error','No Data Found !');
        return back();    
        }

    // online_admission
    public function online_admission(){
        $school_id =  $this->school_info();
        $title = "Online Admission";


        $manage_application = AdmissionForm::leftJoin('school_classes','school_classes.class_id','admission_forms.student_class_id')
                                        ->where('admission_forms.school_id',$school_id)
                                        ->get();

        return view ('SMS.online_admission',compact('title','manage_application'));
    }
    public function view_application(){
        $school_id =  $this->school_info();
        $title = "Onile Admission";


        $manage_application = AdmissionForm::leftJoin('school_classes','school_classes.class_id','admission_forms.student_class_id')
                                        ->where('admission_forms.school_id',$school_id)
                                        ->where('admission_forms.admission_id',$id)
                                        ->get();

        return view ('SMS.view_application',compact('title','manage_application','teacher'));
    }
    public function view_msg($id){
        $school_id =  $this->school_info();
        $title = "View Message";

        $user       = Auth::user()->id;
        $user_role  = Auth::user()->role;

        if($user_role == 'PARENTS'){

            $get_parent = StudentParent::where('user_id',$user)->first();
            $manage_message = Message::leftjoin('inboxes','inboxes.id','messages.inbox_id')
                    ->leftjoin('student_parents','student_parents.parents_id','messages.notifiable_id')
                    ->where('messages.school_id',$school_id)
                    ->where('messages.message_id',$id)
                    ->first();

            $read_msg = Message::where('notifiable_id',$get_parent->parents_id)
                    ->where('message_id',$id)
                    ->update(['read_at' => date('Y-m-d'),]);

        }elseif($user_role == 'STUDENT'){
            $get_student = Student::where('user_id',$user)->first();
            $manage_message = Message::leftjoin('inboxes','inboxes.id','messages.inbox_id')
                    ->leftjoin('students','students.student_id','messages.notifiable_id')
                    ->where('messages.school_id',$school_id)
                    ->where('messages.message_id',$id)
                    ->first();

            $read_msg = Message::where('notifiable_id',$get_student->student_id)
                    ->where('message_id',$id)
                    ->update(['read_at' => date('Y-m-d'),]);
        }else{
            $get_teacher = Teacher::where('user_id',$user)->first();
            $manage_message = Message::leftjoin('inboxes','inboxes.id','messages.inbox_id')
                    ->leftjoin('teachers','teachers.teacher_id','messages.notifiable_id')
                    ->where('messages.school_id',$school_id)
                    ->where('messages.message_id',$id)
                    ->first();

            $read_msg = Message::where('notifiable_id',$get_teacher->teacher_id)
                    ->where('message_id',$id)
                    ->update(['read_at' => date('Y-m-d'),]);
        }

        $manage_settings = Setting::where('school_id',$school_id)->first();            
        return view ('SMS.view_msg',compact('title','manage_message','manage_settings','manage_user'));
    }



    // edit page show

    public function edit_student($id){
        $school_id =  $this->school_info();
        $title = "Student";

        $manage_parents     = StudentParent::where('school_id',$school_id)->get();
        $manage_class       = SchoolClass::where('school_id',$school_id)->get();
        $manage_section     = Section::where('school_id',$school_id)->get();
        $manage_subjects    = Subject::where('subject_type','Optional')
                                        ->where('school_id',$school_id)
                                        ->get();
        $manage_user        = Student::leftJoin('users','users.id','students.user_id')
                                ->where('students.school_id', $school_id)
                                ->where('students.user_id',$id)
                                ->get();
        $edit_student       = Student::leftJoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                                ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                ->where('students.school_id',$school_id)
                                ->where('students.user_id',$id)->get();
        return view ('SMS.student-edit',compact('title','manage_parents','manage_class','manage_section','edit_student','manage_user','manage_subjects'));
    }

    public function edit_parents($id){
        $school_id =  $this->school_info();
        $title = "Parent";
        $manage_parents = StudentParent::where('student_parents.school_id',$school_id)
                        ->where('student_parents.user_id',$id)
                        ->get();

        $manage_user = User::where('users.school_id',$school_id)
                        ->where('users.id',$id)
                        ->get();
        return view ('SMS.edit-parents',compact('title','manage_parents','manage_user'));
    }

    public function edit_subject($id){
        $school_id =  $this->school_info();
        $title = "Subject";

        $teachers       = Teacher::where('school_id',$school_id)->get();
        $classes        = SchoolClass::where('school_id',$school_id)->get();
        $edit_subject   = Subject::leftJoin('teachers','teacher_id','subjects.subject_teacher_id')
                            ->leftJoin('school_classes','class_id','subjects.subject_class_id')
                            ->where('subjects.school_id',$school_id)
                            ->where('subjects.subject_id',$id)
                            ->get();
        return view ('SMS.subject-edit',compact('title','edit_subject','teachers','classes'));
    }

    public function edit_teacher($id){
        $school_id =  $this->school_info();
        $title = "Teacher";

        $edit_teacher  = Teacher::leftJoin('users','users.id','teachers.user_id')
                        ->where('teachers.school_id',$school_id)
                        ->where('teacher_id',$id)->get();
        return view ('SMS.teacher-edit',compact('title','edit_teacher'));
    }
    public function edit_class($id){
        $school_id =  $this->school_info();
        $title = "Class";

        $manage_teachers  = Teacher::where('school_id',$school_id)->get();
        $edit_class       = SchoolClass::leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                            ->where('school_classes.school_id',$school_id)
                            ->where('school_classes.class_id',$id)
                            ->get();
        return view ('SMS.edit_class',compact('title','edit_class','manage_teachers'));
    }
    public function edit_section($id){
        $school_id =  $this->school_info();
        $title = "Section";

        $manage_teachers  = Teacher::where('school_id',$school_id)->get();
        $class = SchoolClass::where('school_id',$school_id)->get();

        $edit_section     = Section::leftJoin('teachers','teachers.teacher_id','sections.section_teacher_id')
                            ->leftJoin('school_classes','school_classes.class_id','sections.class_id')
                            ->where('sections.school_id',$school_id)
                            ->where('sections.saction_id',$id)->get();
        return view ('SMS.section-edit',compact('title','edit_section','manage_teachers','class'));
    }
    public function edit_routine($id){
        $school_id =  $this->school_info();
        $title = "Routine";

        $classes = SchoolClass::where('school_id',$school_id)->get();
        $section = Section::where('school_id',$school_id)->get();
        $subject = Subject::where('school_id',$school_id)->get();
        $teacher = Teacher::where('school_id',$school_id)->get();

        $manage_routine = ClassRoutine::leftJoin('school_classes','school_classes.class_id','class_routines.class_id')
                        ->leftJoin('sections','sections.saction_id','class_routines.section_id')
                        ->leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->leftJoin('teachers','teachers.teacher_id','class_routines.subject_teacher_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.routine_id',$id)
                        ->get();
        return view ('SMS.edit-routine',compact('title','classes','section','subject','teacher','manage_routine'));
    }
    public function edit_assignment($id){
        $school_id =  $this->school_info();
        $title = "Assignment";

        $classes = SchoolClass::where('school_id',$school_id)->get();
        $section = Section::where('school_id', $school_id)->get();
        $subject = Subject::where('school_id',$school_id)->get();

        $manage_assignment = Assignment::leftJoin('school_classes','school_classes.class_id','assignments.assignment_class_id')
                        ->leftJoin('sections','sections.saction_id','assignments.assignment_section_id')
                        ->leftJoin('subjects','subjects.subject_id','assignments.assignment_subject_id')
                        ->where('assignments.school_id',$school_id)
                        ->where('assignments.assignment_id',$id)
                        ->get();
        return view ('SMS.edit-assignment',compact('title','classes','section','subject','teacher','manage_assignment'));
    }
    public function edit_syllabuses($id){
        $school_id =  $this->school_info();
        $title = "Syllabuses";

        $classes = SchoolClass::where('school_id',$school_id)->get();

        $manage_syllabuses = Syllabus::leftJoin('school_classes','school_classes.class_id','syllabi.sellabus_class_id')
                        ->where('syllabi.school_id',$school_id)
                        ->where('syllabi.syllabi_id',$id)
                        ->get();
        return view ('SMS.edit-syllabuses',compact('title','classes','manage_syllabuses'));
    }
    public function edit_exam($id){
        $school_id =  $this->school_info();
        $title = "Exam";

        $manage_exam = Exam::where('exams.school_id',$school_id)
                        ->where('exams.exam_id',$id)
                        ->get();
        return view ('SMS.edit_exam',compact('title','manage_exam'));
    }
    public function view_exam_schedule($id){
        $school_id =  $this->school_info();
        $title = "Exam Schedule";

        $manage_class   = SchoolClass::where('school_id', $school_id)->get();
        $manage_section = Section::where('school_id', $school_id)->get();
        $manage_subject = Subject::where('school_id', $school_id)->get();
        $manage_exam    = Exam::where('exams.school_id', $school_id)->get();

        $manage_exam_schedule = ExamSchedule::leftJoin('school_classes','school_classes.class_id','exam_schedules.class_id')
                        ->leftJoin('sections','sections.saction_id','exam_schedules.section_id')
                        ->leftJoin('subjects','subjects.subject_id','exam_schedules.subject_id')
                        ->leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                        ->where('exam_schedules.school_id',$school_id)
                        ->where('exam_schedules.schedule_id',$id)
                        ->get();
        return view ('SMS.edit_exam_schedule',compact('title','manage_exam_schedule','manage_class','manage_section','manage_subject','manage_exam'));
    }
    
    public function edit_per($id){
        $school_id =  $this->school_info();
        $title = "Mark Percentages";

        $manage_per = MarkPercentage::where('mark_percentages.school_id',$school_id)
                        ->where('mark_percentages.mark_per_id',$id)
                        ->get();
        return view ('SMS.edit_per',compact('title','manage_per'));
    }

    public function edit_grade($id){
        $school_id =  $this->school_info();
        $title = "Grade";

        $manage_grade = Grage::where('grages.school_id',$school_id)
                        ->where('grages.grade_id',$id)
                        ->get();
        return view ('SMS.edit_grade',compact('title','manage_grade'));
    }
    public function edit_transport($id){
        $school_id =  $this->school_info();
        $title = "Transport";

        $manage_transport = Transport::where('transports.school_id',$school_id)
                        ->where('transports.transport_id',$id)
                        ->get();
        return view ('SMS.edit_transport',compact('title','manage_transport'));
    }
    public function edit_transport_member($id){
        $school_id =  $this->school_info();
        $title = "Transport";

        $manage_class = SchoolClass::where('school_id',$school_id)->get();

        $transport_route = Transport::where('school_id',$school_id)
                        ->get();


        $edit_transport_member = TransportMember::leftJoin('school_classes','school_classes.class_id','transport_members.class_id')
                        ->leftJoin('sections','sections.saction_id','transport_members.section_id')
                        ->leftJoin('students','students.student_id','transport_members.student_id')
                        ->leftJoin('transports','transports.transport_id','transport_members.transport_id')
                        ->where('transport_members.school_id',$school_id)
                        ->where('transport_members.transport_member_id',$id)
                        ->get();
        return view ('SMS.edit_transport_member',compact('title','manage_class','transport_route','edit_transport_member'));
    }
    public function edit_hostel($id){
        $school_id =  $this->school_info();
        $title = "Hostel";

        $manage_hostel = Hostel::where('hostels.school_id',$school_id)
                        ->where('hostels.hostel_id',$id)
                        ->get();
        return view ('SMS.edit_hostel',compact('title','manage_hostel'));
    }
    public function edit_member($id){
        $school_id =  $this->school_info();
        $title = "Hostel Members";

        $hostel     = Hostel::where('school_id', $school_id)->get();
        $class      = SchoolClass::where('school_id', $school_id)->get();
        $students   = Student::where('school_id', $school_id)->get();

        $manage_members = HostelMember::leftJoin('students','students.student_id','hostel_members.member_name')
                        ->leftJoin('school_classes','school_classes.class_id','hostel_members.class_id')
                        ->leftJoin('hostels','hostels.hostel_id','hostel_members.hostel_id')
                        ->where('hostel_members.school_id',$school_id)
                        ->where('hostel_members.host_member_id',$id)
                        ->get();
        return view ('SMS.edit_members',compact('title','manage_members','hostel','class','students'));
    }

    // edit library part
    public function edit_library_member_teacher($id){
        $school_id =  $this->school_info();
        $title = "Library Members";
        $manage_teacher = Teacher::where('school_id', $school_id)
                                    ->get();
        $manage_student = Student::where('school_id', $school_id)
                                    ->get();
        $manage_library_member = LibraryMember::leftJoin('teachers','teachers.user_id','library_members.user_id')
                                                ->where('library_members.school_id', $school_id)
                                                ->where('library_members.member_id',$id)
                                                ->get();                          

        return view ('SMS.edit_library_member_teacher',compact('title','manage_teacher','manage_student','manage_library_member'));
    }
    public function edit_library_student_member($id){
        $school_id =  $this->school_info();
        $title = "Library Members";
        $manage_teacher = Teacher::where('school_id', $school_id)
                                    ->get();
        $manage_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                    ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                    ->where('students.school_id', $school_id)
                                    ->get();

        $manage_library_member = LibraryMember::leftJoin('students','students.user_id','library_members.user_id')
                                                ->where('library_members.school_id', $school_id)
                                                ->where('library_members.member_id',$id)
                                                ->get();                          

        return view ('SMS.edit_library_member_student',compact('title','manage_teacher','manage_student','manage_library_member'));
    }
    public function edit_book($id)
    {
        $school_id =  $this->school_info();
        $title = "Book";

        $manage_book = Book::where('books.school_id', $school_id)
                            ->where('books.book_id',$id)
                            ->get();

        return view ('SMS.edit_book',compact('title','manage_book'));
    }
    public function edit_issue_student($id)
    {
        $school_id =  $this->school_info();
        $title = " Issue Book ";

        $manage_student = LibraryMember::
                            leftJoin('students','students.user_id','library_members.user_id')
                            ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                            ->leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('students.school_id', $school_id)
                            ->get();
        $manage_books = Book::where('books.school_id', $school_id)
                            ->get();

        $manage_issue_student = BookIssued::leftJoin('students','students.user_id','book_issueds.user_id')
                                            ->leftJoin('books','books.book_id','book_issueds.book_id')
                                            ->where('book_issueds.school_id',$school_id)
                                            ->where('book_issueds.issu_id',$id)
                                            ->get();

        return view ('SMS.edit_issue_student',compact('title','manage_student','manage_books','manage_issue_student'));
    }
    public function edit_issue_teacher($id)
    {
        $school_id =  $this->school_info();
        $title = " Issue Book ";

        $manage_teacher = LibraryMember::leftJoin('teachers','teachers.user_id','library_members.user_id')
                                    ->where('library_members.school_id', $school_id)
                                    ->get();
        $manage_books = Book::where('books.school_id', $school_id)
                            ->get();

        $manage_issue_teacher = BookIssued::leftJoin('teachers','teachers.user_id','book_issueds.user_id')
                                            ->leftJoin('books','books.book_id','book_issueds.book_id')
                                            ->where('book_issueds.school_id',$school_id)
                                            ->where('book_issueds.issu_id',$id)
                                            ->get();

        return view ('SMS.edit_issue_teacher',compact('title','manage_teacher','manage_books','manage_issue_teacher'));
    }

    // account Part
    public function edit_fee_type($id){
        $school_id =  $this->school_info();
        $title = "Fee Type";

        $manage_class = SchoolClass::where('school_id', $school_id)->get();

        $manage_fee_type = FeeType::leftJoin('school_classes','school_classes.class_id', 'fee_types.class_id')
                        ->where('fee_types.school_id', $school_id)
                        ->where('fee_types.fee_type_id',$id)
                        ->get();

        return view('SMS.edit_fee_type', compact('title','manage_fee_type','manage_class'));
    }

    public function edit_invoice($id){
        $school_id =  $this->school_info();
        $title = "Invoice";
        $class = SchoolClass::where('school_id', $school_id)
                            ->get();
        $fee_type = FeeType::where('school_id', $school_id)
                            ->get();

        $manage_invoice = Invoice::leftJoin('school_classes','school_classes.class_id', 'invoices.class_id')
                        ->leftJoin('students','students.student_id', 'invoices.student_id')
                        ->leftJoin('fee_types','fee_types.fee_type_id', 'invoices.fee_type_id')
                        ->where('invoices.school_id', $school_id)
                        ->where('invoices.invoice_id',$id)
                        ->get();

        return view('SMS.edit_invoice', compact('title','manage_invoice','class','fee_type'));
    }

    
    public function view_invoice($id){
        $school_id =  $this->school_info();
        $title = "Invoice";

        $manage_invoice = Invoice::leftJoin('students','students.student_id','invoices.student_id')
                                ->leftJoin('school_classes','school_classes.class_id','invoices.class_id')
                                ->where('invoices.school_id', $school_id)
                                ->where('invoices.fee_type_id', $id)
                                ->get();

        foreach ($manage_invoice as $key) {
            $fee=$key->fee_type_id;
          }  

        $all_fee_type = PaymentHistory::where('school_id', $school_id)
                                ->get();

        $manage_fee_type = PaymentHistory::leftJoin('invoices','invoices.fee_type_id','payment_histories.random_id')
                                        ->leftJoin('fee_types','fee_types.fee_type_id','payment_histories.fee_type_id')
                                        ->where('payment_histories.random_id', $fee)
                                        ->where('payment_histories.school_id', $school_id)
                                        ->get();                        
        return view('SMS.view_invoice', compact('title','manage_invoice','manage_fee_type'));
    }


    public function edit_single_invoice($id){
        $school_id =  $this->school_info();
        $title = "Invoice";
        $class = SchoolClass::where('school_id', $school_id)
                            ->get();
        $fee_type = FeeType::where('school_id', $school_id)
                            ->get();

        $manage_fee_type = invoice::where('invoices.school_id', $school_id)
                                        ->where('invoices.fee_type_id',$id)
                                        ->get();                        
        return view('SMS.edit_single_invoice', compact('title','class','manage_fee_type','fee_type'));
    }
    public function edit_expense($id){
        $school_id =  $this->school_info();
        $title = "Expense";
        
        $manage_expense = Expense::where('school_id', $school_id)
                                        ->where('exp_id',$id)
                                        ->get();                        
        return view('SMS.edit_expense', compact('title','class','manage_expense','fee_type'));
    }
    public function edit_income($id){
        $school_id =  $this->school_info();
        $title = "Income";
        
        $manage_income = Income::where('school_id', $school_id)
                            ->where('income_id',$id)
                            ->get();                        
        return view('SMS.edit_income', compact('title','manage_income'));
    }

    public function edit_user_profile($id){
        $school_id =  $this->school_info();
        $title = "User Profile";
        
        $user = $id; 

        $role = User::where('school_id',$school_id)
                        ->where('id',$id)
                        ->first();
        $user_role = $role->role;                

        $manage_class     = SchoolClass::where('school_id',$school_id)->get();
        $manage_subjects  = Subject::where('school_id',$school_id)->get();
        $manage_subjects  = Subject::where('school_id',$school_id)->get();
        $manage_parents   = StudentParent::where('school_id',$school_id)->get();

        if ($user_role=='STUDENT') {
            
            
            $manage_parents   = StudentParent::where('school_id',$school_id)->get();
            $manage_section   = Section::where('school_id',$school_id)->get();
            $manage_class     = SchoolClass::where('school_id',$school_id)->get();
            $manage_subjects  = Subject::where('school_id',$school_id)->where('subject_type','Optional')->get();

            $manage_user        = Student::leftJoin('users','users.id','students.user_id')
                                ->where('students.school_id', $school_id)
                                ->where('students.user_id',$user)
                                ->get();


            $student = Student::leftJoin('student_parents','student_parents.parents_id','students.student_guardian_id')
                                ->leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->leftJoin('sections','sections.saction_id','students.student_section_id')
                                ->leftJoin('subjects','subjects.subject_subject_name','students.student_optional_subject')
                                ->where('students.school_id',$school_id)
                                ->where('students.user_id',$user)
                                ->first();
                               
        return view ('SMS.editUserProfile',compact('title','manage_section','manage_class','manage_parents','student','manage_subjects','manage_user'));
        }elseif ($user_role=='TEACHER') {
            $edit_teacher  = Teacher::leftJoin('users','users.id','teachers.user_id')
                        ->where('teachers.school_id',$school_id)
                        ->where('user_id',$user)
                        ->get();
        return view ('SMS.editUserProfile',compact('title','manage_user','edit_teacher'));
        }elseif ($user_role=='PARENTS') {
            $manage_parents = StudentParent::where('school_id',$school_id)
                                        ->where('user_id',$user)
                                        ->get();
        return view ('SMS.editUserProfile',compact('title','manage_class','manage_subjects','manage_parents'));
        }elseif ($user_role=='Admin') {
            $manage_user = userInfo::where('user_infos.school_id',$school_id)
                            ->where('user_infos.user_id',$user)
                            ->get();
        return view ('SMS.editUserProfile',compact('title','manage_user'));
        }else{
            $domain_name = SchoolInfo::where('school_id',$school_id)->first();

            $main_admin = $domain_name->domain_name."@admin.com";
            $manage_user = userInfo::where('user_infos.school_id',$school_id)
                            ->where('user_infos.user_id',$user)
                            ->get();

        return view ('SMS.editUserProfile',compact('title','manage_user','manage_class','manage_subjects','manage_parents','main_admin'));
        }

    }
    public function submitOnlineApplicationForm($id){
        $school_id =  $this->school_info();
        $title = "Online Application ";
        $manage_class = SchoolClass::where('school_classes.school_id',$school_id)
                                ->get();

        $manage_application = AdmissionForm::leftJoin('school_classes','school_classes.class_id','admission_forms.student_class_id')
                                        ->where('admission_forms.school_id',$school_id)
                                        ->where('admission_forms.admission_id',$id)
                                        ->get();                        
        return view ('SMS.submitOnlineApplicationForm',compact('title','school_id','manage_class','manage_application'));

    }
    public function read_notification($id){

        $title = "Notification";

        $get_notification = DB::table('notifications')
            ->leftjoin('assignments','assignments.assignment_id','notifications.student_id')
            ->leftjoin('school_classes','school_classes.class_id','assignments.assignment_class_id')
            ->leftjoin('subjects','subjects.subject_id','assignments.assignment_subject_id')
            ->leftjoin('sections','sections.saction_id','assignments.assignment_section_id')
            ->leftjoin('teachers','teachers.user_id','assignments.user_id')
            ->select('teachers.teacher_name',
                'sections.section_name',
                'subjects.subject_subject_name',
                'school_classes.class_name',
                'assignments.*',
                'notifications.*'
            )
            ->where('notifications.id',$id)
            ->first();
        $notification = DB::table('notifications')->where('notifications.id',$id);

        $notification->update(['status'      =>'1']);
                
        return view('SMS.my_notification',compact('title','get_notification'));
    }
    
    public function insert_absence_data(){
        $title = "Absence Records";
        $school_id =  $this->school_info();

        $manage_absence = DB::table('students')
            ->leftjoin('school_classes','school_classes.class_id','students.student_class_id')
            ->leftjoin('sections','sections.saction_id','students.student_section_id')
            ->leftjoin('attendances','attendances.student_id','students.student_id')
            ->whereNotIn ('students.student_id',DB::table('attendances')->select('attendances.student_id')->where('date',date('Y-m-d')))
            ->select('attendances.date',
                    'attendances.created_at',
                    'students.student_photo',
                    'students.student_name',
                    'students.student_roll_no',
                    'school_classes.class_name',
                    'school_classes.class_id',
                    'sections.section_name',
                    'sections.saction_id',
                    'students.student_id'
                )
            ->get();

            foreach ($manage_absence as $absence) {

                $end_time = "";
                $start_time = "";
                $manage_routine = ClassRoutine::where('school_id',$school_id)
                                        ->where('class_id',$absence->class_id)
                                        ->where('section_id',$absence->saction_id)
                                        ->where('day',date('D'))
                                        ->first();
                // foreach ($manage_routine as $manage_routine) {
                // }
                    $start_time =  $manage_routine->start_time;
                    $end_time =  $manage_routine->end_time;

                if ($end_time == date('H:i')) {
                    $user_id = Student::leftjoin('users','users.id','students.user_id')
                            ->where('student_id',$absence->student_id )
                            ->first();

                    $parents_user_id = StudentParent::
                        leftjoin('users','users.id','student_parents.user_id')
                        ->where('parents_id',$user_id->student_guardian_id )
                        ->first();
                    $user = Auth::user();
                    $user->notify(new Attendance_notify(User::findOrFail(Auth::user()->id))); 
                    $update = DB::table('notifications') 
                        ->where('notifiable_id', Auth::user()->id)
                        ->update( [ 'notifiable_id' => $parents_user_id->user_id,
                                    'school_id'     => $school_id,            
                                    'status'        => 0,            
                                    'student_id'    => $absence->student_id,            
                                                
                    ]);

                    //android notification data
                    $get_time = DB::table('notifications')->where('school_id',$school_id)->where('student_id',$user_id->student_id)->orderBy('updated_at','DESC')->first();             
                     $check_device =  AppsDevice::where('user_id',$parents_user_id->user_id)->first();   
 
                    $title = $user_id->student_name. " Absent Today !!";
                    $body = 'Date '.date('d-M-Y', strtotime($get_time->updated_at));
                    
                    if ($check_device) {

                        $this->fcmNotificationSend($title,$body,$check_device->device_id); 

                    }
                }
            }
            
        // return view ('SMS.absence',compact('title','manage_absence'));
    }


  // ajax functions

    public function find_students($id){
        $school_id =  $this->school_info();
        $students_list = Student::leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('students.school_id',$school_id)
                            ->where('students.student_class_id',$id)
                            ->get();

        return response()->json($students_list);
    }
    public function find_parents($id){
        $school_id =  $this->school_info();
        $parents = StudentParent::leftJoin('students','students.student_guardian_id','student_parents.parents_id')
                            ->where('student_parents.school_id',$school_id)
                            ->where('students.student_class_id',$id)
                            ->get();

        return response()->json($parents);
    }
    public function find_section($id)
    {
        $school_id =  $this->school_info();
        $section_list = Section::where('school_id',$school_id)
                            ->where('class_id',$id)
                            ->get();

        return response()->json($section_list);
    }
    public function find_teacher($id)
    {
        $school_id =  $this->school_info();
        $teacher_list = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                                ->where('subjects.school_id',$school_id)
                                ->where('subject_class_id',$id)
                                ->get();
        return response()->json($teacher_list);
    }
    public function find_section_teacher($id)
    {
        $school_id =  $this->school_info();
        $teacher_list = SchoolClass::leftJoin('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                                ->where('school_classes.school_id',$school_id)
                                ->where('school_classes.class_id',$id)
                                ->get();
        return response()->json($teacher_list);
    }
    public function find_assignment($id)
    {
        $school_id =  $this->school_info();
        $assignment_list = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                                ->where('sections.school_id',$school_id)
                                ->where('sections.class_id',$id)
                                ->get();
        return response()->json($assignment_list);
    }
    public function find_assignment_subject($id)
    {
        $school_id =  $this->school_info();
        $assignment_list = SchoolClass::leftJoin('subjects','subjects.subject_class_id','school_classes.class_id')
                                ->where('school_classes.school_id',$school_id)
                                ->where('school_classes.class_id',$id)
                                ->get();
        return response()->json($assignment_list);
    }
    public function find_routine_section($id)
    {
        $school_id =  $this->school_info();
        $routine_list = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                                ->where('sections.school_id',$school_id)
                                ->where('sections.class_id',$id)
                                ->get();
        return response()->json($routine_list);
    }
    public function find_routine_subject($id)
    {
        $school_id =  $this->school_info();
        $routine_list = SchoolClass::leftJoin('subjects','subjects.subject_class_id','school_classes.class_id')
                                ->where('school_classes.school_id',$school_id)
                                ->where('school_classes.class_id',$id)
                                ->get();
        return response()->json($routine_list);
    }
    public function find_routine_teacher($id)
    {
        $school_id =  $this->school_info();
        $routine_list = Subject::leftJoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')
                                ->where('subjects.school_id',$school_id)
                                ->where('subjects.subject_id',$id)
                                ->get();
        return response()->json($routine_list);
    }
    public function find_exam_schedule($id)
    {
        $school_id =  $this->school_info();
        $schedule_list = ExamSchedule::leftJoin('school_classes','school_classes.class_id','exam_schedules.class_id')
                                ->select('school_classes.class_id','school_classes.class_name')
                                ->where('exam_schedules.school_id',$school_id)
                                ->where('exam_schedules.exam_id',$id)
                                ->distinct('exam_schedules.exam_id')
                                ->get();
        return response()->json($schedule_list);
    }
    public function find_exam_subject($id)
    {
        $school_id =  $this->school_info();
        $exam_subject = ExamSchedule::leftJoin('subjects','subjects.subject_id','exam_schedules.subject_id')
                                ->select('subjects.subject_subject_name','exam_schedules.subject_id')
                                ->where('exam_schedules.school_id',$school_id)
                                ->where('exam_schedules.class_id',$id)
                                ->distinct('exam_schedules.subject_id')
                                ->get();
        return response()->json($exam_subject);
    }
    public function find_transport_student($id)
    {
        $school_id =  $this->school_info();
        $transport_student = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->where('students.school_id',$school_id)
                                ->where('students.student_class_id',$id)
                                ->get();
        return response()->json($transport_student);
    }
    public function find_transport_section($id)
    {
        $school_id =  $this->school_info();
        $transport_section = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                                ->where('sections.school_id',$school_id)
                                ->where('sections.class_id',$id)
                                ->get();

        return response()->json($transport_section);
    }
    public function find_section_student($id,$id2)
    {
        $school_id =  $this->school_info();
        $student_section = Student::leftJoin('school_classes','school_classes.class_id','students.student_class_id')
                                ->where('students.school_id',$school_id)
                                ->where('students.student_section_id',$id2)
                                ->where('students.student_class_id',$id)
                                ->get();

        return response()->json($student_section);
    }
    public function find_fee_type_invoice($id)
    {
        $school_id =  $this->school_info();
        $fee_type = FeeType::where('school_id',$school_id)
                        ->where('fee_type_id',$id)
                        ->get();

        return response()->json($fee_type);
    }

    public function find_fee_type($id)
    {
        $school_id =  $this->school_info();
        $fee_type = FeeType::where('school_id',$school_id)
                    ->where('class_id',$id)
                    ->get();

        return response()->json($fee_type);
    }
    public function find_student_class($id)
    {
        $school_id =  $this->school_info();
        $students = Student::leftJoin('sections','sections.saction_id','students.student_section_id')
                            ->where('students.school_id',$school_id)
                            ->where('students.student_class_id',$id)
                            ->get();

         return response()->json($students);
    }
    public function find_academic_student($id,$id2,$id3)
    {
        $school_id =  $this->school_info();

        $academic = Student::where('school_id',$school_id)
                        ->get();

    foreach ($academic as $key) {

     
        if($id3 == $key->created_at->format('Y')){

        $academic_year = Student::where('school_id',$school_id)
                                    ->where('student_class_id',$id)
                                    ->where('student_section_id',$id2)
                                    ->whereYear('created_at', $id3)
                                    ->get();                           
        }else{
            $academic_year = OldStudent::where('school_id',$school_id)
                                    ->where('student_class_id',$id)
                                    ->where('student_section_id',$id2)
                                    ->whereYear('created_at', $id3)
                                    ->get();
        }

    }
        return response()->json($academic_year);

    }
    
    public function insert_data_per_time(){
        $school_id =  $this->school_info();

        $check = DB::table('notifications')->get();
        $today = date('Y-m-d');
        $students = Attendance::leftjoin('students','students.student_id','attendances.student_id')
            ->leftjoin('users','users.id','students.user_id')
            ->where('attendances.school_id',$school_id)
            ->where('attendances.attndence','p')
            ->whereDate('attendances.date',$today)
            ->get();

        foreach ($students as $key) {
            $manage_routine = ClassRoutine::leftjoin('subjects','subjects.subject_id','class_routines.subject_id')
                                ->where('class_routines.school_id',$school_id)
                                ->where('class_routines.class_id',$key->student_class_id)
                                ->where('class_routines.day',date('D'))
                                ->where('class_routines.start_time','<=',date('H:i'))
                                ->where('class_routines.end_time','>=',date('H:i'))
                                ->first();
            if ($key->machinestype == 'SCHOOLROOM') {            
                if ($manage_routine->start_time == date('H:i')) {

                        $student_user_id = Student::leftjoin('users','users.id','students.user_id')
                                ->where('student_id',$key->student_id )
                                ->first(); 
                        $parents_user_id = StudentParent::
                            leftjoin('users','users.id','student_parents.user_id')
                            ->where('parents_id',$student_user_id->student_guardian_id )
                            ->first();

                        $noti_user = Auth::user();
                        $noti_user->notify(new Attendance_notify(User::findOrFail(Auth::user()->id)));
                            $update = DB::table('notifications') 
                                ->where('notifiable_id', Auth::user()->id)
                                ->update( [ 'notifiable_id' => $parents_user_id->user_id,
                                            'school_id'     => $school_id,            
                                            'student_id'    => $key->student_id,            
                                            'machinestype'  => 'SCHOOLROOM',            
                                            'status'        => '1',            
                            ]);

                            //android notification data
                        $get_time = DB::table('notifications')->where('school_id',$school_id)->where('student_id',$student_user_id->student_id)->orderBy('updated_at','DESC')->first();             
                         $check_device =  AppsDevice::where('user_id',$parents_user_id->user_id)->first();   
     
                        $title = $key->student_name. " just entered into ".$manage_routine->subject_subject_name. " class";
                        $body = 'Entered at '.date('d-M-Y h:i A', strtotime($get_time->updated_at));
                        if ($check_device) {
                            $this->fcmNotificationSend($title,$body,$check_device->device_id);
                        }

                }elseif($manage_routine->end_time == date('H:i')){
                        $student_user_id = Student::leftjoin('users','users.id','students.user_id')
                                ->where('student_id',$key->student_id )
                                ->first(); 
                        $parents_user_id = StudentParent::
                            leftjoin('users','users.id','student_parents.user_id')
                            ->where('parents_id',$student_user_id->student_guardian_id )
                            ->first();

                        $noti_user = Auth::user();
                        $noti_user->notify(new Attendance_notify(User::findOrFail(Auth::user()->id)));
                            $update = DB::table('notifications') 
                                ->where('notifiable_id', Auth::user()->id)
                                ->update( [ 'notifiable_id' => $parents_user_id->user_id,
                                            'school_id'     => $school_id,            
                                            'student_id'    => $key->student_id,            
                                            'machinestype'  => 'SCHOOLROOM',            
                                            'status'        => '1',            
                            ]);

                            //android notification data
                        $get_time = DB::table('notifications')->where('school_id',$school_id)->where('student_id',$student_user_id->student_id)->orderBy('updated_at','DESC')->first();             
                         $check_device =  AppsDevice::where('user_id',$parents_user_id->user_id)->first();   
     
                        $title = $key->student_name. " just left from ".$manage_routine->subject_subject_name. " class";
                        $body = 'left at '.date('d-M-Y h:i A', strtotime($get_time->updated_at));
                        if ($check_device) {
                            $this->fcmNotificationSend($title,$body,$check_device->device_id);
                        }

                }else{
                    echo "timeout!!";
                }
            }else{
                    echo "no data";
            }

        }
        // return response()->json($noti_user);
        
    }

    public function count_messages(){
        $school_id =  $this->school_info();
        $user = Auth::user()->id;
        $user_role = Auth::user()->role;
        if($user_role == 'PARENTS'){

            $get_parent = StudentParent::where('user_id',$user)->first();
            $count_message = Message::where('school_id',$school_id)
                    ->where('notifiable_id',$get_parent->parents_id)
                    ->where('read_at',null)
                    ->count();
        }elseif($user_role == 'STUDENT'){
            $get_student = Student::where('user_id',$user)->first();
            $count_message = Message::where('school_id',$school_id)
                    ->where('notifiable_id',$get_student->student_id)
                    ->where('read_at',null)
                    ->count();
        }else{
            $get_teacher = Teacher::where('user_id',$user)->first();
            $count_message = Message::where('school_id',$school_id)
                    ->where('notifiable_id',$get_teacher->teacher_id)
                    ->where('read_at',null)
                    ->count();
        }

        return response()->json($count_message);
    }
    public function get_messages(){
        $user = Auth::user()->id;

        $school_id =  $this->school_info();
        $user_role = Auth::user()->role;
        if($user_role == 'PARENTS'){

            $get_parent = StudentParent::where('user_id',$user)->first();
            $get_messages = Message::leftjoin('inboxes','inboxes.id','messages.inbox_id')
                    ->where('messages.school_id',$school_id)
                    ->where('messages.notifiable_id',$get_parent->parents_id)
                    ->limit(5)
                    ->orderBy('messages.message_id','DESC')
                    ->get();
        }elseif($user_role == 'STUDENT'){
            $get_student = Student::where('user_id',$user)->first();
            $get_messages = Message::leftjoin('inboxes','inboxes.id','messages.inbox_id')
                    ->where('messages.school_id',$school_id)
                    ->where('messages.notifiable_id',$get_student->student_id)
                    ->limit(5)
                    ->orderBy('messages.message_id','DESC')
                    ->get();
        }else{
            $get_teacher = Teacher::where('user_id',$user)->first();
            $get_messages = Message::leftjoin('inboxes','inboxes.id','messages.inbox_id')
                    ->where('messages.school_id',$school_id)
                    ->where('messages.notifiable_id',$get_teacher->teacher_id)
                    ->limit(5)
                    ->orderBy('messages.message_id','DESC')
                    ->get();
        }
        return response()->json($get_messages);
    }

    /******************** quiz ***************************/

    public function quiz(){
        $title = "Quiz";
        $school_id =  $this->school_info();
        $get_class  = SchoolClass::where('school_id',$school_id)->where('deleted_at',null)->get();

        $get_quiz_info = QuizInfo::leftjoin('school_classes','school_classes.class_id','quiz_infos.class_id')
            ->leftjoin('sections','sections.saction_id','quiz_infos.section_id')
            ->leftjoin('teachers','teachers.user_id','quiz_infos.host_id')
            ->get();

        return view('SMS.quiz',compact('title','get_class','get_quiz_info'));
    }
    public function quiz_details($id){
        $title = "Quiz";
        $school_id =  $this->school_info();
        $get_class  = SchoolClass::where('school_id',$school_id)->where('deleted_at',null)->get();

        $get_quiz_info = QuizInfo::leftjoin('school_classes','school_classes.class_id','quiz_infos.class_id')
            ->leftjoin('sections','sections.saction_id','quiz_infos.section_id')
            ->leftjoin('teachers','teachers.user_id','quiz_infos.host_id')
            ->where('quiz_infos.id',$id)
            ->first();

        $get_question   = QuizQuestion::where('quiz_info_id',$get_quiz_info->id)->get();

        $check_question = QuizAnswer::where('student_id',Auth::user()->id)->where('quiz_info_id',$id)->first();


        $marks = QuizQuestion::leftjoin('quiz_answers','quiz_answers.question_id','quiz_questions.id')
            ->whereRaw('quiz_questions.answer = quiz_answers.answer')
            ->where('quiz_answers.student_id', Auth::user()->id)
            ->sum('marker');

        return view('SMS.quiz_details',compact('title','get_class','get_quiz_info','get_question','check_question','marks'));
    }
    public function get_result($id){
        $get_answer = QuizAnswer::where('student_id',Auth::user()->id)->where('question_id',$id)->first();

        return $get_answer;
    }
    public function get_errors($id){
        $get_question = QuizQuestion::where('id',$id)->first();

        return $get_question;
    }
}
