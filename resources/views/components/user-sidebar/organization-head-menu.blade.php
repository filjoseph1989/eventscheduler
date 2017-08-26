<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Organization</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('org-head.org-list') }}">
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
    <li><a href="{{ route('org-head.event.new') }}">Create Event</a></li>
    <li><a href="{{ route('org-head.my.new.event') }}">Create My Events</a></li>
    <li><a href="{{ route('org-head.event.list') }}">List of Events</a></li>
    <li><a href="{{ route('org-head.approve.event') }}">Approve Events</a></li>
    <li><a href="{{ route('org-head.calendar') }}">Event Calendar</a></li>
  </ul>
</li>
<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">person</i>
    <span>Members</span>
  </a>
  <ul class="ml-menu">
    <li><a href="{{ route('org-adviser.members.list') }}">All Members</a></li>
    <li><a href="">Add Members</a></li>
    {{-- <li><a href="#">Members with organization</a></li> --}}
    {{-- <li><a href="#">Members without organization</a></li> --}}
  </ul>
</li>
<li>
  {{-- <a href="{{ route('org-adviser.event.show') }}"> --}}
  <a href="{{ route('org-adviser.attendance') }}">
    <i class="material-icons">list</i>
    <span>Generate Attendance</span>
  </a>
</li>
