<?php

namespace App\Http\Controllers\OrganizationHead;

use Illuminate\Http\Request;

class OrgHeadAccountController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('web');
  }
}
