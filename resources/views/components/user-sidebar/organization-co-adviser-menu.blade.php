<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Organization</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('org-co-adviser.org-list') }}">
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
    <li><a href="{{ route('org-co-adviser.event.new') }}">Create Event</a></li>
    <li><a href="{{ route('org-co-adviser.my.new.event') }}">Create My Events</a></li>
    <li><a href="{{ route('org-co-adviser.event.list') }}">List of Events</a></li>
    <li><a href="{{ route('org-co-adviser.approve.event') }}">Approve Events</a></li>
    <li><a href="{{ route('org-co-adviser.calendar') }}">Event Calendar</a></li>
  </ul>
</li>
<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">person</i>
    <span>Members</span>
  </a>
  <ul class="ml-menu">
    <li><a href="{{ route('org-co-adviser.members.list') }}">My Organization Members</a></li>
    {{-- <li><a href="{{ route('org-co-adviser.members.join') }}">Join to Organization</a></li> --}}
  </ul>
</li>
<li>
  <a href="{{ route('org-co-adviser.attendance') }}">
    <i class="material-icons">list</i>
    <span>Generate Attendance</span>
  </a>
</li>
