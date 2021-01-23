@extends('layouts.frontend_layout')
@section('contents')
<!-- PROFILE HEADER -->
<div class="profile-header" style="border-radius: 0px;margin-top: -1.5%;">
  	<!-- PROFILE HEADER COVER -->
  	<figure class="profile-header-cover liquid" style="border-radius: 0px;">
    	<img src="{{asset('assets/frontend/img/cover/01.jpg')}}" alt="cover-01">
  	</figure>
  	<!-- /PROFILE HEADER COVER -->

  	<!-- PROFILE HEADER INFO -->
  	<div class="profile-header-info">
        <!-- USER SHORT DESCRIPTION -->
        <div class="user-short-description big">
          <!-- USER SHORT DESCRIPTION AVATAR -->
          	<a class="user-short-description-avatar user-avatar big" href="{{route('profile')}}">
	            <!-- USER AVATAR BORDER -->
	            <div class="user-avatar-border">
	              <!-- HEXAGON -->
	              <div class="hexagon-148-164"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR BORDER -->
	        
	            <!-- USER AVATAR CONTENT -->
	            <div class="user-avatar-content">
	              <!-- HEXAGON -->
	              <div class="hexagon-image-100-110" data-src="{{asset('assets/frontend/img/avatar/01.jpg')}}"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR CONTENT -->
	        
	            <!-- USER AVATAR PROGRESS -->
	            <div class="user-avatar-progress">
	              <!-- HEXAGON -->
	              <div class="hexagon-progress-124-136"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR PROGRESS -->
	        
	            <!-- USER AVATAR PROGRESS BORDER -->
	            <div class="user-avatar-progress-border">
	              <!-- HEXAGON -->
	              <div class="hexagon-border-124-136"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR PROGRESS BORDER -->
	        
	            <!-- USER AVATAR BADGE -->
	            <div class="user-avatar-badge">
	              	<!-- USER AVATAR BADGE BORDER -->
	              	<div class="user-avatar-badge-border">
		                <!-- HEXAGON -->
		                <div class="hexagon-40-44"></div>
		                <!-- /HEXAGON -->
	              	</div>
	              	<!-- /USER AVATAR BADGE BORDER -->
	        
	              	<!-- USER AVATAR BADGE CONTENT -->
	              	<div class="user-avatar-badge-content">
	                	<!-- HEXAGON -->
	                	<div class="hexagon-dark-32-34"></div>
	                	<!-- /HEXAGON -->
	              	</div>
	              	<!-- /USER AVATAR BADGE CONTENT -->
	        
	              	<!-- USER AVATAR BADGE TEXT -->
	              	<p class="user-avatar-badge-text">24</p>
	              	<!-- /USER AVATAR BADGE TEXT -->
	            </div>
	            <!-- /USER AVATAR BADGE -->
          	</a>
          	<!-- /USER SHORT DESCRIPTION AVATAR -->
  
          	<!-- USER SHORT DESCRIPTION AVATAR -->
	        <a class="user-short-description-avatar user-short-description-avatar-mobile user-avatar medium" href="profile-timeline.html">
	            <!-- USER AVATAR BORDER -->
	            <div class="user-avatar-border">
	              <!-- HEXAGON -->
	              <div class="hexagon-120-132"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR BORDER -->
	        
	            <!-- USER AVATAR CONTENT -->
	            <div class="user-avatar-content">
	              <!-- HEXAGON -->
	              <div class="hexagon-image-82-90" data-src="{{asset('assets/frontend/img/avatar/01.jpg')}}"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR CONTENT -->
	        
	            <!-- USER AVATAR PROGRESS -->
	            <div class="user-avatar-progress">
	              <!-- HEXAGON -->
	              <div class="hexagon-progress-100-110"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR PROGRESS -->
	        
	            <!-- USER AVATAR PROGRESS BORDER -->
	            <div class="user-avatar-progress-border">
	              <!-- HEXAGON -->
	              <div class="hexagon-border-100-110"></div>
	              <!-- /HEXAGON -->
	            </div>
	            <!-- /USER AVATAR PROGRESS BORDER -->
	        
	            <!-- USER AVATAR BADGE -->
	            <div class="user-avatar-badge">
	              	<!-- USER AVATAR BADGE BORDER -->
	              	<div class="user-avatar-badge-border">
		                <!-- HEXAGON -->
		                <div class="hexagon-32-36"></div>
		                <!-- /HEXAGON -->
	              	</div>
	              	<!-- /USER AVATAR BADGE BORDER -->
	        
	              	<!-- USER AVATAR BADGE CONTENT -->
	              	<div class="user-avatar-badge-content">
		                <!-- HEXAGON -->
		                <div class="hexagon-dark-26-28"></div>
		                <!-- /HEXAGON -->
	              	</div>
	              	<!-- /USER AVATAR BADGE CONTENT -->
	        
	              	<!-- USER AVATAR BADGE TEXT -->
	              	<p class="user-avatar-badge-text">24</p>
	              	<!-- /USER AVATAR BADGE TEXT -->
	            </div>
	            <!-- /USER AVATAR BADGE -->
	        </a>
          	<!-- /USER SHORT DESCRIPTION AVATAR -->
    
          	<!-- USER SHORT DESCRIPTION TITLE -->
          	<p class="user-short-description-title"><a href="{{route('profile')}}">Marina Valentine</a></p>
          	<!-- /USER SHORT DESCRIPTION TITLE -->
    
          	<!-- USER SHORT DESCRIPTION TEXT -->
          	<p class="user-short-description-text"><a href="#">www.gamehuntress.com</a></p>
          	<!-- /USER SHORT DESCRIPTION TEXT -->
        </div>
        <!-- /USER SHORT DESCRIPTION -->
  
        <!-- PROFILE HEADER SOCIAL LINKS WRAP -->
        <div class="profile-header-social-links-wrap">
          	<!-- PROFILE HEADER SOCIAL LINKS -->
          	<div id="profile-header-social-links-slider" class="profile-header-social-links">
	            <div class="profile-header-social-link">
	              <!-- SOCIAL LINK -->
	              <a class="social-link facebook" href="#">
	                <!-- ICON FACEBOOK -->
	                <svg class="icon-facebook">
	                  <use xlink:href="#svg-facebook"></use>
	                </svg>
	                <!-- /ICON FACEBOOK -->
	              </a>
	              <!-- /SOCIAL LINK -->
	            </div>
	      
	            <div class="profile-header-social-link">
	              <!-- SOCIAL LINK -->
	              <a class="social-link twitter" href="#">
	                <!-- ICON TWITTER -->
	                <svg class="icon-twitter">
	                  <use xlink:href="#svg-twitter"></use>
	                </svg>
	                <!-- /ICON TWITTER -->
	              </a>
	              <!-- /SOCIAL LINK -->
	            </div>
	  
	            <div class="profile-header-social-link">
	              <!-- SOCIAL LINK -->
	              <a class="social-link instagram" href="#">
	                <!-- ICON INSTAGRAM -->
	                <svg class="icon-instagram">
	                  <use xlink:href="#svg-instagram"></use>
	                </svg>
	                <!-- /ICON INSTAGRAM -->
	              </a>
	              <!-- /SOCIAL LINK -->
	            </div>
          	</div>
          	<!-- /PROFILE HEADER SOCIAL LINKS -->
  
          <!-- SLIDER CONTROLS -->
          	<div id="profile-header-social-links-slider-controls" class="slider-controls">
	            <!-- SLIDER CONTROL -->
	            <div class="slider-control left">
	              <!-- SLIDER CONTROL ICON -->
	              <svg class="slider-control-icon icon-small-arrow">
	                <use xlink:href="#svg-small-arrow"></use>
	              </svg>
	              <!-- /SLIDER CONTROL ICON -->
	            </div>
	            <!-- /SLIDER CONTROL -->
	  
	            <!-- SLIDER CONTROL -->
	            <div class="slider-control right">
	              <!-- SLIDER CONTROL ICON -->
	              <svg class="slider-control-icon icon-small-arrow">
	                <use xlink:href="#svg-small-arrow"></use>
	              </svg>
	              <!-- /SLIDER CONTROL ICON -->
	            </div>
	            <!-- /SLIDER CONTROL -->
          	</div>
          <!-- /SLIDER CONTROLS -->
        </div>
        <!-- /PROFILE HEADER SOCIAL LINKS WRAP -->
  
        <!-- USER STATS -->
        <div class="user-stats">
          	<!-- USER STAT -->
          	<div class="user-stat big">
	            <!-- USER STAT TITLE -->
	            <p class="user-stat-title">930</p>
	            <!-- /USER STAT TITLE -->
	    
	            <!-- USER STAT TEXT -->
	            <p class="user-stat-text">posts</p>
	            <!-- /USER STAT TEXT -->
          	</div>
          	<!-- /USER STAT -->
    
          	<!-- USER STAT -->
          	<div class="user-stat big">
	            <!-- USER STAT TITLE -->
	            <p class="user-stat-title">82</p>
	            <!-- /USER STAT TITLE -->
	    
	            <!-- USER STAT TEXT -->
	            <p class="user-stat-text">friends</p>
	            <!-- /USER STAT TEXT -->
          	</div>
          	<!-- /USER STAT -->
    
          	<!-- USER STAT -->
          	<div class="user-stat big">
	            <!-- USER STAT TITLE -->
	            <p class="user-stat-title">5.7k</p>
	            <!-- /USER STAT TITLE -->
	    
	            <!-- USER STAT TEXT -->
	            <p class="user-stat-text">visits</p>
	            <!-- /USER STAT TEXT -->
          	</div>
          	<!-- /USER STAT -->
  
          	<!-- USER STAT -->
          	<div class="user-stat big">
	            <!-- USER STAT IMAGE -->
	            <img class="user-stat-image" src="{{asset('assets/frontend/img/flag/usa.png')}}" alt="flag-usa">
	            <!-- /USER STAT IMAGE -->
	    
	            <!-- USER STAT TEXT -->
	            <p class="user-stat-text">usa</p>
	            <!-- /USER STAT TEXT -->
          	</div>
          <!-- /USER STAT -->
        </div>
        <!-- /USER STATS -->
  
        <!-- PROFILE HEADER INFO ACTIONS -->
        {{-- <div class="profile-header-info-actions">
          	<p class="profile-header-info-action button secondary"><span class="hide-text-mobile">Add</span> Friend +</p>
        </div> --}}
        <!-- /PROFILE HEADER INFO ACTIONS -->
  	</div>
  <!-- /PROFILE HEADER INFO -->
