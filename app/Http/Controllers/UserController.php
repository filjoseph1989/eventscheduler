<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

# Apps
use App\Helpers\RandomHelper;
use App\Mail\EmailNotification;
use App\Common\ValidationTrait;

#Models
use App\Models\User;
use App\Models\Course;
use App\Models\UserType;
use App\Models\Position;
use App\Models\OrganizationGroup;

/**
 * Handle the user related request
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @company DevCaffee
 * @date 09-26-2017
 * @date 10-08-2017 - Updated
 */
class UserController extends Controller
{
    private $validateWho;

    use ValidationTrait;

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
        'courses'    => Course::all(),
        'accounts'   => UserType::all(),
        'positions'   => Position::all()
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
      $this->validateUser($this, $request);

      $user = User::where('email', $request->email)->get();

      if ($user->count() >= 1) {
        return back()
          ->withInput()
          ->with('status_warning', 'Email already exist');
      }

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

      if ($id == 'active') {
        $users = $users->where('status', 'true')->get();
      }
      if ($id == 'inactive') {
        $users = $users->where('status', 'false')->get();
      }

      return view('users_index')->with([
        'users'  => $users,
        'help'   => $help,
        'filter' => true
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

        if ($user->password == null) {
          $password          = str_random(15);
          $request->password = $password;
          
          $request->email = $user->email;
          Mail::to($user->email)->send(new EmailNotification($request));
          
          $user->password = bcrypt($password);
        }
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
