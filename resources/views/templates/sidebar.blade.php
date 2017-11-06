<section class="sidebar">
  <aside id="leftsidebar" class="sidebar">
    <div class="user-info">
      <div class="image">
        @if( Auth::user()->picture != "profile.png" )
          <img src="{{ asset("img/profile/".Auth::user()->picture) }}" width="48" height="48" alt="Profile Picture">
        @else
          <img src="{{ asset("img/profile/profile.png ") }}" width="48" height="48" alt="Profile Picture">
        @endif
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->full_name }}
        </div>
        <div class="email">{{ Auth::user()->email }}</div>
        <div class="email">{{ strtoupper(session('user_account')) }}</div>

        <div class="btn-group user-helper-dropdown">
          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
          <ul class="dropdown-menu pull-right">
            <li>
              <a href="{{ route('Profile.index') }}"><i class="material-icons">person</i>Profile</a>
            </li>
            <li role="seperator" class="divider"></li>
            <li>
              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons">input</i> Sign Out
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="menu">
      <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="/home">
            <i class="material-icons">home</i>
            <span>Home</span>
          </a>
        </li>
        <li>
          @if( session('account') != 'org-member' )
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">account_circle</i>
              @if( session('account') == 'osa' )
                <span>All System Users</span>
              @else
                <span>Primary Org Co-Members</span>
              @endif
            </a>
            <ul class="ml-menu">
              @if (session('account') == 'org-head')
                <li><a href="{{ route('User.index') }}">List of Members</a></li>
                <li><a href="{{ route('User.create') }}">Register Members</a></li>
              @elseif(session('account') == 'osa')
                <li><a href="{{ route('User.index') }}">List of System Users</a></li>
              @endif
            </ul>
          @endif
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">group_work</i>
            <span>Organization/s</span>
          </a>
          <ul class="ml-menu">
            @if(session('account') == 'osa')
              <li><a href="{{ route('Org.create') }}"><span>Add New</span></a></li>
              <li><a href="{{ route('Org.index') }}"><span>University Organizations</span></a></li>
            @elseif(session('account') != 'osa')
              <li><a href="{{ route('Org.show', 'false') }}"><span>My Organizations</span></a></li> 
            @endif
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">alarm</i>
            <span>Events</span>
          </a>
          <ul class="ml-menu">
            @if (session('account') != 'org-member')
              <li>
                <a href="{{ route('Event.create') }}"> <span>Create Event</span> </a>
              </li>
            @endif
            <li>
              <a href="#" class="menu-toggle"><span>List of Events</span></a>
              <ul class="ml-menu">
                @if( session('account') == 'org-head')
                  <li><a href="{{ route('Event.show', 0) }}"><span>My Primary Organization Events</span></a></li>
                @elseif( session('account') == 'org-member' )
                  <li><a href="{{ route('Event.show', 0) }}"><span>My Organization Events</span></a></li>
                @endif
                <li><a href="{{ route('Event.show', 1) }}"> <span>Official</span></a></li>
                <li><a href="{{ route('event.dlv', 2) }}">
                  @if( session('account') != 'org-head' )
                    <span>Personal</span></a>
                  @else
                    <span>Local</span></a></li>
                  @endif
                </li>
              </ul>
            </li>
            @if (session('account') == 'osa')
              <li>
                <a href="{{ route('Event.index') }}"><span>Approve Events</span></a>
              </li>
            @endif
            <li>
              <a href="#" class="menu-toggle"> <span>Calendar</span> </a>
              <ul class="ml-menu">
                <li><a href="{{ route('Calendar.show', 1) }}"><span>Official</span></a></li>
                <li><a href="{{ route('Calendar.show', 2) }}"><span>Personal</span></a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">check_circle</i>
            <span>Attendances</span>
          </a>
          <ul class="ml-menu">
            @if (session('account') == 'org-head')
              <li><a href="{{ route('Attendances.show', 'Official') }}"><span>Official Events</span></a></li>
              <li><a href="{{ route('Attendances.show', 'Local') }}"><span>Local Events</span></a></li>
            @elseif (session('account') == 'osa')
              <li><a href="{{ route('Attendances.show', 'Official') }}"><span>Official Events</span></a></li>
            @else
              <li><a href="{{ route('Attendances.index') }}"><span>My Event Attendance</span></a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div>
    <div class="legal">
      <div class="copyright">
        &copy; 2017 <a href="#">Event Scheduler System</a>.
      </div>
      <div class="version">
        <b>Version: </b> 2.0.0 | <a href="#" data-toggle="modal" data-target="#webknights">Liz</a>
      </div>
    </div>
  </aside>
  <aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
      <li role="presentation" class="active"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
    </ul>
  </aside>
</section>
