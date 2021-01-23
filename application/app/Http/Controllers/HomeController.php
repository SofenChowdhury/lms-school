<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

use App\Student;use App\Subject; use App\SchoolClass; use App\Assignment;  use App\SchoolInfo; use App\Teacher; use App\Book;use App\attendance;use App\TeacherAttendence;
use App\StudentParent;use App\userInfo;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function school_info(){
        
        // $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        // $parsedUrl = parse_url($url);
        // $host = explode('.', $parsedUrl['host']);
        // $domain_name = $host[0];
        // $manage_school_info = SchoolInfo::where('domain_name',$domain_name)->get();
        // foreach ($manage_school_info as $key) {
        //     $school_id = $key->school_id;
        // }
         $school_id = 1;
        Session::put('school_id',$school_id);
        return $school_id;
    }
        
    public function index()
    {
         $school_id =  $this->school_info();

        $title ="Dashboard";
        $student_id = "";
        $student_class_id = "";
        $student_section_id = "";

        $total_student  = Student::where('school_id',$school_id)->count();
        $total_teacher  = Teacher::where('school_id',$school_id)->count();
        $total_class    = SchoolClass::where('school_id',$school_id)->count();
        $total_books    = Book::where('school_id',$school_id)->count();


        if (Auth::user()->role == "STUDENT") {
            $login_student = Student::where('user_id',Auth::user()->id)->where('school_id',$school_id)->get();
            foreach ($login_student as $key) {
                $student_id = $key->student_id;
                $student_class_id = $key->student_class_id;
                $student_section_id = $key->student_section_id;
            }
            $student_info = Student::join('school_classes','school_classes.class_id','students.student_class_id')
                    ->join('sections','sections.saction_id','students.student_section_id')
                    ->where('students.user_id', Auth::user()->id)
                    ->where('students.school_id',$school_id)
                    ->get();               
            $students_subject = Subject::leftjoin('teachers','teachers.teacher_id','subjects.subject_teacher_id')->select('teachers.teacher_name','subjects.*')->where('subjects.subject_class_id',$student_class_id)->where('subjects.school_id',$school_id)->get();
            
            $students_assignment = Assignment::join('subjects','subjects.subject_id','assignments.assignment_subject_id')
                    ->where('assignments.assignment_class_id',$student_class_id)
                    ->where('assignments.assignment_section_id',$student_section_id)
                    ->where('assignments.school_id',$school_id)
                    ->get();
            $all_teacher = Teacher::where('school_id',$school_id)->get();
            
        return view('home',compact('title','student_info','students_subject','students_assignment','total_student','total_teacher','total_class','total_books','all_teacher'));
        }elseif (Auth::user()->role == "PARENTS"){
         

            $parents_info = StudentParent::where('school_id',$school_id)
                                    ->where('student_parents.user_id', Auth::user()->id)
                                    ->get();
            foreach ($parents_info as $key) {
                                      $student_parent_id = $key->parents_id;  
                                    }                        
                                  
            $students = Student::join('school_classes','school_classes.class_id','students.student_class_id')
                            ->join('sections','sections.saction_id','students.student_section_id')
                            ->where('students.school_id',$school_id)
                            ->where('students.student_guardian_id',$student_parent_id)
                            ->get();

        return view('home',compact('title','parents_info','students','total_student','total_teacher','total_class','total_books'));

        }elseif (Auth::user()->role == "Admin" || Auth::user()->role == "SUPPERADMIN") {
         

            $user_info = userInfo::where('school_id',$school_id)
                                    ->where('user_infos.user_id', Auth::user()->id)
                                    ->get();
            // foreach ($parents_info as $key) {
            //                           $student_parent_id = $key->parents_id;  
            //                         }                        
                                  
            // $students = Student::join('school_classes','school_classes.class_id','students.student_class_id')
            //                 ->join('sections','sections.saction_id','students.student_section_id')
            //                 ->where('students.school_id',$school_id)
            //                 ->where('students.student_guardian_id',$student_parent_id)
            //                 ->get();
            $manage_attendance = attendance::leftjoin('students','students.student_id','attendances.student_id')
                        ->where('attendances.school_id',$school_id)
                        ->where('attendances.date',date('Y-m-d'))
                        ->get();

            $manage_teachter_attendance = TeacherAttendence::leftjoin('teachers','teachers.teacher_id','teacher_attendences.teacher_id')
                        ->where('teacher_attendences.school_id',$school_id)
                        ->where('teacher_attendences.attn_date',date('Y-m-d'))
                        ->get();                            

        return view('home',compact('title','user_info','total_student','total_teacher','total_class','total_books','manage_attendance','manage_teachter_attendance'));

        }elseif (Auth::user()->role == "TEACHER") {
         
            $teacher_info = Teacher::where('school_id',$school_id)
                        ->where('teachers.user_id', Auth::user()->id)
                        ->first();
            if($teacher_info->teacher_id){
                $teacher_id = 0;
            }else{
                $teacher_id = $teacher_info->teacher_id;
            }
            $teacher_cls = SchoolClass::join('teachers','teachers.teacher_id','school_classes.class_teacher_id')
                                ->join('sections','sections.class_id','school_classes.class_id')
                                ->join('subjects','subjects.subject_class_id','school_classes.class_id')
                                ->where('school_classes.class_teacher_id',$teacher_id )
                                ->get();

        return view('home',compact('title','teacher_info','total_student','total_teacher','total_class','total_books','teacher_cls'));

        }else{
            $total_student  = Student::where('school_id',$school_id)->count();
            $total_teacher  = Teacher::where('school_id',$school_id)->count();
            $total_class    = SchoolClass::where('school_id',$school_id)->count();
            $total_books    = Book::where('school_id',$school_id)->count();
            return view('home',compact('title','total_student','total_teacher','total_class','total_books'));   
        }
    }
    
    public function playgame(){
        
        $title = "Welcome to our Game board";
        
        return View('SMS.play_game',compact('title'));
    }
}
