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
        $cour = Course::find(Auth::user()->course_id);
        $acc = UserType::find(Auth::user()->user_type_id)->name; 
        /**
         *no filtering needed for $acc, because automatically this is not null, 
         *as osa creates organization, org head is registered with org head user automatically
         *as org head requests to register member/s, these members should automatically have user_type -> "organization-user" 
         */
        $og = OrganizationGroup::with(['position', 'organization'])->where('user_id', Auth::user()->id)->get();
        if($cour == null){
            $cour = 'Not Yet Specified';
        } else{
             $cour = Course::find(Auth::user()->course_id)->name;
        }
        if($og->isEmpty()){
            $og = 'Not Yet Specified';
        }
        return view('user-profile')->with([
          'course'            => $cour,
          'account'           => $acc, 
          'organizationGroup' => $og
        ]);
    }
}
