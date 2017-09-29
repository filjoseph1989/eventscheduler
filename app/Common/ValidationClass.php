<?php

namespace App\Common;

/**
 * Written by Fil for common validation process
 * 
 * @author Fil Joseph <filjoseph22@gmail.com>
 * @date 09-28-2017
 */
class ValidationClass
{

  public function __construct()
  {
    # code...
  }

  /**
   * make validation for event entries
   *
   * @param object $data reference
   * @return void
   */
  public function validate(&$data, &$request)
  {
    $data->validate($request, [
      'event_type_id'   => 'Required',
      'semester_id'     => 'Required',
      'title'           => 'Required',
      'description'     => 'Required',
      'venue'           => 'Required',
      'date_start'      => 'required|date|after_or_equal:today',
      'date_end'        => 'nullable|date|after_or_equal:date_start',
      'date_start_time' => 'filled|date_format:H:i',
      'date_end_time'   => 'nullable|date_format:H:i',
      'whole_day'       => 'nullable',
    ], [
      'regex' => "Time should be valid format",
    ]);
  }
}
