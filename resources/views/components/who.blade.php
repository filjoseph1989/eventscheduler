@if (Auth::guard('admin')->check() and Auth::guard('web')->check())
  <p>
    You are logged in as a <strong>ADMIN</strong>
  </p>
  <p>
    You are logged in as a <strong>USER</strong>
  </p>
@elseif(!(Auth::guard('web')->check()))
  <p>
    You are logged in as a <strong>ADMIN</strong>
  </p>
@endif
