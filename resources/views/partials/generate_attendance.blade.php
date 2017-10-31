<div class="card">
  <div class="header">
    <h2> GENERATE ATTENDANCE
      <small>In this panel you can generate attendances for each event</small>
    </h2>
  </div>
  <div class="body">
    <div class="list-group">
      @if (session('account') == 'org-head')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item">Official Events</a>
        <a href="{{ route('Attendances.show', 'Local') }}" class="list-group-item">Local Events</a>
      @elseif (session('account') == 'osa')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item">Official Events</a>
      @else
        <a href="{{ route('Attendances.index') }}" class="list-group-item">My Event Attendance</a>
      @endif
    </div>
  </div>
</div>
