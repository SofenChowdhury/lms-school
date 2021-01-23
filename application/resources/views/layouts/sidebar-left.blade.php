<!-- NAVIGATION WIDGET -->
<nav id="navigation-widget-small" class="navigation-widget navigation-widget-desktop closed sidebar left delayed">
  <!-- USER AVATAR -->
  <a class="user-avatar small no-outline online" href="{{route('profile')}}">
    <!-- USER AVATAR CONTENT -->
    <div class="user-avatar-content">
      <!-- HEXAGON -->
      <div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/01.jpg')}}">
      </div>
      <!-- /HEXAGON -->
    </div>
    <!-- /USER AVATAR CONTENT -->

    <!-- USER AVATAR PROGRESS -->
    <div class="user-avatar-progress">
      <!-- HEXAGON -->
      <div class="hexagon-progress-40-44"></div>
      <!-- /HEXAGON -->
    </div>
    <!-- /USER AVATAR PROGRESS -->

    <!-- USER AVATAR PROGRESS BORDER -->
    <div class="user-avatar-progress-border">
      <!-- HEXAGON -->
      <div class="hexagon-border-40-44"></div>
      <!-- /HEXAGON -->
    </div>
    <!-- /USER AVATAR PROGRESS BORDER -->

    <!-- USER AVATAR BADGE -->
    <div class="user-avatar-badge">
      <!-- USER AVATAR BADGE BORDER -->
      <div class="user-avatar-badge-border">
        <!-- HEXAGON -->
        <div class="hexagon-22-24"></div>
        <!-- /HEXAGON -->
      </div>
      <!-- /USER AVATAR BADGE BORDER -->

      <!-- USER AVATAR BADGE CONTENT -->
      <div class="user-avatar-badge-content">
        <!-- HEXAGON -->
        <div class="hexagon-dark-16-18"></div>
        <!-- /HEXAGON -->
      </div>
      <!-- /USER AVATAR BADGE CONTENT -->

      <!-- USER AVATAR BADGE TEXT -->
      <p class="user-avatar-badge-text">24</p>
      <!-- /USER AVATAR BADGE TEXT -->
    </div>
    <!-- /USER AVATAR BADGE -->
  </a>
  <!-- /USER AVATAR -->

  <!-- MENU -->
  <ul class="menu small">
    <!-- MENU ITEM -->
    <li class="menu-item">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('home')}}" data-title="Dashboard">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-quests">
            <use xlink:href="#svg-quests"></use>
          </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->
    <!-- MENU ITEM -->
    <li class="menu-item active">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('index')}}" data-title="Newsfeed">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-newsfeed">
          <use xlink:href="#svg-newsfeed"></use>
        </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->

    <!-- MENU ITEM -->
    <li class="menu-item">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('groups')}}" data-title="Groups">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-group">
          <use xlink:href="#svg-group"></use>
        </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->

    <!-- MENU ITEM -->
    <li class="menu-item">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('members')}}" data-title="Members">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-members">
          <use xlink:href="#svg-members"></use>
        </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->

    <!-- MENU ITEM -->
    <li class="menu-item">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('contest')}}" data-title="Contests">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-badges">
          <use xlink:href="#svg-badges"></use>
        </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->

    <!-- MENU ITEM -->
    <li class="menu-item">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('quests')}}" data-title="Quests">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-quests">
          <use xlink:href="#svg-quests"></use>
        </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->
    <!-- MENU ITEM -->
    <li class="menu-item">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('polls')}}" data-title="Polls">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-overview">
          <use xlink:href="#svg-overview"></use>
        </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->

    <!-- MENU ITEM -->
    <li class="menu-item">
      <!-- MENU ITEM LINK -->
      <a class="menu-item-link text-tooltip-tfr" href="{{route('events')}}" data-title="Events">
        <!-- MENU ITEM LINK ICON -->
        <svg class="menu-item-link-icon icon-events">
          <use xlink:href="#svg-events"></use>
        </svg>
        <!-- /MENU ITEM LINK ICON -->
      </a>
      <!-- /MENU ITEM LINK -->
    </li>
    <!-- /MENU ITEM -->
  </ul>
  <!-- /MENU -->
