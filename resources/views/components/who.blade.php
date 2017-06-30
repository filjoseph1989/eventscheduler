@if (Auth::guard('web')->check())
  <p>
    You are logged in as a <strong>USER</strong>
  </p>
@else
  <p>
    You are logged out as a <strong>USER</strong>
  </p>
@endif

@if (Auth::guard('admin')->check())
  <p>
    You are logged in as a <strong>ADMIN</strong>
  </p>
@else
  <p>
    You are logged out as a <strong>ADMIN</strong>
  </p>
@endif
