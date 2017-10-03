<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

#Models
use App\Models\User;
use App\Models\Course;
use App\Models\UserType;
use App\Models\OrganizationGroup;

class UserController extends Controller
{
    /**
     * Initial instance of the class
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RandomHelper $help)
    {
      # Get the list of user together with their
      # course, organization and position in an orgainization
      $users = User::with([
        'course',
        'organizationGroup' => function($query) {
          return $query->with(['position', 'organization'])->get();
        }
      ])->where('status', 'true')
        ->get();

      return view('users_index')->with([
        'loginClass' => 'theme-teal',
        'users'      => $users,
        'help'       => $help
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # Determine if OSA

      # View
      return view('auth/register')->with([
        'loginClass' => 'theme-teal',
        'courses'    => Course::all(),
        'accounts'   => UserType::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      # Issue 19
      $this->validate($request, [
        'full_name'      => 'Required',
        'account_number' => 'Required',
        'email'          => 'Required',
        'mobile_number'  => 'Required',
        'course_id'      => 'Required',
        'user_type_id'   => 'Required',
      ]);

      $user = User::where('email', $request->email)->get();
      if ($user->count() >= 1) {
        return back()
          ->withInput()
          ->with('status_warning', 'Email already exist');
      }
      /*
      1. Generate a randomw password
      2. store a password in email and password in a file for reference
          remove later
       */
      $password = str_random(15);
      $contents = "{$request->email} {$password}";

      # Store password in a file
      # remove me later, because this password is to be email
      # Issue 17
      $file     = 'user.txt';
      $current  = file_get_contents($file);
      $current .= "$contents\n";
      file_put_contents($file, $current);

      # Validate sah

      # save sa database
      $data = $request->all();
      $data['password'] = bcrypt($password);

      $user = User::create( $data );

      if ($user->wasRecentlyCreated) {
        return back()
          ->withInput()
          ->with('status', 'Successfully added new user');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, RandomHelper $help)
    {
      # Get the list of user together with their
      # course, organization and position in an orgainization
      $users = User::with([
        'course',
        'organizationGroup' => function($query) {
          return $query->with(['position', 'organization'])->get();
        }
      ]);

      if ($id == 'all') {
        $users = $users->get();
      }
      if ($id == 'active') {
        $users = $users->where('status', 'true')->get();
      }
      if ($id == 'inactive') {
        $users = $users->where('status', 'false')->get();
      }

      return view('users_index')->with([
        'loginClass' => 'theme-teal',
        'users'      => $users,
        'help'       => $help
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return json_encode([
        'user'      => User::find($id)->toArray(),
        'course'    => Course::all()->toArray(),
        'user_type' => UserType::all()->toArray(),
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user = User::find($id);

      if (isset($request->from_modal_user_edit)) {
        $user->full_name      = empty($request->full_name) ? $user->full_name : $request->full_name;
        $user->account_number = empty($request->account_number) ? $user->account_number : $request->account_number;
        $user->course_id      = empty($request->course_id) ? $user->course_id : $request->course_id;
        $user->user_type_id   = empty($request->user_type_id) ? $user->user_type_id : $request->user_type_id;
      } else {
        $user->status = $request->status;
      }

      if ($user->save()) {
        return back()
          ->with('status', 'Successfully change the status');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
