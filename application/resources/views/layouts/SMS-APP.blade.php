<?php
    use App\Setting;
    use App\ImportantLink;
    use App\SchoolInfo;
    use App\User;
    use Notifications\Attendance_notify;
    use Carbon\Carbon;
    function school_info(){
        
        // $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        // $parsedUrl = parse_url($url);
        // $host = explode('.', $parsedUrl['host']);
        // $domain_name = $host[0];
        // $manage_school_info = SchoolInfo::where('domain_name',$domain_name)->get();
        // foreach ($manage_school_info as $key) {
        //     $school_id = $key->school_id;
        // }
        $school_id = 1;
         return $school_id;
    }
    $school_id    = school_info();

    $manage_links = ImportantLink::where('school_id', $school_id)->get();   
    $settings = Setting::where('school_id', $school_id)->get();
    foreach($settings as $key){
        $sch_name           = $key->name;
        $sch_icon           = $key->image;
        $sch_logo_banner    = $key->logo_banner;
        $sch_address        = $key->address;
        $sch_phone          = $key->phone;
        $sch_email          = $key->email;
    }
    $changelanguage = Session::get('language');
    $user_id = Auth::user()->id;
    $user_role = Auth::user()->role;
    if ($user_role == 'STUDENT') {
        $manage_profile = User::join('students','students.user_id','users.id')
                        ->where('users.school_id',$school_id)
                        ->where('users.id',$user_id)
                        ->get();
    }elseif ($user_role == 'TEACHER') {
    $manage_profile = User::join('teachers','teachers.user_id','users.id')
                        ->where('users.school_id',$school_id)
                        ->where('users.id',$user_id)
                        ->get();
    }elseif($user_role == 'PARENTS'){
        $manage_profile = User::join('student_parents','student_parents.user_id','users.id')
                        ->where('users.school_id',$school_id)
                        ->where('users.id',$user_id)
                        ->get();
    }elseif($user_role == 'Admin'){
        $manage_profile = User::join('user_infos','user_infos.user_id','users.id')
                        ->where('users.school_id',$school_id)
                        ->where('users.id',$user_id)
                        ->get();
    }else if($user_role == "SUPPERADMIN"){
        $manage_profile = User::join('user_infos','user_infos.user_id','users.id')
                        ->where('users.id',$user_id)
                        ->where('users.school_id',$school_id)
                        ->get();
    }
    
    $notification = DB::table('notifications')->where('notifiable_id',Auth::user()->id)->where('status', null)->count();

    $manage_notify = DB::table('notifications')->where('notifiable_id',Auth::user()->id)->where('status', null)->get();

?>
<style>
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        background-color: #3d7d07 !important;
        border-color:white !important;
    }
    .nav-tabs .nav-link{
        border-radius:0px !important;
    }
    .sidebar-nav .metismenu a{
        border-radius: 0rem !important;
    }
    .theme-orange .sidebar-nav .metismenu>li.active>a{
        background-color: #3d7d07 !important;
        color:white !important;
        font-weight:bold;
    }
    .theme-orange .sidebar-nav .metismenu a:hover, .theme-orange .sidebar-nav .metismenu a:focus{
        background-color: #3d7d07 !important;
        color:white !important;
    }
    .theme-orange .sidebar-nav .metismenu>li.active>a i{
        color:white !important;
    }
    .theme-orange .sidebar-nav .metismenu>li:hover i{
        color:white !important;
    }
    .theme-orange .sidebar-nav .metismenu>li:focus i{
        color:white !important;
    }
    .card{
        border: none !important;
        border-radius: 0px !important;
        border-top: none !important;
    }
    .card .header{
        border: none !important;
        border-radius: 0px !important;
        border-top: none !important;
        /*background-color:#1b5773 !important;*/
        background-color:#5ba81c !important;
    }
    button.dt-button, div.dt-button, a.dt-button{
        background-color: #5ba81c !important;
        background-image:linear-gradient(to bottom, #5ba81c 0%, #5ba81c 100%) !important;
    }
    .btn-primary{
        background-color: transparent !important;
        border-color: #ffffff !important;
    }
    .btn-default{
        background-color: #5ba81c !important;
        border-color: #ffffff !important;
        color:white !important;
    }
    .btn{
        border-radius:0px !important;
    }
    .navbar-nav .icon-menu{
        padding:8px !important;
    }
    .block-header{
        margin-top:-2% !important;
    }
    .theme-orange #left-sidebar .user-account .dropdown-menu{
        background: #5ba81c !important;
    }
    .sub-menu{
        background-color:rgba(61, 125, 7, 0.71);
    }
    /*.button-remove{*/
    /*    border-top-left-radius: 15px !important;*/
    /*    border-bottom-right-radius: 15px !important;*/
    /*    background-color: tomato !important;*/
    /*}*/
    /*.button-edit{*/
    /*    border-top-left-radius: 15px !important;*/
    /*    border-bottom-right-radius: 15px !important;*/
    /*}*/
</style>

