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

use App\Slider; use App\GoverningBody; use App\News; use App\Notice; use App\Events; use App\Gallery;use App\SchoolInfo; use App\ImportantLink; use App\AdmissionForm; use App\Machine;

class AddDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function school_info(){   
       // $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
       //  $parsedUrl = parse_url($url);
       //  $host = explode('.', $parsedUrl['host']);
       //  $domain_name = $host[0];
       //  $manage_school_info = SchoolInfo::where('domain_name',$domain_name)->get();
       //  foreach ($manage_school_info as $key) {
       //      $school_id = $key->school_id;
       //  }
        $school_id = 1;    
        return $school_id;    
    }
    public function submitEvent(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'title'             => 'required|max:255',
            'date'              => 'required',
            'time'              => 'required',
            'location'          => 'required|max:255',
            'short_description' => 'required|max:500'    
        );
        $this->validate($request, $rules);
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $events = new Events; 
        $events->school_id          =  $school_id ;          
        $events->title              =   $request->title;          
        $events->date               =   $request->date;          
        $events->event_time         =   $request->time;          
        $events->location           =   $request->location;          
        $events->short_description  =   $request->short_description;  
        $events->description        =   $request->description;  
        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

             $events->image     = $photo;
        }       
        $events->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }

    public function submitLinks(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'title'        => 'required|max:255',           
            'links'        => 'required',           
        );
        $this->validate($request, $rules);

        $important_links = new ImportantLink;
        
        $important_links->school_id      =  $school_id ;          
        $important_links->title          =   $request->title;          
        $important_links->links          =   $request->links;          
        
        $important_links->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();    
	}

    public function submitnotice(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'title'              => 'required|max:255',
            'short_description'  => 'required|max:500',
            'description'        => 'required',            
        );
        $this->validate($request, $rules);
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $news = new Notice; 
        $news->school_id            =  $school_id ;    
        $news->title                =  $request->title;          
        $news->short_description    =  $request->short_description;  
        $news->description          =  $request->description;

        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

             $news->image     = $photo;
        }       
        $news->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }
    public function submitNews(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     => 'required|max:500',
            'description'           => 'required',            
        );
        $this->validate($request, $rules);
        if($request->file){
            $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        }
        $news = new News; 
        $news->school_id            =  $school_id ;    
        $news->title                =   $request->title;          
        $news->short_description    =   $request->short_description;  
        $news->description          =   $request->description;  
        $image = $request->file('file');
        if($image){
            $photo          = rand().$request->file('file')->getClientOriginalName();
            $destination    = 'uploads';

            $request->file('file')->move($destination, $photo);
            $news->image   = $photo;
        }       
        $news->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }
    public function submitSlider(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'title'                 => 'required|max:255',
            'short_description'     =>  'required|max:500',
            'file'                  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
        $this->validate($request, $rules);

        $sliders = new Slider; 
        $sliders->school_id          =  $school_id ;    
        $sliders->title          =   $request->title;          
        $sliders->short_description          =   $request->short_description;  
        $sliders->description          =   $request->description;  
        $image = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            $request->file('file')->move($destination, $photo);

             $sliders->image     = $photo;
        }else{
             $sliders->image   = "";
        }       
        $sliders->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }
    public function submitGoverningBody(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'name'        => 'required|max:255',
            'designation' => 'required|max:500',
            'file'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
        $this->validate($request, $rules);

        $governing_body = new GoverningBody; 
        $governing_body->school_id          = $school_id ;    
        $governing_body->name               = $request->name;          
        $governing_body->designation        = $request->designation; 
        $image                              = $request->file('file');
        if($image){
            $photo          = rand().$request->file('file')->getClientOriginalName();
            $destination    = 'uploads';

            $request->file('file')->move($destination, $photo);
            $governing_body->image     = $photo;
        }      
        $governing_body->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }
    public function submitGallery(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'title'     => 'required|max:255',
            'file'      =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
        $this->validate($request, $rules);

        $gallery = new Gallery; 
        $gallery->school_id  =  $school_id ;    
        $gallery->title      =   $request->title;     
        $image               = $request->file('file');
        if($image){
            $photo = rand().$request->file('file')->getClientOriginalName();
            $destination = 'uploads';
            
            $request->file('file')->move($destination, $photo);
            $gallery->image     = $photo;
        }      
        $gallery->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }
    public function submitmachine(Request $request){
        $school_id =  $this->school_info();
        $rules = array(         
            'machine_sn'     => 'required',
            'machinestype'   =>  'required',
        );
        $this->validate($request, $rules);

        $machine = new Machine; 
        $machine->school_id  =  $school_id ;    
        $machine->machine_sn      =   $request->machine_sn;     
        $machine->machinestype    =   $request->machinestype;    
              
        $machine->save();
        
        Session::flash('success','Added Successfully Done !');
        return redirect()->back();
    }
    


}
