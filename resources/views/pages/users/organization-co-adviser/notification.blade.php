@extends('layouts.master')

@section('page-title', 'Manage Notification')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')
    @include('pages.top-nav')

    @if (session('login_type') and session('login_type') == 'admin')
        @include('pages.admin.sidebar')
    @elseif (session('login_type') and session('login_type') == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (session('status'))
          <div class="alert alert-success">
            {!! session('status') !!}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{--
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>
                  Manage Notification
                  <small>Choose notification media/medium to be used</small>
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
                <div class="demo-switch">
                  <form class="" action="index.html" method="post">
                    <div class="switch" id="facebook">
                      <label>OFF<input type="checkbox" checked><span class="lever switch-col-indigo"></span>ON</label>
                      Facebook
                    </div>
                    <div class="switch" id="instagram">
                      <label>OFF<input type="checkbox" checked><span class="lever switch-col-deep-orange"></span>ON</label>
                      Instagram
                    </div>
                    <div class="switch" id="twitter">
                      <label>OFF<input type="checkbox" checked><span class="lever switch-col-blue"></span>ON</label>
                      Twitter
                    </div>
                    <div class="switch" id="email">
                      <label>OFF<input type="checkbox" checked><span class="lever switch-col-teal"></span>ON</label>
                      Email
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        --}}
        <div class="row">
          <footer class="admin-footer">
            @component('components.who')
            @endcomponent
          </footer>
        </div>
      </div>
    </section>
@endsection

@section('modal')
@endsection

@section('footer')
@endsection
