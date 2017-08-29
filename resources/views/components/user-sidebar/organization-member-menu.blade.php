<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Organization</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('org-member.org-list') }}">
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
    <li><a href="{{ route('org-member.my.new.event') }}">Create My Events</a></li>
    <li><a href="{{ route('org-member.event.list') }}">List of Events</a></li>
    <li><a href="{{ route('org-member.calendar') }}">Event Calendar</a></li>
  </ul>
</li>
<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">person</i>
    <span>Members</span>
  </a>
  <ul class="ml-menu">
    <li><a href="{{ route('org-member.members.list') }}">All Members</a></li>
  </ul>
</li>
<li>
  {{-- <a href="{{ route('org-member.event.show') }}"> --}}
  <a href="{{ route('org-member.attendance') }}">
    <i class="material-icons">list</i>
    <span>Check My Attendance</span>
  </a>
</li>
