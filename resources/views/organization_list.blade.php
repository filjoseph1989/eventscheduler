@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Home Page') }}</title>
@endsection

@section('css')
  <link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> List of Organization
                <small>Display all registered organiztion in the system</small>
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">&nbsp;</ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  {{--  @php extract($helper->dataTableClass($organizations)) @endphp  --}}
                  <table class="table table-bordered table-striped table-hover {{-- $class --}}">
                    <thead>
                      <th>Organization Name</th>
                      <th>Acronym</th>
                      <th>Leader</th>
                      <th>Status</th>
                    </thead>
                    <tbody>
                      @if ( is_null($organizations) )
                        <tr>
                          <td>{{ "No entry yet" }}</td>
                        </tr>
                      @else
                        @foreach ($organizations as $key => $org)
                          @foreach( $org as $key => $value )
                            <tr data-organization-id="{{ $value->organization->id }}">
                              <td>
                                <a href="#" class="organization-list-name" data-target="#org-profile" data-toggle="modal">
                                  {{ $value->organization->name }}
                                  @if( $value->user->id == Auth::id() && Auth::user()->user_type_id != 3)
                                    (I am the head)
                                  @endif
                                </a>
                              </td>
                              <td>{{ $value->organization->acronym }}</a></td>
                              <td>{{ $value->user->full_name }}</td>
                              <td>{{ ucwords($value->organization->status) }}</td>
                            </tr>
                          @endforeach
                        @endforeach
                      @endif
                    </tbody>
                    <tfoot>
                      <th>Organization Name</th>
                      <th>Acronym</th>
                      <th>Leader</th>
                      <th>Status</th>
                    </tfoot>
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
  <div id="org-profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="org-profile-title"></h4>
        </div>
        <div class="modal-body">
          <?php
            $id = "";
            if (session('account') == 'org-head') {
              $id = "mainTable";
            }
          ?>
          <table class="table table-bordered table-striped" id="{{ $id }}">
            <tbody>
              <tr>
                <td id="org-profile-acronym" data-name="acronym"></td>
              </tr>
              <tr>
                <td id="org-profile-description" data-name="description"></td>
              </tr>
              <tr>
                <td id="org-profile-url" data-name="url"></td>
              </tr>
              <tr>
                <td id="org-profile-aniversary" data-name="aniversary"></td>
              </tr>
            </tbody>
          </table>
          <form class="hidden" id="organization-edit-form" action="" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="text" id="organization-form-input" name="" value="">
          </form>
          <a class="btn btn-success" id="official-event-submit"> Official Events</a>
          <a class="btn btn-success" id="local-event-submit">Local Events</a>
          <a class="btn btn-success" id="member-list">Members</a>
        </div>
        <div class="modal-footer">
          ...
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/mindmup-editabletable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.15"></script>
  <script>
    // We inclode this into function to prevent missed up with
    // Other
    (function() {
      $('#mainTable').editableTableWidget();

      $('#mainTable td').on('change', function(evt, newValue) {
        var $name = $(this).data('name');
        var $url  = "<?php echo route('Org.update', Auth::id()) ?>";

        $('#organization-edit-form').attr('action', $url);
        $('#organization-form-input').val(newValue);
        $('#organization-form-input').attr('name', $name);

        $('#organization-edit-form').submit();
      });

    })();
  </script>
@endsection
