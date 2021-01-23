<script src="{{asset('assets/frontend/app.bundle.min.js')}}"></script>
<!-- SECTION -->
<section class="section" style="margin-top: -40px;">
  	<!-- SECTION HEADER -->
  	<div class="section-header">
        <!-- SECTION HEADER INFO -->
        <div class="section-header-info">
          <!-- SECTION PRETITLE -->
          <p class="section-pretitle">Browse Marina's</p>
          <!-- /SECTION PRETITLE -->
  
          <!-- SECTION TITLE -->
          <h2 class="section-title">Groups <span class="highlighted">7</span></h2>
          <!-- /SECTION TITLE -->
        </div>
        <!-- /SECTION HEADER INFO -->
  	</div>
  	<!-- /SECTION HEADER -->

  	<!-- SECTION FILTERS BAR -->
  	<div class="section-filters-bar v1" style="margin-top: 10px;margin-bottom: 10px;">
        <!-- SECTION FILTERS BAR ACTIONS -->
        <div class="section-filters-bar-actions">
          <!-- FORM -->
          <form class="form">
            <!-- FORM INPUT -->
            <div class="form-input small with-button">
              <label for="groups-search">Search Groups</label>
              <input type="text" id="groups-search" name="groups_search">
              <!-- BUTTON -->
              <button class="button primary">
                <!-- ICON MAGNIFYING GLASS -->
                <svg class="icon-magnifying-glass">
                  <use xlink:href="#svg-magnifying-glass"></use>
                </svg>
                <!-- /ICON MAGNIFYING GLASS -->
              </button>
              <!-- /BUTTON -->
            </div>
            <!-- /FORM INPUT -->
    
            <!-- FORM SELECT -->
            <div class="form-select">
              <label for="groups-filter-category">Filter By</label>
              <select id="groups-filter-category" name="groups_filter_category">
                <option value="0">Newly Created</option>
                <option value="1">Most Members</option>
                <option value="2">Alphabetical</option>
              </select>
              <!-- FORM SELECT ICON -->
              <svg class="form-select-icon icon-small-arrow">
                <use xlink:href="#svg-small-arrow"></use>
              </svg>
              <!-- /FORM SELECT ICON -->
            </div>
            <!-- /FORM SELECT -->
          </form>
          <!-- /FORM -->
    
          <!-- FILTER TABS -->
          <div class="filter-tabs">
            <!-- FILTER TAB -->
            <div class="filter-tab active">
              <!-- FILTER TAB TEXT -->
              <p class="filter-tab-text">Newly Created</p>
              <!-- /FILTER TAB TEXT -->
            </div>
            <!-- /FILTER TAB -->
    
            <!-- FILTER TAB -->
            <div class="filter-tab">
              <!-- FILTER TAB TEXT -->
              <p class="filter-tab-text">Most Members</p>
              <!-- /FILTER TAB TEXT -->
            </div>
            <!-- /FILTER TAB -->
    
            <!-- FILTER TAB -->
            <div class="filter-tab">
              <!-- FILTER TAB TEXT -->
              <p class="filter-tab-text">Alphabetical</p>
              <!-- /FILTER TAB TEXT -->
            </div>
            <!-- /FILTER TAB -->
          </div>
          <!-- /FILTER TABS -->
        </div>
        <!-- /SECTION FILTERS BAR ACTIONS -->
  	</div>
  	<!-- /SECTION FILTERS BAR -->

  	<!-- GRID -->
  	<div class="grid">
        <!-- USER PREVIEW -->
        <div class="user-preview landscape" style="border-radius: 0px;">
          	<!-- USER PREVIEW COVER -->
          	<figure class="user-preview-cover liquid" style="border-radius: 0px;">
            	<img src="{{asset('assets/frontend/img/cover/08.jpg')}}" alt="cover-08">
          	</figure>
          	<!-- /USER PREVIEW COVER -->

          	<!-- USER PREVIEW INFO -->
          	<div class="user-preview-info">
	            <!-- USER SHORT DESCRIPTION -->
	            <div class="user-short-description landscape tiny">
	              	<!-- USER SHORT DESCRIPTION AVATAR -->
	              	<a class="user-short-description-avatar user-avatar small no-stats" href="group-timeline.html">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-50-56"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
		            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  <!-- HEXAGON -->
		                  <div class="hexagon-image-40-44" data-src="{{asset('assets/frontend/img/avatar/29.jpg')}}"></div>
		                  <!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</a>
	              	<!-- /USER SHORT DESCRIPTION AVATAR -->
	        
	              	<!-- USER SHORT DESCRIPTION TITLE -->
	              	<p class="user-short-description-title"><a href="group-timeline.html">Twitch Streamers</a></p>
	              	<!-- /USER SHORT DESCRIPTION TITLE -->
	        
	              	<!-- USER SHORT DESCRIPTION TEXT -->
	              	<p class="user-short-description-text">Twitch gaming streamers group</p>
	              	<!-- /USER SHORT DESCRIPTION TEXT -->
	            </div>
	            <!-- /USER SHORT DESCRIPTION -->
	        
	            <!-- USER STATS -->
	            <div class="user-stats">
	              	<!-- USER STAT -->
	              	<div class="user-stat">
	                	<!-- USER STAT TITLE -->
	                	<p class="user-stat-title">265</p>
	                	<!-- /USER STAT TITLE -->
	        
	                	<!-- USER STAT TEXT -->
	                	<p class="user-stat-text">members</p>
	                	<!-- /USER STAT TEXT -->
	              	</div>
	              	<!-- /USER STAT -->
	        
	              	<!-- USER STAT -->
	              	<div class="user-stat">
	                	<!-- USER STAT TITLE -->
	                	<p class="user-stat-title">168</p>
	                	<!-- /USER STAT TITLE -->
	        
		                <!-- USER STAT TEXT -->
		                <p class="user-stat-text">posts</p>
		                <!-- /USER STAT TEXT -->
	              	</div>
	              	<!-- /USER STAT -->
	        
	              	<!-- USER STAT -->
	              	<div class="user-stat">
		                <!-- USER STAT TITLE -->
		                <p class="user-stat-title">11.2k</p>
		                <!-- /USER STAT TITLE -->
		        
		                <!-- USER STAT TEXT -->
		                <p class="user-stat-text">visits</p>
		                <!-- /USER STAT TEXT -->
	              	</div>
	              	<!-- /USER STAT -->
	            </div>
	            <!-- /USER STATS -->

	            <!-- USER AVATAR LIST -->
	            <div class="user-avatar-list medium reverse centered">
	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  <!-- HEXAGON -->
		                  <div class="hexagon-34-36"></div>
		                  <!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
	            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  <!-- HEXAGON -->
		                  <div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/07.jpg')}}"></div>
		                  <!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->
	              
	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-34-36"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
		            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  <!-- HEXAGON -->
		                  <div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/13.jpg')}}"></div>
		                  <!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->

	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-34-36"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
		            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/08.jpg')}}"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->

	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-34-36"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
		            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/16.jpg')}}"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->

	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-34-36"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
	            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/23.jpg')}}"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->

	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-34-36"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
	            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  <!-- HEXAGON -->
		                  <div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/05.jpg')}}"></div>
		                  <!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->

	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-34-36"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
	            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/03.jpg')}}"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->

	              	<!-- USER AVATAR -->
	              	<div class="user-avatar smaller no-stats">
		                <!-- USER AVATAR BORDER -->
		                <div class="user-avatar-border">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-34-36"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR BORDER -->
		            
		                <!-- USER AVATAR CONTENT -->
		                <div class="user-avatar-content">
		                  	<!-- HEXAGON -->
		                  	<div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/02.jpg')}}"></div>
		                  	<!-- /HEXAGON -->
		                </div>
		                <!-- /USER AVATAR CONTENT -->
	              	</div>
	              	<!-- /USER AVATAR -->
	            </div>
	            <!-- /USER AVATAR LIST -->

	            <!-- USER PREVIEW ACTIONS -->
	            <div class="user-preview-actions">
	              	<!-- TAG STICKER -->
	              	<div class="tag-sticker">
	                <!-- TAG STICKER ICON -->
		                <svg class="tag-sticker-icon icon-private">
		                  <use xlink:href="#svg-private"></use>
		                </svg>
	                <!-- /TAG STICKER ICON -->
	              	</div>
	              	<!-- /TAG STICKER -->

	              	<!-- BUTTON -->
	              	<p class="button secondary">
		                <!-- BUTTON ICON -->
		                <svg class="button-icon icon-join-group">
		                  <use xlink:href="#svg-join-group"></use>
		                </svg>
		                <!-- /BUTTON ICON -->
	              	</p>
	              	<!-- /BUTTON -->
	            </div>
	            <!-- /USER PREVIEW ACTIONS -->
          	</div>
          	<!-- /USER PREVIEW INFO -->
        </div>
        <!-- /USER PREVIEW -->
  	</div>
  	<!-- /GRID -->
</section>
<!-- /SECTION -->