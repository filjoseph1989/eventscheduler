<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> </title>
  </head>
  <body style="background: black; color: white">
    <p>Title: {{ $event->title }}</p>
    <p>Description: {{ $event->description }}</p>
    <p>Venue: {{ $event->venue }}</p>
    <p>Organizer: {{ $event->organization->name }}</p>
    <p>Start Date: {{ date('Y M d', strtotime($event->date_start)) }}</p>
    <p>Time: {{ $event->date_start_time }}</p>
    <p>End Date: {{ date('Y M d', strtotime($event->date_end)) }}</p>
    <p>Time: {{ $event->date_end_time }}</p>
  </body>
</html>
