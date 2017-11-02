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
 * @date 10-26-2017 - last update
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

        return view('user-profile')
          ->with([
            'course'            => $cour,
            'account'           => $acc,
            'organizationGroup' => $og,
            'prof_pic'          => Auth::user()->picture,
          ]);
    }

    /**
     * Update profile
     *
     * @param  Request $request
     * @param  int  $id
     * @return Illuminate\Response
     */
    public function update(Request $request, $id)
    {
      if (parent::isOsa()) {
        if (
            $request->has('position_id') ||
            $request->has('user_type_id') ||
            $request->has('status') ||
            $request->has('created_at')
           ) { return back()->with(['status_warning' => 'This field are accessible for authorized-user only.']); }
      } else { // if user or org-head
        if (
            $request->has('organization_id') ||
            $request->has('position_id') ||
            $request->has('user_type_id') ||
            $request->has('status') ||
            $request->has('full_name') ||
            $request->has('created_at')
           ) {
             return back()
               ->with(['status_warning' => 'These fields are accessible for authorized-user only.']);
           }
      }

      $user = User::find($id);

      if ($request->has('full_name') && parent::isOsa()) {
        $user->full_name = $request->full_name;
        $user->save();
      }

      if ($request->has('email') && ( parent::isOsa() || parent::isOrgHead() )) {
        $user->email = $request->email;
        $user->save();
      }

      if ($request->has('mobile_number') && (parent::isOsa() || parent::isOrgHead())) {
        if (strlen($request->mobile_number) != 12 ) {
          return back()
            ->with(['status_warning' => 'Entered mobile number must not be more than or less than 12 characters.']);
        }
        if (!ctype_digit($request->mobile_number)) {
          return back()
            ->with(['status_warning' => 'Contains non-numbers.']);
        }

        $user->mobile_number = $request->mobile_number;
        $user->save();
      }

      if ($request->has('facebook') && (parent::isOsa() || parent::isOrgHead())) {
        $user->facebook = $request->facebook;
        $user->save();
      }

      if ($request->has('twitter') && (parent::isOsa() || parent::isOrgHead())) {
        $user->twitter = $request->twitter;
        $user->save();
      }

      return back();
    }
}
