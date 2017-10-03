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
