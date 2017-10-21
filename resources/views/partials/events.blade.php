<?php
  if (isset($ev)) {
    $event = $ev;
  }
?>

<tr data-event="{{ $event->id }}" data-route="{{ route('Event.edit', $event->id) }}" data-action="{{ route('Event.update', $event->id) }}">
  <td>
    @if (Auth::user()->user_type_id == 1 or Auth::user()->user_type_id == 2)
      <a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ ucwords($event->title) }}</a>
    @else
      <a href="#" class="">{{ ucwords($event->title) }}</a>
    @endif
  </td>
  <td><a href="#">{{ $event->venue }}</a></td>
  <td> {{ $event->organization->name }} </td>
  <td>{{ date('M d, Y', strtotime($event->date_start)) }} {{ date('h:i A', strtotime($event->date_start_time)) }}</td>
  <td>{{ date('M d, Y', strtotime($event->date_end)) }} {{ date('h:i A', strtotime($event->date_end_time)) }}</td>
  @if (Auth::user()->user_type_id != 2)
    <td>{{ ucwords($event->status) }}</td>
  @endif
</tr>
