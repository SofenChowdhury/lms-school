<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function Index(){
    	$title = "Group";
    	return View('social.group.index',compact('title'));
    }
}
