<li>
  <a href="#" class="menu-toggle">
    <i class="material-icons">supervisor_account</i>
    <span>Organization (OSA)</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('osa.org.list') }}">
        <span>List of organizations</span>
      </a>
    </li>
    <li>
      <a href="{{ route('osa.org.add') }}">
        <span>Add an organization</span>
      </a>
    </li>
  </ul>
  <a href="#" class="menu-toggle">
    <i class="material-icons">event</i>
    <span>Manage Events</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('osa.event.get') }}">
        <span>List of events</span>
      </a>
    </li>
    <li>
      <a href="{{ route('osa.event.new') }}">
        <span>Create an event</span>
      </a>
    </li>
    <li>
      <a href="{{ route('osa.event.approval') }}">
        <span>Approve Events</span>
      </a>
    </li>
    <li>
      <a href="{{ route('osa-personnel.event.approval.within') }}">
        <span>Approve Events within OSA</span>
      </a>
    </li>
  </ul>
  <a href="#" class="menu-toggle">
    <i class="material-icons">contacts</i>
    <span>Manage Users</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('osa.user.list') }}">
        <span>List Of Users</span>
      </a>
    </li>
  </ul>
  <a href="#" class="menu-toggle">
    <i class="material-icons">date_range</i>
    <span>Manage Schedule</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('osa-personnel.org-list') }}">
        <span>My Organization</span>
      </a>
    </li>
    <li>
      <a href="{{ route('org-head.personal-calendar') }}">
        <span>My Personal</span>
      </a>
    </li>
    <li>
      <a href="{{ route('university-calendar') }}">
        <span>University Calendar</span>
      </a>
    </li>
    <li>
      <a href="{{ route('all-organization-calendar') }}">
        <span>All Organization Calendar</span>
      </a>
    </li>
    <li>
      <a href="{{ route('my-organization-calendar') }}">
        <span>My Organization Calendar</span>
      </a>
    </li>
    <li>
      <a href="{{ route('my-personal-calendar') }}">
        <span>My Personal Calendar</span>
      </a>
    </li>
  </ul>
</li>
