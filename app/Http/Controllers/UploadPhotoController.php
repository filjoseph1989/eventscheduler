<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

/**
 * Handle the user related request
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @company DevCaffee
 *
 * @date 11-09-2017
 * @date 11-09-2017 - updated
 */
class UploadPhotoController extends Controller
{
  /**
   * Build instance of a class
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Upload photo for facebook post
   * @return
   */
  public function uploadFacebookPhoto(Request $request)
  {

  }

  /**
   * Upload photo for twitter
   * @param  Request $request
   * @return
   */
  public function uploadTwitterPhoto(Request $request)
  {

  }

  /**
   * Upload photo for email
   * @param  Request $request
   * @return
   */
  public function uploadEmailPhoto(Request $request)
  {
    
  }
}
