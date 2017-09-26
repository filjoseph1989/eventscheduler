<section class="sidebar">
  <aside id="leftsidebar" class="sidebar">
    <div class="user-info">
      <div class="image">
        <img src="/img/profile.png" width="48" height="48" alt="User">
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Eldora Vandervort</div>
        <div class="email">nannie73@emard.net</div>
        <div class="email">organization-head</div>
        <div class="btn-group user-helper-dropdown">
          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
          <ul class="dropdown-menu pull-right">
            <li><a href="/users/profile/1"><i class="material-icons">person</i>Profile</a></li>
            <li role="seperator" class="divider"></li>
            <li>
              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons">input</i> Sign Out
              </a>
              <form id="logout-form" action="/users/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" value="PjMLKYxnBUqo7t4YyZpwYNY8AWL0k3qaMWeMVwyL">
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
          <a href="{{ route('User.index') }}" class="menu-toggle">
            <i class="material-icons">account_circle</i>
            <span>All System Users</span>
          </a>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">group_work</i>
            <span>Organization</span>
          </a>
          <ul class="ml-menu">
            <li><a href="{{ route('Org.create') }}"><span>Add New</span></a></li>
            <li><a href="{{ route('Org.index') }}"><span>University Organizations</span></a></li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">alarm</i>
            <span>Events</span>
          </a>
          <ul class="ml-menu">
            <li>
              <a href="{{ route('Event.create') }}">
                <span>Add New</span>
              </a>
            </li>
            <li>
              <a href="#" class="menu-toggle"><span>List</span></a>
              <ul class="ml-menu">
                <li><a href="{{ route('Event.show', 0) }}"><span>Official</span></a></li>
                <li><a href="{{ route('Event.show', 1) }}"> <span>Personal</span></a></li>
              </ul>
            </li>
            <li>
              <a href="{{ route('Event.index') }}"><span>Approved Events</span></a>
            </li>
            <li>
              <a href="#" class="menu-toggle">
                <span>Calendar</span>
              </a>
              <ul class="ml-menu">
                <li><a href="{{ route('Calendar.show', 0) }}"><span>Official</span></a></li>
                <li><a href="{{ route('Calendar.show', 1) }}"><span>Personal</span></a></li>
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
            <li><a href="{{ route('Attendances.show', 0) }}"><span>Official</span></a></li>
            <li><a href="{{ route('Attendances.show', 1) }}"><span>Expected</span></a></li>
            <li><a href="{{ route('Attendances.show', 2) }}"><span>Confirmed</span></a></li>
            <li><a href="{{ route('Attendances.show', 3) }}"><span>Declined</span></a></li>
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
