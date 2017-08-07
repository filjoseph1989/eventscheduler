<?php
namespace App\Library;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;

/**
 *
 */
class ApproverLibrary extends Controller
{
  /**
   * Return event that need approval
   *
   * @return object
   */
  public static function getGetEventsNeedApproval()
  {
    return Event::select(
      'events.*',
      'organizations.id as org_id',
      'organizations.name as org_name',
      'organization_groups.user_id as orgg_uid',
      'organizations.name as org_name',
      'users.first_name as fname'
    )
    ->join('organization_groups', 'events.organization_id', '=', 'organization_groups.organization_id')
    ->join('organizations', 'events.organization_id', '=', 'organizations.id')
    ->join('users', 'events.user_id', '=', 'users.id')
    ->where('approve_status', '=', 'unapproved')
    ->where('organization_groups.user_id', '=', Auth::user()->id)
    ->get();
  }
}
