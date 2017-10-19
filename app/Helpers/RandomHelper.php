<?php

namespace App\Helpers;

/**
 *
 */
class RandomHelper
{
  /**
   * Return dataTable class
   *
   * @param mixed $reference
   * @return string
   */
  public static function dataTableClass($reference)
  {
    $class = "";
    foreach ($reference as $key => $org) {
      foreach ($org as $key => $value) {
        if ($value->count() > 10) {
          $class = "js-basic-example dataTable";
        }

        return [
          'class' => $class
        ];
      }
    }
  }

  /**
   * format the display of local events
   *
   * @param  object $events
   * @return void
   */
  public static function formatLocalEvents($events)
  {

  }
}

/**
 * Independent functions and not belong to a class
 *
 * @param string  $url
 * @param boolean $permanent
 */
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
