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
  <section class="sidebar">
    <aside id="leftsidebar" class="sidebar">
      <div class="user-info">
        <div class="image">
          <img src="/images/profile.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Eldora Vandervort</div>
          <div class="email">nannie73@emard.net</div>
          <div class="email">organization-head</div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
              <li><a href="/users/profile/1"><i class="material-icons">person</i>Profile</a></li>
              <li role="seperator" class="divider"></li>
              <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="material-icons">input</i> Sign Out
                </a>
                <form id="logout-form" action="/users/logout" method="POST" style="display: none;">
                  <input type="hidden" name="_token" value="PjMLKYxnBUqo7t4YyZpwYNY8AWL0k3qaMWeMVwyL">
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="menu">
        <ul class="list">
          <li class="header">MAIN NAVIGATION</li>
          <li class="active">
            <a href="/home">
              <i class="material-icons">home</i>
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="{{ route('User.index') }}" class="menu-toggle">
              <i class="material-icons">account_circle</i>
              <span>System User</span>
            </a>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">group_work</i>
              <span>Organization</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="#">
                  <span>Add New</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>University Organizations</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">alarm</i>
              <span>Events</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="#">
                  <span>Add New</span>
                </a>
              </li>
              <li>
                <a href="#" class="menu-toggle">
                  <span>list</span>
                </a>
                <ul class="ml-menu">
                  <li>
                    <a href="#"><span>Official</span> </a>
                  </li>
                  <li>
                    <a href="#"> <span>Personal</span> </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#"><span>Approved Events</span></a>
              </li>
              <li>
                <a href="#" class="menu-toggle">
                  <span>Calendar</span>
                </a>
                <ul class="ml-menu">
                  <li>
                    <a href="#"><span>Official</span> </a>
                  </li>
                  <li>
                    <a href="#"> <span>Personal</span> </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">check_circle</i>
              <span>Attendances</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="#">
                  <span>Create</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>list</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="legal">
        <div class="copyright">
          &copy; 2017 <a href="#">Event Scheduler System</a>.
        </div>
        <div class="version">
          <b>Version: </b> 2.0.0 | <a href="#" data-toggle="modal" data-target="#webknights">Liz</a>
        </div>
      </div>
    </aside>
    <aside id="rightsidebar" class="right-sidebar">
      <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
      </ul>
    </aside>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                ADVERTISEMENT
                <small>In this panel you set or approved for advertisement</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-pink">14 For Approval</span> Official Events
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-cyan">99 Upcoming</span> Personal Events
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                CALENDAR
                <small>Show the event in a calendar</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-pink">14 New</span> Official Events
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-cyan">99 Unread</span> Personal Events
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                ATTENDANCE
                <small>In this panel you set the user attendance for each event</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-pink">14 Attendees</span> Official
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-cyan">99 Confirmed</span> Confirmation
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-teal">0</span> Expected
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-blue">0</span> Decline
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                MANAGE NOTIFICATIONS
                <small>you panel for notification management</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item"> Notification Settings </a>
                <a href="javascript:void(0);" class="list-group-item"> Approved Events </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="notification" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Accept Invitation</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          ...
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
</body>
</html>
