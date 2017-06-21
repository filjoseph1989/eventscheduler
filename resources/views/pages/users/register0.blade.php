@extends('layouts.master')

@section('page-title', 'User Registration')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')
  @include('pages.top-nav')

  @include('pages.sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>WELCOME</h2>
      </div>
      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <div class="row clearfix">
                <div class="col-xs-12 col-sm-6">
                  <h2 id="heading-schedule">User Registration</h2>
                </div>
              </div>
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
              <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                <div class="row clearfix">
                  <div class="col-sm-12">
                    <div class="form-group form-float">
                      <div class="form-line">
                        <input type="text" class="form-control" name="">
                        <label class="form-label">Name</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group form-float">
                      <div class="form-line">
                        <input type="text" class="form-control" name="">
                        <label class="form-label">Name</label>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
@endsection
