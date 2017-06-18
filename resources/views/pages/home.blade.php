@extends('layouts.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/morris.css') }}?v=0.15">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}?v=0.15">
@endsection

@section('content')
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
        <a class="navbar-brand" href="">Event Scheduler System</a>
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
                    <a href="#">
                      <div class="icon-circle bg-light-green">
                        <i class="material-icons">person_add</i>
                      </div>
                      <div class="menu-info">
                        <h4>12 new members joined</h4>
                        <p>
                          <i class="material-icons">access_time</i> 14 mins ago
                        </p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="icon-circle bg-cyan">
                        <i class="material-icons">add_shopping_cart</i>
                      </div>
                      <div class="menu-info">
                        <h4>4 sales made</h4>
                        <p>
                          <i class="material-icons">access_time</i> 22 mins ago
                        </p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="icon-circle bg-red">
                        <i class="material-icons">delete_forever</i>
                      </div>
                      <div class="menu-info">
                        <h4><b>Nancy Doe</b> deleted account</h4>
                        <p>
                          <i class="material-icons">access_time</i> 3 hours ago
                        </p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="icon-circle bg-orange">
                        <i class="material-icons">mode_edit</i>
                      </div>
                      <div class="menu-info">
                        <h4><b>Nancy</b> changed name</h4>
                        <p>
                          <i class="material-icons">access_time</i> 2 hours ago
                        </p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="icon-circle bg-blue-grey">
                        <i class="material-icons">comment</i>
                      </div>
                      <div class="menu-info">
                        <h4><b>John</b> commented your post</h4>
                        <p>
                          <i class="material-icons">access_time</i> 4 hours ago
                        </p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="icon-circle bg-light-green">
                        <i class="material-icons">cached</i>
                      </div>
                      <div class="menu-info">
                        <h4><b>John</b> updated status</h4>
                        <p>
                          <i class="material-icons">access_time</i> 3 hours ago
                        </p>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="icon-circle bg-purple">
                        <i class="material-icons">settings</i>
                      </div>
                      <div class="menu-info">
                        <h4>Settings updated</h4>
                        <p>
                          <i class="material-icons">access_time</i> Yesterday
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
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
              <i class="material-icons">flag</i>
              <span class="label-count">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">TASKS</li>
              <li class="body">
                <ul class="menu tasks">
                  <li>
                    <a href="#">
                      <h4> Footer display issue <small>32%</small> </h4>
                      <div class="progress">
                        <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <h4> Make new buttons <small>45%</small> </h4>
                      <div class="progress">
                        <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <h4> Create new dashboard <small>54%</small> </h4>
                      <div class="progress">
                        <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <h4> Solve transition issue <small>65%</small> </h4>
                      <div class="progress">
                        <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <h4> Answer GitHub questions <small>92%</small> </h4>
                      <div class="progress">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer">
                <a href="#">View All Tasks</a>
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
          <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
          <div class="email">john.doe@example.com</div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
              <li><a href="#"><i class="material-icons">person</i>Profile</a></li>
              <li role="seperator" class="divider"></li>
              <li><a href="#"><i class="material-icons">group</i>Followers</a></li>
              <li><a href="#"><i class="material-icons">favorite</i>Likes</a></li>
              <li role="seperator" class="divider"></li>
              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="material-icons">input</i> Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
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
            <a href="index.html">
              <i class="material-icons">home</i>
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="#" class="menu-toggle">
              <i class="material-icons">widgets</i>
              <span>Widgets</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="#" class="menu-toggle">
                  <span>Option 1</span>
                </a>
                <ul class="ml-menu">
                  <li>
                    <a href="#">Sub-Option</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#" class="menu-toggle">
                  <span>Infobox</span>
                </a>
                <ul class="ml-menu">
                  <li>
                    <a href="#">Infobox-1</a>
                  </li>
                  <li>
                    <a href="#">Infobox-2</a>
                  </li>
                  <li>
                    <a href="#">Infobox-3</a>
                  </li>
                  <li>
                    <a href="#">Infobox-4</a>
                  </li>
                  <li>
                    <a href="#"Infobox-5</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="header">LABELS</li>
          <li>
            <a href="#">
              <i class="material-icons col-red">donut_large</i>
              <span>Important</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="material-icons col-amber">donut_large</i>
              <span>Warning</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="material-icons col-light-blue">donut_large</i>
              <span>Information</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="legal">
        <div class="copyright">
          &copy; 2017 <a href="#">Event Scheduler Syste,</a>.
        </div>
        <div class="version">
          <b>Version: </b> 1.0.0
        </div>
      </div>
    </aside>
    <aside id="rightsidebar" class="right-sidebar">
      <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
        <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
          <ul class="demo-choose-skin">
            <li data-theme="red" class="active">
              <div class="red"></div>
              <span>Red</span>
            </li>
            <li data-theme="pink">
              <div class="pink"></div>
              <span>Pink</span>
            </li>
            <li data-theme="purple">
              <div class="purple"></div>
              <span>Purple</span>
            </li>
            <li data-theme="deep-purple">
              <div class="deep-purple"></div>
              <span>Deep Purple</span>
            </li>
            <li data-theme="indigo">
              <div class="indigo"></div>
              <span>Indigo</span>
            </li>
            <li data-theme="blue">
              <div class="blue"></div>
              <span>Blue</span>
            </li>
            <li data-theme="light-blue">
              <div class="light-blue"></div>
              <span>Light Blue</span>
            </li>
            <li data-theme="cyan">
              <div class="cyan"></div>
              <span>Cyan</span>
            </li>
            <li data-theme="teal">
              <div class="teal"></div>
              <span>Teal</span>
            </li>
            <li data-theme="green">
              <div class="green"></div>
              <span>Green</span>
            </li>
            <li data-theme="light-green">
              <div class="light-green"></div>
              <span>Light Green</span>
            </li>
            <li data-theme="lime">
              <div class="lime"></div>
              <span>Lime</span>
            </li>
            <li data-theme="yellow">
              <div class="yellow"></div>
              <span>Yellow</span>
            </li>
            <li data-theme="amber">
              <div class="amber"></div>
              <span>Amber</span>
            </li>
            <li data-theme="orange">
              <div class="orange"></div>
              <span>Orange</span>
            </li>
            <li data-theme="deep-orange">
              <div class="deep-orange"></div>
              <span>Deep Orange</span>
            </li>
            <li data-theme="brown">
              <div class="brown"></div>
              <span>Brown</span>
            </li>
            <li data-theme="grey">
              <div class="grey"></div>
              <span>Grey</span>
            </li>
            <li data-theme="blue-grey">
              <div class="blue-grey"></div>
              <span>Blue Grey</span>
            </li>
            <li data-theme="black">
              <div class="black"></div>
              <span>Black</span>
            </li>
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="settings">
          <div class="demo-settings">
            <p>GENERAL SETTINGS</p>
            <ul class="setting-list">
              <li>
                <span>Report Panel Usage</span>
                <div class="switch">
                  <label>
                    <input type="checkbox" checked><span class="lever"></span></label>
                </div>
              </li>
              <li>
                <span>Email Redirect</span>
                <div class="switch">
                  <label>
                    <input type="checkbox"><span class="lever"></span></label>
                </div>
              </li>
            </ul>
            <p>SYSTEM SETTINGS</p>
            <ul class="setting-list">
              <li>
                <span>Notifications</span>
                <div class="switch">
                  <label>
                    <input type="checkbox" checked><span class="lever"></span></label>
                </div>
              </li>
              <li>
                <span>Auto Updates</span>
                <div class="switch">
                  <label>
                    <input type="checkbox" checked><span class="lever"></span></label>
                </div>
              </li>
            </ul>
            <p>ACCOUNT SETTINGS</p>
            <ul class="setting-list">
              <li>
                <span>Offline</span>
                <div class="switch">
                  <label>
                    <input type="checkbox"><span class="lever"></span></label>
                </div>
              </li>
              <li>
                <span>Location Permission</span>
                <div class="switch">
                  <label>
                    <input type="checkbox" checked><span class="lever"></span></label>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </aside>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>WELCOME</h2>
      </div>

      <!-- Widgets -->
      <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
              <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
              <div class="text">NEW TASKS</div>
              <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
              <i class="material-icons">help</i>
            </div>
            <div class="content">
              <div class="text">NEW TICKETS</div>
              <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
              <i class="material-icons">forum</i>
            </div>
            <div class="content">
              <div class="text">NEW COMMENTS</div>
              <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
              <i class="material-icons">person_add</i>
            </div>
            <div class="content">
              <div class="text">NEW VISITORS</div>
              <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  <script src="{{ asset('js/admin.js') }}" charset="utf-8"></script>
@endsection
