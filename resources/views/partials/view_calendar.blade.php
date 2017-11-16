<div class="card">
  <div class="header bg-grey">
    <h2> VIEW CALENDAR
      <small>View events in the calendar of particular event type</small>
    </h2>
  </div>
  <div class="body" style="border: 2px; border-style: none dashed dashed dashed">
    <div class="list-group">
      <a href="{{ route('Calendar.show', 1) }}" class="list-group-item"  style="border:none"> <strong> Official Events </strong>  </a>
      <a href="{{ route('Calendar.show', 2) }}" class="list-group-item"  style="border:none"> <strong> Personal Events </strong> </a>
    </div>
  </div>
</div>
