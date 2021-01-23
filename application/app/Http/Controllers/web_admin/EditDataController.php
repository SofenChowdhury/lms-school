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

use App\Slider;use App\History;use App\ChairmanMessage;use App\PrincipalMessage;use App\PresidencyMessage;use App\MissionVision;use App\GoverningBody;use App\Infrastructure;use App\DressCode;use App\AcademicCalender;use App\News;use App\Notice;use App\Events;use  App\PoliciesGuideline; use  App\Facility; use  App\Library; use  App\It;  use  App\Setting; use  App\AdmissionInfo;  use  App\AdmissionPaymentInfo;   use  App\AdmissionPolicyInfo;    use  App\AdmissionProspectusInfo;  use  App\AdmissionScholarShip;  use  App\ImportantLink; 

class EditDataController  extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function submitUpdateGeneralSetting(Request $request){
        $rules = array(         
            'name'        => 'required|max:255',
            'phone'       =>  'required|max:255',
            'email'       =>  'required|max:255',
            'address'     =>  'required|max:255',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $setting = new Setting; 
        $setting         = $setting->find($request->id);

        $setting->name              =   $request->name;          
        $setting->phone             =   $request->phone;  
        $setting->email             =   $request->email;  
        $setting->address           =   $request->address;  
        $setting->fb_link           =   $request->fb_link;  
        $setting->twitter_link      =   $request->twitter_link;  
        $setting->google_plus_link  =   $request->google_plus_link;  
        $setting->linkedin_link     =   $request->linkedin_link;  
        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

             $setting->image     = $photo;
        }
        $banner = $request->file('banner');
        if($banner){
            $photo = rand().$request->file('banner')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('banner')->move($destination, $photo);

             $setting->banner     = $photo;
        }
        $logo_banner = $request->file('logo_banner');
        if($logo_banner){
            $photo = rand().$request->file('logo_banner')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('logo_banner')->move($destination, $photo);

             $setting->logo_banner     = $photo;
        }     
        $setting->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateSlider(Request $request){
         $rules = array(         
            'title'             =>  'required|max:255',
            'short_description' =>  'required|max:300'
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $slider = new Slider; 
        $slider         = $slider->find($request->id);

        $slider->title              =   $request->title;          
        $slider->short_description  =   $request->short_description;  
        $slider->description        =   $request->description;  
  
        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

             $slider->image     = $photo;
        }
        
        $slider->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    
    // links part
    public function updateLinks(Request $request){
         $rules = array(         
            'title'        => 'required|max:255',           
            'links'        => 'required',  
        );
        $this->validate($request, $rules);

        $links = new ImportantLink; 
        $links = $links->find($request->id);

        $links->title          =   $request->title;          
        $links->links          =   $request->links;   
           
        $links->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    // link part end

    public function submitUpdateLibrary(Request $request){
         $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  =>  'required|max:700',
            'description'        =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $library = new Library; 
        $library         = $library->find($request->id);

        $library->title          =   $request->title;          
        $library->short_description          =   $request->short_description;  
        $library->description          =   $request->description;  
        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

             $library->image     = $photo;
        }     
        $library->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateIt(Request $request){
         $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  =>  'required|max:700',
            'description'        =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $it         = new It; 
        $it         = $it->find($request->id);

        $it->title                =   $request->title;          
        $it->short_description    =   $request->short_description;  
        $it->description          =   $request->description;  
        $image                    = $request->file('file');
        if($image){
            $photo          = rand().$request->file('file')->getClientOriginalName();
            $destination    = 'uploads';

            $request->file('file')->move($destination, $photo);
            $it->image     = $photo;
        }     
        $it->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateNews(Request $request){
         $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     =>  'required|max:700',
            'description'           =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $news           = new News; 
        $news           = $news->find($request->id);

        $news->title                =   $request->title;          
        $news->short_description    =   $request->short_description;  
        $news->description          =   $request->description;  
        $image                      = $request->file('file');
        if($image){
            $photo          = rand().$request->file('file')->getClientOriginalName();
            $destination    = 'uploads';

            $request->file('file')->move($destination, $photo);
            $news->image   = $photo;
        }     
        $news->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateAdmissionPolicyInfo(Request $request){
         $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  =>  'required|max:700',
            'description'        =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $admission_policy_info         = new AdmissionPolicyInfo; 
        $admission_policy_info         = $admission_policy_info->find($request->id);

        $admission_policy_info->title                =   $request->title;          
        $admission_policy_info->short_description    =   $request->short_description;  
        $admission_policy_info->description          =   $request->description;  
        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';

            $request->file('file')->move($destination, $photo);
            $admission_policy_info->image     = $photo;
        } 

        $admission_policy_info->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateAdmissionScholarShipInfo(Request $request){
         $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     =>  'required|max:700',
            'description'           =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $admission_scholarship_info = new AdmissionScholarShip; 
        $admission_scholarship_info                     = $admission_scholarship_info->find($request->id);

        $admission_scholarship_info->title              = $request->title;          
        $admission_scholarship_info->short_description  = $request->short_description;  
        $admission_scholarship_info->description        = $request->description;  
        $image                                          = $request->file('file');
        if($image){
            $photo          = rand().$request->file('file')->getClientOriginalName();
            $destination    = 'uploads';

            $request->file('file')->move($destination, $photo);
            $admission_scholarship_info->image     = $photo;
        }     
        $admission_scholarship_info->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateAdmissionProspectusInfo(Request $request){
         $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  =>  'required|max:700',
            'description'        =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $admission_prospectus_info                      = new AdmissionProspectusInfo; 
        $admission_prospectus_info                      = $admission_prospectus_info->find($request->id);

        $admission_prospectus_info->title               =   $request->title;          
        $admission_prospectus_info->short_description   =   $request->short_description;  
        $admission_prospectus_info->description         =   $request->description;  
        $image                                          = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';

            $request->file('file')->move($destination, $photo);
            $admission_prospectus_info->image     = $photo;
        }     
        $admission_prospectus_info->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateAdmissionPaymentInfo(Request $request){
         $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     => 'required|max:700',
            'description'           => 'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }

        $admission_payment_info             = new AdmissionPaymentInfo; 
        $admission_payment_info             = $admission_payment_info->find($request->id);

        $admission_payment_info->title                =   $request->title;          
        $admission_payment_info->short_description    =   $request->short_description;  
        $admission_payment_info->description          =   $request->description;  
        $image                                        = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';

            $request->file('file')->move($destination, $photo);
            $admission_payment_info->image     = $photo;
        }     
        $admission_payment_info->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }    
    public function submitUpdateAdmissionInfo(Request $request){
         $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     =>  'required|max:700',
            'description'           =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $admission_info                     = new AdmissionInfo; 
        $admission_info                     = $admission_info->find($request->id);

        $admission_info->title              =   $request->title;          
        $admission_info->short_description  =   $request->short_description;  
        $admission_info->description        =   $request->description;  
        $image                              = $request->file('file');

        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';

            $request->file('file')->move($destination, $photo);
            $admission_info->image     = $photo;
        }     
        $admission_info->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateFacility(Request $request){
         $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  =>  'required|max:700',
            'description'        =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $facility                       = new Facility; 
        $facility                       = $facility->find($request->id);
        $facility->title                =   $request->title;          
        $facility->short_description    =   $request->short_description;  
        $facility->description          =   $request->description; 

        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);
            $facility->image     = $photo;
        }     
        $facility->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdatePolices(Request $request){
         $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     =>  'required|max:700',
            'description'           =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $polices                    = new PoliciesGuideline; 
        $polices                    = $polices->find($request->id);
        $polices->title             =   $request->title;          
        $polices->short_description =   $request->short_description;  
        $polices->description       =   $request->description;

        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);
            $polices->image     = $photo;
        }     
        $polices->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateEvent(Request $request){
         $rules = array(         
            'title'             => 'required|max:255',
            'date'              => 'required',
            'time'              => 'required',
            'location'          => 'required|max:255',
            'short_description' =>  'required|max:700',
            'description'       =>  'required',  
        );
        $this->validate($request, $rules);
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $events   = new Events; 
        $events   = $events->find($request->id);

        $events->title              =   $request->title;          
        $events->date               =   $request->date;          
        $events->event_time         =   $request->time;          
        $events->location           =   $request->location;          
        $events->short_description  =   $request->short_description;  
        $events->description        =   $request->description; 

        $image = $request->file('file');
        if($image){
            $photo              = rand().$request->file('file')->getClientOriginalName();
            $destination        = 'uploads';
            $request->file('file')->move($destination, $photo);
            $events->image      = $photo;
        }       
        $events->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateNotice(Request $request){
         $rules = array(         
            'title'             => 'required|max:255',
            'short_description' =>  'required|max:500',
            'description'       =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $notice = new Notice; 
        $notice                    = $notice->find($request->id);

        $notice->title             =   $request->title;          
        $notice->short_description =   $request->short_description;  
        $notice->description       =   $request->description; 

        $image = $request->file('file');
        if($image){
            $photo              = rand().$request->file('file')->getClientOriginalName();
            $destination        = 'uploads';
            $request->file('file')->move($destination, $photo);
            $notice->image      = $photo;
        }     
        $notice->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateGoverningBody(Request $request){
         $rules = array(         
            'name'          => 'required|max:255',
            'designation'   =>  'required|max:255',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $governing_body  = new GoverningBody; 
        $governing_body  = $governing_body->find($request->id);

        $governing_body->name         =   $request->name;          
        $governing_body->designation  =   $request->designation;

        $image = $request->file('file');
        if($image){
            $photo                  = rand().$request->file('file')->getClientOriginalName();
            $destination            = 'uploads';
            $request->file('file')->move($destination, $photo);
            $governing_body->image  = $photo;
        }     
        $governing_body->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateHistory(Request $request){
         $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     => 'required|max:700',
            'description'           =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $history    = new History; 
        $history    = $history->find($request->id);

        $history->title                 =   $request->title;  
        $history->short_description     =   $request->short_description;  
        $history->description           =   $request->description; 

        $image = $request->file('file');
        if($image){
            $photo              = rand().$request->file('file')->getClientOriginalName();
            $destination        = 'uploads';
            $request->file('file')->move($destination, $photo);
            $history->image     = $photo;
        }     
        $history->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }    
    public function submitUpdateChairmanMessage(Request $request){
         $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  => 'required|max:700',
            'description'        =>  'required',
            'name'               =>  'required',
            'designation'        =>  'required',
            'institute_name'     =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $message = new ChairmanMessage; 
        $message = $message->find($request->id);

        $message->title                 =   $request->title;  
        $message->short_description     =   $request->short_description;  
        $message->description           =   $request->description;  
        $message->name                  =   $request->name;  
        $message->designation           =   $request->designation;  
        $message->institute_name        =   $request->institute_name;

        $image = $request->file('file');
        if($image){
            $photo           = rand().$request->file('file')->getClientOriginalName();
            $destination     = 'uploads';
            $request->file('file')->move($destination, $photo);
            $message->image  = $photo;
        }     
        $message->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdatePrincipalMessage(Request $request){
         $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  => 'required|max:700',
            'description'        =>  'required',
            'name'               =>  'required',
            'designation'        =>  'required',
            'institute_name'     =>  'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $message  = new PrincipalMessage; 
        $message  = $message->find($request->id);

        $message->title                =   $request->title;  
        $message->short_description    =   $request->short_description;  
        $message->description          =   $request->description;  
        $message->name                 =   $request->name;  
        $message->designation          =   $request->designation;  
        $message->institute_name       =   $request->institute_name; 

        $image = $request->file('file');
        if($image){
            $photo              = rand().$request->file('file')->getClientOriginalName();
            $destination        = 'uploads';
            $request->file('file')->move($destination, $photo);
            $message->image     = $photo;
        }     
        $message->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }    
    public function submitUpdatePresidencyMessage(Request $request){
         $rules = array(         
            'title'             => 'required|max:255',
            'short_description' => 'required|max:700',
            'description'       => 'required',
            'name'              => 'required',
            'designation'       => 'required',
            'institute_name'    => 'required',
        );
        $this->validate($request, $rules);
       
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $message        = new PresidencyMessage; 
        $message        = $message->find($request->id);

        $message->title             =   $request->title;  
        $message->short_description =   $request->short_description;  
        $message->description       =   $request->description;  
        $message->name              =   $request->name;  
        $message->designation       =   $request->designation;  
        $message->institute_name    =   $request->institute_name;

        $image = $request->file('file');
        if($image){
            $photo              = rand().$request->file('file')->getClientOriginalName();
            $destination        = 'uploads';
            $request->file('file')->move($destination, $photo);
            $message->image     = $photo;
        }     
        $message->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }   
    public function submitUpdateMissionVision(Request $request){
         $rules = array(         
            'title'         => 'required|max:255',
            'description'   =>  'required',
            'title2'        => 'required|max:255',
            'description2'  =>  'required',
        );
        $this->validate($request, $rules);
       
        
        $mission_vision = new MissionVision; 
        $mission_vision = $mission_vision->find($request->id);

        $mission_vision->title         =   $request->title;  
        $mission_vision->description   =   $request->description;  
        $mission_vision->title2        =   $request->title2;  
        $mission_vision->description2  =   $request->description2;

        $mission_vision->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    } 
    public function submitUpdateInfrastructure(Request $request){
         $rules = array(         
            'title'        => 'required|max:255',
            'description'  =>  'required',
        );
        $this->validate($request, $rules);
       
        
        $infrastructure  = new Infrastructure; 
        $infrastructure  = $infrastructure->find($request->id);

        $infrastructure->title       =   $request->title;  
        $infrastructure->description =   $request->description;

        $infrastructure->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateAcademicCalender(Request $request){
         $rules = array(         
            'title'        => 'required|max:255',
            'description'  =>  'required',
        );
        $this->validate($request, $rules);
       
        
        $academic_calender  = new AcademicCalender; 
        $academic_calender  = $academic_calender->find($request->id);

        $academic_calender->title        =   $request->title;  
        $academic_calender->description  =   $request->description; 

        $academic_calender->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    public function submitUpdateDressCode(Request $request){
    	 $rules = array(         
            'title'        => 'required|max:255',
            'description'  =>  'required',
        );
        $this->validate($request, $rules);
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        
        $dress_code = new DressCode; 
        $dress_code = $dress_code->find($request->id);

        $dress_code->title        =   $request->title; 
        $dress_code->description  =   $request->description; 

        $image = $request->file('file');
        if($image){
            $photo              = rand().$request->file('file')->getClientOriginalName();
            $destination        = 'uploads';
            $request->file('file')->move($destination, $photo);
            $dress_code->image  = $photo;
        }

        $dress_code->save();

        Session::flash('success','Update Successfully Done !');
        return redirect()->back();
    }
    


}
