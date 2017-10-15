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
  private function getOrganization()
  {
    return OrganizationGroup::where('user_id', Auth::id())
      ->get()
      ->first()
      ->getOrganizationId();
  }
}
