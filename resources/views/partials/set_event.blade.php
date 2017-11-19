<div class="card" dir="">
  @if (session('account') == 'osa')
    <div class="header bg-indigo">
  @elseif (session('account') == 'org-head')
    <div class="header" style="background-color:#FF5722">
  @else
    <div class="header bg-teal">
  @endif
    @if (session('account') == 'osa')
      <h2 style="color:white"> MANAGE SCHEDULE
        <small style="color:white">In this panel you view or create your personal event/s or events for your office</small>
      </h2>
    @elseif (session('account') == 'org-head')
      <h2 style="color:black"> MANAGE SCHEDULE
        <small style="color:black">In this panel you view or create your personal event/s or events for your organization</small>
      </h2>
    @else
      <h2 style="color:white"> MANAGE SCHEDULE
        <small style="color:white">In this panel you view or create your personal event/s</small>
      </h2>
    @endif
  </div>
  <div class="body">
    <div class="list-group manage-schedule">
      @if( session('account') == 'org-head')
        <a href="{{ route('Event.show', 0) }}" class="list-group-item"  style="border:none;  color: #7A7A7A">
          <i class="material-icons">group_work</i>
          <span>{{ session('org_name') }} Events</span>
        </a>
      @elseif( session('account') == 'org-member' )
        <a href="{{ route('Event.show', 0) }}" class="list-group-item " style="border:none;  color: #7A7A7A">
          <i class="material-icons">group_work</i>
          <span>My Organization Events</span>
        </a>
      @endif
        <a href="{{ route('Event.show', 1) }}" class="list-group-item " style="border:none;  color: #7A7A7A">
          <i class="material-icons">stars</i>
          <span>Official Events</span>
        </a>
      @if (session('account') == 'org-head')
        <a href="{{ route('event.dlv', 2) }}" class="list-group-item " style="border:none;  color: #7A7A7A">
          <i class="material-icons">domain</i>
          <span>Local Events</span>
        </a>
      @else
        <a href="{{ route('event.dlv', 2) }}" class="list-group-item " style="border:none;  color: #7A7A7A">
          <i class="material-icons">person_outline</i>
          <span>Personal Events</span>
        </a>
      @endif
        <a href="{{ route('event.dlv', 2) }}" class="list-group-item " style="border:none;  color: #7A7A7A">
          <i class="material-icons">create</i>
          <span>Create Event</span>
        </a>
    </div>
  </div>
</div>
