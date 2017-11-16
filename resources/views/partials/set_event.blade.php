<div class="card" dir="">
  <div class="header bg-brown" style="border:none">
    @if (Auth::user()->user_type_id == 3)
      <h2> ADVERTISE / SET EVENT
        <small>In this panel you view or set your personal event/s or events for your office</small>
      </h2>
    @elseif(Auth::user()->user_type_id == 1)
      <h2> SET EVENT
        <small>In this panel you view or set your personal event/s or events for your organization</small>
      </h2>
    @else
      <h2> SET EVENT
        <small>In this panel you set your personal event/s</small>
      </h2>
    @endif
  </div>
  <div class="body" style="border: 2px; border-style: none dashed dashed dashed">
    <div class="list-group">
      {{-- sa side-bar na lang ang create events, dri kay mag check na lang jud sa list of events tapos
        approve.. kulang pa ata ang list of event og is_approve status tapos kailangan pud makita iyang type of official
        event, kung university or organizations sa sulod na lang sa link sa event tung status na field --}}

        <a href="{{ route('Event.show', 1) }}" class="list-group-item" style="border:none"> <strong> Official Events </strong> </a>
        <a href="{{ route('event.dlv', 2) }}"  class="list-group-item" style="border:none" > <strong> Personal Events </strong> </a>
    </div>
  </div>
</div>
