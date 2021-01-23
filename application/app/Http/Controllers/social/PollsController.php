<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PollsController extends Controller
{
    public function Index(){
    	$title = "Polls";
    	return View('social.polls.index',compact('title'));
    }
}
