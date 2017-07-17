<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Manage Schedule</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('org-head.org-list') }}">
        <span>My Organization</span>
      </a>
    </li>
    <li>
      <a href="{{ route('org-head.personal-calendar') }}">
        <span>My Personal</span>
      </a>
    </li>
  </ul>
</li>
<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">event_seat</i>
    <span>Events</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="#" class="menu-toggle">My Organization</a>
      <ul class="ml-menu">
        <li><a href="{{ route('event.get') }}">List</a></li>
        <li><a href="{{ route('event.new') }}">Create</a></li>
      </ul>
    </li>
    <li>
      <a href="#" class="menu-toggle">My Personal</a>
      <ul class="ml-menu">
        <li><a href="{{ route('event.get') }}">List</a></li>
        <li><a href="{{ route('event.new') }}">Create</a></li>
      </ul>
    </li>
  </ul>
</li>
<li>
  <a href="{{ route('event.show')}}">
    <i class="material-icons">list</i>
    <span>Generate Attendance</span>
  </a>
</li>
