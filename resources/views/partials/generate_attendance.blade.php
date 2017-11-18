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
    <div class="list-group" >
      @if (session('account') == 'org-head')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">playlist_add_check</i> Official Events</a>
        <a href="{{ route('Attendances.show', 'Local') }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">layers</i> Local Events</a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none;  color: #7A7A7A" > My Event Attendance</a>
      @elseif (session('account') == 'osa')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">playlist_add_check</i> Official Events</a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">person_pin</i> My Event Attendance</a>
      @else
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none;  color: #7A7A7A"><i class="material-icons" style="margin-right:5px">person_pin</i> My Event Attendance</a>
      @endif
    </div>
  </div>
</div>
