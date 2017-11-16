<div class="card">
  <div class="header bg-black">
    <h2> GENERATE ATTENDANCE
      <small>In this panel you can generate attendances for each event</small>
    </h2>
  </div>
  <div class="body" style="border: 2px; border-style: none dashed dashed dashed">
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
