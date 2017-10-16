<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Course;
use App\Models\UserType;
use App\Models\OrganizationGroup;

/**
 * Display the profile of the user
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 2.0.0
 * @company DevCaffee
 * @date 10-10-2017
 * @date 10-17-2017 - last update
 */
class UserProfileController extends Controller
{
    /**
     * Create an instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cour = Course::find(Auth::user()->course_id);
        $acc  = UserType::find(Auth::user()->user_type_id)->name;
        $og   = OrganizationGroup::with(['position', 'organization'])
          ->where('user_id', Auth::id())
          ->get();

        if ($cour == null) {
          $cour = 'Not Yet Specified';
        } else {
          $cour = Course::find(Auth::user()->course_id)->name;
        }

        if ($og->isEmpty()) {
          $og = 'Not Yet Specified';
        }

        return view('user-profile')->with([
          'course'            => $cour,
          'account'           => $acc,
          'organizationGroup' => $og
        ]);
    }

    public function update(Request $request, $id)
    {
      $user = User::find($id);
      if ($request->has('full_name')) {
        $user->full_name = $request->full_name;
        $user->save();
      }

      return back();
    }
}
