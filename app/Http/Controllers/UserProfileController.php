<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\OrganizationGroup;
use App\Models\UserType;

/**
 * Display the profile of the user
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 2.0.0
 * @company DevCaffee
 * @date 10-10-2017
 * @date 10-10-2017 - last update
 */
class UserProfileController extends Controller
{
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
        return view('user-profile')->with([
          'course'            => Course::find(Auth::user()->course_id)->name,
          'account'           => UserType::find(Auth::user()->user_type_id)->name,
          'organizationGroup' => OrganizationGroup::with(['position', 'organization'])
            ->where('user_id', Auth::user()->id)
            ->get(),
        ]);
    }
}
