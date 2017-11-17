<div class="card">
@if (session('account') == 'osa')
  <div class="header bg-purple">
@elseif (session('account') == 'org-head')
  <div class="header bg-brown">
@else
  <div class="header bg-blue-grey">
@endif
    <h2> GENERATE ATTENDANCE
      <small>In this panel you can generate attendances for each event</small>
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      @if (session('account') == 'org-head')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"> Official Events</a>
        <a href="{{ route('Attendances.show', 'Local') }}" class="list-group-item"> Local Events</a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"> My Event Attendance</a>
      @elseif (session('account') == 'osa')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"> Official Events</a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"> My Event Attendance</a>
      @else
        <a href="{{ route('Attendances.index') }}" class="list-group-item"> My Event Attendance</a>
      @endif
    </div>
  </div>
</div>
