<div class="card">
@if (session('account') == 'osa')
  <div class="header" style="background-color:#5C6BC0">
@elseif (session('account') == 'org-head')
  <div class="header" style="background-color:#FF7043">
@else
  <div class="header" style="background-color:#26A69A">
@endif
    @if (session('account') == 'osa')
      <h2 style="color:white"> GENERATE ATTENDANCE
        <small style="color:white">In this panel you can generate attendances for each event</small>
    @elseif (session('account') == 'org-head')
      <h2 style="color:black"> GENERATE ATTENDANCE
        <small style="color:black">In this panel you can generate attendances for each event</small>
    @else
      <h2 style="color:black"> GENERATE ATTENDANCE
        <small style="color:black">In this panel you can generate attendances for each event</small>
    @endif
      </h2>
  </div>
  <div class="body"  >
    <div class="list-group manage-attendance">
      @if (session('account') == 'org-head')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"  style="border:none;  color: #7A7A7A">
          <i class="material-icons">playlist_add_check</i>
          <span>Official Events</span>
        </a>
        <a href="{{ route('Attendances.show', 'Local') }}" class="list-group-item"  style="border:none;  color: #7A7A7A">
          <i class="material-icons">layers</i>
          <span>Local Events</span>
        </a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none;  color: #7A7A7A" >
          <i class="material-icons">date_range</i>
          <span>My Event Attendance</span>
        </a>
      @elseif (session('account') == 'osa')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"  style="border:none;  color: #7A7A7A">
          <i class="material-icons">playlist_add_check</i>
          <span>Official Events</span>
        </a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none;  color: #7A7A7A">
          <i class="material-icons">person_pin</i>
          <span>My Event Attendance</span>
        </a>
      @else
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none;  color: #7A7A7A">
          <i class="material-icons">person_pin</i>
          <span>My Event Attendance</span>
        </a>
      @endif
    </div>
  </div>
</div>
