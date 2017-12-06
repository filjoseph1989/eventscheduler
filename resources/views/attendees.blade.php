@extends('layouts.app')

@section('title')
  <title>List of Attendees</title>
@endsection

@section('css')
  <link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
<?php date_default_timezone_set('Asia/Manila'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> {{ $events->title }}
                <small>Display the list attendees of the event</small>
              </h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php if (isset($expected)): ?>
                    <h5>These are the list of user(s) who are expected to attend this event</h5>
                  <?php elseif (isset($confirmed)): ?>
                    <h5>These are the list of user(s) who confirmed to attend this event</h5>
                  <?php elseif (isset($declined)): ?>
                    <h5>These are the list of user(s) who declined to attend attendance to this event</h5>
                  <?php else: ?>
                    <h5>These are the official list of user(s) who attended this event</h5>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  {{-- Remove duplicate --}}
                  <?php foreach ($users as $ukey => $user): ?>
                    <?php foreach ($attendance as $akey => $att): ?>
                      <?php
                      if ($user->user_id == $att->user_id) {
                        unset($users[$ukey]);
                      }
                      ?>
                    <?php endforeach; ?>
                  <?php endforeach; ?>

                  <?php $count = 1; ?>
                  <table class="table table-bordered table-striped table-hover js-exportable">
                    <thead>
                      <tr>
                        <th style="width: 100px;">Count</th>
                        <th>Name</th>
                        <th>RESPONSE</th>
                        <?php if (isset($expected) and $creator === true and (date('Y-m-d', strtotime($events->date_start)) == date('Y-m-d'))): ?>
                          <th>ACTUAL</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($attendance as $key => $att): ?>
                        <tr>
                          <td>{{ $count++ }}</td>
                          <td>{{ $att->user->full_name }}</td>
                          <td> {{ ucwords($att->status) }} </td>
                          <?php if (isset($expected) and $creator === true and (date('Y-m-d', strtotime($events->date_start)) == date('Y-m-d'))): ?>
                            <td>
                              @if($att->did_attend == 'true')
                                <button type="button" class="confirm-attendance btn" data-event-id="{{ $events->id }}" data-attendance-id="{{ $user->user->id }}"
                                  data-actual="false">
                                  PRESENT
                                </button>
                              @elseif($att->did_attend == 'false')
                                <button type="button" class="confirm-attendance btn" data-event-id="{{ $events->id }}" data-attendance-id="{{ $user->user->id }}"
                                  data-actual = "true" >
                                  ABSENT
                                </button>
                              @endif
                            </td>
                          <?php endif; ?>
                        </tr>
                      <?php endforeach; ?>

                      <?php foreach ($users as $key => $user): ?>
                        <tr>
                          <td>{{ $count++ }}</td>
                          <td>{{ $user->user->full_name }}</td>
                          <td>Not Yet Determined</td>
                          <?php if (isset($expected) and $creator === true and (date('Y-m-d', strtotime($events->date_start)) == date('Y-m-d'))): ?>
                            <td>
                                <button type="button" class="confirm-attendance btn" data-event-id="{{ $events->id }}" data-attendance-id="{{ $user->user->id }}"
                                  data-actual = "false" >
                                  NOT YET DETERMINED
                                </button>
                            </td>
                          <?php endif; ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@section('modals')
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}?v=0.1"></script>
  <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('js/buttons.print.min.js') }}"></script>

  <script src="{{ asset('js/app.js') }}?v=2.7"></script>
  <?php if (isset($creator) and $creator === true): ?>
    <script type="text/javascript">
      (function() {
        $(document).on('click', '.confirm-attendance', function() {
          var _this = $(this);
          let data = {
            id: $(this).data('attendance-id'),
            event_id: $(this).data('event-id'),
            actual: $(this).data('actual')
          };

          axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          axios.post('/attendance/update', data)
            .then(function (response) {
              if (response.data.actual == true) {
                $(_this).addClass('btn-success');
                $(_this).removeClass('btn-default');
                $(_this).html('PRESENT');
              } else {
                $(_this).removeClass('btn-success');
                $(_this).addClass('btn-default');
                $(_this).html('ABSENT');
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        });
      })();
    </script>
  <?php endif; ?>
@endsection
