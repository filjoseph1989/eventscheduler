@extends('layouts.master')

@section('page-title', 'Organization Profile')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')

    @include('pages.top-nav')

    @if (isset($login_type) and $login_type == 'admin')
        @include('pages.admin.sidebar')
    @elseif (isset($login_type) and $login_type == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

    		@if ($message = Session::get('status'))
      		<div class="alert alert-success">
  	        <strong>{{ $message }}</strong>
      		</div>
    		@endif
    		@if ($message = Session::get('status_warning'))
      		<div class="alert alert-warning">
  	        <strong>{{ $message }}</strong>
      		</div>
    		@endif
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> ORGANIZATION PROFILE </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      @if ($adviser === true AND $isMember === true)
                        <li><a href="{{ route('org-co-adviser.org-edit', $organization->id) }}"><i class="material-icons">create</i> Edit</a></li>
                      @else
                        <li><a href="#">No Options</a></li>
                      @endif
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="body table-responsive">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    @if (file_exists("images/org_profile/{$organization->logo}"))
                      <img class="org-logo" src="{{ asset("images/org_profile/{$organization->logo}") }}" alt="Organization Logo">
                    @else
                      <img class="org-logo" src="{{ asset("images/ship.jpg") }}" alt="Credit https://www.askideas.com/media/87/Black-Ink-Pirate-Ship-In-Rope-Frame-With-Banner-And-Anchor-Tattoo-Design.jpg">
                      <small>Credit: <a href="https://www.askideas.com/media/87/Black-Ink-Pirate-Ship-In-Rope-Frame-With-Banner-And-Anchor-Tattoo-Design.jpg" target="_blank">Here</a></small>
                    @endif
                    @if ($adviser === true AND $isMember === true)
                      <form action="{{ route('org-co-adviser.org-logo') }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="row">&nbsp;</div>
                        <div class="row">
                          <div class="col-md-12">
                            <input type="hidden" name="id" value="{{ $organization->id }}">
                            <input type="file" name="image">
                            <button type="submit" class="btn btn-success" style="margin-top: 3px; "><i class="material-icons">file_upload</i> Upload</button>
                          </div>
                        </div>
                      </form>
                    @endif
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <div class="row">
                      <div class="col-md-12">
                        <article class="">
                          <strong>Name of the organization:</strong>
                          <p>{{ $organization->name }}</p>
                          <strong>School Status</strong>
                          <p>{{ $organization->status == 1 ? 'Active' : 'Inactive' }}</p>
                          <strong>Official Website</strong>
                          <p><a href="{{ $organization->url }}" target="_blank">{{ $organization->url }}</a></p>
                          <strong>Color</strong>
                          <div class="" style="width:30px; height:30px;background-color:{{ $organization->color }}">&nbsp;</div>
                          <strong>Who are they?</strong>
                          <p class="org-description">{{ $organization->description }}</p>
                          <strong>School Registration</strong>
                          <p>
                            <span id="org-date-start">Start</span>: {{ date('M d, Y', strtotime($organization->date_started)) }}
                            <span id="org-date-end">Expire</span>: {{ date('M d, Y', strtotime($organization->date_expired)) }}
                          </p>
                          <strong>Number of Members</strong>
                          <p>{{ $organization->number_of_members }} Students</p>
                        </article>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        @if ($isMember == false)
                          <form class="" action="{{ route('org-co-adviser.org-membership', $organization->id ) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="organization_id" value="{{ $organization->id }}">
                            <input type="hidden" name="membership_status" value="no">
                            <button type="submit" class="btn btn-success" name="button">Request Membership</button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
@endsection

@section('footer')
@endsection
