<div class="card" dir="">
  @if (session('account') == 'osa')
    <div class="header" style="background-color:#3F51B5">
  @elseif (session('account') == 'org-head')
    <div class="header bg-red">
  @else
    <div class="header bg-blue-grey">
  @endif
    @if (Auth::user()->user_type_id == 3)
      <h2 style="color:white"> MANAGE SCHEDULE
        <small style="color:white">In this panel you view or create your personal event/s or events for your office</small>
      </h2>
    @elseif(Auth::user()->user_type_id == 1)
      <h2> SET EVENT
        <small style="color:white">In this panel you view or create your personal event/s or events for your organization</small>
      </h2>
    @else
      <h2> SET EVENT
        <small style="color:white">In this panel you view or create your personal event/s</small>
      </h2>
    @endif
  </div>
  <div class="body">
    <div class="list-group">
      @if( session('account') == 'org-head')
        <a href="{{ route('Event.show', 0) }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">group_work</i>{{ session('org_name') }} Events</a>
      @elseif( session('account') == 'org-member' )
        <a href="{{ route('Event.show', 0) }}" class="list-group-item " style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">group_work</i>My Organization Events</a>
      @endif
        <a href="{{ route('Event.show', 1) }}" class="list-group-item " style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">stars</i>Official Events</a>
      @if (session('account') == 'org-head')
          <a href="{{ route('event.dlv', 2) }}" class="list-group-item " style="border:none;  color: #7A7A7A"> <i class="material-icons" style="margin-right:5px">domain </i>  Local Events </a>
      @else
          <a href="{{ route('event.dlv', 2) }}" class="list-group-item " style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">person_outline</i>  Personal Events </a>
      @endif
        <a href="{{ route('event.dlv', 2) }}" class="list-group-item " style="border:none;  color: #7A7A7A"> <i class="material-icons" style="margin-right:5px">create</i> Create Event </a>
    </div>
  </div>
</div>
