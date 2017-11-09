<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

# Models
use App\Models\Event;

/**
 * Handle the user related request
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @company DevCaffee
 *
 * @date 11-09-2017
 * @date 11-10-2017 - updated
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
   *
   * Issue 35: Problem is how to remove those images not in the database
   * @return
   */
  public function uploadFacebookPhoto(Request $request)
  {
    $this->validate($request, [
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    /*
    Do it here.
    Get the ID of the event and then get the upload picture,
    deleted it
     */

    # Get image, rename and save to images folder
    $imageName = time().'.'.$request->image->getClientOriginalExtension();
    $request->image->move(public_path('img/social'), $imageName);

    # Save to database
    $event      = Event::find($request->id);
    $picture    = (! is_null($event->img)) ? $event->img : "";
    $event->img = $imageName;
    $event->save();

    # Delete old pic except default
    if (! empty($picture) and file_exists("img/social/$picture")) {
      unlink("img/social/$picture");
    }

    $sucessOrFailed = "Image Uploaded successfully.";

    # Return to uploader page
    return back()
      ->with('status', $sucessOrFailed);
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
