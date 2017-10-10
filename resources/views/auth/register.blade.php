{{--  I THINK THIS BLADE WILL NOT BE NEEDE OR MUST BE MODIFIED SINCE THE ONLY WAY TO REGISTER A USER IN THEIS SYSTEM IS BY THE REGISTRATION OF THE ORG HEAD TO A MEMBER USER  --}}
@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Add User') }}</title>
@endsection

@section('css')
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> Add New User
                <small>Form to add new system user</small>
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    {{-- Options here --}}
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <form class="" id="add-user-form" action="{{ route('User.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="row clearfix">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter student student number" value="{{ old('account_number') }}" required autofocus>
                        @if ($errors->has('account_number'))
                          <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter student full name" value="{{ old('full_name') }}" required autofocus>
                        @if ($errors->has('full_name'))
                          <span class="help-block"> <strong>{{ $errors->first('full_name') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter student email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                          <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-group form-float">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="position_id" name="position_id">
                          <option value="{{ old('position_id') }}" id="position-option">-- Select Position --</option>
                          @foreach ($positions as $key => $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                          @endforeach
                        </select> 
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="b1" class="btn add-more" type="button">+</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> Add New User
                <small>Form to add new system user</small>
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    {{-- Options here --}}
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="row">
                <input type="hidden" name="count" value="1" />
                <div class="control-group" id="fields">
                  <label class="control-label" for="field1">Nice Multiple Form Fields</label>
                  <div class="controls" id="profs">
                    <form class="input-append">
                      <div id="field">
                        <input autocomplete="off" class="input" id="field1" name="prof1" type="text" placeholder="Type something" data-items="8">
                        <button id="b1" class="btn add-more" type="button">+</button>
                      </div>
                    </form>
                    <br>
                    <small>Press + to add another form field :)</small>
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

@section('modals')
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
  <script>
    $(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
});

  </script>
@endsection
