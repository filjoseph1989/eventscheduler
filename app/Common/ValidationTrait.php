<?php

namespace App\Common;

/**
 * Written by Fil for common validation process
 *
 * @author Fil Joseph <filjoseph22@gmail.com>
 * @date 09-28-2017
 */
trait ValidationTrait 
{ 

  /**
   * make validation for event entries
   *
   * @param object $data reference
   * @return void
   */
  public function validateRequest(&$data, &$request)
  {
    $data->validate($request, [
      'user_id'         => 'Required',
      'category'        => 'Required',
      'semester_id'     => 'Required',
      'title'           => 'Required',
      'description'     => 'Required',
      'venue'           => 'Required',
      'date_start'      => 'required|date|after_or_equal:today',
      'date_end'        => 'nullable|date|after_or_equal:date_start',
      'date_start_time' => 'filled|date_format:H:i',
      'date_end_time'   => 'nullable|date_format:H:i',
      'whole_day'       => 'nullable',
    ]);
  }

  /**
   * Validate the users entries
   *
   * @return void
   */
  public function validateUser(&$data, &$request)
  {   
      $data->validate($request, [
        'full_name'      => 'Required',
        'account_number' => 'Required',
        'email'          => 'Required',
        'mobile_number'  => 'Required',
        'course_id'      => 'Required',
        'user_type_id'   => 'Required',
      ]);
  }

  public function validateMembers( &$data, &$request ) {
       
      $data->validate($request, [
        'full_name'      => 'required|string|max      : 255',
        'email'          => 'required|string|email|max: 255|unique: users',
        'account_number' => 'Required',
        'mobile_number'  => 'Required',
        'course_id'      => 'Required',
        'user_type_id'   => 'Required',
      ]);
  }
}
 