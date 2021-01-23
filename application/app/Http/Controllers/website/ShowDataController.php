<?php
namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

use App\Slider; use App\History; use App\ChairmanMessage; use App\PrincipalMessage; use App\PresidencyMessage; use App\MissionVision; use App\GoverningBody;use App\Infrastructure;use App\DressCode;use App\AcademicCalender; use App\News; use App\Notice;use App\Events;use App\PoliciesGuideline; use App\Facility; use App\Library; use App\It; use App\Gallery; use App\Setting; use App\AdmissionInfo; use App\AdmissionPolicyInfo; use App\AdmissionProspectusInfo;use App\SchoolInfo;use App\AdmissionScholarShip;use App\ImportantLink;use App\Teacher;use App\SchoolClass;use App\Subject;use App\ExamSchedule;use App\Exam;use App\Section;use App\ClassRoutine;use App\AdmissionForm;use App\AdmissionPaymentInfo;use App\Machine;
class ShowDataController extends Controller
{
   
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
         return $school_id;
    }
    public function index(){
        $school_id =  $this->school_info();
        $sliders = Slider::where('school_id',$school_id)->get();
        $history = History::where('school_id',$school_id)->get();
        $news = News::where('school_id',$school_id)->orderBy('created_at','DESC')->limit(15)->get();
        $notice = Notice::where('school_id',$school_id)->orderBy('created_at','DESC')->limit(15)->get();
        $facility = Facility::where('school_id',$school_id)->orderBy('created_at','DESC')->limit(10)->get();
        $event = Events::where('school_id',$school_id)->orderBy('created_at','DESC')->limit(15)->get();
        $principal_message = PrincipalMessage::where('school_id',$school_id)->get();
        $manage_links =  ImportantLink::where('school_id', $school_id)->orderBy('created_at','DESC')->limit(10)->get();
        return view ('website.index',compact('sliders','history','principal_message','notice','news','facility','event','manage_links'));
    }
    public function changelanguage(Request $request){
        $ban_language = $request->ban;
        $eng_language = $request->eng;
        if($request->ban){
            $request->session()->put('language',$ban_language);
        }else{
            $request->session()->put('language',$eng_language);
        }
        
        return redirect()->back();

    }
    public function slider_details($id){
        $school_id =  $this->school_info();
        $title = "Description";
        $sliders = Slider::find($id);
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.slider-details',compact('title','sliders','banner'));
    }  
    public function about_history(){
        $school_id =  $this->school_info();
        $title = "About History";
        $banner = Setting::where('school_id',$school_id)->get();
        $history = History::where('school_id',$school_id)->get();
        return view ('website.about-history',compact('title','history','banner'));
    }    
    public function academic_calendar(){
        $school_id =  $this->school_info();
        $title = 'Academic Calender';
        $banner = Setting::where('school_id',$school_id)->get();
        $academic_calender = AcademicCalender::where('school_id',$school_id)->get();
        return view ('website.academic-calendar',compact('academic_calender','banner','title'));
    }  
    public function admission_circular(){
        $school_id =  $this->school_info();
        $title = 'Admission Circular';
        $banner = Setting::where('school_id',$school_id)->get();
        $admission_info = AdmissionInfo::where('school_id',$school_id)->get();
        return view ('website.admission-circular',compact('admission_info','banner','title'));
    } 
    public function admission_form(){
        $school_id =  $this->school_info();
        $title = 'Admission Form';
        $manage_class = SchoolClass::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.admission-form',compact('banner','title','manage_class'));
    }
    public function admission_information_and_conditions(){
        $school_id =  $this->school_info();
        return view ('website.admission-information-and-conditions');
    }
    public function admission_result(){
        $school_id =  $this->school_info();
        $title = 'Admission Results';
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.admission-result',compact('banner','title'));
    }
    public function book_list_and_syllabus(){
        $school_id =  $this->school_info();
        $title = 'Book List And Syllabus';

        $manage_books = SchoolClass::where('school_id',$school_id)
                                ->get();

        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.book-list-and-syllabus',compact('banner','title','manage_books','school_id'));
    }
    public function chairman_message(){
        $school_id =  $this->school_info();
        $title = 'Chairman Message';
        $banner = Setting::where('school_id',$school_id)->get();
        $chairman_message = ChairmanMessage::where('school_id',$school_id)->get();
        return view ('website.chairman-message',compact('chairman_message','banner','title'));
    }
    public function class_routine(){
        $school_id =  $this->school_info();
        $title = 'Class Routine';
        $manage_class = SchoolClass::where('school_id',$school_id)->get();
        $class_id = NULL;
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.class-routine',compact('banner','title','manage_class','class_id'));
    }

    public function showClassRoutins(Request $request){

        $rules = array(         
            'class_id'   => 'required',
                
        );
        $this->validate($request, $rules);

        $school_id =  $this->school_info();
        $title = 'Class Routine';
        $manage_class = SchoolClass::where('school_id',$school_id)->get();
        $class_id   = $request->class_id;
        $section_id = $request->section_id;
        $sat = "sat";
        $sun = "sun";
        $mon = "mon";
        $tus = "tus";
        $wed = "wed";
        $thu = "thu";
        $fri = "fri";

        if ($section_id == NULL) {
            $manage_routine = ClassRoutine::where('school_id',$school_id)
                                ->where('class_id',$class_id)
                                ->get();

        $sat = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sat)
                        ->where('class_routines.class_id',$class_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $sun = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$sun)
                        ->where('class_routines.class_id',$class_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $mon = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$mon)
                        ->where('class_routines.class_id',$class_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $tus = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$tus)
                        ->where('class_routines.class_id',$class_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $wed = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$wed)
                        ->where('class_routines.class_id',$class_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $thu = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$thu)
                        ->where('class_routines.class_id',$class_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $fri = ClassRoutine::leftJoin('subjects','subjects.subject_id','class_routines.subject_id')
                        ->where('class_routines.school_id',$school_id)
                        ->where('class_routines.day',$fri)
                        ->where('class_routines.class_id',$class_id)
                        ->orderBy("start_time", "ASC")
                        ->get();

        $classes = SchoolClass::where('school_classes.school_id',$school_id)
                        ->where('school_classes.class_id',$class_id)
                        ->get();                 

        }else{

        $manage_routine = ClassRoutine::where('school_id',$school_id)
                                ->where('class_id',$class_id)
                                ->where('section_id',$section_id)
                                ->get();

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
        $classes = Section::leftJoin('school_classes','school_classes.class_id','sections.class_id')
                        ->where('sections.school_id',$school_id)
                        ->where('sections.saction_id',$section_id)
                        ->get();                 
        }

                        


        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.class-routine',compact('banner','title','manage_class','class_id','manage_routine','sat','sun','mon','tus','wed','thu','fri','classes'));
    }

    public function contact_us(){
        $school_id =  $this->school_info();
        $title = 'Contact us';
        $banner = Setting::where('school_id',$school_id)->get();
        $contact = Setting::where('school_id',$school_id)->get();
        return view ('website.contact-us',compact('contact','banner','title'));
    }    
    public function dress_code(){
        $school_id =  $this->school_info();
        $title = 'Dress Code';
        $banner = Setting::where('school_id',$school_id)->get();
        $dress_code = DressCode::where('school_id',$school_id)->get();
        return view ('website.dress-code',compact('dress_code','banner','title'));
    }   
    public function event(){
        $school_id =  $this->school_info();
        $title = 'Our Events';
        $banner = Setting::where('school_id',$school_id)->get();
        $events = Events::where('school_id',$school_id)->get();
        return view ('website.event',compact('events','banner','title'));
    }   
    public function event_description($id){
        $school_id =  $this->school_info();
        $title ="Event Description" ;
        $events = Events::find($id);
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.event-description',compact('title','events','banner'));
    }  
    public function exam_routine(){
        $school_id =  $this->school_info();
        $title = 'Exam Routine';
        $class_id = NULL;
        $manage_exam = Exam::where('school_id',$school_id)
                    ->get();            
        $banner = Setting::where('school_id',$school_id)->get();
        
        return view ('website.exam-routine',compact('banner','title','manage_exam','school_id','class_id'));
    }
    public function showExamSchedule(Request $request){

        $rules = array(         
            'class_id'   => 'required',
            'exam_id'    => 'required',
                
        );
        $this->validate($request, $rules);

        $school_id =  $this->school_info();
        $title = 'Exam Routine';
        $class_id       = $request->class_id;
        $exam_id        = $request->exam_id;
        $manage_exam    = Exam::where('school_id',$school_id)
                        ->get();

        $manage_exam_sch = ExamSchedule::leftJoin('school_classes','school_classes.class_id','exam_schedules.class_id')
                                    ->leftJoin('subjects','subjects.subject_id','exam_schedules.subject_id')
                                    ->leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                    ->where('exam_schedules.school_id',$school_id)
                                    ->where('exam_schedules.class_id',$class_id)
                                    ->where('exam_schedules.exam_id',$exam_id)
                                    ->get();

        $exam = Exam::where('school_id',$school_id)
                ->where('exam_id',$exam_id)
                ->get();
        $class = SchoolClass::where('school_id',$school_id)
                        ->where('class_id',$class_id)
                        ->get();
        $exam_sch =  ExamSchedule::leftJoin('school_classes','school_classes.class_id','exam_schedules.class_id')
                                ->leftJoin('exams','exams.exam_id','exam_schedules.exam_id')
                                ->where('exam_schedules.school_id',$school_id)
                                ->where('exam_schedules.class_id',$class_id)
                                ->where('exam_schedules.exam_id',$exam_id)
                                ->limit(1)
                                ->get();              

        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.exam-routine',compact('banner','title','manage_exam','class_id','manage_exam_sch','school_id','exam','class','exam_sch'));
    } 



    public function facilities(){
        $school_id =  $this->school_info();
        $title = 'Facility';
        $facility = Facility::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.facilities',compact('facility','banner','title'));
    } 
    public function fees_and_payments(){
        $school_id =  $this->school_info();
        $title = 'Fees & Payments';
        $fees_payments = AdmissionPaymentInfo::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.fees-and-payments',compact('fees_payments','banner','title'));
    }
    public function gallery(){
        $school_id =  $this->school_info();
        $title = 'Our Gallery';
        $gallery = Gallery::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.gallery',compact('gallery','banner','title'));
    }
    public function governing_Body(){
        $school_id =  $this->school_info();
        $title = 'Governing Body';
        $governing_body = GoverningBody::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.governing-Body',compact('governing_body','banner','title'));
    }
    public function infrastructure(){
        $school_id =  $this->school_info();
        $title = ' Infrastructure ';
        $infrastructure = Infrastructure::where('school_id',$school_id)->get(); 
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.infrastructure',compact('infrastructure','banner','title'));
    }
    public function it(){
        $school_id =  $this->school_info();
        $title = 'Information & Technology';
        $it = It::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.it',compact('it','banner','title'));
    }
    public function library(){
        $school_id =  $this->school_info();
        $title = 'Library';
        $library = Library::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.library',compact('library','banner','title'));
    }
    public function mission_vision(){
        $school_id =  $this->school_info();
        $title = 'Mission & Vision';
        $mission_vission = MissionVision::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.mission-vision',compact('mission_vission','banner','title'));
    }
    public function news(){
        $school_id =  $this->school_info();
        $title = 'Our News';
        $news = News::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.news',compact('news','banner','title'));
    }
    public function news_description($id){
        $school_id =  $this->school_info();
        $title = "News Description";
        $news = News::find($id);
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.news-description',compact('title','news','banner'));
    }
    public function notice(){
        $school_id =  $this->school_info();
        $title = 'Our Notice';
        $notice = Notice::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.notice',compact('notice','banner','title'));
    }
    public function notice_description($id){
        $school_id =  $this->school_info();
        $title = "Notice Description";
        $notice = Notice::find($id);
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.notice-description',compact('title','notice','banner'));
    }
    public function policies_and_guidelines(){
        $school_id =  $this->school_info();
        $title = 'Policies & Guideline';
        $police =PoliciesGuideline::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.policies-and-guidelines',compact('police','banner','title'));
    }
    public function presidency_message(){
        $school_id =  $this->school_info();
        $title = 'Presidency Message';
        $presidency_message = PresidencyMessage::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.presidency-message',compact('presidency_message','banner','title'));
    }
    public function principal_message(){
        $school_id =  $this->school_info();
        $title = 'Principal Message';
        $chairman_message = PrincipalMessage::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.principal-message',compact('chairman_message','banner','title'));
    }
    public function prospectus(){
        $school_id =  $this->school_info();
        $title = 'Our Prospectus';
        $admission_prospectus = AdmissionProspectusInfo::where('school_id',$school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.prospectus',compact('admission_prospectus','banner','title'));
    }
    public function result(){
        $school_id =  $this->school_info();
        $title = 'Class Results';
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.result',compact('banner','title'));
    }
    public function scholarships(){
        $school_id =  $this->school_info();
        $title = 'Scholarship';
        $manage_scholarship = AdmissionScholarShip::where('school_id', $school_id)->get();
        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.scholarships',compact('manage_scholarship','banner','title'));
    }
    
    public function teachers_and_staffs(){
        $school_id =  $this->school_info();
        $title = 'Teachers';

        $manage_teacher = Teacher::where('school_id',$school_id)->get();

        $banner = Setting::where('school_id',$school_id)->get();
        return view ('website.teachers-and-staffs',compact('banner','title','manage_teacher'));
    }    
    public function teacher_details($id){
        $school_id =  $this->school_info();
        $title ='Teachers Details';
        $banner = Setting::where('school_id',$school_id)->get();

        $manage_teacher = Teacher::where('school_id',$school_id)
                                ->where('teacher_id',$id)
                                ->get();
        return view ('website.teacher-details',compact('banner','title','manage_teacher'));
    }

public function saveAdmissionForm(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'student_name'                  => 'required|max:255',
            'student_birthday'              => 'required|max:255',
            'student_group'                 => 'required|max:255',
            'student_gender'                => 'required|max:255',
            'student_class_id'              => 'required|max:255',
            'student_religion'              => 'required|max:255',
            'student_email'                 => 'required|email|unique:users,email',
            'student_address'               => 'required|max:255',
            'student_photo'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'student_country'               => 'required|max:255',
            'student_gurdian'               => 'required|max:255',
            'student_gurdian_photo'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'student_gurdian_profession'    => 'required|max:255',
            'student_gurdian_country'       => 'required|max:255',
            'student_gurdian_email'         => 'required|email|unique:users,email',
            'student_gurdian_address'       => 'required|max:255',
            'student_phone'                 => 'required|max:255',
        );
        $this->validate($request, $rules);

        $student = new AdmissionForm; 
        $student->school_id                     =   $school_id ;    
        $student->student_name                  =   $request->student_name; 
        $student->student_birthday              =   $request->student_birthday; 
        $student->student_group                 =   $request->student_group; 
        $student->student_gender                =   $request->student_gender; 
        $student->student_class_id              =   $request->student_class_id; 
        $student->student_religion              =   $request->student_religion; 
        $student->student_blood_group           =   $request->student_blood_group; 
        $student->student_email                 =   $request->student_email; 
        $student->student_address               =   $request->student_address; 
        $student->student_country               =   $request->student_country; 
        $student->student_gurdian               =   $request->student_gurdian; 
        $student->student_gurdian_profession    =   $request->student_gurdian_profession; 
        $student->student_gurdian_country       =   $request->student_gurdian_country; 
        $student->student_gurdian_email         =   $request->student_gurdian_email; 
        $student->student_gurdian_address       =   $request->student_gurdian_address; 
        $student->student_phone                 =   $request->student_phone; 


        $image_student = $request->file('student_photo');
        $image_gurdian = $request->file('student_gurdian_photo');
        if($image_student){
            $photo = rand().$request->file('student_photo')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('student_photo')->move($destination, $photo);

             $student->student_photo     = $photo;
        }
        if($image_gurdian){
            $photo = rand().$request->file('student_gurdian_photo')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('student_gurdian_photo')->move($destination, $photo);

             $student->student_gurdian_photo     = $photo;
        }      
        $student->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }
    
    // ajax

    public function find_schedule($id)
    {
        $school_id =  $this->school_info();
        $schedule_list = ExamSchedule::leftJoin('school_classes','school_classes.class_id','exam_schedules.class_id')
                                ->select('school_classes.class_id','school_classes.class_name')
                                ->where('exam_schedules.exam_id',$id)
                                ->where('exam_schedules.school_id',$school_id)
                                ->distinct('exam_schedules.exam_id')
                                ->get();
        return response()->json($schedule_list);
    }
    public function find_sections($id)
    {
        $school_id =  $this->school_info();
        $section_list = Section::where('school_id',$school_id)
                            ->where('class_id',$id)
                            ->get();
        return response()->json($section_list);
    }
}
