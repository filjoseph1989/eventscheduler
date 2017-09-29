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

  @include ('templates/sidebar');
  
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                System Members
                <small>List of users</small>
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
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Position</th>
                  <th>Organization</th>
                </thead>
                <tbody>
                  {{--  <tr>
                    <td><a href="#" data-toggle="modal" data-target="#profile">Katherine Mcnamara</a></td>
                    <td><a href="#" data-toggle="modal" data-target="#course">MS in Applied Economics</a></td>
                    <td><a href="#">American Actress/Singer</a></td>
                    <td><a href="#">Active</a></td>
                  </tr>  --}}
                   @if ($users->count() == 0)
                      <tr>
                        <td>{{ "No entry yet" }}</td>
                      </tr>
                    @else
                      @foreach ($users as $key => $value) 
                      {{--all listed here are users with status='true'
                      Organization Users Request should be seen in another blade,
                      and in the All System Users Navigation, add tab for approve user requests,
                      also, if there are/is org user requests, the no. of user requests should 
                      be seen at the All System Users Navigation at the side-bar--}}
                        <tr>
                          <td><a href="#" data-target="#profile" data-toggle="modal">{{ $value->full_name }}</a></td>                            
                          <td>{{ $value->name }}</a></td>
                          <td> @php $help::userAttribute($position, $value->id); @endphp </td>
                          <td> @php $help::userAttribute($organization, $value->id); @endphp </td>
                        </tr>
                      @endforeach
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Katherine Mcnamara</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td>Katherine Mcnamara</td>
              </tr>
              <tr>
                <td>Actress Singer</td>
              </tr>
              <tr>
                <td>Bachelor of Science in Business Administration</td>
              </tr>
              <tr>
                <td>Summa Cum Laude</td>
              </tr>
              <tr>
                <td>Drexel University</td>
              </tr>
              <tr>
                <td>Master in Applid Economics</td>
              </tr>
              <tr>
                <td>Johns Hopkins University</td>
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
  <div id="course" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Business Administration</h4>
        </div>
        <div class="modal-body">
          <p><strong>Business administration</strong> is management of a business. It includes all aspects of overseeing and supervising business operations.</p>
          <a href="https://en.wikipedia.org/wiki/Business_administration" target="_blank">Source Wikipedia</a>
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
</body>
</html>
