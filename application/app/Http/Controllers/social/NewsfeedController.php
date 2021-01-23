<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsfeedController extends Controller
{
    public function Index(){
    	$title = "News Feed";
    	return View('social.index',compact('title'));
    }
}
