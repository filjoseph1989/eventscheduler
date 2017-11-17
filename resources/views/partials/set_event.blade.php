<div class="card" dir="">
  @if (session('account') == 'osa')
    <div class="header bg-purple">
  @elseif (session('account') == 'org-head')
    <div class="header bg-brown">
  @else
    <div class="header bg-blue-grey">
  @endif
    @if (Auth::user()->user_type_id == 3)
      <h2> MANAGE SCHEDULE
        <small>In this panel you view or set your personal event/s or events for your office</small>
      </h2>
    @elseif(Auth::user()->user_type_id == 1)
      <h2> SET EVENT
        <small>In this panel you view or set your personal event/s or events for your organization</small>
      </h2>
    @else
      <h2> SET EVENT
        <small>In this panel you view or set your personal event/s</small>
      </h2>
    @endif
  </div>
  <div class="body">
    <div class="list-group">
      @if( session('account') == 'org-head')
        <a href="{{ route('Event.show', 0) }}" class="list-group-item"><strong> {{ session('org_name') }} </strong>Events</a>
      @elseif( session('account') == 'org-member' )
        <a href="{{ route('Event.show', 0) }}" class="list-group-item">My Organization Events</a>
      @endif
        <a href="{{ route('Event.show', 1) }}" class="list-group-item">Official Events</a>
      @if (session('account') == 'org-head')
          <a href="{{ route('event.dlv', 2) }}" class="list-group-item"> Local Events </a>
      @else
          <a href="{{ route('event.dlv', 2) }}" class="list-group-item"> Personal Events </a>
      @endif
    </div>
  </div>
</div>
