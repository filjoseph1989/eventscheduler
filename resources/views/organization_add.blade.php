@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Home Page') }}</title>
@endsection

@section('css')
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         @if (session('status'))
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Dismiss alert">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('status') }}
            </div>
          @endif
          @if (session('status_warning'))
            <div class="alert alert-warning" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Dismiss alert">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('status_warning') }}
            </div>
          @endif
          <div class="card">
            <div class="header">
              <h2> Add New Organization
                <small>This form used to register new organization in the system</small>
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    {{-- Options Here --}}
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 col-sm-offset-2">
                  <form class="" action="{{ route('Org.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name of the organization" autofocus value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                          <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="acronym" name="acronym" placeholder="Acronym" value="{{ old('acronym') }}" required>
                        @if ($errors->has('acronym'))
                          <span class="help-block"> <strong>{{ $errors->first('acronym') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="student_number" name="account_number" placeholder="Organization Leader Student number" value="{{ old('account_number') }}" required>
                        @if ($errors->has('account_number'))
                          <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="student_name" name="full_name" placeholder="Organization Leader Name" value="{{ old('full_name') }}" required>
                         @if ($errors->has('full_name'))
                          <span class="help-block"> <strong>{{ $errors->first('full_name') }}</strong> </span>
                         @endif
                      </div>
                    </div>
                     <div class="form-group">
                      <div class="form-line">
                        {{--  <input type="text" class="form-control" id="course" name="course" placeholder="Organization Leader Name" value="{{ old('course') }}" required>  --}}
                        <select class="form-control show-tick" id="course_id" name="course_id">
                          <option value="{{ old('course_id') }}" id="course-option">- Select the Org Leader's Course -</option>
                          @foreach ($course as $key => $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="student_email" name="email" placeholder="Organization Leader Email" value="{{ old('email') }}" required>
                         @if ($errors->has('email'))
                          <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                        @endif
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
@endsection

@section('modals')
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
@endsection
