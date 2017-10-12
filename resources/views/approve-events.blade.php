@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Approve Events') }}</title>
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

          @if (session('status'))
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Dismiss alert">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('status') }}
            </div>
          @endif
          
          <div class="card">
            <div class="header">
              <h2> Approve Events
                <small>Display organizations in the system</small>
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
                  @php extract($helper->dataTableClass($events)) @endphp
                  <table class="table table-bordered table-striped table-hover {{ $class }}">
                    <thead>
                      <tr>
                        <th><a href="#">Organization Name</a></th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($events as $key => $event)
                        <tr class="approve-event" data-event-id="{{ $event->id }}">
                          <td>{{ $event->title }}</td>
                          <td>
                            <form class="approve-event" action="{{ route('Approve.update', $event->id) }}" method="POST">
                              {{ csrf_field() }}
                              {{ method_field('PUT') }}
                              <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <th>Title</th>
                      <th>Action</th>
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
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
@endsection
