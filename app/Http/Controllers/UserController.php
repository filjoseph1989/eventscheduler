<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Position;
use App\Models\Department;
use App\Models\UserAccount;
use Illuminate\Http\Request;


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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'position_id'        => $data['position_id'],
            'account_number'     => $data['account_number'],
            'email'              => $data['email'],
            'password'           => bcrypt($data['account_number']),
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

      if ($user->save()) {
        return redirect()->route('admin.user.list')
          ->with('status', 'Successfuly updated module');
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
      $user->position_id        = $data['position_id'];
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
        return redirect()->route('admin.user.list')
          ->with('status', 'Successfuly User Information');
      }
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
          'position_id'        => $data['position_id'],
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
     * Get the single row of user base on the given ID
     *
     * @param  Request $data
     * @return json
     */
    public function getUser(Request $data)
    {
        $data = [
          'department'   => Department::All(),
          'user_account' => UserAccount::all(),
          'position'     => Position::all(),
          'course'       => Course::all(),
          'user'         => User::find($data->id),
        ];

        echo json_encode($data);
        
        # next time use Illuminate\Response to return json
        // return User::find($data->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
