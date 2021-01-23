<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function Profile(){
        $title = "Profile";
    	return View('social.profile_layout',compact('title'));
    }
    public function Timeline(){
        $title ="Timeline";
    	return View('social.profile.timeline',compact('title'));
    }
    public function About(){
        $title ="About";
    	return View('social.profile.about',compact('title'));
    }
    public function Photos(){
        $title ="Photos";
    	return View('social.profile.photos',compact('title'));
    }
    public function Videos(){
        $title ="Videos";
    	return View('social.profile.videos',compact('title'));
    }
    public function Groups(){
        $title ="Groups";
    	return View('social.profile.my_groups',compact('title'));
    }
}
