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
          <a href="index.html">
            <span>Home</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.users.list') }}">
            <span>Manage Users</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.user.account.list') }}">
            <span>User Accounts</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.course.list') }}">
            <span>Courses</span>
          </a>
        </li>
        <li>
            <a href="{{ route('admin.department.list') }}" class="">
                <span>Department</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.position.list') }}" class="">
                <span>Position</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user.organization.list') }}" class="">
                <span>Organization</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.event.categories.list') }}" class="">
                <span>Event Categories</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.event.types.list') }}" class="">
                <span>Event Types</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.approvers.list') }}" class="">
                <span>Approvers</span>
            </a>
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
