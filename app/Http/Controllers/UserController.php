<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Position;
use App\Models\Department;
use App\Models\UserAccount;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Library\ImageLibrary;
use App\Models\OrganizationGroup;

/**
 * The user controller is reponsible for
 * entertain request
 *
 * @author LN De Guzman
 * @package SystemScheduler
 * @since 0.1
 * @version 0.1
 *
 * @last Update July 12, 2017
 */
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Return the view profile page for org adviser
     *
     * @return
     */
    public function viewProfile($id = false)
    {
      # Is the organization adviser loggedin?
      parent::loginCheck();

      $login_type = "user";

      # Unlike the typical return which object, here is different
      # an array
      $originUser      = OrganizationGroup::userProfile(Auth::user(), $id)->toArray();
      $user            = $originUser[0];
      $current_user = ($id === false) ? true: false;

      return view('pages/users/user-profile', compact(
          'login_type', 'originUser', 'user', 'current_user'
        ));
    }

    /**
     * Get the single row of user base on the given ID
     * Used by Ajax request in the admin panel
     *
     * @param  Request $data
     * @return json
     */
    public function getUserData(Request $data)
    {
      $department = User::find($data->id)->department()->getResults();
      $user_account   = User::find($data->id)->userAccount()->getResults();
      $course     = User::find($data->id)->course()->getResults();

      $data               = [
        'allDepartments' => $department->all(),
        'allUserAccounts'=> $user_account->all(),
        'allCourses'     => $course->all(),
        'departmentName' => $department->name,
        'UserAccountName'   => $user_account->name,
        'courseName'     => $course->name,
        // 'user_account' => UserAccount::all(),
        // 'position'     => Position::all(),
        // 'course'       => Course::all(),
        // 'user'         => User::find($data->id),
      ];

        echo json_encode($data);

        # next time use Illuminate\Response to return json
        // return User::find($data->id);
    }

    /**
     * Upload a user profile photo
     *
     * @param  Request $request
     * @return Illuminate\Response
     */
    public function uploadPhoto(Request $request)
    {
      # Is user loggedin?
      parent::loginCheck();

      # Upload image
      $imageName = ImageLibrary::uploadImage($request, 'images/profiles');

      # Save to database
      $user = User::find($request->id);
      $picture       = $user->picture;
      $user->picture = $imageName;

      # Delete old pic except default
      if ($user->save() and file_exists("images/profiles/$picture")) {
        unlink("images/profiles/$picture");
      }

      $sucessOrFailed = "Image Uploaded successfully.";

      # Return to uploader page
      return back()->with('success', $sucessOrFailed);
    }

    /**
     * Issue 37:
     * Methods below is subject for review
     * if still in use or not
     */

    /**
     * validate the incoming data
     *
     * @param  array  $data
     * @return \Illuminate\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'suffix_name' => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:users',
            'password'    => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminCreate(Request $data)
    {
      $user = User::create([
        'user_account_id'    => $data['user_account_id'],
        'course_id'          => $data['course_id'],
        'department_id'      => $data['department_id'],
        'account_number'     => $data['account_number'],
        'email'              => $data['email'],
        'password'           => bcrypt($data['account_number']),
        'first_name'         => ucwords($data['first_name']), # Capitalize the name
        'last_name'          => ucwords($data['last_name']), # Capitalize the last name
        'middle_name'        => ucwords($data['middle_name']), # Capitalize the middle name
        'suffix_name'        => ucwords($data['suffix_name']), # Capitalize the suffix name
        'facebook_username'  => $data['facebook_username'],
        'twitter_username'   => $data['twitter_username'],
        'instagram_username' => $data['instagram_username'],
        'mobile_number'      => $data['mobile_number'],
        'status'             => $data['status'],
      ]);

      # if successfuly save
      if ($user->save()) {
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.user.list')
            ->with('status', 'Successfuly User Information');
        }
        if (Auth::guard('web')->check()){
          return redirect()->route('user.list')
            ->with('status', 'Successfuly User Information');
        }
      }
    }

    /**
     * Edit the user's information
     *
     * @param Request $data
     * @return \illuminate\resposnse
     */
    public function edit(Request $data)
    {
      $user                     = User::find($data->id);
      $user->user_account_id    = $data['user_account_id'];
      $user->course_id          = $data['course_id'];
      $user->department_id      = $data['department_id'];
      $user->account_number     = $data['account_number'];
      $user->email              = $data['email'];
      $user->first_name         = $data['first_name'];
      $user->last_name          = $data['last_name'];
      $user->middle_name        = $data['middle_name'];
      $user->suffix_name        = $data['suffix_name'];
      $user->facebook_username  = $data['facebook_username'];
      $user->twitter_username   = $data['twitter_username'];
      $user->instagram_username = $data['instagram_username'];
      $user->mobile_number      = $data['mobile_number'];
      $user->status             = $data['status'];

      if ($user->save()) {
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.user.list')
            ->with('status', 'Successfully User Information');
        }
        if (Auth::guard('web')->check()){
          return redirect()->route('user.list')
            ->with('status', 'Successfully User Information');
        }
      }
    }

    public function delete(Request $data)
    {
      $user = User::find($data->id);
      $name = "the name: ".$user->first_name." ".$user->middle_name." ".$user->last_name." and account number: ".$user->account_number;
      $user->delete();
      $data = [
        'result' => true,
        'name' => $name,
        'id'  => $data
      ];
      echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
      return User::create([
          'user_account_id'    => $data['user_account_id'],
          'course_id'          => $data['course_id'],
          'department_id'      => $data['department_id'],
          'account_number'     => $data['account_number'],
          'email'              => $data['email'],
          'password'           => bcrypt($data['password']),
          'first_name'         => $data['first_name'],
          'last_name'          => $data['last_name'],
          'middle_name'        => $data['middle_name'],
          'suffix_name'        => $data['suffix_name'],
          'facebook_username'  => $data['facebook_username'],
          'twitter_username'   => $data['twitter_username'],
          'instagram_username' => $data['instagram_username'],
          'mobile_number'      => $data['mobile_number'],
          'status'             => $data['status'],
      ]);
    }

    /**
     * [gets description]
     * @return [type] [description]
     */
    public function gets(Request $data)
    {
      # Note: use eloquent for this code
      $org = new OrganizationGroup();
      $orgs = $org->select('organization.name as org_name', 'position.name as pos_name')
        ->join('organization', 'organization.id', '=', 'organization_group.organization_id')
        ->join('position', 'position.id', '=', 'organization_group.position_id')
        ->join('users', 'users.id', '=', 'users.user_id')
        ->where('users.id','=',$data->id)
        ->get();

      echo json_encode(
        ['result' => $orgs]
      );
    }

    /**
     * Display the user form for registration
     *
     * @return
     */
    public function showRegisterForm()
    {
        $login_type = 'user';
        return view('pages.forms.users.register', compact('login_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request)
    {
      #Note: Need validation i think

      $user                                = User::find($request->id);

      $organization_group                  = new OrganizationGroup();
      $organization_group->user_id         = $user->id;
      $organization_group->organization_id = $request->add_organization_id;
      $organization_group->position_id     = $request->add_position_id;

      if ( $organization_group->save() && $user->save() ) {
        return redirect()->route('osa.user.list')
          ->with('status', "Successfuly added the organization/s of {$user->first_name} {$user->last_name} with corresponding positions");
      }
    }

    public function updateUserAccount(Request $request)
    {
      #Note: Need validation i think

      $user = User::find($request->id);
      $user->user_account_id = $request->edit_user_account_id;

      if ($user->save() ) {
        return redirect()->route('osa.user.list')
          ->with('status', "Successfuly changed the account type of {$user->first_name} {$user->last_name}");
      }
    }

    public function updateUserApproverStatus($user_id)
    {
      #Note: Need validation i think
      $user = User::find($user_id);
      if($user->approver_or_not == 0)  $user->approver_or_not = 1; else $user->approver_or_not = 0;

        if($user->approver_or_not == 1){
          if($user->save() ){
            return redirect()->route('osa.user.list')
            ->with('status', "Successfuly made {$user->first_name} {$user->last_name} as an approver of an event");
          }
        } else {
          if($user->save() ){
            return redirect()->route('osa.user.list')
            ->with('status', "Successfuly deleted {$user->first_name} {$user->last_name} as an approver of an event");
          }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $name = $user->first_name;
        $user->status = 0;

        if ($user->save()) {
            echo json_encode([
                'result' => true,
                'name'   => $name
            ]);
        }
    }

    /**
     * Display the list of users
     *
     * @return
     */
    public function showAllUserList()
    {
      $users      = User::all();
      $login_type = 'user';

      return view(
        'pages/users/admin-user/users/list',
        compact(
          'login_type',
          'users'
        )
      );
    }

    public function addOrgGroup(){
      //
    }
}
