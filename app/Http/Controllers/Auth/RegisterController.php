<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

#models
use App\Models\User;
use App\Models\Course;
use App\Models\UserType;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);
            /**
             * modifying validators for registration
             */
        return Validator::make($data, [
            'full_name' => 'required|string|max:255',
            'email'     => 'required|string|email|max: 255|unique: users',
            'password'  => 'required|string|min:6|confirmed',
            'account_number' => 'required|string|',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]);
            /**
             * modifying create function
             */
         return User::create([
            'user_type_id'   => $data['user_type_id'],   
            'course_id'      => $data['course_id'],
            'account_number' => $data['account_number'],
            'email'          => $data['email'],
            'password'       => bcrypt($data['password']),
            'full_name'      => $data['full_name'],
            'facebook'       => $data['facebook'],
            'twitter'        => $data['twitter'],
            'mobile_number'  => $data['mobile_number'],
        ]);
        
    }

    public function showRegistrationForm()
    {
        $courses = Course::all();
        session(['class' => 'signup-page']);
        return view('auth.register', compact('courses')); 
    }
}
