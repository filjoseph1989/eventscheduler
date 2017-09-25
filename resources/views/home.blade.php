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
  <link href="{{ asset('css/bootstrap.css') }}?v=3.3.7" rel="stylesheet">
  <link href="{{ asset('css/waves.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}?v=0.20" rel="stylesheet">

  {{-- Remove Me --}}
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fullcalendar.css') }}?v=0.1" rel="stylesheet">
  <link href="{{ asset('css/fullcalendar.print.css') }}?v=0.1" rel="stylesheet">
</head>
<head>

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
        <a class="navbar-brand" href="http://fil2.local/home" title="Event Scheduler System">
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

  <section>
    <aside id="leftsidebar" class="sidebar">
      <div class="user-info">
        <div class="image">
          <img src="http://fil2.local/images/profile.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Eldora Vandervort</div>
          <div class="email">nannie73@emard.net</div>
          <div class="email">organization-head</div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
              <li><a href="http://fil2.local/users/profile/1"><i class="material-icons">person</i>Profile</a></li>
              <li role="seperator" class="divider"></li>
              <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="material-icons">input</i> Sign Out
                </a>
                <form id="logout-form" action="http://fil2.local/users/logout" method="POST" style="display: none;">
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
            <a href="http://fil2.local/home">
              <i class="material-icons">home</i>
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">date_range</i>
              <span>Organization</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="http://fil2.local/users/org-head/list_of_organizations">
                  <span>University Organizations</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">event_seat</i>
              <span>Events</span>
            </a>
            <ul class="ml-menu">
              <li><a href="http://fil2.local/users/org-head/new-event">Create Event</a></li>
              <li><a href="http://fil2.local/users/org-head/my/new/event">Create My Events</a></li>
              <li><a href="http://fil2.local/users/org-head/get/event-list">List of Events</a></li>
              <li><a href="http://fil2.local/users/org-head/approve/event">Approve Events</a></li>
              <li><a href="http://fil2.local/users/org-head/calendar">Event Calendar</a></li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">person</i>
              <span>Members</span>
            </a>
            <ul class="ml-menu">
              <li><a href="http://fil2.local/users/org-head/members/list">All Members</a></li>
              <li><a href="http://fil2.local/users/org-head/members/invite">Invite</a></li>
              <li><a href="http://fil2.local/users/org-head/members/accept">Accept</a></li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">list</i>
              <span>Generate Attendance</span>
            </a>
            <ul class="ml-menu">
              <li><a href="http://fil2.local/users/org-head/generate/declined-attendance/org-list">Generate Declined Attendance</a></li>
              <li><a href="http://fil2.local/users/org-head/generate/confirmed-attendance/org-list">Generate Confirmed Attendance</a></li>
              <li><a href="http://fil2.local/users/org-head/attendance/org-list">Confirm and View Organization Members' Event Expected Attendance/s</a></li>
              <li><a href="http://fil2.local/users/org-head/generate/official-attendance/org-list">Generate Official Attendance</a></li>
              <li><a href="#">Check My Attendance</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="legal">
        <div class="copyright">
          &copy; 2017 <a href="#">Event Scheduler System</a>.
        </div>
        <div class="version">
          <b>Version: </b> 1.0.0
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
      <div class="block-header">
        <h2>WELCOME <span class="font-10">Eldora</span></h2>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="http://fil2.local/users/org-head/manage-schedule">
          <div class="info-box bg-brown hover-expand-effect">
            <div class="icon">
              <i class="material-icons">date_range</i>
            </div>
            <div class="content">
              <div class="text">Manage Schedule</div>
              <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="http://fil2.local/users/org-head/generate-attendance/menu">
          <div class="info-box bg-brown hover-expand-effect">
            <div class="icon">
              <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
              <div class="text">Generate Attendance</div>
              <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="http://fil2.local/users/org-head/manage-notification-menu">
          <div class="info-box bg-brown hover-expand-effect">
            <div class="icon">
              <i class="material-icons">playlist_add</i>
            </div>
            <div class="content">
              <div class="text">Manage Notifications</div>
              <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
            </div>
          </div>
        </a>
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
  <script src="{{ asset('js/jquery.min.js') }}?v=3.2.2"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}?v=3.3.8"></script>
  <script src="{{ asset('js/waves.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}?v=0.1"></script>
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
</body>
</html>
