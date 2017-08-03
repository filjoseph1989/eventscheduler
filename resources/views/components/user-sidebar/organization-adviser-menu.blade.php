<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Organization</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('org.adviser.org-list') }}">
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
    <li><a href="{{ route('org-adviser.event.new') }}">Create Event</a></li>
    <li><a href="{{ route('org-adviser.my.new.event') }}">Create My Events</a></li>
    <li><a href="{{ route('org-adviser.event.list') }}">List of Events</a></li>
    <li><a href="{{ route('org-head.event.get.personal') }}">List of My Events</a></li>
    <li><a href="{{ route('org-head.approval') }}">Approve Events</a></li>
    <li><a href="#">Calendar of Events</a></li>
  </ul>
</li>
<li>
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="material-icons">person</i>
    <span>Members</span>
  </a>
  <ul class="ml-menu">
    <li><a href="#">All Members</a></li>
    <li><a href="#">Members with organization</a></li>
    <li><a href="#">Members without organization</a></li>
  </ul>
</li>
<li>
  <a href="{{ route('event.show')}}">
    <i class="material-icons">list</i>
    <span>Generate Attendance</span>
  </a>
</li>
