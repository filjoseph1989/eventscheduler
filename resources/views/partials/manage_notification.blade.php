<div class="card">
  <div class="header">
    <h2> MANAGE NOTIFICATIONS
      @if (Auth::user()->user_type_id == 1)
        <small>you panel for notification management for your org's events or your personal events</small>
      @else
        <small>you panel for notification management for your personal events</small>
      @endif
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      <a href="javascript:void(0);" class="list-group-item"> Edit Notification Settings </a>
      @if (Auth::user()->user_type_id == 3)
        <a href="javascript:void(0);" class="list-group-item"> Approve Events </a>
      @endif
    </div>
  </div>
</div>
