<?php

namespace App\Helpers;

/**
 * 
 */
class RandomHelper
{ 

  /**
   * Show the suer attribute
   *
   * @param array $attr
   * @param int $id
   * @return void
   */
  public static function userAttribute($attr, $id)
  {
    if (count($attr[$id]) > 1) {
      foreach ($attr[$id] as $key => $val) {
        echo "$val <br>";
      }
    } else {
      echo $attr[$id];
    }
  }

  /**
   * Set datatable
   *
   * @param mixed $reference
   * @return array
   */
  public static function setAttribute($reference)
  {
    $class    = "setapprover";
    $approver = "Set as Approver";
    $btn      = "primary";

    if ($reference == 'true') {
      $class    = "revokeapprover";
      $approver = "Revoke as Approver";
      $btn      = "warning";
    }

    return [
      'class'    => $class,
      'approver' => $approver,
      'btn'      => $btn
    ];
  }

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
