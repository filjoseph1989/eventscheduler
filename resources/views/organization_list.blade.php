@extends('layouts.app')
@section('title')
  <title>{{ config('app.name', 'Home Page') }}</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap.css') }}?v=3.3.8" rel="stylesheet">
  <link href="{{ asset('css/waves.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}?v=1.0.1" rel="stylesheet">
  <link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">

  {{-- Remove Me --}}
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
</head>
<body class="theme-brown">
  @include ('templates/top-navigation')

  @include ('templates/sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                List of Organization
                <small>Display all registered organiztion in the system</small>
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <th><a href="#">Organization Name</a></th>
                      <th>Acronym</th>
                      <th>Leader</th>
                      <th>Status</th>
                    </thead>
                    <tbody>
                      @if ($organizations->count() == 0)
                        <tr>
                          <td>{{ "No entry yet" }}</td>
                        </tr>
                      @else
                        @foreach ($organizations as $key => $value)
                          <tr>
                            <td><a href="#" data-target="#org-profile" data-toggle="modal">{{ $value->organization->name }}</a></td>
                            <td>{{ $value->organization->acronym }}</a></td>
                            <td>{{ $value->user->full_name }}</td>
                            <td>{{ $value->organization->status }}</td>
                          </tr>
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
          <h4 class="modal-title" id="myModalLabel">Organization Details</h4>
        </div>
        <div class="modal-body">
          {{--  Content  --}}
          @foreach ($organizations as $key => $value)
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">{{ $value->organization->name }}</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                {{--  <td>{{ $value->organization->name }}</td>  --}}
              </tr>
              <tr>
                <td>
                  <p>
                   {{ $value->organization->description }}
                  </p>
                </td>
              </tr>
              <tr>
                <td>Lead by: {{ $value->user->full_name }}</td>
              </tr>
              <tr>
                <td>Aniversary: {{ date('M d, Y', strtotime($value->organization->anniversary)) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
  <div id="webknights" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          @endforeach
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
  <script src="{{ asset('js/bootstrap-select.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery-datatable.js') }}"?v=0.1></script>
@endsection