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
  <link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">

  {{-- Remove Me --}}
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
</head>
<body class="theme-brown">
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="preloader">
        <div class="spinner-layer pl-red">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      <p>Please wait...</p>
    </div>
  </div>
  <div class="overlay"></div>
  <div class="search-bar">
    <div class="search-icon">
      <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
      <i class="material-icons">close</i>
    </div>
  </div>
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="#" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="#" class="bars"></a>
        <a class="navbar-brand" href="/home" title="Event Scheduler System">
          <i class="material-icons">access_time</i>
        </a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
              <i class="material-icons">notifications</i>
              <span class="label-count">7</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">NOTIFICATIONS</li>
              <li class="body">
                <ul class="menu">
                  <li>
                    <a href="#" data-target="#notification" data-toggle="modal">
                      <div class="icon-circle bg-light-green">
                        <i class="material-icons">mail_outline</i>
                      </div>
                      <div class="menu-info">
                        <h4>You're invited to join <br>Alpha Phi Omega</h4>
                        <p>
                          <i class="material-icons">access_time</i> 14 mins ago
                        </p>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer">
                <a href="#">View All Notifications</a>
              </li>
            </ul>
          </li>
          <li class="pull-right"><a href="#" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
        </ul>
      </div>
    </div>
  </nav>

  @include ('templates/sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                Official Calendar
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
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <th><a href="#">Organization Name</a></th>
                      <th>Abbrivation</th>
                      <th>Leader</th>
                      <th>Status</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#" data-target="#org-profile" data-toggle="modal">Computer Science Society</a></td>
                        <td>CSS</td>
                        <td><a href="#">Mark Zuckerberg</a></td>
                        <td>Active</td>
                      </tr>
                      <tr>
                        <td><a href="#" data-target="#org-profile" data-toggle="modal">Association of IT students</a></td>
                        <td>AITS</td>
                        <td><a href="#">Donald Trump</a></td>
                        <td>Active</td>
                      </tr>
                      <tr>
                        <td><a href="#" data-target="#org-profile" data-toggle="modal">Association of Engineering students</a></td>
                        <td>AES</td>
                        <td><a href="#">Elon Musk</a></td>
                        <td>Active</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <th>Organization Name</th>
                      <th>Abbrivation</th>
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
  <div id="org-profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Computer Science Society</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td>Computer Science Society</td>
              </tr>
              <tr>
                <td>
                  <p>
                    First appeared in 2017, when the two of the student of Bachelor of Science in Computer Science
                    Namely Larry Page and Sergey Brin in time of on going research conventional search engine that
                    ranked results by counting how many times the search terms appeared on the page and
                    analyzed the relationships among websites called pagerank
                  </p>
                  <p>These project grow and now what is known as google</p>
                </td>
              </tr>
              <tr>
                <td>Lead by: Jeff Bezos</td>
              </tr>
              <tr>
                <td>Aniversary: September 25, 2017</td>
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
  <script src="{{ asset('js/bootstrap-select.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery-datatable.js') }}"?v=0.1></script>
</body>
</html>
