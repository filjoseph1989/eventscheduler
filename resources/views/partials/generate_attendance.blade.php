<div class="card">
@if (session('account') == 'osa')
  <div class="header" style="background-color:#5C6BC0">
@elseif (session('account') == 'org-head')
  <div class="header bg-brown">
@else
  <div class="header bg-blue-grey">
@endif
    <h2 style="color:white"> GENERATE ATTENDANCE
      <small style="color:white">In this panel you can generate attendances for each event</small>
    </h2>
  </div>
  <div class="body"  >
    <div class="list-group" >
      @if (session('account') == 'org-head')
        <i class="material-icons" style="margin-right:5px">playlist_add_check</i> <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"  style="border:none;  color: #7A7A7A"> Official Events</a>
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
