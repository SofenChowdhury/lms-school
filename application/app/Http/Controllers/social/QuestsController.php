<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestsController extends Controller
{
    public function Index(){
    	$title = "Quests";
    	return View('social.quests.index',compact('title'));
    }
}
