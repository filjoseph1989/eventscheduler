<?php

namespace App\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ImageLibrary extends Controller
{
  /**
   * Upload image to a path
   *
   * @param  Object $request
   * @param  string $path
   * @return string
   */
  public static function uploadImage($request, $path = 'images')
  {
    $image = new ImageLibrary();

    $image->validate($request, [
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    # Get image, rename and save to images folder
    $imageName = time().'.'.$request->image->getClientOriginalExtension();
    $request->image->move(public_path($path), $imageName);

    return $imageName;
  }
}
