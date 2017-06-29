<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Admin;
use App\Models\User;
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
      return User::create([
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
      $user->password           = $data['password'];
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
          ->with('status', 'Successfuly updated module');
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

    public function getUser(Request $data)
    {
        return User::find($data->id);
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
    public function destroy($id)
    {
        //
    }
}
