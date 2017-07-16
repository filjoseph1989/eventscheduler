<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Manage Schedule</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('my-organization-calendar') }}">
        <span>My Organization Calendar</span>
      </a>
    </li>
    <li>
      <a href="javascript:void(0);">
        <span>My Personal Calendar</span>
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
      <a href="{{ route('event.get') }}">List of Events</a>
    </li>
    <li>
      <a href="{{ route('event.new') }}">Create Events</a>
    </li>
  </ul>
</li>
<li>
  <a href="{{ route('attendance')}}">
    <i class="material-icons">list</i>
    <span>Generate Attendance</span>
  </a>
</li>
<li>
  <a href="javascript:void(0);">
    <i class="material-icons">list</i>
    <span>List of Organizations</span>
  </a>
</li>
