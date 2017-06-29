<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
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
    public function create(Request $data)
    {
        #
    }

    public function getUsers(Request $data)
    {
        return User::find($data->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Note:
     * AdminUser class is used to validate the incoming request
     * which is define in app\Http\Requests\AdminUser.php and created
     * using php artisan make:request AdminUser
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(AdminUser $request)
    public function store(Request $data)
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
