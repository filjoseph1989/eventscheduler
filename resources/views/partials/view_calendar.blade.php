<div class="card">
  @if (session('account') == 'osa')
    <div class="header bg-teal">
  @elseif (session('account') == 'org-head')
    <div class="header bg-teal">
  @else
    <div class="header bg-teal">
  @endif
    <h2> VIEW CALENDAR
      <small>View approved events in the calendar of particular event type</small>
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      <a href="{{ route('Calendar.show', 1) }}" class="list-group-item" >  Official Events  </a>
        @if (session('account') != 'osa')
          <a href="{{ route('Calendar.show', 2) }}" class="list-group-item" >Local Events</a>
        @endif
          <a href="{{ route('Calendar.show', 3) }}" class="list-group-item" >Personal Events</a>
    </div>
  </div>
</div>
