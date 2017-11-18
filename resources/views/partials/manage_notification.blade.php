<div class="card">
  @if (session('account') == 'osa')
    <div class="header" style="background-color:#7986CB" >
  @elseif (session('account') == 'org-head')
    <div class="header" style="background-color:#FF8A65">
  @else
    <div class="header" style="background-color:#4DB6AC">
  @endif
  @if (session('account') == 'osa')
    <h2 style="color:white"> MANAGE NOTIFICATIONS
  @elseif (session('account') == 'org-head')
    <h2 style="color:black"> MANAGE NOTIFICATIONS
  @else
    <h2 style="color:black"> MANAGE NOTIFICATIONS
  @endif
      @if (Auth::user()->user_type_id == 1)
        <small style="color:black">your panel for notification management for your org's events or your personal events</small>
      @elseif (Auth::user()->user_type_id == 3)
        <small style="color:white">your panel where you approve advertisement requests and notification management of events</small>
      @else
        <small style="color:black">your panel for notification management for your personal events</small>
      @endif
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      @if( session('account') == 'org-member' )
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">settings_input_composite</i>  Edit Notification Settings for Unadvertised Personal Events </a>
      @elseif( session('account') == 'org-head' )
        <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">settings_input_composite</i>  Edit Notification Settings for Unadvertised Official Events</a>
          <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">settings_input_composite</i>  Edit Notification Settings for Unadvertised Local Events</a>
      @elseif( session('account') == 'osa' )
        <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">settings_input_composite</i>  Edit Notification Settings for Unadvertised Official Events</a>
        <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">settings_input_composite</i>  Edit Notification Settings for Unadvertised Personal Events</a>
      @endif
      @if (Auth::user()->user_type_id == 3)
        <a href="{{ route('Event.index') }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">playlist_add_check</i> Approve Advertisement Request for Official Events</a>
      @endif
    </div>
  </div>
</div>
