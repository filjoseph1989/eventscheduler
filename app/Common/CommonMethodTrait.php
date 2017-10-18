<?php

namespace App\Common;

use App\Models\OrganizationGroup;
use Auth;
/**
 * Written by Fil for common validation process
 *
 * @author Fil Joseph <filjoseph22@gmail.com>
 * @date 10-15-2017
 */
trait CommonMethodTrait
{

  /**
   * Return the user organizatoin ID
   *
   * @return void
   */
  private function getOrganizations()
  {
    // ☐ if user accesses getOrganization() function from CommonMethodTrait, 
    // array of organizationGroup instance must be returned where organnization_id are the id of orgs the user belongs to,
    // since org-user(member) can belong to many orgs

    $orgs = OrganizationGroup::where('user_id', Auth::id())
      ->get(); 
    
    $org_ids = [];
    foreach ($orgs as $key => $value) {
      $org_ids[$value->id] = $value->getOrganizationId();
    }
    return $org_ids;
  }

  private function getOrganizationLeading()
  {
    if( Auth::user()->user_type_id < 3 ){ 
      //if org-head or org-user(and must be adviser)
      $my_primary_organization_id = OrganizationGroup::where('user_id', Auth::id())
        ->where('position_id', 3)
        ->orWhere('position_id', 4)
        ->get() 
        ->first();

      if( $my_primary_organization_id != null ) {
        return $my_primary_organization_id->getOrganizationId();
      } else {
        return $my_primary_organization_id; //this is null
      }
    } else {
      //temporary error trapping
      echo 'You are not an organization head, niether an organization adviser. 
      You cannot access this functionality';
    } 
  }
}