</div>
<!-- /PROFILE HEADER -->

<!-- SECTION NAVIGATION -->
<nav class="section-navigation" style="margin-bottom: 1.5%;">
  <!-- SECTION MENU -->
  	<div id="section-navigation-slider" class="section-menu">
	    <a class="section-menu-item nv_timeline active" href="#" id="nv_timeline">
	      	<svg class="section-menu-item-icon icon-timeline">
	        	<use xlink:href="#svg-timeline"></use>
	      	</svg>
	      	<p class="section-menu-item-text">Timeline</p>
	    </a>
	    <a class="section-menu-item nv_about" href="#" id="nv_about">
	      	<svg class="section-menu-item-icon icon-profile">
	        	<use xlink:href="#svg-profile"></use>
	      	</svg>
	      	<p class="section-menu-item-text">About</p>
	    </a>
	    <a class="section-menu-item nv_group" href="#" id="nv_group">
	      	<svg class="section-menu-item-icon icon-group">
	        	<use xlink:href="#svg-group"></use>
	      	</svg>
	      	<p class="section-menu-item-text">Groups</p>
	    </a>
	    <a class="section-menu-item nv_photos" href="#" id="nv_photos">
	      	<svg class="section-menu-item-icon icon-photos">
	        	<use xlink:href="#svg-photos"></use>
	      	</svg>
	      	<p class="section-menu-item-text">Photos</p>
	    </a>
	    <a class="section-menu-item nv_videos" href="#" id="nv_videos">
	      	<svg class="section-menu-item-icon icon-videos">
	        	<use xlink:href="#svg-videos"></use>
	      	</svg>
	      	<p class="section-menu-item-text">Videos</p>
	    </a>
	    <!-- /SECTION MENU ITEM -->

  		<!-- SLIDER CONTROLS -->
	  	<div id="section-navigation-slider-controls" class="slider-controls">
	        <!-- SLIDER CONTROL -->
	        <div class="slider-control left">
	          <!-- SLIDER CONTROL ICON -->
	          <svg class="slider-control-icon icon-small-arrow">
	            <use xlink:href="#svg-small-arrow"></use>
	          </svg>
	          <!-- /SLIDER CONTROL ICON -->
	        </div>
	        <!-- /SLIDER CONTROL -->
	  
	        <!-- SLIDER CONTROL -->
	        <div class="slider-control right">
	          <!-- SLIDER CONTROL ICON -->
	          <svg class="slider-control-icon icon-small-arrow">
	            <use xlink:href="#svg-small-arrow"></use>
	          </svg>
	          <!-- /SLIDER CONTROL ICON -->
	        </div>
	        <!-- /SLIDER CONTROL -->
	  	</div>
  	<!-- /SLIDER CONTROLS -->
  	</div>
