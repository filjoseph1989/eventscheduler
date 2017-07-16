<?php

namespace app\Http\Controllers\OrganizationHead\ManageSchedule;

use Auth;
use App\Models\User;
use App\Models\UserAttendance;
use Illuminate\Http\Request;
use App\Models\OrganizationGroup;
use App\Http\Controllers\Controller;

class GenerateAttendanceController extends Controller
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
     * Display the Attendance sheet
     * .
     * @param  int $id Organization ID
     * @return Object Response
     */
    public function index($id, $eid)
    {
      $attendance = OrganizationGroup::with(['user', 'organization'])
        ->where('organization_id', '=', $id)
        ->get();

      $login_type = 'user';
      return view(
        'pages.users.organization-head.calendars.generate_attendance.attendance',
        compact(
          'login_type',
          'attendance',
          'eid'
        )
      );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * store the confirmation to
     * table attendance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data['event_id']     = $request->eid;
      $data['user_id']      = $request->id;
      $data['confirmation'] = 1;
      $data['confirmation'] = 1;
      $data['reason']       = '';
      $data['status']       = 1;

      $result = UserAttendance::create($data);
      if ($result->wasRecentlyCreated) {
        echo json_encode([
          'status' =>  true
        ]);
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
