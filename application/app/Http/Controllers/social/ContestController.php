<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function Index(){
    	$title = "Contest";
    	return View('social.contest.index',compact('title'));
    }
}
