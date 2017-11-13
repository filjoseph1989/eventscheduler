<div class="card">
  <div class="header">
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
      <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item"> Edit Notification Settings of Unadvertised Official Events </a>
      @if(Auth::user()->user_type_id != 1)
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"> Edit Notification Settings of Unadvertised Personal Events </a>
      @else
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"> Edit Notification Settings of Unadvertised Local Events </a>
      @endif
      @if (Auth::user()->user_type_id == 3)
        <a href="{{ route('Event.index') }}" class="list-group-item"> Approve Advertisement Request for Official Events </a>
      @endif
    </div>
  </div>
</div>
