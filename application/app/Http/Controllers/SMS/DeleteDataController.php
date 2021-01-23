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

use App\Teacher; use App\User; use App\SchoolClass;  use App\Subject;  use App\Section;use App\StudentParent;use App\Student; use App\SchoolInfo; use App\ClassRoutine; use App\Assignment; use App\Syllabus; use App\Exam; use App\ExamSchedule; use App\Grage; use App\Transport; use App\MarkPercentage; use App\Hostel; use App\HostelMember; use App\LibraryMember; use App\Book; use App\BookIssued; use App\FeeType; use App\Invoice; use App\PaymentHistory; use App\Expense; use App\Income; use App\TeacherAttendence; use App\attendance; use App\TransportMember; use App\AdmissionForm; use App\userInfo; use App\Inbox;

class DeleteDataController extends Controller
{
    //
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
    public function delete_student($id){
        $school_id =  $this->school_info();
        $delete_student = Student::where('school_id',$school_id)
                                ->where('user_id',$id)
                                ->delete();
        $delete_user = User::where('users.school_id',$school_id)
                            ->where('id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    public function delete_teacher($id){
        $school_id =  $this->school_info();
        $delete_teacher = Teacher::where('school_id',$school_id)
                                    ->where('user_id',$id)
                                    ->delete();
        $delete_user = User::where('users.school_id',$school_id)
                            ->where('id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_class($id){
        $school_id =  $this->school_info();
        $delete_class = SchoolClass::where('school_id',$school_id)
                                    ->where('class_id',$id)
                                    ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    public function delete_subject($id){
        $school_id =  $this->school_info();
        $delete_class = Subject::where('subjects.school_id',$school_id)
                                ->where('subject_id',$id)
                                ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    public function delete_section($id){
        $school_id =  $this->school_info();
        $delete_section = Section::where('sections.school_id',$school_id)
                                ->where('saction_id',$id)
                                ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_routine($id){
        $school_id =  $this->school_info();
        $delete_routine = ClassRoutine::where('class_routines.school_id',$school_id)
                                        ->where('routine_id',$id)
                                        ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_parent($id){
        $school_id =  $this->school_info();
        $delete_parent = StudentParent::where('student_parents.school_id',$school_id)
                                        ->where('user_id',$id)
                                        ->delete();
        $delete_user = User::where('users.school_id',$school_id)->where('id',$id)->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_assignment($id){
        $school_id =  $this->school_info();
        
        $delete_assignment = Assignment::where('assignments.school_id',$school_id)
                                        ->where('assignment_id',$id)
                                        ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_syllabuses($id){
        $school_id =  $this->school_info();
        
        $delete_syllabuses = Syllabus::where('syllabi.school_id',$school_id)
                                        ->where('syllabi_id',$id)
                                        ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_exam($id){
        $school_id =  $this->school_info();
        
        $delete_exam = Exam::where('exams.school_id',$school_id)
                            ->where('exam_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_exam_schedule($id){
        $school_id =  $this->school_info();
        
        $delete_exam = ExamSchedule::where('exam_schedules.school_id',$school_id)
                                    ->where('schedule_id',$id)
                                    ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_per($id){
            $school_id =  $this->school_info();
            
            $delete_per = MarkPercentage::where('mark_percentages.school_id',$school_id)
                                        ->where('mark_percentages.mark_per_id',$id)
                                        ->delete();
            Session::flash('success','Delete Successfully Done !');
            return redirect()->back();
        } 

    public function delete_grade($id){
        $school_id =  $this->school_info();
        
        $delete_grade = Grage::where('grages.school_id',$school_id)
                                ->where('grages.grade_id',$id)
                                ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_transport($id){
        $school_id =  $this->school_info();
        
        $delete_transport = Transport::where('transports.school_id',$school_id)
                            ->where('transports.transport_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_hostel($id){
        $school_id =  $this->school_info();
        
        $delete_transport = Hostel::where('hostels.school_id',$school_id)
                            ->where('hostels.hostel_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_member($id){
        $school_id =  $this->school_info();
        
        $delete_member = HostelMember::where('hostel_members.school_id',$school_id)
                            ->where('hostel_members.host_member_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->route('hostel_members');
    }
    public function delete_library_member($id){
        $school_id =  $this->school_info();
        
        $delete_library_member = LibraryMember::where('library_members.school_id',$school_id)
                            ->where('library_members.member_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    public function delete_book($id){
        $school_id =  $this->school_info();
        
        $delete_book = Book::where('books.school_id',$school_id)
                            ->where('books.book_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    public function delete_issue($id){
        $school_id =  $this->school_info();
        
        $delete_book = BookIssued::where('book_issueds.school_id',$school_id)
                            ->where('book_issueds.issu_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_fee_type($id){
        $school_id =  $this->school_info();
        
        $delete_fee_type = FeeType::where('fee_types.school_id',$school_id)
                            ->where('fee_types.fee_type_id',$id)
                            ->delete();
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    public function delete_invoice($id){
        $school_id =  $this->school_info();
        
        $delete_invoice = Invoice::where('invoices.school_id',$school_id)
                            ->where('invoices.fee_type_id',$id)
                            ->delete();

        $delete_payment_history = PaymentHistory::where('school_id',$school_id)
                            ->where('random_id',$id)
                            ->delete();
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }


    public function delete_single_invoice($id,$random,$fee_type){
        $school_id =  $this->school_info();

        // echo $random;

        $invoice = Invoice::where('school_id',$school_id)
                            ->where('fee_type_id',$random)
                            ->get();

        $fee_type = FeeType::where('school_id', $school_id)
                            ->where('fee_type_id',$fee_type)
                            ->get();

        foreach ($fee_type as $type) {
            $feetype=$type->amount;
          }

        foreach ($invoice as $key) {
            $fee=$key->total_fee;
          }
            echo $payable= ($fee - $feetype);
        
        $invoice = new Invoice;
        $invoice = $invoice->where('fee_type_id',$random);
  
            $invoice->update([
                          'total_fee'  => $payable,
                        ]);


        $delete_payment_history = PaymentHistory::where('school_id',$school_id)
                            ->where('pay_id',$id)
                            ->delete(); 
                            

        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }


    public function delete_expense($id){
        $school_id =  $this->school_info();

        $delete_expense = Expense::where('school_id',$school_id)
                            ->where('exp_id',$id)
                            ->delete();
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_income($id){
        $school_id =  $this->school_info();

        $delete_income = Income::where('school_id',$school_id)
                            ->where('income_id',$id)
                            ->delete();
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 

    public function delete_teacher_attn($id){
        $school_id =  $this->school_info();

        $delete_teacher_attn = TeacherAttendence::where('school_id',$school_id)
                            ->where('attn_id',$id)
                            ->delete();
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_student_attn($id){
        $school_id =  $this->school_info();

        $delete_student_attn = attendance::where('school_id',$school_id)
                            ->where('attn_id',$id)
                            ->delete();
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_transport_member($id){
        $school_id =  $this->school_info();

        $delete_transport_member = TransportMember::where('school_id',$school_id)
                            ->where('attn_id',$id)
                            ->delete();
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_application($id){
        $school_id =  $this->school_info();

        $delete_application = AdmissionForm::where('school_id',$school_id)
                            ->where('admission_id',$id)
                            ->delete();
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_user($id){
        $school_id =  $this->school_info();

        $delete_user_info = userInfo::where('school_id',$school_id)
                            ->where('user_id',$id)
                            ->delete();
        $delete_user = User::where('school_id',$school_id)
                            ->where('id',$id)
                            ->delete();                    
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    public function delete_inbox($id){
        $school_id =  $this->school_info();

        $delete_inbox = Inbox::where('school_id',$school_id)
                            ->where('id',$id)
                            ->delete();                    
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    } 
    
}
