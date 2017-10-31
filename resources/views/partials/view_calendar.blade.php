<div class="card">
  <div class="header">
    <h2> VIEW CALENDAR
      <small>View events in the calendar of particular event type</small>
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      <a href="{{ route('Calendar.show', 1) }}" class="list-group-item"> Official Events </a> 
      <a href="{{ route('Calendar.show', 2) }}" class="list-group-item"> Personal Events </a>
    </div>
  </div>
</div>