</nav>
<!-- /NAVIGATION WIDGET -->
<nav id="navigation-widget" class="navigation-widget navigation-widget-desktop sidebar left hidden" data-simplebar>
    <!-- NAVIGATION WIDGET COVER -->
    <figure class="navigation-widget-cover liquid">
      <img src="{{asset('assets/frontend/img/cover/01.jpg')}}" alt="cover-01">
    </figure>
    <!-- /NAVIGATION WIDGET COVER -->

    <!-- USER SHORT DESCRIPTION -->
    <div class="user-short-description">
      <!-- USER SHORT DESCRIPTION AVATAR -->
      <a class="user-short-description-avatar user-avatar medium" href="{{route('profile')}}">
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

    <!-- BADGE LIST -->
    <div class="badge-list small">
      <!-- BADGE ITEM -->
      <div class="badge-item">
        <img src="{{asset('assets/frontend/img/badge/gold-s.png')}}" alt="badge-gold-s">
      </div>
      <!-- /BADGE ITEM -->

      <!-- BADGE ITEM -->
      <div class="badge-item">
        <img src="{{asset('assets/frontend/img/badge/age-s.png')}}" alt="badge-age-s">
      </div>
      <!-- /BADGE ITEM -->

      <!-- BADGE ITEM -->
      <div class="badge-item">
        <img src="{{asset('assets/frontend/img/badge/caffeinated-s.png')}}" alt="badge-caffeinated-s">
      </div>
      <!-- /BADGE ITEM -->

      <!-- BADGE ITEM -->
      <div class="badge-item">
        <img src="{{asset('assets/frontend/img/badge/warrior-s.png')}}" alt="badge-warrior-s">
      </div>
      <!-- /BADGE ITEM -->

      <!-- BADGE ITEM -->
      <a class="badge-item" href="profile-badges.html">
        <img src="{{asset('assets/frontend/img/badge/blank-s.png')}}" alt="badge-blank-s">
        <!-- BADGE ITEM TEXT -->
        <p class="badge-item-text">+9</p>
        <!-- /BADGE ITEM TEXT -->
      </a>
      <!-- /BADGE ITEM -->
    </div>
    <!-- /BADGE LIST -->

    <!-- USER STATS -->
    <div class="user-stats">
      <!-- USER STAT -->
      <div class="user-stat">
        <!-- USER STAT TITLE -->
        <p class="user-stat-title">930</p>
        <!-- /USER STAT TITLE -->

        <!-- USER STAT TEXT -->
        <p class="user-stat-text">posts</p>
        <!-- /USER STAT TEXT -->
      </div>
      <!-- /USER STAT -->

      <!-- USER STAT -->
      <div class="user-stat">
        <!-- USER STAT TITLE -->
        <p class="user-stat-title">82</p>
        <!-- /USER STAT TITLE -->

        <!-- USER STAT TEXT -->
        <p class="user-stat-text">friends</p>
        <!-- /USER STAT TEXT -->
      </div>
      <!-- /USER STAT -->

      <!-- USER STAT -->
      <div class="user-stat">
        <!-- USER STAT TITLE -->
        <p class="user-stat-title">5.7k</p>
        <!-- /USER STAT TITLE -->

        <!-- USER STAT TEXT -->
        <p class="user-stat-text">visits</p>
        <!-- /USER STAT TEXT -->
      </div>
      <!-- /USER STAT -->
    </div>
    <!-- /USER STATS -->

    <!-- MENU -->
    <ul class="menu">
      <!-- MENU ITEM -->
      <li class="menu-item active">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="{{route('index')}}">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-newsfeed">
            <use xlink:href="#svg-newsfeed"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Newsfeed
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="groups.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-group">
            <use xlink:href="#svg-group"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Groups
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="members.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-members">
            <use xlink:href="#svg-members"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Members
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="badges.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-badges">
            <use xlink:href="#svg-badges"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Badges
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="quests.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-quests">
            <use xlink:href="#svg-quests"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Quests
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="streams.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-streams">
            <use xlink:href="#svg-streams"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Streams
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="events.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-events">
            <use xlink:href="#svg-events"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Events
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="forums.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-forums">
            <use xlink:href="#svg-forums"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Forums
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="marketplace.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-marketplace">
            <use xlink:href="#svg-marketplace"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Marketplace
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->
    </ul>
    <!-- /MENU -->
