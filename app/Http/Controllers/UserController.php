<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

#Models
use App\Models\User;
use App\Models\Course;
use App\Models\OrganizationGroup;
use App\Models\UserType;

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $user->status = $request->status;
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
