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
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"  style="border:none"> <strong> Official Events </strong> </a>
        <a href="{{ route('Attendances.show', 'Local') }}" class="list-group-item"  style="border:none"> <strong> Local Events </strong> </a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none"> <strong> My Event Attendance </strong> </a>
      @elseif (session('account') == 'osa')
        <a href="{{ route('Attendances.show', 'Official') }}" class="list-group-item"  style="border:none"> <strong> Official Events </strong> </a>
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none"> <strong> My Event Attendance </strong> </a>
      @else
        <a href="{{ route('Attendances.index') }}" class="list-group-item"  style="border:none"> <strong> My Event Attendance </strong> </a>
      @endif
    </div>
  </div>
</div>