</nav>
  <!-- NAVIGATION WIDGET -->
  <nav id="navigation-widget-mobile" class="navigation-widget navigation-widget-mobile sidebar left hidden" data-simplebar>
    <!-- NAVIGATION WIDGET CLOSE BUTTON -->
    <div class="navigation-widget-close-button">
      <!-- NAVIGATION WIDGET CLOSE BUTTON ICON -->
      <svg class="navigation-widget-close-button-icon icon-back-arrow">
        <use xlink:href="#svg-back-arrow"></use>
      </svg>
      <!-- NAVIGATION WIDGET CLOSE BUTTON ICON -->
    </div>
    <!-- /NAVIGATION WIDGET CLOSE BUTTON -->

    <!-- NAVIGATION WIDGET INFO WRAP -->
    <div class="navigation-widget-info-wrap">
      <!-- NAVIGATION WIDGET INFO -->
      <div class="navigation-widget-info">
        <!-- USER AVATAR -->
        <a class="user-avatar small no-outline" href="{{route('profile')}}">
          <!-- USER AVATAR CONTENT -->
          <div class="user-avatar-content">
            <!-- HEXAGON -->
            <div class="hexagon-image-30-32" data-src="{{asset('assets/frontend/img/avatar/01.jpg')}}"></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR CONTENT -->
      
          <!-- USER AVATAR PROGRESS -->
          <div class="user-avatar-progress">
            <!-- HEXAGON -->
            <div class="hexagon-progress-40-44"></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR PROGRESS -->
      
          <!-- USER AVATAR PROGRESS BORDER -->
          <div class="user-avatar-progress-border">
            <!-- HEXAGON -->
            <div class="hexagon-border-40-44"></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR PROGRESS BORDER -->
      
          <!-- USER AVATAR BADGE -->
          <div class="user-avatar-badge">
            <!-- USER AVATAR BADGE BORDER -->
            <div class="user-avatar-badge-border">
              <!-- HEXAGON -->
              <div class="hexagon-22-24"></div>
              <!-- /HEXAGON -->
            </div>
            <!-- /USER AVATAR BADGE BORDER -->
      
            <!-- USER AVATAR BADGE CONTENT -->
            <div class="user-avatar-badge-content">
              <!-- HEXAGON -->
              <div class="hexagon-dark-16-18"></div>
              <!-- /HEXAGON -->
            </div>
            <!-- /USER AVATAR BADGE CONTENT -->
      
            <!-- USER AVATAR BADGE TEXT -->
            <p class="user-avatar-badge-text">24</p>
            <!-- /USER AVATAR BADGE TEXT -->
          </div>
          <!-- /USER AVATAR BADGE -->
        </a>
        <!-- /USER AVATAR -->

        <!-- NAVIGATION WIDGET INFO TITLE -->
        <p class="navigation-widget-info-title"><a href="{{route('profile')}}">Marina Valentine</a></p>
        <!-- /NAVIGATION WIDGET INFO TITLE -->

        <!-- NAVIGATION WIDGET INFO TEXT -->
        <p class="navigation-widget-info-text">Welcome Back!</p>
        <!-- /NAVIGATION WIDGET INFO TEXT -->
      </div>
      <!-- /NAVIGATION WIDGET INFO -->

      <!-- NAVIGATION WIDGET BUTTON -->
      <p class="navigation-widget-info-button button small secondary">Logout</p>
      <!-- /NAVIGATION WIDGET BUTTON -->
    </div>
    <!-- /NAVIGATION WIDGET INFO WRAP -->

    <!-- NAVIGATION WIDGET SECTION TITLE -->
    <p class="navigation-widget-section-title">Sections</p>
    <!-- /NAVIGATION WIDGET SECTION TITLE -->

    <!-- MENU -->
    <ul class="menu">
      <!-- MENU ITEM -->
      <li class="menu-item active">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="newsfeed.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-newsfeed">
            <use xlink:href="#svg-newsfeed"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Newsfeed
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="overview.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-overview">
            <use xlink:href="#svg-overview"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Overview
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="groups.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-group">
            <use xlink:href="#svg-group"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Groups
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="members.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-members">
            <use xlink:href="#svg-members"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Members
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="badges.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-badges">
            <use xlink:href="#svg-badges"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Badges
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="quests.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-quests">
            <use xlink:href="#svg-quests"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Quests
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="streams.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-streams">
            <use xlink:href="#svg-streams"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Streams
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="events.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-events">
            <use xlink:href="#svg-events"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Events
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="forums.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-forums">
            <use xlink:href="#svg-forums"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Forums
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->

      <!-- MENU ITEM -->
      <li class="menu-item">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="marketplace.html">
          <!-- MENU ITEM LINK ICON -->
          <svg class="menu-item-link-icon icon-marketplace">
            <use xlink:href="#svg-marketplace"></use>
          </svg>
          <!-- /MENU ITEM LINK ICON -->
          Marketplace
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
      <!-- /MENU ITEM -->
    </ul>
    <!-- /MENU -->

    <!-- NAVIGATION WIDGET SECTION TITLE -->
    <p class="navigation-widget-section-title">My Profile</p>
    <!-- /NAVIGATION WIDGET SECTION TITLE -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="{{route('profile')}}">Profile Info</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-profile-social.html">Social &amp; Stream</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-profile-notifications.html">Notifications</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-profile-messages.html">Messages</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-profile-requests.html">Friend Requests</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION TITLE -->
    <p class="navigation-widget-section-title">Account</p>
    <!-- /NAVIGATION WIDGET SECTION TITLE -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-account-info.html">Account Info</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-account-password.html">Change Password</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-account-settings.html">General Settings</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION TITLE -->
    <p class="navigation-widget-section-title">Groups</p>
    <!-- /NAVIGATION WIDGET SECTION TITLE -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-group-management.html">Manage Groups</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-group-invitations.html">Invitations</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION TITLE -->
    <p class="navigation-widget-section-title">My Store</p>
    <!-- /NAVIGATION WIDGET SECTION TITLE -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-store-account.html">My Account <span class="highlighted">$250,32</span></a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-store-statement.html">Sales Statement</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-store-items.html">Manage Items</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="hub-store-downloads.html">Downloads</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION TITLE -->
    <p class="navigation-widget-section-title">Main Links</p>
    <!-- /NAVIGATION WIDGET SECTION TITLE -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="#">Home</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="#">Careers</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="#">Faqs</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="#">About Us</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="#">Our Blog</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="#">Contact Us</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->

    <!-- NAVIGATION WIDGET SECTION LINK -->
    <a class="navigation-widget-section-link" href="#">Privacy Policy</a>
    <!-- /NAVIGATION WIDGET SECTION LINK -->
  </nav>
  <!-- /NAVIGATION WIDGET -->