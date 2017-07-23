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

    		@if ($message = Session::get('success'))
      		<div class="alert alert-success">
  	        <strong>{{ $message }}</strong>
      		</div>
    		@endif
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> ORGANIZATION PROFILE </h2>
              </div>
              <div class="body table-responsive">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <img class="org-logo" src="{{ asset("images/{$organization->logo}") }}" alt="Credit https://www.askideas.com/media/87/Black-Ink-Pirate-Ship-In-Rope-Frame-With-Banner-And-Anchor-Tattoo-Design.jpg">
                    @if ($organization->logo == 'ship.jpg')
                      <small>Credit: <a href="https://www.askideas.com/media/87/Black-Ink-Pirate-Ship-In-Rope-Frame-With-Banner-And-Anchor-Tattoo-Design.jpg" target="_blank">Here</a></small>
                    @endif
                    <form action="{{ route('org-adviser.org-logo') }}" enctype="multipart/form-data" method="POST">
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
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <article class="">
                      <strong>Name of the organization:</strong>
                      <p>{{ $organization->name }}</p>
                      <strong>School Status</strong>
                      <p>{{ $organization->status == 1 ? 'Active' : 'Inactive' }}</p>
                      <strong>Official Website</strong>
                      <p><a href="{{ $organization->url }}" target="_blank">{{ $organization->url }}</a></p>
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