<!doctype html>
<html lang="en">
<head>
<title>LMS</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="BAI World (Pvt.) Ltd. Bootstrap 4x Admin Template">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('SMS/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('SMS/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('SMS/assets/vendor/summernote/dist/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('SMS/assets/vendor/dropify/css/dropify.min.css') }}">

<link rel="stylesheet" href="{{ asset('SMS/assets/vendor/sweetalert/sweetalert.css') }}">

<link rel="stylesheet" href="{{ asset('SMS/assets/vendor/light-gallery/css/lightgallery.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('SMS/assets/css/export-data-table-css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('SMS/assets/css/export-data-table-css/buttons.dataTables.min.css') }}">
<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('SMS/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('SMS/assets/css/color_skins.css') }}">
<style>
    td.details-control {
    background: url('SMS/assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('SMS/assets/images/details_close.png') no-repeat center center;
    }
</style>

<link rel="stylesheet" href="{{ asset('SMS/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body class="theme-orange">

<!-- Page Loader -->
<div class="page-loader-wrapper" style="background: #9bc366 !important;">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset('uploads'.'/'.$sch_icon)}}" height="100" alt="WhitePaper.Ltd."></div>
        <p>Please wait...</p>        
    </div>
</div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <div id="wrapper">
        <nav class="navbar navbar-fixed-top" style="background-color:white;">
            <div class="container-fluid">
    
                <div class="navbar-left">
                    <div class="navbar-btn">
                        <a href="{{ route('home') }}" style="text-align: center;">
                            <img src="{{asset('uploads'.'/'.$sch_icon)}}" class="img-fluid logo">
                        </a>
                        <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                    </div>
                    <a href="javascript:void(0);" class="icon-menu btn-toggle-fullwidth">
                        <i class="fa fa-arrow-right" style="float: left;font-size: 18px;padding-right: 15px;margin-top: 4px;color:#123088;"></i>
                        <h1 style="font-size: 18px;float: left;text-align: center;font-weight:bold;">{{$sch_name}}</h1>
                    </a>
                    
                </div>
                
                <div class="navbar-right">
                    <div id="navbar-menu">
                        <ul class="nav navbar-nav" style="text-align:right;">
                            
                            <li class="dropdown dropdown-animated scale-left">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-bell" style="color:#123088;"></i>
                                    @if($notification > 0)
                                    <span style="background-color: #c02f2c; padding:5px 10px; font-weight: bold;">{{ $notification }}</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu feeds_widget" style="top: 80%; width: 425px; border-top-right-radius: 0px; max-height: 300px; overflow-y: scroll;">
                                
                                    <li class="header"> You have {{$notification }} new Notifications</li>
                                    @foreach($manage_notify as $notify)
                                    <li>
                                        <a href="{{route('read_notification',['id'=>$notify->id])}}">
                                            <div class="feeds-left"><i class="fab fa-accusoft"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-success">{{$notify->data}}</h4>
    
                                                <small style="color: #4390b1;">{{Carbon::parse($notify->created_at)->diffForHumans()}}</small>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
    
                            <li class="dropdown dropdown-animated scale-left">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-envelope" style="color:#123088;"></i>
                                    
                                    <span id="count_msg"></span>
                                    
                                </a>
                                <ul class="dropdown-menu feeds_widget" style="top: 80%; width: 425px; border-top-right-radius: 0px; max-height: 300px; overflow-y: scroll;">
    
                                    <li class="header" id="#count_message" style="font-size: 13px; color:gray;"> You have <span id="dataText"></span> new Message</li>
                                    <li>
    
                                        <div class="feeds-body" >
                                            <div id="MyMsg"></div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
    
                            <li><a class="icon-menu"  href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="icon-power" style="color:#123088;"></i>
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </nav>
        <div id="left-sidebar" class="sidebar" style="background-color:#1b5773;background-image:url('https://png.pngtree.com/thumb_back/fw800/back_our/20190628/ourmid/pngtree-green-nature-background-texture-image_264197.jpg')">
            <div style="background-color:rgba(109, 160, 53, 0.39);">
                <div class="navbar-brand" style="padding;0px;margin:0px;padding-bottom:15px;">
                    <a href="{{ route('home') }}">
        				<?php if($sch_icon){?>
        				<center><img src="{{asset('uploads'.'/'.$sch_icon)}}" style="width:66%;"  class="img-fluid logo"></center>
        				<?php }else{?>
        				<img src="{{asset('uploads'.'/'.$sch_logo_banner)}}" style="width:100%;"  class="img-fluid logo">					
        				<?php } ?>
        				</a><i class="fa fa-close close-btn"></i>
                    <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
            </div>
                <div class="sidebar-scroll">
                    <div class="user-account">
                        <div class="user_div"style="display:none;"> 
        
                            @foreach($manage_profile as $profile)
                                @if( $profile->role == 'STUDENT')
                                <img src="{{ asset('uploads').'/'.$profile->student_photo }}" class="user-photo" alt="User Profile Picture">
                                @php 
                                    $user_name= $profile->student_name;
                                @endphp    
                                @elseif( $profile->role == 'TEACHER')
                                <img src="{{ asset('uploads').'/'.$profile->teacher_photo }}" class="user-photo" alt="User Profile Picture">
                                @php 
                                    $user_name= $profile->teacher_name;
                                @endphp 
                                @elseif( $profile->role == 'PARENTS')
                                <img src="{{ asset('uploads').'/'.$profile->guardian_photo }}" class="user-photo" alt="User Profile Picture">
                                @php 
                                    $user_name= $profile->guardian_name;
                                @endphp 
                                @elseif( $profile->role == 'Admin')
                                <img src="{{ asset('uploads').'/'.$profile->user_image }}" class="user-photo" alt="User Profile Picture">
                               <?php 
                                    $user_name= $profile->user_name;
                                    $user_image = $profile->user_image;
                                ?>
                                @else
                                <img src="{{ asset('uploads').'/'.$profile->user_image }}" class="user-photo" alt="User Profile Picture">
                                <?php 
                                    $user_name= $profile->user_name;
                                    $user_image = $profile->user_image;
                                ?>
                                @endif
                                
                            @endforeach
                        </div>
                        <div class="dropdown">
                            <span style="color: #fff">Welcome,</span>
                            <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown" style="color: white;"><strong style="color: #fff">{{Auth::user()->email}}</strong></a>
                            <ul class="dropdown-menu dropdown-menu-right account">
                                <li><a href="{{route('userProfile')}}"><i class="icon-user"></i>My Profile</a></li>
                                <li><a href="{{route('edit_user_profile',['id'=>Auth::user()->id])}}"><i class="icon-settings"></i>Settings</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="icon-power"></i>{{ __('Logout') }}
                                    </a>
        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <hr style="border-top: 1px solid rgba(238,238,238,0.1)">
                    </div>  
                    <ul class="nav nav-tabs">
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                        <li class="nav-item"><a class="nav-link 
                                {{ request()->is('add-slider-page') ? 'active show' : '' }} || 
                                {{ request()->is('slider-page') ? 'active show' : '' }} || 
                                {{ request()->is('slider-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('manage_links') ? 'active ' : '' }} || 
                                {{ request()->is('add_links') ? 'active ' : '' }} || 
                                {{ request()->is('edit_links/*') ? 'active' : '' }} || 
                                {{ request()->is('update-slider-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('history-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-history-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('chairman-message-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-chairman-message-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('principal-message-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-principal-message-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('presidency-message-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-presidency-message-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('mission-vision-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-mision-vision-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('governing-body-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-governing-body-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-governing-body-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('infrstructure-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-infrastructure-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('dress-code-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-dress-code-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('academic-calender-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-academic-calender-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('book-list-page') ? 'active show' : '' }} || 
                                {{ request()->is('class-routine-page') ? 'active show' : '' }} || 
                                {{ request()->is('exam-routine-page') ? 'active show' : '' }} || 
                                {{ request()->is('teacher-staff-page') ? 'active show' : '' }} || 
                                {{ request()->is('news-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-news-page') ? 'active show' : '' }} || 
                                {{ request()->is('news-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('update-news-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('notice-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-notice-page') ? 'active show' : '' }} || 
                                {{ request()->is('notice-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('update-notice-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('event-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-event-page') ? 'active show' : '' }} || 
                                {{ request()->is('event-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('update-event-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('policies-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-polices/*') ? 'active show' : '' }} || 
                                {{ request()->is('facilities-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-facility-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('library-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-library-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('updaate-it-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('it-page') ? 'active show' : '' }} || 
                                {{ request()->is('admission-info-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('admission-form-page') ? 'active show' : '' }} || 
                                {{ request()->is('admission-result-page') ? 'active show' : '' }} || 
                                {{ request()->is('fees-payment-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-payment-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('admission-policy-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-policy-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('prospectus-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-prospectus-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('scholarships-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-scholarship-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-recruitment-exam-page') ? 'active show' : '' }} || 
                                {{ request()->is('recruitment-exam-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-gallery-page') ? 'active show' : '' }} || 
                                {{ request()->is('manage-gallery-page') ? 'active show' : '' }} || 
                                {{ request()->is('general-setting-page') ? 'active show' : '' }}  
                                {{ request()->is('update-general-setting-page/*') ? 'active show' : '' }}||  
                                {{ request()->is('machines') ? 'active show' : '' }} || 
                                {{ request()->is('add_machine') ? 'active show' : '' }} || 
        
                            " data-toggle="tab" href="#website">WEBSITE MENU</a></li>
                        @endif    
        
                        <?php if(Auth::user()->role=="STUDENT" && Auth::user()->role=="PARENTS"){?>
                        <li class="nav-item" style="width: 100% !important">
                        <?php }else{?>
                        <li class="nav-item"  >
                        <?php }?>
                            <a class="nav-link 
                                {{ request()->is('userProfile') ? 'active show' : '' }} || 
                                {{ request()->is('edit_user_profile/*') ? 'active show' : '' }} || 
                                {{ request()->is('home') ? 'active show' : '' }} || 
                                {{ request()->is('students') ? 'active show' : '' }} || 
                                {{ request()->is('student-details/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_student/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-student') ? 'active show' : '' }} || 
                                {{ request()->is('student-details') ? 'active show' : '' }} || 
                                {{ request()->is('parents') ? 'active show' : '' }} || 
                                {{ request()->is('parent_details/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_parents/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-parent') ? 'active show' : '' }} || 
                                {{ request()->is('teachers') ? 'active show' : '' }} || 
                                {{ request()->is('edit_teacher/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-teacher') ? 'active show' : '' }} || 
                                {{ request()->is('teacher-details/*') ? 'active show' : '' }} || 
                                {{ request()->is('users') ? 'active show' : '' }} || 
                                {{ request()->is('add-user') ? 'active show' : '' }} || 
                                {{ request()->is('classes') ? 'active show' : '' }} || 
                                {{ request()->is('edit_class/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_subject/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_section/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_syllabuses/*') ? 'active show' : '' }} || 
                                {{ request()->is('view_syllabuses/*') ? 'active show' : '' }} || 
                                {{ request()->is('assignments/*') ? 'active show' : '' }} || 
                                {{ request()->is('view_assignment/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_assignment/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_routine/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-class') ? 'active show' : '' }} || 
                                {{ request()->is('subjects') ? 'active show' : '' }} || 
                                {{ request()->is('add-subject') ? 'active show' : '' }} || 
                                {{ request()->is('sections') ? 'active show' : '' }} || 
                                {{ request()->is('add-section') ? 'active show' : '' }} || 
                                {{ request()->is('syllabuses') ? 'active show' : '' }} || 
                                {{ request()->is('add-syllabus') ? 'active show' : '' }} || 
                                {{ request()->is('assignments') ? 'active show' : '' }} || 
                                {{ request()->is('add-assignment') ? 'active show' : '' }} || 
                                {{ request()->is('submited-assignment/*') ? 'active show' : '' }} || 
                                {{ request()->is('routine') ? 'active show' : '' }} || 
                                {{ request()->is('add-routine') ? 'active show' : '' }} || 
                                {{ request()->is('student-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('view_attn/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-student-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('teacher-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('add-teacher-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('saveteacherForm') ? 'active show' : '' }} || 
                                {{ request()->is('user-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('exam') ? 'active show' : '' }} || 
                                {{ request()->is('examschedule') ? 'active show' : '' }} || 
                                {{ request()->is('grade') ? 'active show' : '' }} || 
                                {{ request()->is('add_grade') ? 'active show' : '' }} || 
                                {{ request()->is('show_marks') ? 'active' : '' }} ||
                                {{ request()->is('exam_attendence') ? 'active show' : '' }} || 
                                {{ request()->is('add_exam') ? 'active show' : '' }} || 
                                {{ request()->is('edit_exam/*') ? 'active show' : '' }} || 
                                {{ request()->is('view_exam_schedule/*') ? 'active show' : '' }} || 
                                {{ request()->is('add_examschedule') ? 'active show' : '' }} || 
                                {{ request()->is('edit_grade/*') ? 'active show' : '' }} || 
                                {{ request()->is('marks') ? 'active' : '' }} || 
                                {{ request()->is('add_marks') ? 'active' : '' }} ||
                                {{ request()->is('give_marks') ? 'active' : '' }} ||
                                {{ request()->is('markpercentage') ? 'active' : '' }} || 
                                {{ request()->is('library_members_student') ? 'active' : '' }} ||
                                {{ request()->is('promotion') ? 'active' : '' }} ||
                                {{ request()->is('save_promotionForm') ? 'active' : '' }} ||
                                {{ request()->is('show_students_promotion') ? 'active' : '' }} ||
                                {{ request()->is('library_members_teachers') ? 'active' : '' }} ||
                                {{ request()->is('library_members') ? 'active' : '' }} ||
                                {{ request()->is('book_issue_teachers') ? 'active' : '' }} ||
                                {{ request()->is('transport') ? 'active' : '' }} ||
                                {{ request()->is('edit_transport/*') ? 'active' : '' }} ||
                                {{ request()->is('transport_memeber') ? 'active' : '' }} ||
                                {{ request()->is('hostel') ? 'active' : '' }} ||
                                {{ request()->is('add_hostel') ? 'active' : '' }} ||
                                {{ request()->is('add_hostel_members') ? 'active' : '' }} ||
                                {{ request()->is('edit_hostel/*') ? 'active' : '' }} ||
                                {{ request()->is('edit_member/*') ? 'active' : '' }} ||
                                {{ request()->is('hostel_members') ? 'active' : '' }} ||
                                {{ request()->is('ShowHostelMembers') ? 'active' : '' }} ||
                                {{ request()->is('add-user-attendance') ? 'active show' : '' }} ||
                                {{ request()->is('give_attendance') ? 'active show' : '' }} ||
                                {{ request()->is('company_paid') ? 'active show' : '' }} ||
                                {{ request()->is('add_company_paid') ? 'active show' : '' }} ||
        
                                {{ request()->is('classes') ? 'active' : '' }} || 
                                        {{ request()->is('add-class') ? 'active' : '' }} || 
                                        {{ request()->is('edit_class/*') ? 'active' : '' }} || 
                                        {{ request()->is('subjects') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_subject/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-subject') ? 'active' : '' }} !! 
                                        {{ request()->is('sections') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_section/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-section') ? 'active' : '' }} !! 
                                        {{ request()->is('syllabuses') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_syllabuses/*') ? 'active' : '' }} !! 
                                        {{ request()->is('view_syllabuses/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-syllabus') ? 'active' : '' }} !!  
                                        {{ request()->is('assignments') ? 'active' : '' }} !! 
                                        {{ request()->is('view_assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-assignment') ? 'active' : '' }} !! 
                                        {{ request()->is('routine') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_routine/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-routine') ? 'active' : '' }} ||
        
                                {{ request()->is('library_members_student') ? 'active' : '' }} || 
                                        {{ request()->is('library_members_teachers') ? 'active' : '' }}  || 
                                        {{ request()->is('books') ? 'active' : '' }} || 
                                        {{ request()->is('book_issue_students') ? 'active' : '' }} || 
        
        
                                {{ request()->is('fee_types') ? 'active' : '' }} || 
                                        {{ request()->is('invoice') ? 'active' : '' }} || 
                                        {{ request()->is('add_invoice') ? 'active' : '' }} || 
                                        {{ request()->is('payment_history') ? 'active' : '' }} || 
                                        {{ request()->is('profit') ? 'active' : '' }} || 
                                        {{ request()->is('expense') ? 'active' : '' }} || 
                                        {{ request()->is('add_expance') ? 'active' : '' }} || 
                                        {{ request()->is('edit_expense/*') ? 'active' : '' }} || 
                                        {{ request()->is('income') ? 'active' : '' }} || 
                                        {{ request()->is('add_income') ? 'active' : '' }} || 
                                        {{ request()->is('edit_income/*') ? 'active' : '' }} || 
        
                                {{ request()->is('class_report') ? 'active' : '' }} || 
                                        {{ request()->is('student_report') ? 'active' : '' }} || 
                                        {{ request()->is('id_card') ? 'active' : '' }} || 
                                        {{ request()->is('admit_card') ? 'active' : '' }} || 
                                        {{ request()->is('routine_report') ? 'active' : '' }} || 
                                        {{ request()->is('examschedulereport') ? 'active' : '' }} || 
                                        {{ request()->is('attendanceReport') ? 'active' : '' }} || 
                                        {{ request()->is('terminalReport') ? 'active' : '' }} || 
                                        {{ request()->is('meritstagereport') ? 'active' : '' }} || 
                                        {{ request()->is('tabulationsheetreport') ? 'active' : '' }} || 
                                        {{ request()->is('progresscardreport') ? 'active' : '' }} || 
                                        {{ request()->is('certificate') ? 'active' : '' }} || 
                                        {{ request()->is('feeReport') ? 'active' : '' }} || 
                                        {{ request()->is('balancefeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('transectionreport') ? 'active' : '' }} ||
                                        {{ request()->is('show_class_report') ? 'active' : '' }} ||
                                        {{ request()->is('showStudentReport') ? 'active' : '' }} ||
        
                                        {{ request()->is('idCardFrom') ? 'active' : '' }} ||
                                        {{ request()->is('adminCardFrom') ? 'active' : '' }} ||
                                        {{ request()->is('showRoutine') ? 'active' : '' }} ||
                                        {{ request()->is('showexamschedulereport') ? 'active' : '' }} ||
                                        {{ request()->is('quiz') ? 'active' : '' }} ||
                                        {{ request()->is('quiz_details/*') ? 'active' : '' }} ||
                                        {{ request()->is('showAttendance') ? 'active' : '' }} ||
                                        {{ request()->is('showterminalReport') ? 'active' : '' }} ||
                                        {{ request()->is('showMeritstagereport') ? 'active' : '' }} ||
                                        {{ request()->is('showTabulationsheetreport') ? 'active' : '' }} ||
                                        {{ request()->is('showProgresscardreport') ? 'active' : '' }} ||
                                        {{ request()->is('showCertificatereport') ? 'active' : '' }} || 
        
                                        {{ request()->is('showFeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('showBalancefeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('showTransectionreport') ? 'active' : '' }} || 
        
        
                                {{ request()->is('edit_library_student_member/*') ? 'active' : '' }} || 
                                        {{ request()->is('add_library_member_student') ? 'active' : '' }} || 
                                        {{ request()->is('edit_library_member_teacher/*') ? 'active' : '' }} || 
                                        {{ request()->is('edit_issue_student/*') ? 'active' : '' }} || 
                                        {{ request()->is('edit_issue_teacher/*') ? 'active' : '' }} || 
                                        {{ request()->is('add_book_issue') ? 'active' : '' }} || 
                                        {{ request()->is('edit_book/*') ? 'active' : '' }} || 
                                        {{ request()->is('add_book') ? 'active' : '' }} || 
        
                                        {{ request()->is('add_transport_member') ? 'active' : '' }} || 
                                        {{ request()->is('add_transport') ? 'active' : '' }} || 
                                        {{ request()->is('edit_transport/*') ? 'active' : '' }} || 
                                        {{ request()->is('edit_transport_member/*') ? 'active' : '' }} ||
                                        
                                        {{ request()->is('add_fee_types') ? 'active' : '' }} ||
                                        {{ request()->is('edit_fee_type/*') ? 'active' : '' }} ||
                                        {{ request()->is('showpayment_history') ? 'active' : '' }} ||
                                        {{ request()->is('show_profit') ? 'active' : '' }} ||
                                
                                {{ request()->is('online_admission') ? 'active' : '' }} ||
                                        {{ request()->is('view_application/*') ? 'active' : '' }} ||
                                        {{ request()->is('submitOnlineApplicationForm/*') ? 'active' : '' }} ||
                                        
                                {{ request()->is('read_notification/*') ? 'active' : '' }} ||
                                {{ request()->is('student_attendanceForm') ? 'active' : '' }} ||
                                {{ request()->is('inbox') ? 'active' : '' }} ||
                                {{ request()->is('add_inbox') ? 'active' : '' }} ||
                                {{ request()->is('view_msg/*') ? 'active' : '' }} 
        
                                " data-toggle="tab" href="#sms">LMS MENU</a>
                        </li>
                    </ul>
                    <div class="tab-content" style="margin-bottom:80px;">
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                        <div class="tab-pane  
                                
                                {{ request()->is('add-slider-page') ? 'active show' : '' }} || 
                                {{ request()->is('slider-page') ? 'active show' : '' }} || 
                                {{ request()->is('slider-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('update-slider-page/*') ? 'active show' : '' }} ||                         
                                {{ request()->is('manage_links') ? 'active ' : '' }} || 
                                {{ request()->is('add_links') ? 'active ' : '' }} || 
                                {{ request()->is('edit_links/*') ? 'active' : '' }} || 
                                {{ request()->is('history-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-history-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('chairman-message-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-chairman-message-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('principal-message-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-principal-message-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('presidency-message-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-presidency-message-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('mission-vision-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-mision-vision-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('governing-body-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-governing-body-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-governing-body-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('infrstructure-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-infrastructure-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('dress-code-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-dress-code-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('academic-calender-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-academic-calender-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('book-list-page') ? 'active show' : '' }} || 
                                {{ request()->is('class-routine-page') ? 'active show' : '' }} || 
                                {{ request()->is('exam-routine-page') ? 'active show' : '' }} || 
                                {{ request()->is('teacher-staff-page') ? 'active show' : '' }} || 
                                {{ request()->is('news-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-news-page') ? 'active show' : '' }} || 
                                {{ request()->is('news-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('update-news-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('notice-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-notice-page') ? 'active show' : '' }} || 
                                {{ request()->is('notice-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('update-notice-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('event-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-event-page') ? 'active show' : '' }} || 
                                {{ request()->is('event-description-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('update-event-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('policies-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-polices/*') ? 'active show' : '' }} || 
                                {{ request()->is('facilities-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-facility-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('library-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-library-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('it-page') ? 'active show' : '' }} || 
                                {{ request()->is('updaate-it-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('admission-info-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('admission-form-page') ? 'active show' : '' }} || 
                                {{ request()->is('admission-result-page') ? 'active show' : '' }} || 
                                {{ request()->is('fees-payment-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-payment-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('admission-policy-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-policy-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('prospectus-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-prospectus-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('scholarships-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-admission-scholarship-info-page/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-recruitment-exam-page') ? 'active show' : '' }} || 
                                {{ request()->is('recruitment-exam-page') ? 'active show' : '' }} || 
                                {{ request()->is('add-gallery-page') ? 'active show' : '' }} || 
                                {{ request()->is('manage-gallery-page') ? 'active show' : '' }} || 
                                {{ request()->is('general-setting-page') ? 'active show' : '' }} || 
                                {{ request()->is('update-general-setting-page/*') ? 'active show' : '' }}||  
                                {{ request()->is('machines') ? 'active show' : '' }} || 
                                {{ request()->is('add_machine') ? 'active show' : '' }}  
        
                            " id="website">
        
                            <nav id="left-sidebar-nav" class="sidebar-nav">
                                <ul id="main-menu" class="metismenu">
                                                                
                                    <li class="{{ request()->is('add-slider-page') ? 'active' : '' }} || {{ request()->is('slider-page') ? 'active ' : '' }} || {{ request()->is('slider-description-page/*') ? 'active ' : '' }}  || {{ request()->is('update-slider-page/*') ? 'active ' : '' }} ">
                                        <a href="" class="has-arrow"><i class="icon-notebook"></i><span>Sliders</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('add-slider-page') ? 'active' : '' }}"><a href="{{ route('add-slider-web') }}">Add Slider</a></li>
                                            <li class="{{ request()->is('slider-page') ? 'active ' : '' }}"><a href="{{ route('slider-web') }}">Manage Slider</a></li>
                                        </ul>
                                    </li>
        
                                    <li class="{{ request()->is('edit_links/*') ? 'active' : '' }} || {{ request()->is('add_links') ? 'active' : '' }} || {{ request()->is('manage_links') ? 'active ' : '' }} || {{ request()->is('edit_links/*') ? 'active ' : '' }}  || {{ request()->is('update_links/*') ? 'active ' : '' }} ">
                                        <a href="" class="has-arrow"><i class="icon-notebook"></i><span>Important Links</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('add_links') ? 'active' : '' }}"><a href="{{ route('add_links') }}">Add Important Links</a></li>
                                            <li class="{{ request()->is('manage_links') ? 'active ' : '' }}"><a href="{{ route('manage_links') }}">Manage Important Links</a></li>
                                        </ul>
                                    </li>
        
                                    <li class="
                                        {{ request()->is('history-page') ? 'active show' : '' }} || 
                                        {{ request()->is('update-history-page/*') ? 'active show' : '' }} || 
                                        {{ request()->is('chairman-message-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-chairman-message-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('principal-message-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-principal-message-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('presidency-message-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-presidency-message-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('mission-vision-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-mision-vision-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('governing-body-page') ? 'active ' : '' }} || 
                                        {{ request()->is('add-governing-body-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-governing-body-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('infrstructure-page') ? 'active ' : '' }} ||  
                                        {{ request()->is('update-infrastructure-page/*') ? 'active ' : '' }} " >
                                        <a href="#uiElements" class="has-arrow"><i class="icon-notebook"></i><span>About Us</span></a>
                                        <ul class="sub-menu">
                                            <li class=" {{ request()->is('history-page') ? 'active show' : '' }} || {{ request()->is('update-history-page/*') ? 'active show' : '' }}"><a href="{{ route('history-web') }}">History</a></li>
                                            <li class="{{ request()->is('chairman-message-page') ? 'active ' : '' }} || {{ request()->is('update-chairman-message-page/*') ? 'active ' : '' }}"><a href="{{ route('chairman-message-web') }}">Chairman Messages</a></li>
                                            <li class="{{ request()->is('principal-message-page') ? 'active ' : '' }} || {{ request()->is('update-principal-message-page/*') ? 'active ' : '' }}"><a href="{{ route('principal-message-web') }}">Principal Messages</a></li>
                                            <li class="{{ request()->is('presidency-message-page') ? 'active ' : '' }} || {{ request()->is('update-presidency-message-page/*') ? 'active ' : '' }}"><a href="{{ route('presidency-message-web') }}">Presidency Messages</a></li>
                                            <li class="{{ request()->is('mission-vision-page') ? 'active ' : '' }} || {{ request()->is('update-mision-vision-page/*') ? 'active ' : '' }} "><a href="{{ route('mission-vision-web') }}">Mission & Vision</a></li>
                                            <li class=" {{ request()->is('governing-body-page') ? 'active ' : '' }} || {{ request()->is('add-governing-body-page') ? 'active ' : '' }} || {{ request()->is('update-governing-body-page/*') ? 'active ' : '' }}"><a href="{{ route('governing-body-web') }}">Governing Body</a></li>
                                            <li class="{{ request()->is('infrstructure-page') ? 'active ' : '' }} || {{ request()->is('update-infrastructure-page/*') ? 'active ' : '' }}"><a href="{{ route('infrstructure-web') }}">Infrastructure</a></li>
                                        </ul>
                                    </li>
                                    <li class="
                                        {{ request()->is('dress-code-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-dress-code-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('academic-calender-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-academic-calender-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('book-list-page') ? 'active ' : '' }} || 
                                        {{ request()->is('class-routine-page') ? 'active ' : '' }} || 
                                        {{ request()->is('exam-routine-page') ? 'active ' : '' }} || 
                                        {{ request()->is('teacher-staff-page') ? 'active ' : '' }} || ">
                                        <a href="#uiElements" class="has-arrow"><i class="icon-notebook"></i><span>Academic</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('dress-code-page') ? 'active ' : '' }} || {{ request()->is('update-dress-code-page/*') ? 'active ' : '' }} "><a href="{{ route('dress-code-web') }}">Dress Code</a></li>
                                            <li class="{{ request()->is('academic-calender-page') ? 'active ' : '' }} || {{ request()->is('update-academic-calender-page/*') ? 'active ' : '' }} "><a href="{{ route('academic-calender-web') }}">Academic Calender</a></li>
                                            <!-- <li class="{{ request()->is('book-list-page') ? 'active ' : '' }} "><a href="{{ route('book-list-web') }}">Book List & Syllabus</a></li>
                                            <li class=" {{ request()->is('class-routine-page') ? 'active ' : '' }}"><a href="{{ route('class-routine-web') }}">Class Routione</a></li>
                                            <li class="{{ request()->is('exam-routine-page') ? 'active ' : '' }}"><a href="{{ route('exam-routine-web') }}">Exam Routine</a></li>
                                            <li class="{{ request()->is('teacher-staff-page') ? 'active ' : '' }}"><a href="{{ route('teacher-staff-web') }}">Teachers & Staffs</a></li>  -->    
                                        </ul>
                                    </li>    
                                    <li class="
                                        {{ request()->is('news-page') ? 'active ' : '' }} || 
                                        {{ request()->is('add-news-page') ? 'active ' : '' }} || 
                                        {{ request()->is('news-description-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('update-news-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('notice-page') ? 'active ' : '' }} || 
                                        {{ request()->is('add-notice-page') ? 'active ' : '' }} || 
                                        {{ request()->is('notice-description-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('update-notice-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('event-page') ? 'active ' : '' }} || 
                                        {{ request()->is('event-description-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('add-event-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-event-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('policies-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-polices/*') ? 'active ' : '' }} || 
                                        {{ request()->is('facilities-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-facility-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('library-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-library-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('it-page') ? 'active ' : '' }} || 
                                        {{ request()->is('updaate-it-page/*') ? 'active ' : '' }} || ">
                                        <a href="#uiElements" class="has-arrow"><i class="icon-notebook"></i><span>Information</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('update-news-page/*') ? 'active ' : '' }} || {{ request()->is('news-description-page/*') ? 'active ' : '' }} || {{ request()->is('news-page') ? 'active ' : '' }} || {{ request()->is('add-news-page') ? 'active ' : '' }} "><a href="{{ route('news-web') }}">News</a></li>
                                            <li class="{{ request()->is('update-notice-page/*') ? 'active ' : '' }} || {{ request()->is('notice-description-page/*') ? 'active ' : '' }} || {{ request()->is('notice-page') ? 'active ' : '' }} || {{ request()->is('add-notice-page') ? 'active ' : '' }}"><a href="{{ route('notice-web') }}">Notice</a></li>
                                            <li class=" {{ request()->is('update-event-page/*') ? 'active ' : '' }} ||   {{ request()->is('event-description-page/*') ? 'active ' : '' }} ||  {{ request()->is('add-event-page') ? 'active ' : '' }} || {{ request()->is('event-page') ? 'active ' : '' }}"><a href="{{ route('event-web') }}">Events</a></li>
                                            <li class=" {{ request()->is('update-polices/*') ? 'active ' : '' }}  ||  {{ request()->is('policies-page') ? 'active ' : '' }}"><a href="{{ route('policies-web') }}">Policies & Guidlines</a></li>
                                            <li class="{{ request()->is('update-facility-page/*') ? 'active ' : '' }} || {{ request()->is('facilities-page') ? 'active ' : '' }}"><a href="{{ route('facilities-web') }}">Facilities</a></li>
                                            <li class="{{ request()->is('update-library-page/*') ? 'active ' : '' }} || {{ request()->is('library-page') ? 'active ' : '' }}"><a href="{{ route('library-web') }}">Library</a></li>
                                            <li class="{{ request()->is('updaate-it-page/*') ? 'active ' : '' }} || {{ request()->is('it-page') ? 'active ' : '' }}"><a href="{{ route('it-web') }}">IT</a></li> 
                                        </ul>
                                    </li>        
                                    <li class="
                                        {{ request()->is('admission-info-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-admission-info-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('admission-form-page') ? 'active ' : '' }} || 
                                        {{ request()->is('admission-result-page') ? 'active ' : '' }} || 
                                        {{ request()->is('fees-payment-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-admission-payment-info-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('admission-policy-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-admission-policy-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('prospectus-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-admission-prospectus-info-page/*') ? 'active ' : '' }} || 
                                        {{ request()->is('scholarships-page') ? 'active ' : '' }} || 
                                        {{ request()->is('update-admission-scholarship-info-page/*') ? 'active ' : '' }}  "  >
                                        <a href="#uiElements" class="has-arrow"><i class="icon-notebook"></i><span>Admission</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('update-admission-info-page/*') ? 'active ' : '' }} || {{ request()->is('admission-info-page') ? 'active ' : '' }}"><a href="{{ route('admission-info-web') }}">Admission Information</a></li>
                                            <!-- <li class="{{ request()->is('admission-form-page') ? 'active ' : '' }}"><a href="{{ route('admission-form-web') }}">Admission Form</a></li> -->
                                            <!-- <li class="{{ request()->is('admission-result-page') ? 'active ' : '' }}"><a href="{{ route('admission-result-web') }}">Admission Result</a></li> -->
                                            <li class="{{ request()->is('update-admission-payment-info-page/*') ? 'active ' : '' }} || {{ request()->is('fees-payment-page') ? 'active ' : '' }}"><a href="{{ route('fees-payment-web') }}">Fees & Payments</a></li>
                                            <li class="{{ request()->is('update-admission-policy-page/*') ? 'active ' : '' }} || {{ request()->is('admission-policy-page') ? 'active ' : '' }}"><a href="{{ route('admission-policy-web') }}">Admission Policy</a></li>
                                            <li class="{{ request()->is('update-admission-prospectus-info-page/*') ? 'active ' : '' }} || {{ request()->is('prospectus-page') ? 'active ' : '' }}"><a href="{{ route('prospectus-web') }}">Prospectus</a></li>
                                            <li class="{{ request()->is('update-admission-scholarship-info-page/*') ? 'active ' : '' }} || {{ request()->is('scholarships-page') ? 'active ' : '' }}"><a href="{{ route('scholarships-web') }}">Scholarships</a></li>
                                        </ul>
                                    </li>            
                                    <!-- <li class="
                                        {{ request()->is('add-recruitment-exam-page') ? 'active ' : '' }} || 
                                        {{ request()->is('recruitment-exam-page') ? 'active ' : '' }} || ">
                                        <a href="#uiElements" class="has-arrow"><i class="icon-notebook"></i><span>Result</span></a>
                                        <ul>
                                            <li class="{{ request()->is('add-recruitment-exam-page') ? 'active ' : '' }}"><a href="{{ route('add-recruitment-exam-web') }}">Add Recruitment Result</a></li>
                                            <li class="{{ request()->is('recruitment-exam-page') ? 'active ' : '' }}"><a href="{{ route('recruitment-exam-web') }}">Recruitment Result</a></li>
                                        </ul>
                                    </li> -->                 
                                    <li class="
                                        {{ request()->is('add-gallery-page') ? 'active ' : '' }} || 
                                        {{ request()->is('manage-gallery-page') ? 'active ' : '' }} || "    >
                                        <a href="#uiElements" class="has-arrow"><i class="icon-notebook"></i><span>Gallery</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('add-gallery-page') ? 'active ' : '' }}"><a href="{{ route('add-gallery-web') }}">Add Gallery</a></li>
                                            <li class="{{ request()->is('manage-gallery-page') ? 'active ' : '' }}"><a href="{{ route('manage-gallery-web') }}">Manage Gallery</a></li>
                                        </ul>
                                    </li> 
                                    <li class="{{ request()->is('general-setting-page') ? 'active show' : '' }} || {{ request()->is('update-general-setting-page/*') ? 'active show' : '' }}|| {{ request()->is('add_machine') ? 'active show' : '' }} || {{ request()->is('machines') ? 'active show' : '' }} 
                                        " >
                                        <a href="#Maps" class="has-arrow"><i class="icon-settings"></i><span>Settings</span></a>
                                        <ul class="sub-menu">
                                            <li  class="{{ request()->is('general-setting-page') ? 'active show' : '' }} ||  {{ request()->is('update-general-setting-page/*') ? 'active show' : '' }} "><a href="{{ route('general-setting-web') }}">General Setings</a></li>
                                            <!--<li  class="{{ request()->is('machines') ? 'active show' : '' }} || {{ request()->is('add_machine') ? 'active show' : '' }} "><a href="{{ route('machines') }}">Machines</a></li>                      -->
                                        </ul>
                                    </li>                           
                                </ul>
                            </nav>  
                        </div>
                        @endif 
                        <div  class="tab-pane 
                                {{ request()->is('home') ? 'active show' : '' }} || 
                                {{ request()->is('userProfile') ? 'active show' : '' }} || 
                                {{ request()->is('edit_user_profile/*') ? 'active show' : '' }} || 
                                {{ request()->is('students') ? 'active show' : '' }} || 
                                {{ request()->is('student-details/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_student/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-student') ? 'active show' : '' }} || 
                                {{ request()->is('student-details') ? 'active show' : '' }} || 
                                {{ request()->is('parents') ? 'active show' : '' }} || 
                                {{ request()->is('parent_details/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_parents/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-parent') ? 'active show' : '' }} || 
                                {{ request()->is('teachers') ? 'active show' : '' }} || 
                                {{ request()->is('edit_teacher/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-teacher') ? 'active show' : '' }} || 
                                {{ request()->is('teacher-details/*') ? 'active show' : '' }} || 
                                {{ request()->is('users') ? 'active show' : '' }} || 
                                {{ request()->is('add-user') ? 'active show' : '' }} || 
                                {{ request()->is('classes') ? 'active show' : '' }} || 
                                {{ request()->is('edit_class/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_subject/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_section/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_syllabuses/*') ? 'active show' : '' }} || 
                                {{ request()->is('view_syllabuses/*') ? 'active show' : '' }} || 
                                {{ request()->is('assignments/*') ? 'active show' : '' }} || 
                                {{ request()->is('view_assignment/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_assignment/*') ? 'active show' : '' }} || 
                                {{ request()->is('edit_routine/*') ? 'active show' : '' }} ||
                                {{ request()->is('add-class') ? 'active show' : '' }} || 
                                {{ request()->is('subjects') ? 'active show' : '' }} || 
                                {{ request()->is('add-subject') ? 'active show' : '' }} || 
                                {{ request()->is('sections') ? 'active show' : '' }} || 
                                {{ request()->is('add-section') ? 'active show' : '' }} || 
                                {{ request()->is('syllabuses') ? 'active show' : '' }} || 
                                {{ request()->is('add-syllabus') ? 'active show' : '' }} || 
                                {{ request()->is('assignments') ? 'active show' : '' }} || 
                                {{ request()->is('add-assignment') ? 'active show' : '' }} || 
                                {{ request()->is('submited-assignment/*') ? 'active show' : '' }} || 
                                {{ request()->is('routine') ? 'active show' : '' }} || 
                                {{ request()->is('add-routine') ? 'active show' : '' }} || 
                                {{ request()->is('student-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('view_attn/*') ? 'active show' : '' }} || 
                                {{ request()->is('add-student-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('teacher-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('add-teacher-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('saveteacherForm') ? 'active show' : '' }} || 
                                {{ request()->is('user-attendance') ? 'active show' : '' }} || 
                                {{ request()->is('exam') ? 'active show' : '' }} ||  
                                {{ request()->is('ExamAttendenceFrom') ? 'active' : '' }} 
                                {{ request()->is('examschedule') ? 'active show' : '' }} || 
                                {{ request()->is('grade') ? 'active show' : '' }} || 
                                {{ request()->is('add_grade') ? 'active show' : '' }} || 
                                {{ request()->is('show_marks') ? 'active' : '' }} || 
                                {{ request()->is('exam_attendence') ? 'active show' : '' }} || 
                                {{ request()->is('add_exam') ? 'active show' : '' }} || 
                                {{ request()->is('edit_exam/*') ? 'active show' : '' }} || 
                                {{ request()->is('view_exam_schedule/*') ? 'active show' : '' }} || 
                                {{ request()->is('add_examschedule') ? 'active' : '' }} ||
                                {{ request()->is('edit_grade/*') ? 'active show' : '' }} || 
                                {{ request()->is('marks') ? 'active' : '' }} || 
                                {{ request()->is('add_marks') ? 'active' : '' }} ||
                                {{ request()->is('give_marks') ? 'active' : '' }} ||
                                {{ request()->is('markpercentage') ? 'active' : '' }} || 
                                {{ request()->is('edit_per/*') ? 'active' : '' }} ||
                                {{ request()->is('promotion') ? 'active' : '' }} ||
                                {{ request()->is('save_promotionForm') ? 'active' : '' }} ||
                                {{ request()->is('show_students_promotion') ? 'active' : '' }} ||
                                {{ request()->is('book_issue_students') ? 'active' : '' }} ||
                                {{ request()->is('library_members_teachers') ? 'active' : '' }} ||
                                {{ request()->is('library_members') ? 'active' : '' }} ||
                                {{ request()->is('book_issue_teachers') ? 'active' : '' }} ||
                                {{ request()->is('transport') ? 'active' : '' }} ||
                                {{ request()->is('transport_memeber') ? 'active' : '' }} || 
                                {{ request()->is('hostel') ? 'active' : '' }} ||
                                {{ request()->is('add_hostel') ? 'active' : '' }} ||
                                {{ request()->is('add_hostel_members') ? 'active' : '' }} ||
                                {{ request()->is('edit_hostel/*') ? 'active' : '' }} ||
                                {{ request()->is('edit_member/*') ? 'active' : '' }} ||
                                {{ request()->is('hostel_members') ? 'active' : '' }} ||
                                {{ request()->is('ShowHostelMembers') ? 'active' : '' }} ||
                                {{ request()->is('add-user-attendance') ? 'active show' : '' }} ||
                                {{ request()->is('give_attendance') ? 'active show' : '' }} ||
                                {{ request()->is('company_paid') ? 'active show' : '' }} ||
                                {{ request()->is('add_company_paid') ? 'active show' : '' }} ||
        
                                {{ request()->is('classes') ? 'active' : '' }} || 
                                        {{ request()->is('add-class') ? 'active' : '' }} || 
                                        {{ request()->is('edit_class/*') ? 'active' : '' }} || 
                                        {{ request()->is('subjects') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_subject/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-subject') ? 'active' : '' }} !! 
                                        {{ request()->is('sections') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_section/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-section') ? 'active' : '' }} !! 
                                        {{ request()->is('syllabuses') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_syllabuses/*') ? 'active' : '' }} !! 
                                        {{ request()->is('view_syllabuses/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-syllabus') ? 'active' : '' }} !!  
                                        {{ request()->is('assignments') ? 'active' : '' }} !! 
                                        {{ request()->is('submited-assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('view_assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-assignment') ? 'active' : '' }} !! 
                                        {{ request()->is('routine') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_routine/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-routine') ? 'active' : '' }} ||
        
                                {{ request()->is('library_members_student') ? 'active' : '' }} || 
                                        {{ request()->is('library_members_teachers') ? 'active' : '' }}  || 
                                        {{ request()->is('books') ? 'active' : '' }} || 
        
        
                                {{ request()->is('fee_types') ? 'active' : '' }} || 
                                        {{ request()->is('add_fee_types') ? 'active' : '' }} ||  
                                        {{ request()->is('edit_fee_type/*') ? 'active' : '' }} ||  
                                        {{ request()->is('invoice') ? 'active' : '' }} || 
                                        {{ request()->is('add_invoice') ? 'active' : '' }} || 
                                        {{ request()->is('view_invoice/*') ? 'active show' : '' }} || 
                                        {{ request()->is('payment_history') ? 'active' : '' }} || 
                                        {{ request()->is('showpayment_history') ? 'active show' : '' }} ||
                                        {{ request()->is('profit') ? 'active' : '' }} || 
                                        {{ request()->is('show_profit') ? 'active' : '' }} ||  
                                        {{ request()->is('expense') ? 'active' : '' }} || 
                                        {{ request()->is('add_expance') ? 'active' : '' }} || 
                                        {{ request()->is('edit_expense/*') ? 'active' : '' }} || 
                                        {{ request()->is('income') ? 'active' : '' }} ||
                                        {{ request()->is('add_income') ? 'active' : '' }} ||
                                        {{ request()->is('edit_income/*') ? 'active' : '' }} ||
        
                                {{ request()->is('class_report') ? 'active' : '' }} || 
                                        {{ request()->is('student_report') ? 'active' : '' }} || 
                                        {{ request()->is('id_card') ? 'active' : '' }} || 
                                        {{ request()->is('admit_card') ? 'active' : '' }} || 
                                        {{ request()->is('routine_report') ? 'active' : '' }} || 
                                        {{ request()->is('examschedulereport') ? 'active' : '' }} || 
                                        {{ request()->is('attendanceReport') ? 'active' : '' }} || 
                                        {{ request()->is('terminalReport') ? 'active' : '' }} || 
                                        {{ request()->is('meritstagereport') ? 'active' : '' }} || 
                                        {{ request()->is('tabulationsheetreport') ? 'active' : '' }} || 
                                        {{ request()->is('progresscardreport') ? 'active' : '' }} || 
                                        {{ request()->is('certificate') ? 'active' : '' }} || 
                                        {{ request()->is('feeReport') ? 'active' : '' }} || 
                                        {{ request()->is('balancefeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('transectionreport') ? 'active' : '' }} ||
                                        {{ request()->is('show_class_report') ? 'active' : '' }} ||
                                        {{ request()->is('showStudentReport') ? 'active' : '' }} ||
                                        
                                        {{ request()->is('idCardFrom') ? 'active' : '' }} ||
                                        {{ request()->is('adminCardFrom') ? 'active' : '' }} ||
                                        {{ request()->is('showRoutine') ? 'active' : '' }} ||
                                        {{ request()->is('showexamschedulereport') ? 'active' : '' }} ||
                                        {{ request()->is('quiz') ? 'active' : '' }} ||
                                        {{ request()->is('quiz_details/*') ? 'active' : '' }} ||
                                        {{ request()->is('showAttendance') ? 'active' : '' }} ||
                                        {{ request()->is('showterminalReport') ? 'active' : '' }} ||
                                        {{ request()->is('showMeritstagereport') ? 'active' : '' }} ||
                                        {{ request()->is('showTabulationsheetreport') ? 'active' : '' }} ||
                                        {{ request()->is('showProgresscardreport') ? 'active' : '' }} ||
                                        {{ request()->is('showCertificatereport') ? 'active' : '' }} || 
        
                                        {{ request()->is('showFeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('showBalancefeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('showTransectionreport') ? 'active' : '' }} ||
        
                                        {{ request()->is('edit_library_student_member/*') ? 'active' : '' }} || 
                                        {{ request()->is('add_library_member_student') ? 'active' : '' }} || 
                                        {{ request()->is('edit_library_member_teacher/*') ? 'active' : '' }} || 
                                        {{ request()->is('edit_issue_student/*') ? 'active' : '' }} || 
                                        {{ request()->is('add_book_issue') ? 'active' : '' }} || 
                                        {{ request()->is('edit_issue_teacher/*') ? 'active' : '' }} || 
                                        {{ request()->is('edit_book/*') ? 'active' : '' }} || 
                                        {{ request()->is('add_book') ? 'active' : '' }} || 
        
                                        {{ request()->is('add_transport') ? 'active' : '' }} || 
                                        {{ request()->is('add_transport_member') ? 'active' : '' }} || 
                                        {{ request()->is('edit_transport/*') ? 'active' : '' }} || 
                                        {{ request()->is('edit_transport_member/*') ? 'active' : '' }} ||
                                    
                                    {{ request()->is('online_admission') ? 'active' : '' }} ||
                                        {{ request()->is('view_application/*') ? 'active' : '' }} ||
                                        {{ request()->is('submitOnlineApplicationForm/*') ? 'active' : '' }} ||
                                         
                                    {{ request()->is('read_notification/*') ? 'active' : '' }} ||
                                    {{ request()->is('student_attendanceForm') ? 'active' : '' }} ||
                                    {{ request()->is('inbox') ? 'active' : '' }} ||
                                    {{ request()->is('add_inbox') ? 'active' : '' }} ||
                                    {{ request()->is('view_msg/*') ? 'active' : '' }}
        
                        " id="sms">
                            <nav id="left-sidebar-nav1" class="sidebar-nav">
                                <ul id="main-menu1" class="metismenu">
                                    <li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ route('home') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>                            
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <li class="{{ request()->is('students') ? 'active' : '' }} !! {{ request()->is('add-student') ? 'active' : '' }} !! {{ request()->is('student-details/*') ? 'active' : '' }} !! {{ request()->is('edit_student/*') ? 'active' : '' }}"><a href="{{ route('students') }}"><i class="icon-user"></i><span>Students</span></a></li>
                                    @endif
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <li class="{{ request()->is('online_admission') ? 'active' : '' }} || {{ request()->is('view_application/*') ? 'active' : '' }} || {{ request()->is('submitOnlineApplicationForm/*') ? 'active' : '' }} "><a href="{{ route('online_admission') }}"><i class="fa fa-graduation-cap"></i><span>Online Admission</span></a></li>
                                    @endif
                                    @if(Auth::user()->role != 'PARENTS')
                                    <li class="{{ request()->is('parents') ? 'active' : '' }} !! {{ request()->is('add-parent') ? 'active' : '' }} !! {{ request()->is('parent_details/*') ? 'active' : '' }} !! {{ request()->is('edit_parents/*') ? 'active' : '' }}"><a href="{{ route('parents') }}"><i class="icon-user"></i><span>Parents</span></a></li>
                                    @endif
                                    <li class="{{ request()->is('teacher-details/*') ? 'active' : '' }} !! {{ request()->is('teachers') ? 'active' : '' }} !! {{ request()->is('add-teacher') ? 'active' : '' }} !! {{ request()->is('edit_teacher/*') ? 'active' : '' }}"><a href="{{ route('teachers') }}"><i class="icon-user"></i><span>Teachers</span></a></li>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <li class="{{ request()->is('users') ? 'active' : '' }} !! {{ request()->is('add-user') ? 'active' : '' }}"><a href="{{ route('users') }}"><i class="icon-user"></i><span>User</span></a></li>
                                    @endif
        
                                    <li class="{{ request()->is('classes') ? 'active' : '' }} !! 
                                        {{ request()->is('add-class') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_class/*') ? 'active' : '' }} !! 
                                        {{ request()->is('subjects') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_subject/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-subject') ? 'active' : '' }} !! 
                                        {{ request()->is('sections') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_section/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-section') ? 'active' : '' }} !! 
                                        {{ request()->is('syllabuses') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_syllabuses/*') ? 'active' : '' }} !! 
                                        {{ request()->is('view_syllabuses/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-syllabus') ? 'active' : '' }} !!  
                                        {{ request()->is('assignments') ? 'active' : '' }} !! 
                                        {{ request()->is('view_assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-assignment') ? 'active' : '' }} !! 
                                        {{ request()->is('submited-assignment/*') ? 'active' : '' }} !! 
                                        {{ request()->is('routine') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_routine/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add-routine') ? 'active' : '' }} ">
                                        <a href="#uiElements" class="has-arrow"><i class="icon-notebook"></i><span>Academic</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('classes') ? 'active' : '' }} !! {{ request()->is('add-class') ? 'active' : '' }} !! {{ request()->is('edit_class/*') ? 'active' : '' }}"><a href="{{ route('classes') }}">Class</a></li>
                                            <li class="{{ request()->is('subjects') ? 'active' : '' }} !! {{ request()->is('edit_subject/*') ? 'active' : '' }} !! {{ request()->is('add-subject') ? 'active' : '' }}"><a href="{{ route('subjects') }}">Subject</a></li>
                                            <li  class="{{ request()->is('sections') ? 'active' : '' }} !! {{ request()->is('edit_section/*') ? 'active' : '' }} !! {{ request()->is('add-section') ? 'active' : '' }}"><a href="{{ route('sections') }}">Section</a></li>
                                            <li class="{{ request()->is('syllabuses') ? 'active' : '' }} !! {{ request()->is('edit_syllabuses/*') ? 'active' : '' }} !!  {{ request()->is('view_syllabuses/*') ? 'active' : '' }} !! {{ request()->is('add-syllabus') ? 'active' : '' }}"><a href="{{ route('syllabuses') }}">Syllabus</a></li>
                                            <li class="{{ request()->is('assignments') ? 'active' : '' }} !! {{ request()->is('view_assignment/*') ? 'active' : '' }}  !! {{ request()->is('edit_assignment/*') ? 'active' : '' }} !! {{ request()->is('add-assignment') ? 'active' : ''}}  !! {{ request()->is('submited-assignment/*') ? 'active' : '' }}"><a href="{{ route('assignments') }}">Assignment</a></li>
                                            <li class="{{ request()->is('routine') ? 'active' : '' }} !! {{ request()->is('edit_routine/*') ? 'active' : '' }} !! {{ request()->is('add-routine') ? 'active' : '' }}"><a href="{{ route('routine') }}">Routine</a></li>
                                        </ul>
                                    </li>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')
                                    <li class="{{ request()->is('student-attendance') ? 'active' : '' }} !!  
                                        {{ request()->is('add-student-attendance') ? 'active' : '' }} !! 
                                        {{ request()->is('teacher-attendance') ? 'active' : '' }} !! 
                                        {{ request()->is('add-teacher-attendance') ? 'active' : '' }} !! 
                                        {{ request()->is('saveteacherForm') ? 'active' : '' }} !! 
                                        {{ request()->is('user-attendance') ? 'active' : '' }} !! 
                                        {{ request()->is('give_attendance') ? 'active' : '' }} !!
                                        {{ request()->is('read_notification/*') ? 'active' : '' }} !!
                                        {{ request()->is('view_attn/*') ? 'active' : '' }}
                                        {{ request()->is('student_attendanceForm') ? 'active' : '' }} 
                                        ">
                                        <a href="{{ route('student-attendance') }}"><i class="icon-calendar"></i><span>Attendance</span></a>
                                    </li>
                                    @endif
                                    <li class=" 
                                        {{ request()->is('exam') ? 'active show' : '' }} !! 
                                        {{ request()->is('examschedule') ? 'active show' : '' }} !! 
                                        {{ request()->is('grade') ? 'active show' : '' }} !! 
                                        {{ request()->is('exam_attendence') ? 'active show' : '' }} !! 
                                        {{ request()->is('ExamAttendenceFrom') ? 'active' : '' }} !!
                                        {{ request()->is('add_exam') ? 'active show' : '' }} !! 
                                        {{ request()->is('add_examschedule') ? 'active show' : '' }} !! 
                                        {{ request()->is('edit_exam/*') ? 'active show' : '' }} !! 
                                        {{ request()->is('view_exam_schedule/*') ? 'active show' : '' }} !! 
                                        {{ request()->is('quiz') ? 'active show' : '' }} !!
                                        {{ request()->is('quiz_details/*') ? 'active show' : '' }} !!
                                        {{ request()->is('edit_grade/*') ? 'active show' : '' }} !!
                                        {{ request()->is('add_grade') ? 'active show' : '' }} 
        
                                        ">
                                        <a href="#Tables" class="has-arrow"><i class="icon-pencil"></i><span>Exam</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('exam') ? 'active' : '' }} !! {{ request()->is('add_exam') ? 'active' : '' }} !! {{ request()->is('edit_exam/*') ? 'active' : '' }}"><a href="{{route('exam')}}">Exam</a></li>
                                            <li class="{{ request()->is('examschedule') ? 'active' : '' }} !! {{ request()->is('view_exam_schedule/*') ? 'active' : '' }} !! {{ request()->is('add_examschedule') ? 'active' : '' }}" ><a href="{{route('examschedule')}}">Exam Schedule</a></li>
                                            <li class="{{ request()->is('grade') ? 'active' : '' }} !! {{ request()->is('add_grade') ? 'active' : '' }} !! {{ request()->is('edit_grade/*') ? 'active' : '' }}"><a href="{{route('grade')}}">Grade</a></li>

                                            <li class="{{ request()->is('quiz') ? 'active' : '' }}||{{ request()->is('quiz_details/*') ? 'active' : '' }}"><a href="{{route('quiz')}}">Quiz</a></li>
                                            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')
                                            <li class="{{ request()->is('exam_attendence') ? 'active' : '' }} !! {{ request()->is('ExamAttendenceFrom') ? 'active' : '' }}"><a href="{{route('exam_attendence')}}">Exam Attendance</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="{{ request()->is('marks') ? 'active' : '' }} !! 
                                            {{ request()->is('add_marks') ? 'active' : '' }} !! 
                                            {{ request()->is('markpercentage') ? 'active' : '' }} !! 
                                            {{ request()->is('edit_per/*') ? 'active' : '' }} !!
                                            {{ request()->is('show_marks') ? 'active' : '' }} !!
                                            {{ request()->is('give_marks') ? 'active' : '' }}!!
                                            {{ request()->is('promotion') ? 'active' : '' }} !!
                                            {{ request()->is('save_promotionForm') ? 'active' : '' }} !!
                                            {{ request()->is('show_students_promotion') ? 'active' : '' }} 
                                            ">
                                        <a href="#Tables" class="has-arrow"><i class="icon-bar-chart"></i><span>Mark</span></a>
                                        <ul class="sub-menu">
                                            
                                            <li class="{{ request()->is('marks') ? 'active' : '' }} !! {{ request()->is('show_marks') ? 'active' : '' }} !! {{ request()->is('give_marks') ? 'active' : '' }} !! {{ request()->is('add_marks') ? 'active' : '' }} "><a href="{{route('marks')}}">Mark</a></li>
                                            
                                            <!-- <li class="{{ request()->is('markpercentage') ? 'active' : '' }} !! {{ request()->is('edit_per/*') ? 'active' : '' }}"><a href="{{route('markpercentage')}} ">Mark Distribution</a></li> -->
                                            <li class="{{ request()->is('promotion') ? 'active' : '' }} !! {{ request()->is('show_students_promotion') ? 'active' : '' }}"><a href="{{route('promotion')}}">Promotion</a></li>
                                        </ul>
                                    </li>
                                    <!-- <li><a href="app-taskboard.html"><i class="icon-envelope"></i><span>Message</span></a></li>                    
                                    <li><a href="app-calendar.html"><i class="icon-grid"></i><span>Media</span></a></li>
                                    <li><a href="app-contact.html"><i class="icon-envelope"></i><span>Mail/SMS</span></a></li> -->
                                    <li class="{{ request()->is('library_members_students') ? 'active' : '' }} !! 
                                        {{ request()->is('library_members_teachers') ? 'active' : '' }}  !! 
                                        {{ request()->is('book_issue_teachers') ? 'active' : '' }} !!
                                        {{ request()->is('books') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_library_student_member/*') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_library_member_teacher/*') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_issue_student/*') ? 'active' : '' }} !! 
                                        {{ request()->is('add_book_issue') ? 'active' : '' }} !!
                                        {{ request()->is('edit_issue_teacher/*') ? 'active' : '' }} !! 
                                        {{ request()->is('edit_book/*') ? 'active' : '' }} !! 
                                        {{ request()->is('book_issue_teachers') ? 'active' : '' }} !!
                                        {{ request()->is('add_library_member_student') ? 'active' : '' }} !!
                                        {{ request()->is('add_book') ? 'active' : '' }} !!
                                        {{ request()->is('library_members') ? 'active' : '' }} !!
                                        {{ request()->is('book_issue_students') ? 'active' : '' }} !!
                                        {{ request()->is('library_members_student') ? 'active' : '' }} !!
        
                                        ">
                                        <a href="#Blog" class="has-arrow"><i class="icon-book-open"></i><span>Library</span></a>
                                        <ul class="sub-menu">
                                            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                            <li class="{{ request()->is('library_members_student') ? 'active' : '' }} !! 
                                                {{ request()->is('library_members_teachers') ? 'active' : '' }} !! 
                                                {{ request()->is('edit_library_student_member/*') ? 'active' : '' }} !!
                                                {{ request()->is('edit_library_member_teacher/*') ? 'active' : '' }} !!
                                                {{ request()->is('library_members') ? 'active' : '' }}
                                                ">
                                                <a href="" class="has-arrow"><span>Member</span></a>
        
                                                <ul>
                                                    <li class="{{ request()->is('library_members_students') ? 'active' : '' }} !! 
                                                        {{ request()->is('edit_library_student_member/*') ? 'active' : '' }} !! 
                                                        {{ request()->is('add_library_member_student/*') ? 'active' : '' }}!!
                                                        "><a href="{{route('library_members_student')}}">Students</a></li>
        
                                                    <li class="{{ request()->is('library_members_teachers') ? 'active' : '' }} !! {{ request()->is('edit_library_member_teacher/*') ? 'active' : '' }} !! 
                                                        {{ request()->is('book_issue_teachers') ? 'active' : '' }}!!
                                                        "><a href="{{route('library_members_teachers')}}">Teachers</a></li>
                                                </ul>
        
                                            </li>
                                            @endif
                                            <li class="{{ request()->is('books') ? 'active' : '' }} !! 
                                                {{ request()->is('add_book') ? 'active' : '' }} !! 
                                                {{ request()->is('edit_book/*') ? 'active' : '' }} !! 
                                                {{ request()->is('edit_issue_student/*') ? 'active' : '' }} !! 
        
                                                "><a href="{{route('books')}}">Books</a>
                                            </li>
        
                                            <li class="{{ request()->is('book_issue_students') ? 'active' : '' }} !! 
                                                {{ request()->is('edit_issue_student/*') ? 'active' : '' }} !! 
                                                {{ request()->is('book_issue_teachers') ? 'active' : '' }} !! 
                                                {{ request()->is('add_book_issue') ? 'active' : '' }} !! 
                                                {{ request()->is('edit_issue_teacher/*') ? 'active' : '' }} !! 
        
                                                ">
                                                <a href="" class="has-arrow">Issue</a>
                                                <ul class="sub-menu">
                                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'STUDENT'|| Auth::user()->role == 'PARENTS')
                                                    <li class="{{ request()->is('book_issue_students') ? 'active' : '' }} !! {{ request()->is('add_book_issue') ? 'active' : '' }}"><a href="{{route('book_issue_students')}}">Students</a></li>
                                                    @endif
        
                                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'TEACHER')
                                                    <li class="{{ request()->is('book_issue_teachers') ? 'active' : '' }} !! 
                                                        {{ request()->is('book_issue_teachers') ? 'active' : '' }}"><a href="{{route('book_issue_teachers')}}">Teachers</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'STUDENT')
                                    <li class="{{ request()->is('transport_memeber') ? 'active' : '' }} !! 
                                        {{ request()->is('add_transport') ? 'active' : '' }} !!
                                        {{ request()->is('transport') ? 'active' : '' }} !!
                                        {{ request()->is('add_transport_member') ? 'active' : '' }} !!
        
                                        {{ request()->is('edit_transport/*') ? 'active' : '' }} !!
                                        {{ request()->is('edit_transport_member/*') ? 'active' : '' }} !!
        
                                        ">
                                        <a href="#charts" class="has-arrow"><i class="icon-pointer"></i><span>Transport</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('transport') ? 'active' : '' }} !! {{ request()->is('edit_transport/*') ? 'active' : '' }}"><a href="{{route('transport')}}">Transport</a></li>
                                            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')
                                            <li class="{{ request()->is('transport_memeber') ? 'active' : '' }} !! {{ request()->is('edit_transport_member\*') ? 'active' : '' }} !! {{ request()->is('add_transport_member') ? 'active' : '' }} "><a href="{{route('transport_memeber')}}">Member</a></li>
                                            @endif
                                        </ul>
                                    </li>
        
                                    <li class="{{ request()->is('hostel') ? 'active' : '' }} !!
                                        {{ request()->is('add_hostel') ? 'active' : '' }}  !!
                                        {{ request()->is('add_hostel_members') ? 'active' : '' }}  !!
                                        {{ request()->is('edit_hostel/*') ? 'active' : '' }} !!
                                        {{ request()->is('edit_member/*') ? 'active' : '' }} !!
                                        {{ request()->is('hostel_members') ? 'active' : '' }} !!
                                        {{ request()->is('ShowHostelMembers') ? 'active' : '' }}"  >
                                        <a href="#Widgets" class="has-arrow"><i class="icon-home"></i><span>Hostel</span></a>
                                        <ul class="sub-menu">                                    
                                            <li class="{{ request()->is('hostel') ? 'active' : '' }}  !! 
                                                {{ request()->is('add_hostel') ? 'active' : '' }}  !! 
                                                {{ request()->is('edit_hostel/*') ? 'active' : '' }}"><a href="{{route('hostel')}}">Hostel</a></li>
                                            <li class="{{ request()->is('hostel_members') ? 'active' : '' }} !! 
                                                {{ request()->is('edit_member/*') ? 'active' : '' }} !! 
                                                {{ request()->is('add_hostel_members') ? 'active' : '' }} !! 
                                                {{ request()->is('ShowHostelMembers') ? 'active' : '' }}"><a href="{{route('hostel_members')}}">Member</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <li class="{{ request()->is('inbox') ? 'active' : '' }} ||
                                               {{ request()->is('add_inbox') ? 'active' : '' }} || 
                                               {{ request()->is('view_msg/*') ? 'active' : '' }} 
                                               ">
                                        <a href="{{route('inbox')}}"><i class="icon-envelope"></i><span>Inbox</span></a>
                                    </li>
                                    @endif                    
                                    <!--<li class="{{ request()->is('fee_types') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('edit_fee_type/*') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('invoice') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('add_invoice') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('view_invoice/*') ? 'active show' : '' }} !! -->
                                    <!--    {{ request()->is('payment_history') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('showpayment_history') ? 'active show' : '' }} !! -->
                                    <!--    {{ request()->is('profit') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('show_profit') ? 'active' : '' }} !!-->
                                    <!--    {{ request()->is('expense') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('add_expance') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('edit_expense/*') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('income') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('add_income') ? 'active' : '' }} !!-->
                                    <!--    {{ request()->is('edit_income/*') ? 'active' : '' }} !!-->
                                    <!--    {{ request()->is('add_fee_types') ? 'active' : '' }} !! -->
                                    <!--    {{ request()->is('company_paid') ? 'active' : '' }} !!-->
                                    <!--    {{ request()->is('add_company_paid') ? 'active' : '' }} -->
                                    <!--    ">-->
                                    <!--    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'STUDENT'|| Auth::user()->role == 'PARENTS')-->
                                    <!--    <a href="#Widgets" class="has-arrow"><i class="icon-users"></i><span>Account</span></a>-->
                                    <!--    <ul>-->
        
                                    <!--            <li class="{{ request()->is('fee_types') ? 'active' : '' }} !! {{ request()->is('edit_fee_type/*') ? 'active' : '' }} !! {{ request()->is('add_fee_types') ? 'active' : '' }} "><a href="{{route('fee_types')}}">Fee Types</a></li>-->
                                    <!--            <li class="{{ request()->is('invoice') ? 'active' : '' }} !! {{ request()->is('add_invoice') ? 'active show' : '' }}!! {{ request()->is('view_invoice/*') ? 'active show' : '' }}"><a href="{{route('invoice')}}">Invoice</a></li>-->
                                    <!--        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')-->
                                    <!--            <li class="{{ request()->is('payment_history') ? 'active' : '' }} !! {{ request()->is('showpayment_history') ? 'active show' : '' }} "><a href="{{route('payment_history')}}">Payment History</a></li>-->
                                    <!--        @endif-->
                                            
        
                                    <!--        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')-->
                                    <!--            <li class="{{ request()->is('profit') ? 'active' : '' }} !! -->
                                    <!--                {{ request()->is('show_profit') ? 'active' : '' }} !!-->
                                    <!--                "><a href="{{route('profit')}}">Profit</a></li>-->
                                    <!--            <li class="{{ request()->is('expense') ? 'active' : '' }} !! -->
                                    <!--                {{ request()->is('add_expance') ? 'active' : '' }} !! -->
                                    <!--                {{ request()->is('edit_expense/*') ? 'active' : '' }}-->
                                    <!--                "><a href="{{route('expense')}}">Expense</a></li>-->
                                    <!--            <li class="{{ request()->is('income') ? 'active' : '' }} !! -->
                                    <!--                {{ request()->is('add_income') ? 'active' : '' }} !! -->
                                    <!--                {{ request()->is('edit_income/*') ? 'active' : '' }}-->
                                    <!--                "><a href="{{route('income')}}">Income</a></li>-->
        
                                    <!--                 <li class="{{ request()->is('add_company_paid') ? 'active' : '' }} !!-->
                                    <!--                {{ request()->is('company_paid') ? 'active' : '' }}-->
                                    <!--                "><a href="{{route('company_paid')}}">Company Paid</a></li> -->
        
                                    <!--        @endif-->
                                    <!--    </ul>-->
                                    <!--    @endif-->
                                    <!--</li>-->
                                    <li>
                                        <a href="{{route('index')}}"> 
                                        <i class="fa fa-comments"></i> Discussion forum </a>
                                    </li>
                                    <li class="{{ request()->is('class_report') ? 'active' : '' }} || 
                                        {{ request()->is('student_report') ? 'active' : '' }} || 
                                        {{ request()->is('id_card') ? 'active' : '' }} || 
                                        {{ request()->is('admit_card') ? 'active' : '' }} || 
                                        {{ request()->is('routine_report') ? 'active' : '' }} || 
                                        {{ request()->is('examschedulereport') ? 'active' : '' }} || 
                                        {{ request()->is('attendanceReport') ? 'active' : '' }} || 
                                        {{ request()->is('terminalReport') ? 'active' : '' }} || 
                                        {{ request()->is('meritstagereport') ? 'active' : '' }} || 
                                        {{ request()->is('tabulationsheetreport') ? 'active' : '' }} || 
                                        {{ request()->is('progresscardreport') ? 'active' : '' }} || 
                                        {{ request()->is('certificate') ? 'active' : '' }} || 
                                        {{ request()->is('feeReport') ? 'active' : '' }} || 
                                        {{ request()->is('balancefeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('transectionreport') ? 'active' : '' }} ||
                                        {{ request()->is('show_class_report') ? 'active' : '' }} ||
                                        {{ request()->is('showStudentReport') ? 'active' : '' }} ||
        
        
                                        {{ request()->is('idCardFrom') ? 'active' : '' }} ||
                                        {{ request()->is('adminCardFrom') ? 'active' : '' }} ||
                                        {{ request()->is('showRoutine') ? 'active' : '' }} ||
                                        {{ request()->is('showexamschedulereport') ? 'active' : '' }} ||
                                        {{ request()->is('showAttendance') ? 'active' : '' }} ||
                                        {{ request()->is('showterminalReport') ? 'active' : '' }} ||
                                        {{ request()->is('showMeritstagereport') ? 'active' : '' }} ||
                                        {{ request()->is('showTabulationsheetreport') ? 'active' : '' }} ||
                                        {{ request()->is('showProgresscardreport') ? 'active' : '' }} ||
                                        {{ request()->is('showCertificatereport') ? 'active' : '' }} ||
        
                                        {{ request()->is('showFeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('showBalancefeesreport') ? 'active' : '' }} || 
                                        {{ request()->is('showTransectionreport') ? 'active' : '' }} ||
        
                                        ">
                                        <a href="#Pages" class="has-arrow"><i class="icon-docs"></i><span>Report</span></a>
                                        <ul class="sub-menu">
                                            <li class="{{ request()->is('class_report') ? 'active' : '' }} || {{ request()->is('show_class_report') ? 'active' : '' }}"><a href="{{route('class_report')}}">Class Report</a></li>
                                            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                            <li class="{{ request()->is('student_report') ? 'active' : '' }} !! {{ request()->is('showStudentReport') ? 'active' : '' }} "><a href="{{route('student_report')}}">Student Report</a></li>
                                            <li class="{{ request()->is('id_card') ? 'active' : '' }} || {{ request()->is('idCardFrom') ? 'active' : '' }}"><a href="{{route('id_card')}}">ID Card Report </a></li>
                                            <li class="{{ request()->is('admit_card') ? 'active' : '' }} || {{ request()->is('adminCardFrom') ? 'active' : '' }}"><a href="{{route('admit_card')}}">Admit Card Report </a></li>                                  
                                            <li class="{{ request()->is('routine_report') ? 'active' : '' }} || {{ request()->is('showRoutine') ? 'active' : '' }}"><a href="{{route('routine_report')}}">Routine </a></li>
                                            @endif
                                            <li class="{{ request()->is('examschedulereport') ? 'active' : '' }} || {{ request()->is('showexamschedulereport') ? 'active' : '' }}"><a href="{{route('examschedulereport')}}">Exam Schedule Report </a></li>
                                            <!-- <li><a href="page-timeline.html">Attendance Report</a></li> -->
                                            @if(Auth::user()->role != 'TEACHER')
                                            <li class="{{ request()->is('attendanceReport') ? 'active' : '' }} || {{ request()->is('showAttendance') ? 'active' : '' }}"><a href="{{route('attendanceReport')}}">Attendance Overview Report</a></li>
                                            @endif
                                            <li class="{{ request()->is('terminalReport') ? 'active' : '' }} || {{ request()->is('showterminalReport') ? 'active' : '' }}"><a href="{{route('terminalReport')}}">Terminal Report</a></li>
                                            <li class="{{ request()->is('meritstagereport') ? 'active' : '' }} || {{ request()->is('showMeritstagereport') ? 'active' : '' }}"><a href="{{route('meritstagereport')}}">Marit Stage Report</a></li>                            
                                            <li class="{{ request()->is('tabulationsheetreport') ? 'active' : '' }} || {{ request()->is('showTabulationsheetreport') ? 'active' : '' }}"><a href="{{route('tabulationsheetreport')}}">Tabulation Sheet Report</a></li>
                                            <!-- <li><a href="page-testimonials.html">Mark Sheet Report</a></li> -->
                                            <li class="{{ request()->is('progresscardreport') ? 'active' : '' }} || {{ request()->is('showProgresscardreport') ? 'active' : '' }}"><a href="{{route('progresscardreport')}}">Progress Card Report</a></li>
                                            <!-- <li><a href="page-faq.html">Online Exam Report</a></li> -->
                                            <!-- <li class="{{ request()->is('certificate') ? 'active' : '' }} || {{ request()->is('showCertificatereport') ? 'active' : '' }}"><a href="{{route('certificate')}}">Certificate Report</a></li> -->
        
                                            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                            <li class="{{ request()->is('feeReport') ? 'active' : '' }} || {{ request()->is('showFeesreport') ? 'active' : '' }}"><a href="{{route('feeReport')}}">Fees Report</a></li>
                                            <!-- <li><a href="page-faq.html">Due Fees Report</a></li> -->
                                            <li class="{{ request()->is('balancefeesreport') ? 'active' : '' }} || {{ request()->is('showBalancefeesreport') ? 'active' : '' }}"><a href="{{route('balancefeesreport')}}">Blance Fees Report</a></li>
                                            <li class="{{ request()->is('transectionreport') ? 'active' : '' }} || {{ request()->is('showTransectionreport') ? 'active' : '' }}"><a href="{{route('transectionreport')}}">Transection  Report</a></li>
                                            <!-- <li><a href="page-faq.html">Student Fine  Report</a></li> -->
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </nav>  
                        </div>
                    </div>
            </div>
            </div>
        </div>
        <div id="main-content">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>{{ $title }}</h2>
                    </div>            
                    <div class="col-md-6 col-sm-12 text-right">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ul>
                        
                    </div>
                </div>
            </div>
    
            @yield('content')
            
            <div class="block-footer" style="bottom: 10px;top: 100%;left: 4%;position: absolute;">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12 text-right"></div>
                        <div class="copyright-text">
                            <p style="bottom: 10px;top: 100%;left: 4%;width:100%;">Copyright &COPY; 2021 <a href="http://www.whitepaper.com/" style="color:green;font-weight:bold;">Powered by: Whitepaper </a>. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>

<!-- Javascript -->
<script src="{{ asset('SMS/assets/bundles/libscripts.bundle.js') }}"></script>    
<script src="{{ asset('SMS/assets/bundles/vendorscripts.bundle.js') }}"></script>

<script src="{{ asset('SMS/assets/vendor/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('SMS/assets/js/pages/forms/dropify.js') }}"></script>

<script src="{{ asset('SMS/assets/vendor/summernote/dist/summernote.js') }}"></script>
<script src="{{ asset('SMS/assets/bundles/knob.bundle.js') }}"></script><!-- Jquery Knob-->
<script>
    $(function () {
        $('.knob').knob({
            draw: function () {           
            }
        });
    });    
</script>
<script>
    jQuery(document).ready(function(){
        jQuery(".btn-toggle-offcanvas").click(function(){
            jQuery("#left-sidebar").css("left", "0");
        });
        jQuery(".close-btn").click(function(){
            jQuery("#left-sidebar").css("left", "-250px");
        });
    });
</script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/buttons.flash.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('SMS/assets/js/export-data-table-js/buttons.print.min.js') }}"></script>

<script type="text/javascript">
   $(document).ready(function() {
    $('#tableid').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    } );
} );
</script>
<script src="{{ asset('SMS/assets/vendor/sweetalert/sweetalert.min.js') }}"></script><!-- SweetAlert Plugin Js --> 


<script src="{{ asset('SMS/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('SMS/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('SMS/assets/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('SMS/assets/js/bootbox.min.js') }}"></script>
<script>
    $(document).on("click", "#delete", function(e){
      e.preventDefault();
      var link = $(this).attr("href");
      bootbox.confirm("Are you sure!! You want to Delete This ??",function(confirmed){

        if(confirmed){
          window.location.href = link;
        };
      });
    });
  </script>

 <script>
    $(document).on("click", "#return", function(e){
      e.preventDefault();
      var link = $(this).attr("href");
      bootbox.confirm("Did he return the book ??",function(confirmed){

        if(confirmed){
          window.location.href = link;
        };
      });
    });
  </script>
<script>
        $(document).ready(function(){
            var my_time;
            $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: '/count-messages/',
                    method: 'get',
                    success: function(result){
                        if (result!=0) {

                            $('#dataText').html(result);
                            $('#count_msg').html('<span style="background-color: #c02f2c; padding:5px 10px; font-weight: bold;"><span>'+result+'</span>');
                        }else{
                            $('#dataText').html('0');
                            $('#count_msg').html('');
                        }
                    }
                });
            $.ajax({
                    url: '/get-messages/',
                    method: 'get',
                    success: function(result){
                        // $('#msg_title').html(result);
                        // $('#msg_short').html(result);
                        // .append('<option value="">Select Subject</option>'); 
                            for ( var i = 0, l = result.length; i < l; i++ ) {
                                var id = result[i].message_id;
                                var link = "/view_msg/"+id;
                                $("#MyMsg").append('<a href="'+link+'" style="border:none;border-bottom:1px solid #ccc;padding:0px;color:green"><h4 style="font-size: 18px;line-height: 1px;padding-top: 15px;">'+result[i].inbox_title+'</h4></a>'+
                                '<p style="margin-top:15px;font-size:13px !important;">'+result[i].inbox_short_description+'</p>'+
                                '<small style="color: #4390b1;" class="timeago" datetime='+result[i].created_at+'>'+result[i].created_at+'</small></div>');

                                $('#myid').html(id);
                                
                            }
                        }
                    });
 
        });


    </script>
</html>
