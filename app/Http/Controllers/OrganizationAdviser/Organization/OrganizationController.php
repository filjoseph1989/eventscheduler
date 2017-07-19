<?php

namespace App\Http\Controllers\OrganizationAdviser\Organization;

use Auth;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class controller handles the request related to
 * Organization
 *
 * @author jlvoice777
 * @author Janica Liz De Guzman
 * @version 0.1
 * @created 7/19/2017
 */
class OrganizationController extends Controller
{
    /**
     * Guard
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Return the list of organization
     *
     * @return Illuminate\Response
     */
    public function showAllOrganizationList()
    {
      $organization = Organization::all();

      $login_type = 'user';
      return view(
        'pages/users/organization-adviser/manage_schedule/my-organization',
        compact(
          'login_type',
          'organization'
        )
      );
    }

}
