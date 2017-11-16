<div class="card">
  <div class="header bg-blue-grey">
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
  <div class="body" style="border: 2px; border-style: none dashed dashed dashed">
    <div class="list-group">
      @if( session('account') == 'org-member' )
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"  style="border:none"> <strong> Edit Notification Settings for Unadvertised Personal Events </strong>  </a>
      @elseif( session('account') == 'org-head' )
        <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item"  style="border:none"> <strong> Edit Notification Settings for Unadvertised Official Events </strong> </a>
          <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"  style="border:none"> <strong> Edit Notification Settings for Unadvertised Local Events </strong> </a>
      @elseif( session('account') == 'osa' )
        <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item"  style="border:none"> <strong> Edit Notification Settings for Unadvertised Official Events </strong> </a>
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"  style="border:none"> <strong> Edit Notification Settings for Unadvertised Personal Events </strong> </a>
      @endif
      @if (Auth::user()->user_type_id == 3)
        <a href="{{ route('Event.index') }}" class="list-group-item"  style="border:none"> Approve Advertisement Request for Official Events </a>
      @endif
    </div>
  </div>
</div>
