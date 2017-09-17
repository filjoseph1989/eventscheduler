<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Organization</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('user-admin.org-list') }}">
        <span>List of organizations</span>
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
    <li><a href="{{ route('user-admin.event.new') }}">Create Event</a></li>
    <li><a href="{{ route('user-admin.my.new.event') }}">Create My Events</a></li>
    <li><a href="{{ route('user-admin.event.list') }}">List of Events</a></li>
    <li><a href="{{ route('user-admin.calendar') }}">Event Calendar</a></li>
  </ul>
</li>
<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">person</i>
    <span>Members</span>
  </a>
  <ul class="ml-menu">
    <li><a href="{{ route('user-admin.members.list') }}">All Members</a></li>
    <li><a href="{{ route('user-admin.members.add') }}">Add Members</a></li>
    <li><a href="{{ route('user-admin.accept-users') }}">Accept Registraton Request</a></li>
  </ul>
</li>
<li>
  {{-- <a href="{{ route('user-admin.event.show') }}"> --}}
  <a href="{{ route('user-admin.attendance') }}">
    <i class="material-icons">list</i>
    <span>Generate Attendance</span>
  </a>
</li>
