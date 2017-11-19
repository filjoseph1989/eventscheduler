<div class="card">
  @if (session('account') == 'osa')
    <div class="header" style="background-color: #9FA8DA ">
  @elseif (session('account') == 'org-head')
    <div class="header" style="background-color:#FFAB91">
  @else
    <div class="header" style="background-color:#80CBC4">
  @endif
    <h2 style="color:black"> VIEW CALENDAR
      <small style="color:black">View approved events in the calendar of particular event type</small>
    </h2>
  </div>
  <div class="body" >
    <div class="list-group manage-calendar">
      <a href="{{ route('Calendar.show', 1) }}" class="list-group-item" style="border:none;  color: #7A7A7A" >
        <i class="material-icons">stars</i>
        <span>Official Events</span>
      </a>
      @if (session('account') != 'osa')
        <a href="{{ route('Calendar.show', 2) }}" class="list-group-item" style="border:none;  color: #7A7A7A" >
          <i class="material-icons">domain</i>
          <span>Within Organization/s Events</span>
        </a>
      @endif
        <a href="{{ route('Calendar.show', 3) }}" class="list-group-item" style="border:none;  color: #7A7A7A" >
          <i class="material-icons">person_outline</i>
          <span>Personal Events</span>
        </a>
    </div>
  </div>
</div>
