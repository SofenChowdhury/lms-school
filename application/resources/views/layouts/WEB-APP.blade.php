<?php
    use App\Setting;
    use App\ImportantLink;
    use App\SchoolInfo;
    
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
	$manage_links = ImportantLink::where('school_id', $school_id)->limit(1)->get();	
	$settings     = Setting::where('school_id', $school_id)->get();
	foreach($settings as $key){
	    $sch_name           = $key->name;
        $sch_icon           = $key->imge;
        $sch_logo_banner    = $key->logo_banner;
        $sch_address        = $key->address;
        $sch_phone          = $key->phone;
	    $sch_email          = $key->email;
	}
    $changelanguage = Session::get('language');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$sch_name}}</title> 
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('uploads').'/'.$sch_icon}}" />      
        <link href="{{ asset('website/assets/css/bootstrap.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('website/assets/css/owl.carousel.min.css') }}" media="all" />
        <link href="{{ asset('website/assets/css/bootstrap-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/iconmoon.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/chosen.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/jquery.mobile-menu.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/style.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/cs-smartstudy-plugin.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/lightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/color.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/widget.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/responsive.css') }}" rel="stylesheet">
        
        <link href="{{ asset('website/assets/css/slick.min.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('website/assets/css/animated-slider.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        <script src="{{ asset('website/assets/scripts/jquery.js') }}"></script>
        <script src="{{ asset('website/assets/scripts/modernizr.js') }}"></script>
        <script src="{{ asset('website/assets/scripts/bootstrap.min.js') }}"></script>
        <style type="text/css">
            .menu_active{
                background: #88c238;
                padding: 0 10px !important;
                color:#fff;
            }
            .ctg_active{
               color:#88c238 !important;
               font-size: 16px !important;;
               font-weight: 900 !important; 
               
            }
        </style>
    </head>
    <body class="wp-smartstudy">
        <div class="wrapper"> 
            <!-- Side Menu Start -->
            <div id="overlay"></div>
            <div id="mobile-menu">
                <ul>
                    <li >Home</a></li>
                    <li class="menu-item-has-children"><a href="javascript: avoid(0)">About</a>
                        <ul>
                            <li><a href="{{ route('about-history-page') }}">History</a></li>
                            <li><a href="{{ route('chairman-message-page') }}"> Chairman Message</a></li>
                            <li><a href="{{ route('principal-message-page') }}"> Principal Message </a></li>
                            <li><a href="{{ route('principal-message-page') }}">Presidency Message</a></li>
                            <li><a href="{{ route('mission-vision-page') }}">Mission & Vision</a></li>
                            <li><a href="{{ route('governing-Body-page') }}">Governing Body</a></li>
                            <li><a href="{{ route('infrastructure-page') }}">Infrastructure</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="javascript: avoid(0)">Academic</a>
                        <ul>
                            <li><a href="{{ route('dress-code-page') }}">Dress Code</a></li>
                            <li><a href="{{ route('academic-calendar-page') }}">Academic Calendar</a></li>
                            <li><a href="{{ route('book-list-and-syllabus-page') }}">Book List & Syllabus</a></li>
                            <li><a href="{{ route('class-routine-page') }}">Class Routine</a></li>
                            <li><a href="{{ route('exam-routine-page') }}">Exam Routine</a></li>
                            <li><a href="{{ route('teachers-and-staffs-page') }}">Teachers and Staffs</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="javascript: avoid(0)">Information</a>
                        <ul>
                            <li><a href="{{ route('news-page') }}">News</a></li>
                            <li><a href="{{ route('notice-page') }}">Notice</a></li>
                            <li><a href="{{ route('event-page') }}">Events</a></li>
                            <li><a href="{{ route('academic-calendar-page') }}">Holiday List</a></li>
                            <li><a href="{{ route('policies-and-guidelines-page') }}">Policies and Guidelines</a></li>
                            <li><a href="{{ route('facilities-page') }}">Facilities</a></li>
                            <li><a href="{{ route('library-page') }}">Library</a></li>
                            <li><a href="{{ route('it-page') }}">IT</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="javascript: avoid(0)">Admission</a>
                        <ul>
                            <li><a href="{{ route('admission-circular-page') }}">Admission Information</a></li>
                            <li><a href="{{ route('admission-form-page') }}">Admission Form</a></li>
                            <!-- <li><a href="{{ route('admission-result-page') }}">Admission Result</a></li> -->
                            <li><a href="{{ route('fees-and-payments-page') }}">Fees and payments</a></li>
                            <li><a href="{{ route('prospectus-page') }}">Prospectus</a></li>
                            <li><a href="{{ route('scholarships-page') }}">Scholarships</a></li>
                        </ul>
                    </li>
                    <!--<li class="menu-item-has-children"><a href="javascript: avoid(0)">Result</a>-->
                    <!--    <ul>-->
                    <!--        <li><a href="http://www.educationboardresults.gov.bd">Public Exam Result</a></li>-->
                    <!--        <li><a href="{{ route('result-page') }}">Recruitment Result</a></li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                    <li><a href="{{ route('gallery-page') }}">Gallery</a></li>
                    <li><a href="{{ route('contact-us-page') }}">Contact</a></li>
                </ul>
            </div>
            <!-- Side Menu End -->

            <!-- Header Start -->
            <header id="header" class=""> 
                <div class="top-bar" style="background-image: url('{{asset('website/assets/images/istockphoto-1189407772-1024x1024.jpg')}}');background-size: cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                @foreach($settings as $setting)
                                <ul class="top-nav nav-left">
                                    <li><a href="">{{$setting->phone}}</a></li>
                                    <li><a href="">{{$setting->email}}</a></li>
                                </ul>
                                @endforeach
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="cs-user">

                                    @if(!Auth::user())
                                    <select style="background-color: transparent; border: 1px solid lightgray;color: white;" id="login">
                                        <option value="" style="color:black;">Select Login</option>
                                        <option value="" style="color:black;">Admin/Supper Admin</option>
                                        <option value="" style="color:black;">Teachers</option>
                                        <option value="" style="color:black;">Parents</option>
                                        <option value="" style="color:black;">Students</option>
                                    </select>
                                    @else
                                    <ul>
                                        <li style="margin-right: 60px;">
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> Logout
                                            </a>
                
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    @if($sch_logo_banner)
                        <img src="{{asset('uploads').'/'.$sch_logo_banner}}" style="width: 100%; height: 150px;">
                    @endif
                </div>
                <div class="main-header news" >
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                @if(!$sch_logo_banner)
                                    <div class="cs-logo cs-logo-dark">
                                        <div class="cs-media">
                                         <a href="{{ route('indexpage') }}"><img src="{{ asset('uploads/'.$key->image) }}" alt="" style="height: 45px"  /></a>
                                        </div>
                                    </div>
                                    <div class="cs-logo cs-logo-light">
                                        <div class="cs-media">
                                            <a href="{{ route('indexpage') }}"><img src="{{ asset('uploads/'.$key->image) }}"  style="height: 45px" alt="" /></a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                <div class="cs-main-nav pull-right">
                                    @if($changelanguage == 1)
                                    
                                    @else
                                    <nav class="main-navigation">
                                        <ul>
                                            <li class="{{ request()->is('index') ? 'menu_active': '' }} "><a href="{{ route('indexpage') }}">Home</a></li>
                                            <li class="menu-item-has-children  
                                                {{ request()->is('about-history') ? 'menu_active': '' }} || 
                                                {{ request()->is('chairman-message') ? 'menu_active': '' }} || 
                                                {{ request()->is('principal-message') ? 'menu_active': '' }} || 
                                                {{ request()->is('presidency-message') ? 'menu_active': '' }} || 
                                                {{ request()->is('mission-vision') ? 'menu_active': '' }} || 
                                                {{ request()->is('governing-Body') ? 'menu_active': '' }} || 
                                                {{ request()->is('infrastructure') ? 'menu_active': '' }} || 
                                                 "><a href="javascript: avoid(0)">About</a>
                                                <ul>
                                                    <li><a href="{{ route('about-history-page') }}">History</a></li>
                                                    <li><a href="{{ route('chairman-message-page') }}"> Chairman Message</a></li>
                                                    <li><a href="{{ route('principal-message-page') }}"> Principal Message </a></li>
                                                    <li><a href="{{ route('presidency-message-page') }}">Presidency Message</a></li>
                                                    <li><a href="{{ route('mission-vision-page') }}">Mission & Vision</a></li>
                                                    <li><a href="{{ route('governing-Body-page') }}">Governing Body</a></li>
                                                    <li><a href="{{ route('infrastructure-page') }}">Infrastructure</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children  
                                                {{ request()->is('dress-code') ? 'menu_active': '' }} || 
                                                {{ request()->is('academic-calendar') ? 'menu_active': '' }} || 
                                                {{ request()->is('book-list-and-syllabus') ? 'menu_active': '' }} || 
                                                {{ request()->is('class-routine') ? 'menu_active': '' }} || 
                                                {{ request()->is('exam-routine') ? 'menu_active': '' }} || 
                                                {{ request()->is('teachers-and-staffs') ? 'menu_active': '' }} || 
                                                {{ request()->is('showExamSchedule') ? 'menu_active': '' }} ||
                                                {{ request()->is('showClassRoutins') ? 'menu_active': '' }} ||
                                                {{ request()->is('teacher-details-page/*') ? 'menu_active': '' }}
                                                "><a href="javascript: avoid(0)">Academic</a>
                                                <ul>
                                                    <li><a href="{{ route('dress-code-page') }}">Dress Code</a></li>
                                                    <li><a href="{{ route('academic-calendar-page') }}">Academic Calendar</a></li>
                                                    <li><a href="{{ route('book-list-and-syllabus-page') }}">Book List & Syllabus</a></li>
                                                    <li><a href="{{ route('class-routine-page') }}">Class Routine</a></li>
                                                    <li><a href="{{ route('exam-routine-page') }}">Exam Routine</a></li>
                                                    <li><a href="{{ route('teachers-and-staffs-page') }}">Teachers and Staffs</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children 
                                                {{ request()->is('news') ? 'menu_active': '' }} || 
                                                {{ request()->is('notice') ? 'menu_active': '' }} || 
                                                {{ request()->is('event') ? 'menu_active': '' }} || 
                                                {{ request()->is('policies-and-guidelines') ? 'menu_active': '' }} || 
                                                {{ request()->is('facilities') ? 'menu_active': '' }} || 
                                                {{ request()->is('library') ? 'menu_active': '' }} || 
                                                {{ request()->is('it') ? 'menu_active': '' }} || 
                                                "><a href="javascript: avoid(0)">Information</a>
                                                <ul>
                                                    <li><a href="{{ route('news-page') }}">News</a></li>
                                                    <li><a href="{{ route('notice-page') }}">Notice</a></li>
                                                    <li><a href="{{ route('event-page') }}">Events</a></li>
                                                    <li><a href="{{ route('policies-and-guidelines-page') }}">Policies and Guidelines</a></li>
                                                    <li><a href="{{ route('facilities-page') }}">Facilities</a></li>
                                                    <li><a href="{{ route('library-page') }}">Library</a></li>
                                                    <li><a href="{{ route('it-page') }}">IT</a></li>
                                                </ul>
                                            </li> 
                                            <li class="menu-item-has-children 
                                                {{ request()->is('admission-circular') ? 'menu_active': '' }} || 
                                                {{ request()->is('admission-form') ? 'menu_active': '' }} || 
                                                {{ request()->is('admission-result') ? 'menu_active': '' }} || 
                                                {{ request()->is('fees-and-payments') ? 'menu_active': '' }} || 
                                                {{ request()->is('prospectus') ? 'menu_active': '' }} || 
                                                {{ request()->is('scholarships') ? 'menu_active': '' }} || 
                                                "><a href="javascript: avoid(0)">Admission</a>
                                                <ul>
                                                    <li><a href="{{ route('admission-circular-page') }}">Admission Information</a></li>
                                                    <li><a href="{{ route('admission-form-page') }}">Admission Form</a></li>
                                                    <!-- <li><a href="{{ route('admission-result-page') }}">Admission Result</a></li> -->
                                                    <li><a href="{{ route('fees-and-payments-page') }}">Fees and payments</a></li>
                                                    <li><a href="{{ route('prospectus-page') }}">Prospectus</a></li>
                                                    <li><a href="{{ route('scholarships-page') }}">Scholarships</a></li>
                                                </ul>
                                            </li>
                                            <!--<li class="menu-item-has-children {{ request()->is('result') ? 'menu_active': '' }} "><a href="javascript: avoid(0)">Result</a>-->
                                            <!--    <ul>-->
                                            <!--        <li><a href="http://www.educationboardresults.gov.bd/">Public Exam Result</a></li>-->
                                                    <!-- <li><a href="{{ route('result-page') }}">Recruitment Result</a></li> -->
                                            <!--    </ul>-->
                                            <!--</li>-->
                                            <li class="{{ request()->is('gallery') ? 'menu_active': '' }} "><a href="{{ route('gallery-page') }}">Gallery</a></li>
                                            <li class="{{ request()->is('contact-us') ? 'menu_active': '' }} "><a href="{{ route('contact-us-page') }}">Contact</a></li>
                                        </ul>
                                    </nav>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </header>
            <!-- Header End --> 
                @yield('content')

                <!-- Footer Start -->
                <footer style="background-image: url('https://png.pngtree.com/thumb_back/fw800/back_our/20190622/ourmid/pngtree-cartoon-school-kids-going-to-school-background-image_216409.jpg');background-size: cover;color:white;"> 
                    <div class="cs-footer-widgets" id="footer" style="background-color: rgba(136,194,56,0.7)">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="widget widget-text">
                                        @foreach($settings as $settings)
                                        <div class="widget-section-title">
                                            <a href="{{route('indexpage')}}">
                                                <img src="{{ asset('uploads').'/'.$settings->image }}" alt="" style="width: 60%;" />
                                            </a>
                                        </div>
                                        <p style="text-align: justify; font-size: 20px;color:white;">{{$settings->name}}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="widget widget-categores">
                                        <div class="widget-section-title"><h6 style="color:#fff !important;color:white;">Admission Information</h6></div>
                                        <ul>
                                            <li><a href="{{ route('admission-circular-page') }}" style="color:white;">Admission Information</a></li>
                                            <li><a href="{{ route('admission-form-page') }}" style="color:white;">Admission Form</a></li>
                                            <!-- <li><a href="{{ route('admission-result-page') }}">Admission Result</a></li> -->
                                            <li><a href="{{ route('prospectus-page') }}" style="color:white;">Prospectus</a></li>
                                            <li><a href="{{ route('scholarships-page') }}" style="color:white;">Scholarships</a></li>
                                        </ul>	
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="widget widget-useful-links">
                                        <div class="widget-section-title"><h6 style="color:#fff !important">Important Link</h6></div>
                                        <ul>
                                            @foreach($manage_links as $links)
                                            <li><a target="_blank" href="{{$links->links}}" style="color:white;">{{$links->title}}</a></li>
                                            @endforeach
                                        </ul>	
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="widget widget-text">
                                        <div class="widget-section-title"><h6 style="color:#fff !important">Contact us</h6></div>

                                        <ul>
                                            <li>
                                                <i class="icon-light-bulb "></i>
                                                <p style="color:white !important;">{{$sch_address}}</p>
                                            </li>
                                            <li>
                                                <i class="icon-phone3"></i>
                                                <p style="color:white !important;">{{$sch_phone}}</p>
                                            </li>
                                            <li>
                                                <i class="icon-mail"></i>
                                                <p><a href="mailto:{{$sch_email}}" style="color:white;">{{$sch_email}}</a></p>
                                            </li>
                                        
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-copyright" style="background-color: #4b8c19bf;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="copyright-text">
                                        <p>Copyright &COPY; 2021 <a href="http://www.whitepaper.com/" style="color:white;">Powered by: Whitepaper </a>. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- Footer End --> 
            </div>
        </div>
        <script src="{{ asset('website/assets/scripts/responsive.menu.js') }}"></script> <!-- Slick Nav js --> 
        <script src="{{ asset('website/assets/scripts/chosen.select.js') }}"></script> <!-- Chosen js --> 
        <script src="{{ asset('website/assets/scripts/slick.js') }}"></script> <!-- Slick Slider js --> 
        <script src="{{ asset('website/assets/scripts/jquery.mCustomScrollbar.concat.min.js') }}"></script> 
        <script src="{{ asset('website/assets/scripts/jquery.mobile-menu.min.js') }}"></script><!-- Side Menu js --> 
        <script src="{{ asset('website/assets/scripts/counter.js') }}"></script><!-- Counter js --> 
        <script type="text/javascript" src="{{ asset('website/assets/scripts/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('website/assets/scripts/script.j') }}s"></script>
        <script type="text/javascript" src="{{ asset('website/assets/js/lightbox.min.js') }}"></script>
        
        <script type="text/javascript" src="{{ asset('website/assets/js/slick.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('website/assets/js/slider.script.js') }}"></script>
        <script type="text/javascript" src="{{ asset('website/assets/js/animated-slider.js') }}"></script>

        <!-- Put all Functions in functions.js --> 
        <script src="{{ asset('website/assets/scripts/functions.js') }}"></script>
        
        <script>
            $('#login').change(function(){
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                window.location.replace("/lms-school/login/");
            });
        </script>
    </body>
</html>