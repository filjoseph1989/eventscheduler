<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Organization</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('osa-personnel.org-list') }}">
        <span>List of organizations</span>
      </a>
    </li>
    <li>
      <a href="{{ route('osa-personnel.org-add') }}">
        <span>Add Organization</span>
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
    <li><a href="{{ route('osa-personnel.event.new') }}">Create Event</a></li>
    <li><a href="{{ route('osa-personnel.my.new.event') }}">Create My Events</a></li>
    <li><a href="{{ route('osa-personnel.event.list') }}">List of Events</a></li>
    <li><a href="{{ route('osa-personnel.approve.event') }}">Approve Events</a></li>
    <li><a href="{{ route('osa-personnel.calendar') }}">Event Calendar</a></li>
  </ul>
</li>
<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">person</i>
    <span>Members</span>
  </a>
  <ul class="ml-menu">
    <!-- <li><a href="#">All Members</a></li> -->
    <li><a href="{{ route('osa-personnel.members.list') }}">All Members</a></li>
  </ul>
</li>
<li>
  <a href="{{ route('osa-personnel.attendance') }}">
    <i class="material-icons">list</i>
    <span>Generate Attendance</span>
  </a>
</li>