</nav>
<!-- /SECTION NAVIGATION -->

<!-- GRID -->
<div id="profile_contents">
	@include('social.profile.timeline');
</div>
<!-- /GRID -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$('#nv_timeline').click(function(event){
		event.preventDefault();
		$.ajax({
            url: "{{ url('profile/timeline') }}",
            method: 'get',
            success: function(result){
                console.log(result)
                $('#profile_contents').empty();
                $('#profile_contents').html(result);
                $('.nv_timeline').addClass('active')
                $('.nv_about').removeClass('active')
                $('.nv_group').removeClass('active')
                $('.nv_photos').removeClass('active')
                $('.nv_videos').removeClass('active')
            }
        });
	});
	$('#nv_about').click(function(event){
		event.preventDefault();
		$.ajax({
            url: "{{ url('profile/about') }}",
            method: 'get',
            success: function(result){
                console.log(result)
                $('#profile_contents').empty();
                $('#profile_contents').html(result);
                $('.nv_about').addClass('active')
                $('.nv_timeline').removeClass('active')
                $('.nv_group').removeClass('active')
                $('.nv_photos').removeClass('active')
                $('.nv_videos').removeClass('active')
            }
        });
	});
	$('#nv_group').click(function(event){
		event.preventDefault();
		$.ajax({
            url: "{{ url('profile/groups') }}",
            method: 'get',
            success: function(result){
                console.log(result)
                $('#profile_contents').empty();
                $('#profile_contents').html(result);
                $('.nv_group').addClass('active')
                $('.nv_timeline').removeClass('active')
                $('.nv_about').removeClass('active')
                $('.nv_photos').removeClass('active')
                $('.nv_videos').removeClass('active')
            }
        });
	});
	$('#nv_photos').click(function(event){
		event.preventDefault();
		$.ajax({
            url: "{{ url('profile/photos') }}",
            method: 'get',
            success: function(result){
                console.log(result)
                $('#profile_contents').empty();
                $('#profile_contents').html(result);
                $('.nv_timeline').removeClass('active')
                $('.nv_about').removeClass('active')
                $('.nv_group').removeClass('active')
                $('.nv_photos').addClass('active')
                $('.nv_videos').removeClass('active')
            }
        });
	});
	$('#nv_videos').click(function(event){
		event.preventDefault();
		$.ajax({
            url: "{{ url('profile/videos') }}",
            method: 'get',
            success: function(result){
                console.log(result)
                $('#profile_contents').empty();
                $('#profile_contents').html(result);
                $('.nv_timeline').removeClass('active')
                $('.nv_about').removeClass('active')
                $('.nv_group').removeClass('active')
                $('.nv_photos').removeClass('active')
                $('.nv_videos').addClass('active')
            }
        });
	});
</script>
@stop