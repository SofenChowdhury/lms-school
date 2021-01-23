<?php
namespace App\Http\Controllers\web_admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

use App\Slider; use App\History; use App\ChairmanMessage;use App\PrincipalMessage;use App\PresidencyMessage;use App\MissionVision;use App\GoverningBody;use App\Infrastructure;use App\DressCode;use App\AcademicCalender;use App\News; use App\Notice;use App\Events; use App\PoliciesGuideline; use App\Facility; use App\Library; use App\It; use App\Gallery; use App\Setting; use App\AdmissionInfo; use App\AdmissionPaymentInfo; use App\AdmissionPolicyInfo; use App\AdmissionProspectusInfo; use App\AdmissionScholarShip;use App\SchoolInfo;use App\ImportantLink;;use App\Machine;

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
        $school_id = 1;
        return $school_id;
    }
    public function slider(){
        $school_id =  $this->school_info();
        $title = "Slider";
        $sliders = Slider::where('school_id',$school_id)->get();
        return view ('web_admin.slider',compact('title','sliders'));
    }
    // links 
    public function add_links(){
        $school_id =  $this->school_info();
        $title = "Add Important Links";
        $important_links = ImportantLink::where('school_id',$school_id)->get();
        return view ('web_admin.add_links',compact('title','important_links'));
    }
    public function manage_links(){
        $school_id =  $this->school_info();
        $title = "Important Links";
        $manage_links = ImportantLink::where('school_id',$school_id)->get();
        return view ('web_admin.manage_links',compact('title','manage_links'));
    }
    public function edit_links($id){
        $school_id =  $this->school_info();
        $title = "Edit Important Links ";
        $edit_links = ImportantLink::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.edit_links',compact('title','edit_links'));
    }
    // links end 
    public function update_slider($id){
        $school_id =  $this->school_info();
        $title = "Slider ";
        $sliders = Slider::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-slider',compact('title','sliders'));
    }

    public function slider_description($id){
        $school_id =  $this->school_info();
        $title = "Slider ";
        $sliders = Slider::where('id',$id)->where('school_id',$school_id)->first();
        return view ('web_admin.slider-description',compact('title','sliders'));
    }
    public function add_slider(){
        $school_id =  $this->school_info();
        $title = "Slider";
        return view ('web_admin.add-slider',compact('title'));
    }
    public function history(){
        $school_id =  $this->school_info();
        $title = "History";
        $history = History::where('school_id',$school_id)->get();
        return view ('web_admin.history',compact('title','history'));
    }
    public function update_history($id){
        $school_id =  $this->school_info();
        $title = "History";
        $history = History::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-history',compact('title','history'));
    }
    public function chairman_message(){
        $school_id =  $this->school_info();
        $title = "Chairman Message";
        $chairman_message  = ChairmanMessage::where('school_id',$school_id)->get();
        return view ('web_admin.chairman-message',compact('title','chairman_message'));
    }
    public function update_chairman_message($id){
        $school_id =  $this->school_info();
        $title = "Chairman Message";
        $chairman_message  = ChairmanMessage::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-chairman-message',compact('title','chairman_message'));
    }
    public function principal_message(){
        $school_id =  $this->school_info();
        $title = "Principal Message";        
        $principal_message  = PrincipalMessage::where('school_id',$school_id)->get();
        return view ('web_admin.principal-message',compact('title','principal_message'));
    }
    public function update_principal_message($id){
        $school_id =  $this->school_info();
        $title = "Principal Message";        
        $principal_message  = PrincipalMessage::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-principal-message',compact('title','principal_message'));
    }
    public function presidency_message(){
        $school_id =  $this->school_info();
        $title = "Presidency Message";
        $presidency_message = PresidencyMessage::where('school_id',$school_id)->get();
        return view ('web_admin.presidency-message',compact('title','presidency_message'));
    }
    public function update_presidency_message($id){
        $school_id =  $this->school_info();
        $title = "Presidency Message";
        $presidency_message = PresidencyMessage::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-presidency-message',compact('title','presidency_message'));
    }
    public function mission_vision(){
        $school_id =  $this->school_info();
        $title = "Mission & Vision";
        $mission_vision = MissionVision::where('school_id',$school_id)->get();
        return view ('web_admin.mission-vision',compact('title','mission_vision'));
    }
    public function update_mission_vision($id){
        $school_id =  $this->school_info();
        $title = "Mission & Vision";
        $mission_vision = MissionVision::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-mission-vision',compact('title','mission_vision'));
    }
    public function governing_body(){
        $school_id =  $this->school_info();
        $title = "Governing Body";
        $governing_body = GoverningBody::where('school_id',$school_id)->get();
        return view ('web_admin.governing-body',compact('title','governing_body'));
    }
    public function update_governing_body($id){
        $school_id =  $this->school_info();
        $title = "Governing Body";
        $governing_body = GoverningBody::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-governing-body',compact('title','governing_body'));
    }
    public function add_governing_body(){
        $school_id =  $this->school_info();
        $title = "Governing Body";
        return view ('web_admin.add-governing-body',compact('title'));
    }
    public function infrstructure(){
        $school_id =  $this->school_info();
        $title = "Infrastructure";
        $infrastructure = Infrastructure::where('school_id',$school_id)->get();
        return view ('web_admin.infrstructure',compact('title','infrastructure'));
    }
    public function update_infrstructure($id){
        $school_id =  $this->school_info();
        $title = "Infrstructure";
        $infrastructure = Infrastructure::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-infrstructure',compact('title','infrastructure'));
    }
    public function dress_code(){
        $school_id =  $this->school_info();
        $title = "Dress Code";
        $dress_code = DressCode::where('school_id',$school_id)->get();
        return view ('web_admin.dress-code',compact('title','dress_code'));
    }
    public function update_dress_code($id){
        $school_id =  $this->school_info();
        $title = "Dress Code";
        $dress_code = DressCode::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-dress-code',compact('title','dress_code'));
    }
    public function academic_calender(){
        $school_id =  $this->school_info();
        $title = "Academic Calender";
        $academic_calender = AcademicCalender::where('school_id',$school_id)->get();
        return view ('web_admin.academic-calender',compact('title','academic_calender'));
    }
    public function update_academic_calender($id){
        $school_id =  $this->school_info();
        $title = "Academic Calender";
        $academic_calender = AcademicCalender::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-academic-calender',compact('title','academic_calender'));
    }
    public function book_list(){
        $school_id =  $this->school_info();
        $title = "Book List";
        return view ('web_admin.book-list',compact('title'));
    }
    public function class_routine(){
        $school_id =  $this->school_info();
        $title = "Class Routine";
        return view ('web_admin.class-routine',compact('title'));
    }
    public function exam_routine(){
        $school_id =  $this->school_info();
        $title = "Exam Routine";
        return view ('web_admin.exam-routine',compact('title'));
    }
    public function teacher_staff(){
        $school_id =  $this->school_info();
        $title = "Teacher & Staff ";
        return view ('web_admin.teacher-staff',compact('title'));
    }
    public function news(){
        $school_id =  $this->school_info();
        $title = "News ";
        $news =  News::where('school_id',$school_id)->get();
        return view ('web_admin.news',compact('title','news'));
    }
    public function news_description($id){
        $school_id =  $this->school_info();
        $title = "News ";
        $news =  News::where('id',$id)->where('school_id',$school_id)->first();
        return view ('web_admin.news-description',compact('title','news'));
    }
    public function update_news($id){
        $school_id =  $this->school_info();
        $title = "News ";
        $news =  News::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-news',compact('title','news'));
    }
    public function add_news(){
        $school_id =  $this->school_info();
        $title = "News ";
        return view ('web_admin.add-news',compact('title'));
    }
    public function notice(){
        $school_id =  $this->school_info();
        $title = "Notice ";
        $notice = Notice::where('school_id',$school_id)->get();
        return view ('web_admin.notice',compact('title','notice'));
    }
    public function notice_description($id){
        $school_id =  $this->school_info();
        $title = "Notice ";
        $notice = Notice::where('id',$id)->where('school_id',$school_id)->first();
        return view ('web_admin.notice-description',compact('title','notice'));
    }
    public function update_notice($id){
        $school_id =  $this->school_info();
        $title = "Notice ";
        $notice = Notice::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-notice',compact('title','notice'));
    }
    public function add_notice(){
        $school_id =  $this->school_info();
        $title = "Notice ";
        return view ('web_admin.add-notice',compact('title'));
    }
    public function event(){
        $school_id =  $this->school_info();
        $title = "Event ";
        $event = Events::where('school_id',$school_id)->get();
        return view ('web_admin.event',compact('title','event'));
    }
    public function event_description($id){
        $school_id =  $this->school_info();
        $title = "Event ";
        $event = Events::where('id',$id)->where('school_id',$school_id)->first();
        return view ('web_admin.event-description',compact('title','event'));
    }  
    public function update_event($id){
        $school_id =  $this->school_info();
        $title = "Event ";
        $event = Events::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-event',compact('title','event'));
    }    
    public function add_event(){
        $school_id =  $this->school_info();
        $title = "Event ";
        return view ('web_admin.add-event',compact('title'));
    }
    public function policies(){
        $school_id =  $this->school_info();
        $title = "Policies";
        $policies = PoliciesGuideline::where('school_id',$school_id)->get();
        return view ('web_admin.policies',compact('title','policies'));
    }
    public function update_polices($id){
        $school_id =  $this->school_info();
        $title = "Policies";
        $policies = PoliciesGuideline::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-polices',compact('title','policies'));
    }
    public function facilities(){
        $school_id =  $this->school_info();
        $title = "Facilities";
        $facility = Facility::where('school_id',$school_id)->get();
        return view ('web_admin.facilities',compact('title','facility'));
    }
    public function update_facility($id){
        $school_id =  $this->school_info();
        $title = "Facilities";
        $facility = Facility::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-facilities',compact('title','facility'));
    }
    public function library(){
        $school_id =  $this->school_info();
        $title = "Library";
        $library =Library::where('school_id',$school_id)->get();
        return view ('web_admin.library',compact('title','library'));
    }
    public function update_library($id){
        $school_id =  $this->school_info();
        $title = "Library";
        $library =Library::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-library',compact('title','library'));
    }
    public function it(){
        $school_id =  $this->school_info();
        $title = "IT";
        $it = It::where('school_id',$school_id)->get();
        return view ('web_admin.it',compact('title','it'));
    }
    public function update_it($id){
        $school_id =  $this->school_info();
        $title = "IT";
        $it = It::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-it',compact('title','it'));
    }
    public function admission_info(){
        $school_id =  $this->school_info();
        $title = "Admission Info";
        $admission_info = AdmissionInfo::where('school_id',$school_id)->get();
        return view ('web_admin.admission-info',compact('title','admission_info'));
    }
    public function update_admission_info($id){
        $school_id =  $this->school_info();
        $title = "Admission Info";
        $admission_info = AdmissionInfo::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.upadte-admission-info',compact('title','admission_info'));
    }
    public function admission_form(){
        $school_id =  $this->school_info();
        $title = "Admission Form";
        return view ('web_admin.admission-form',compact('title'));
    }
    public function admission_result (){
        $school_id =  $this->school_info();
        $title = "Admission Result";
        return view ('web_admin.admission-result',compact('title'));
    }
    public function fees_payment (){
        $school_id =  $this->school_info();
        $title = "Fees & Payment";
        $payment_info = AdmissionPaymentInfo::where('school_id',$school_id)->get();
        return view ('web_admin.fees-payment',compact('title','payment_info'));
    }
    public function update_admission_payment_info($id){
        $school_id =  $this->school_info();
        $title = "Fees & Payment";
        $payment_info = AdmissionPaymentInfo::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-admission-payment-info',compact('title','payment_info'));
    }
    public function admission_policy (){
        $school_id =  $this->school_info();
        $title = "Admission Policy";
        $admission_policy_info =AdmissionPolicyInfo::where('school_id',$school_id)->get();
        return view ('web_admin.admission-policy',compact('title','admission_policy_info'));
    }
    public function update_admission_policy ($id){
        $school_id =  $this->school_info();
        $title = "Admission Policy";
        $admission_policy_info =AdmissionPolicyInfo::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-admission-policy',compact('title','admission_policy_info'));
    }
    public function prospectus (){
        $school_id =  $this->school_info();
        $title = "Prospectus";
        $admission_prospectus = AdmissionProspectusInfo::where('school_id',$school_id)->get();
        return view ('web_admin.prospectus',compact('title','admission_prospectus'));
    }
    public function update_admission_prospectus_info ($id){
        $school_id =  $this->school_info();
        $title = "Prospectus";
        $admission_prospectus = AdmissionProspectusInfo::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-admission-prospectus-info',compact('title','admission_prospectus'));
    }
    public function scholarships (){
        $school_id =  $this->school_info();
        $title = "Scholarship";
        $admission_scolarship = AdmissionScholarShip::where('school_id',$school_id)->get();
        return view ('web_admin.scholarships',compact('title','admission_scolarship'));
    }
    public function update_admission_scholarship_info($id){
        $school_id =  $this->school_info();
        $title = "Scholarships";
        $admission_scolarship = AdmissionScholarShip::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-admission-scholarship-info',compact('title','admission_scolarship'));
    }
    public function recruitment_exam (){
        $school_id =  $this->school_info();
        $title = "Recruitment Exam";
        return view ('web_admin.recruitment-exam',compact('title'));
    }
    public function add_recruitment_exam (){
        $school_id =  $this->school_info();
        $title = "Recruitment Exam";
        return view ('web_admin.add-recruitment-exam',compact('title'));
    }
    public function add_gallery (){
        $school_id =  $this->school_info();
        $title = "Gallery";
        return view ('web_admin.add-gallery',compact('title'));
    }
    public function manage_gallery (){
        $school_id =  $this->school_info();
        $title = "Gallery";
        $gallery = Gallery::where('school_id',$school_id)->get();
        return view ('web_admin.manage-gallery',compact('title','gallery'));
    }
    public function contactus (){
        $school_id =  $this->school_info();
        $title = "Contactus";
        return view ('web_admin.contactus',compact('title'));
    }
    public function general_setting (){
        $school_id =  $this->school_info();
        $title = "Setting";
        $setting = Setting::where('school_id',$school_id)->get();
        return view ('web_admin.general-setting',compact('title','setting'));
    }
    public function update_general_setting($id){
        $school_id =  $this->school_info();
        $title = "Setting";
        $setting = Setting::where('id',$id)->where('school_id',$school_id)->get();
        return view ('web_admin.update-general-setting',compact('title','setting'));
    }
    public function machines(){
        $school_id =  $this->school_info();
        $title = 'Machines';
        $manage_machines = Machine::where('school_id', $school_id)->get();
        
        return view ('web_admin.machine',compact('manage_machines','title'));
    }
    public function add_machine(){
        $school_id =  $this->school_info();
        $title = 'Machines';
        
        return view ('web_admin.add_machine',compact('title'));
    }
}
