<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function Index(){
    	$title = "Events";
    	return View('social.events.index',compact('title'));
    }
}
