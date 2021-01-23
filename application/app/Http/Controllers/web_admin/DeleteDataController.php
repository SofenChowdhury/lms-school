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

use App\Slider; use App\GoverningBody; use App\News; use App\Notice; use App\Events; use App\Gallery;use App\SchoolInfo;use App\ImportantLink;use App\Machine;

class DeleteDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function delete_gallery($id){

       $delete_gallery = Gallery::where('id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_slider($id){

       $delete_slider = Slider::where('id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_governing_body($id){

       $delete_governing_body = GoverningBody::where('id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_news($id){

       $delete_news = News::where('id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_notice($id){

       $delete_notice = Notice::where('id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_event($id){

       $delete_events = Events::where('id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_links($id){

       $delete_links = ImportantLink::where('id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    public function delete_machine($id){

       $delete_machine = Machine::where('machine_id',$id)->delete();       
        
        Session::flash('success','Delete Successfully Done !');
        return redirect()->back();
    }
    


}
