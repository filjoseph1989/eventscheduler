@extends('layouts.master')

@section('page-title', 'list of events')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')

    @include('pages.top-nav')

    @if (isset($login_type) and $login_type == 'admin')
        @include('pages.admin.sidebar')
    @elseif (isset($login_type) and $login_type == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if (session('status_warning'))
          <div class="alert alert-warning">{!! session('status_warning') !!}</div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF EVENTS </h2>
              </div>
              <div class="body table-responsive">
                @if ($event->count() == 0)
                  <p>No entry yet</p>
                @else
                  @php $class = ($event->count() > 10) ? "js-basic-example dataTable" : ""; @endphp
                  <table class="table table-striped table-hover {{ $class }}">
                    <thead>
                      <th>Title</th>
                    </thead>
                    <tbody>
                      @foreach ($event as $key => $value)
                        <tr data-id="{{ $value->id }}" data-user="{{ Auth::user()->id }}">
                          <td>
                            <a href="#" class="event-details-notification" data-event-id="{{ $value->id }}" data-toggle="modal" data-target="#event-details">{{ $value->title }}</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <th>Title</th>
                    </tfoot>
                  </table>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
  <div class="modal fade" id="event-details" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="event-details-title">Manage Notification for Event <span id="event-name">Name</span></h4>
        </div>
        <div class="modal-body table-responsive event-table" id="event-details-body">
          <form class="" action="{{ route('org-adviser.update-notification') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="event_id" id="event_id" value="">
            <div id="event-notificiation-content">
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="demo-switch">
                    <div class="switch" id="twitter">
                      <label>OFF<input type="checkbox" name="notify_via_twitter" checked><span class="lever switch-col-blue"></span>ON</label> Twitter
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="demo-switch">
                    <div class="switch" id="facebook">
                      <label>OFF<input type="checkbox" name="notify_via_facebook" checked><span class="lever switch-col-indigo"></span>ON</label> Facebook
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <textarea rows="4" class="form-control no-resize" id="additional_msg_facebook" name="additional_msg_facebook" required placeholder="Additional message in the facebook notification"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="demo-switch">
                    <div class="switch" id="email">
                      <label>OFF<input type="checkbox" name="notify_via_email" checked><span class="lever switch-col-teal"></span>ON</label> Email
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <textarea rows="4" class="form-control no-resize" id="additional_msg_email" name="additional_msg_email" required placeholder="Additional message in the email notification"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="demo-switch">
                    <div class="switch" id="phone">
                      <label>OFF<input type="checkbox" name="notify_via_sms" checked><span class="lever switch-col-pink"></span>ON</label> Phone
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <textarea rows="4" class="form-control no-resize" id="additional_msg_sms" name="additional_msg_sms" required placeholder="Additional message in the SMS notification"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <button type="submit" class="btn btn-primary">
                      <i class="material-icons">save</i> Save
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i>Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/mindmup-editabletable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.29" charset="utf-8"></script>
@endsection
