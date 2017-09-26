<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Home Page') }}</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap.css') }}?v=3.3.8" rel="stylesheet">
  <link href="{{ asset('css/waves.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}?v=1.0.1" rel="stylesheet">

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
                Add New Organization
                <small>This form used to register new organization in the system</small>
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
                <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 col-sm-offset-2">
                  <form class="" action="{{ route('Org.store') }}" method="post">
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Organization Name" required autofocus>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="acronym" name="acronym" placeholder="Acronym" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="student_number" name="student_number" placeholder="Organization Leader Student number" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="student_name" name="student_name" placeholder="Organization Leader Name" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="student_email" name="student_email" placeholder="Organization Leader Email" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success" name="button">
                        <i class="material-icons">save</i>Save
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div id="webknights" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Janica Liz De Guzman</h4>
        </div>
        <div class="modal-body">
          <p>System Creator</p>
          <p>janicalizdeguzman at gmail dot com</p>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/jquery.min.js') }}?v=3.2.2"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}?v=3.3.8"></script>
  <script src="{{ asset('js/waves.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}?v=0.1"></script>
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
</body>
</html>
