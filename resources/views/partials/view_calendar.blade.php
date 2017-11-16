<div class="card">
  @if (session('account') == 'osa')
    <div class="header bg-purple">
  @elseif (session('account') == 'org-head')
    <div class="header bg-brown">
  @else
    <div class="header bg-blue-grey">
  @endif
    <h2> VIEW CALENDAR
      <small>View events in the calendar of particular event type</small>
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      <a href="{{ route('Calendar.show', 1) }}" class="list-group-item"  style="border:none"> <strong> Official Events </strong>  </a>
      <a href="{{ route('Calendar.show', 2) }}" class="list-group-item"  style="border:none"> <strong> Personal Events </strong> </a>
    </div>
  </div>
</div>
