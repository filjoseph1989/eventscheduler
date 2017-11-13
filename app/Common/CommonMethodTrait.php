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
  private function getOrganizationsID()
  {
    # if user accesses getOrganization() function from CommonMethodTrait,
    # array of organizationGroup instance must be returned where organnization_id are the id of orgs the user belongs to,
    # since org-user(member) can belong to many orgs
    $orgs = OrganizationGroup::where('user_id', Auth::id())
      ->get();

    $IDs = [];
    foreach ($orgs as $key => $value) {
      $IDs[$value->id] = $value->getOrganizationId();
    }

    return $IDs;
  }

  /**
   * Determine whos the leader of the organization
   *
   * @return
   */
  private function leaderID()
  {
    if (Auth::user()->user_type_id < 3) {
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

  /**
   * Return account name
   *
   * @param int $count
   * @return string
   */
  private function getAccount($account)
  {
    if ($account == 1) {
      return "org-head";
    }
    if ($account == 2) {
      return "org-member";
    }
    if ($account == 3) {
      return "osa";
    }
  }

  /**
   * [getOrgHeadOrgName description] : get primary organization name of org head
   * @param  [type] $user_id [description]
   * @return [type]          [description]
   */

  private function getOrgHeadOrgName($id)
  {
    $org = OrganizationGroup::with('organization')
          ->where('user_id', $id )
          ->where('position_id', 3)
          ->get()->first();
    $str = $org->organization->name;
    return $str;
  }
 /**
     * This method compare the given date to current date
     * and when true, set the status to on going
     *
     * @return void
     */
    private function getDateComparison(&$events)
    {
      if ( ! is_null($events) ) {
        foreach ($events as $key => $event) {
          if ($events->count() > 1) {
            if (self::matchDate($event->date_start)) {
              $events[$key]->status = "on going";
              # Issue 25
            }
          } else {
            if (self::matchDate($event->date_start)) {
              $events[0]->status = "on going";
            }
          }
        }
      }
    }

    /**
     * Match the current month with the given month
     *
     * Issue 29
     *
     * @param int $date
     * @return void
     */
    private function matchDate($date)
    {
      list($year, $month, $day) = explode('-', $date);

      if (self::matchYear($year) and self::matchMonth($month) and self::matchDay($day)) {
        return true;
      }
      return false;
    }

    /**
     * Match the current year with the given year
     *
     * Issue 29
     *
     * @param int $year
     * @return void
     */
    private function matchYear($year)
    {
      if (date('Y') ==  $year){
        return true;
      }
      return false;
    }

    /**
     * Match the given month with the current month
     *
     * Issue 29
     *
     * @param int $month
     * @return void
     */
    private function matchMonth($month)
    {
      if (date('m') ==  $month){
        return true;
      }
      return false;
    }

    /**
     * Match the given day with current day
     *
     * Issue 29
     *
     * @param int $day
     * @return void
     */
    private function matchDay($day)
    {
      if (date('d') ==  $day){
        return true;
      }
      return false;
    }

    /**
     * Return Organization ID
     *
     * @param  array $referrence
     * @return
     */
    private function extractID($referrence)
    {
      $temp;
      foreach ($referrence as $key => $id) {
        $temp = $id;
      }

      return $temp;
    }

}
