<section>
  <aside id="leftsidebar" class="sidebar">
    <div class="user-info">
      <div class="image">
        <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
        <div class="email">{{ Auth::user()->email }}</div>
        <div class="btn-group user-helper-dropdown">
          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
          <ul class="dropdown-menu pull-right">
            <li><a href="#"><i class="material-icons">person</i>Profile</a></li>
            <li role="seperator" class="divider"></li>
            <li><a href="#"><i class="material-icons">group</i>Followers</a></li>
            <li><a href="#"><i class="material-icons">favorite</i>Likes</a></li>
            <li role="seperator" class="divider"></li>
            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
          <a href="{{ route('home') }}">
            <i class="material-icons">home</i>
            <span>Home</span>
          </a>
        </li>
        <li>
          <a href="#" class="menu-toggle">
            <i class="material-icons">widgets</i>
            <span>Widgets</span>
          </a>
          <ul class="ml-menu">
            <li>
              <a href="#" class="menu-toggle">
                <span>Organizations</span>
              </a>
              <ul class="ml-menu">
                <li><a href="{{ route('organization.list') }}">List of Organizations</a></li>
              </ul>
            </li>
            <li>
                <a href="#" class="menu-toggle">
                    <span>Users</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ route('user.register') }}">Register User</a></li>
                </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="legal">
      <div class="copyright">
        &copy; 2017 <a href="#">Event Scheduler System</a>.
      </div>
      <div class="version">
        <b>Version: </b> 1.0.0
      </div>
    </div>
  </aside>

  @include('pages.right-sidebar')
</section>
