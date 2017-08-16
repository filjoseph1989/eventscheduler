<div class="card">
  <div class="header">
    <h2>Change Password</h2>
  </div>
  <div class="body">
    <form class="" id="" role="form" method="POST" action="{{ route('change.password') }}">
      {{ csrf_field() }}
      <div class="row clearfix">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="form-group form-float form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
            <div class="form-line">
              <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" required="true" autofocus>
              @if ($errors->has('old_password'))
                <span class="help-block"> <strong>{{ $errors->first('old_password') }}</strong> </span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
          <div class="form-group form-float form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
            <div class="form-line">
              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required="true">
              @if ($errors->has('new_password'))
                <span class="help-block"> <strong>{{ $errors->first('new_password') }}</strong> </span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
          <div class="form-group form-float form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
            <div class="form-line">
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required="true">
              @if ($errors->has('confirm_password'))
                <span class="help-block"> <strong>{{ $errors->first('confirm_password') }}</strong> </span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
          <button type="submit" class="btn btn-success">
            <i class="material-icons">save</i> Save
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
