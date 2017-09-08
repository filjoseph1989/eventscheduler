<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Library\OrgAdviserLibrary;
use App\Http\Controllers\Controller;

//models
use App\Models\UserAttendance;

class UserAttendanceController extends Controller
{
  private $adviser;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('web');
    $this->adviser = new OrgAdviserLibrary();
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
      // parent::loginCheck();
      //
      // $this->adviser->isAdviser();
        # Get the data from form
        $request = $data->only( 'status', 'reason', 'event_id' );
        $request['user_id'] = Auth::user()->id;

        # Lets check if the use exists
        $result = UserAttendance::where('user_id', '=', Auth::user()->id)->get();

        # Finally create events
        if ($result->count() == 0) {
            $result = UserAttendance::create($request);
            return back()->with('status', 'See you on the event');
        } else {
            $result = UserAttendance::where('user_id', '=', Auth::user()->id);
            $result = $result->update($request);
            # inform the user what happend
            if ($result->status == 'false') {
                return back()->with('status', 'Thank you for letting us know, yet you are still welcome to attend');
            }
            // return back()->with('status', 'See you on the event');
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
