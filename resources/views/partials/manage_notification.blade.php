<div class="card">
  @if (session('account') == 'osa')
    <div class="header bg-purple">
  @elseif (session('account') == 'org-head')
    <div class="header bg-brown">
  @else
    <div class="header bg-blue-grey">
  @endif
    <h2> MANAGE NOTIFICATIONS
      @if (Auth::user()->user_type_id == 1)
        <small>your panel for notification management for your org's events or your personal events</small>
      @elseif (Auth::user()->user_type_id == 3)
        <small>your panel where you approve advertisement requests of events</small>
        <small>your panel for notification management for your personal events</small>
      @else
        <small>your panel for notification management for your personal events</small>
      @endif
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      @if( session('account') == 'org-member' )
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item">  Edit Notification Settings for Unadvertised Personal Events  </a>
      @elseif( session('account') == 'org-head' )
        <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item">  Edit Notification Settings for Unadvertised Official Events </a>
          <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item">  Edit Notification Settings for Unadvertised Local Events </a>
      @elseif( session('account') == 'osa' )
        <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item">  Edit Notification Settings for Unadvertised Official Events </a>
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item">  Edit Notification Settings for Unadvertised Personal Events </a>
      @endif
      @if (Auth::user()->user_type_id == 3)
        <a href="{{ route('Event.index') }}" class="list-group-item"> Approve Advertisement Request for Official Events </a>
      @endif
    </div>
  </div>
</div>
