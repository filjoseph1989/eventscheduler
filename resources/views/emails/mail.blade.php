@extends('beautymail::templates.ark')

@section('content')

    @include('beautymail::templates.ark.heading', [ 
      'heading' => 'Hello '.$event->user->first_name,
      'level'   => 'h1'
    ])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>{{ $event->title }}</strong></h4>
        <p>We would like to remind you have upcoming event this {{ date('M d, Y', strtotime($event->date_start)) }} at {{ $event->date_start_time }}
          Title <strong>{{ ucwords($event->title) }}</strong> organized by <strong>{{ ucfirst($event->organization->name) }}</strong></p>
        <p>Description of the event: {{ $event->description }}</p>
        <p>&nbsp;</p>
        <p>See you there</p>
        <p>&nbsp;</p>
        <p>Best regards</p>
        <p>{{ $event->organization->name }}</p>

    @include('beautymail::templates.ark.contentEnd')

    {{-- @include('beautymail::templates.ark.heading', [ 'heading' => 'Another headline', 'level' => 'h2' ]) --}}

    {{--

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Hello World again</strong></h4>
        <p>This is another test</p>

    @include('beautymail::templates.ark.contentEnd')

    --}}
@stop