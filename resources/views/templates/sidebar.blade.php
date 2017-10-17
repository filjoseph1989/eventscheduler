<section class="sidebar">
  <aside id="leftsidebar" class="sidebar">
    <div class="user-info">
      <div class="image">
        <img src="/img/profile.png" width="48" height="48" alt="User">
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->full_name }}
        </div>
        <div class="email">{{ Auth::user()->email }}</div>
        <div class="email">{{ session('user_account') }}</div>
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
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">account_circle</i>
            <span>All System Users</span>
          </a>
          <ul class="ml-menu">
            <li><a href="{{ route('User.index') }}">List of Users</a></li>
            @if (Auth::user()->user_type_id == 1)
              <li><a href="{{ route('User.create') }}">Register New Users</a></li>
            @endif
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">group_work</i>
            <span>Organization</span>
          </a>
          <ul class="ml-menu">
            @if(Auth::user()->user_type_id == 3)
              <li><a href="{{ route('Org.create') }}"><span>Add New</span></a></li>
            @endif
            <li><a href="{{ route('Org.index') }}"><span>University Organizations</span></a></li>
            @if (Auth::user()->user_type_id == 2)
              <li><a href="#"><span>My Organization</span></a></li>
            @endif
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">alarm</i>
            <span>Events</span>
          </a>
          <ul class="ml-menu">
            @if (Auth::user()->user_type_id != 2)
              <li>
                <a href="{{ route('Event.create') }}"> <span>Create Event</span> </a>
              </li>
            @endif
            <li>
              <a href="#" class="menu-toggle"><span>List of Events</span></a>
              <ul class="ml-menu">
                <li><a href="{{ route('Event.show', 0) }}"><span>All</span></a></li>
                <li><a href="{{ route('Event.show', 1) }}"> <span>Official</span></a></li>
                <li><a href="{{ route('Event.show', 2) }}"> <span>Local</span></span></a></li>
              </ul>
            </li>
            @if (Auth::user()->user_type_id == 3)
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
            <?php if (Auth::user()->user_type_id != 2): ?>
              <li><a href="{{ route('Attendances.show', 'Official') }}"><span>Official Events</span></a></li>
              <li><a href="{{ route('Attendances.show', 'Local') }}"><span>Local Events</span></a></li>
            <?php else: ?>
              <li><a href="{{ route('Attendances.index') }}"><span>My Event Attendance</span></a></li>
            <?php endif; ?>
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
