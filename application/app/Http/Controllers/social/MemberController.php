<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function Index(){
    	$title = "Members";
    	return View('social.member.index',compact('title'));
    }
}
