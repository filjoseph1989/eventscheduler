<?php

namespace app\Http\Controllers\OrganizationCoAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Library\OrgCoAdviserLibrary;
use App\Http\Controllers\Controller;

# Models
use App\Models\User;
use App\Models\UserAttendance;
use App\Models\OrganizationGroup;

class GenerateAttendanceController extends Controller
{
    private $co_adviser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('web');
      $this->co_adviser = new OrgCoAdviserLibrary();
    }

    /**
     * Display the organization list of the co_adviser
     * .
     * @return Illuminate\Response
     */
    public function index()
    {
      # Get the organization of the co_adviser
      $org = OrganizationGroup::with('organization')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

      $login_type = 'user';
      return view('pages/users/organization-co-adviser/events/org-list', compact(
        'org', 'login_type'
      ));
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
      $data['event_id'] = $request->eid;
      $data['user_id']  = $request->id;
      $data['reason']   = '';
      $data['status']   = 'true';

      $result = UserAttendance::updateOrCreate($data);
      if ($result) {
        echo json_encode([
          'status' => true
        ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id Organization ID
     * @param int $eid Event ID
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $eid)
    {
      parent::loginCheck();

      $this->co_adviser->isAdviser();

      # Get the user belong to an organization
      $attendance = OrganizationGroup::with(['user', 'organization'])
        ->where('organization_id', '=', $id)
        ->get();

      # Get the status of the user attendance
      $att       = [];
      $att_sheet = UserAttendance::where('event_id', '=', $eid)->get();
      foreach ($att_sheet as $key => $value) {
        $att[$value->user_id] = $value->status;
      }

      $login_type = 'user';
      return view('pages/users/organization-co-adviser/calendars/events/attendance', compact(
        'login_type', 'attendance', 'eid', 'att'
      ));
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
