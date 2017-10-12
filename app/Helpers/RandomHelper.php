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
    if ($reference->count() > 10) {
      $class = "js-basic-example dataTable";
    }

    return [
      'class' => $class
    ];
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

