<div class="card">
  <div class="header">
    @if (Auth::user()->user_type_id == 3)
      <h2> ADVERTISE / SET EVENT
        <small>In this panel you view or set your personal event/s or events for your office</small>        
      </h2>
    @elseif(Auth::user()->user_type_id == 1)
      <h2> SET EVENT
        <small>In this panel you view or set your personal event/s or events for your organization</small>
      </h2>
    @else
      <h2>
        <small>In this panel you set your personal event/s</small>
      </h2>
    @endif
  </div>
  <div class="body">
    <div class="list-group">
      {{-- sa side-bar na lang ang create events, dri kay mag check na lang jud sa list of events tapos
        approve.. kulang pa ata ang list of event og is_approve status tapos kailangan pud makita iyang type of official
        event, kung university or organizations sa sulod na lang sa link sa event tung status na field --}}
      
        <a href="{{ route('Event.show', 1) }}" class="list-group-item"> Official Events </a>      
        <a href="{{ route('event.dlv', 2) }}"  class="list-group-item" > Personal Events </a>
    </div>
  </div>
</div>
