<?php

namespace app\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Library\OrgAdviserLibrary;
use App\Http\Controllers\Controller;

# Models
use App\Models\User;
use App\Models\UserAttendance;
use App\Models\OrganizationGroup;
use App\Models\Organization;
use App\Models\Event;
use App\Models\Course;

class GenerateAttendanceController extends Controller
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
     * Display the organization list of the adviser
     * .
     * @return Illuminate\Response
     */
    public function index()
    {
      # Get the organization of the adviser
      $org = OrganizationGroup::with('organization')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

      $login_type = 'user';
      return view('pages/users/organization-adviser/events/org-list', compact(
        'org', 'login_type'
      ));
    }

    public function generateExpectedAttendance(){
      parent::loginCheck();

      $this->adviser->isAdviser();
      $login_type = 'user';
      $org = OrganizationAdviserGroup::with('organization')
      ->where('user_id', Auth::user()->id)
      ->get();

      # Get members
      if (isset($org[0])) {
        $org    = $org[0];
        $member = OrganizationGroup::getMembers($org->organization_id);
      } else {
        $org = false;
      }

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/generate-expected-attendance', compact(
        'org', 'login_type', 'member'
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
      // $data['event_id'] = $request->eid;
      // $data['user_id']  = $request->id;
      // $data['reason']   = '';
      // $data['status']   = 'true';
      // $data['confirmation'] = 'true';

      $result = UserAttendance::updateOrCreate(
        ['event_id' => $request->eid, 'user_id' => $request->id],
        ['status' => 'true', 'confirmation' => 'true']
      );
      if ($result) {
        echo json_encode([
          'status' => true
        ]);
      }
    }
    public function store2(Request $request)
    {
      // $data['event_id'] = $request->eid;
      // $data['user_id']  = $request->id;
      // $data['reason']   = '';
      // $data['status']   = 'true';
      // $data['confirmation'] = 'true';

      $result = UserAttendance::updateOrCreate(
        ['event_id' => $request->eid, 'user_id' => $request->id],
        ['status' => 'false', 'confirmation' => 'false']
      );
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

      $this->adviser->isAdviser();

      # Get the user belong to an organization
      $attendance = OrganizationGroup::with(['user', 'organization'])
        ->where('organization_id', '=', $id)
        ->get();

      # Get the status of the user attendance
      $att = []; # attendance
      $cnf = []; # confirmation
      $att_sheet = UserAttendance::where('event_id', '=', $eid)->get();
      foreach ($att_sheet as $key => $value) {
        $att[$value->user_id] = $value->status;
        $confirm[$value->user_id] = $value->confirmation;
      }

      $login_type = 'user';
      return view('pages/users/organization-adviser/calendars/events/attendance', compact(
        'login_type', 'attendance', 'eid', 'att', 'confirm'
      ));
    }

    #menu blade for functionality generate attendance
    public function generateAttendanceMenu(){
      parent::loginCheck();

      $this->adviser->isAdviser();
      $login_type = 'user';
      return view('pages/users/organization-adviser/calendars/events/generate-attendance-menu', compact(
        'login_type'
      ));
    }



    public function declinedAttendanceOrgList()
    {
      # Get the organization of the adviser
      $org = OrganizationGroup::with('organization')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/declined-attendance-org-list', compact(
        'org', 'login_type'
      ));
    }
    public function confirmedAttendanceOrgList()
    {
      # Get the organization of the adviser
      $org = OrganizationGroup::with('organization')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/confirmed-attendance-org-list', compact(
        'org', 'login_type'
      ));
    }
    public function officialAttendanceOrgList()
    {
      # Get the organization of the adviser
      $org = OrganizationGroup::with('organization')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/official-attendance-org-list', compact(
        'org', 'login_type'
      ));
    }



    public function generateConfirmedAttendanceEventList($id = null){

      $event = Event::where('organization_id', '=', $id)
      ->where('approve_status', '=', 'approved')
      ->get();

      $login_type = 'user';
      return view('pages\users\organization-adviser\generate-attendance\confirmed_attendance_event_list', compact(
        'event', 'login_type'
      ));
    }

    public function generateOfficialAttendanceEventList($id = null){

      $event = Event::where('organization_id', '=', $id)
      ->where('approve_status', '=', 'approved')
      ->get();

      $login_type = 'user';
      return view('pages\users\organization-adviser\generate-attendance\official_attendance_event_list', compact(
        'event', 'login_type'
      ));
    }

    public function generateDeclinedAttendanceEventList($id = null){

      $event = Event::where('organization_id', '=', $id)
      ->where('approve_status', '=', 'approved')
      ->get();

      $login_type = 'user';
      return view('pages\users\organization-adviser\generate-attendance\declined_attendance_event_list', compact(
        'event', 'login_type'
      ));
    }


    public function generateConfirmedAttendance($id = null){
      parent::loginCheck();

      $this->adviser->isAdviser();
      $login_type = 'user';
      $org = OrganizationAdviserGroup::with('organization')
        ->where('user_id', Auth::user()->id)
        ->get();

      # Get members
      if (isset($org[0])) {
        $org    = $org[0];
        $member = OrganizationGroup::getMembers($org->organization_id);
      } else {
        $org = false;
      }

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/generate-confirmed-attendance', compact(
        'org', 'login_type', 'member'
      ));
    }

    public function declinedAttendanceMemberList($id, $eid)
    {
      parent::loginCheck();
      $this->adviser->isAdviser();

      #get the event details
      $event = Event::find($eid);

      #get the organization details
      $organization = Organization::find($id);

      # Get the users in the user_attendance table whose status are false
      $att       = []; //the course of user in user_attendance
      $pos2       = []; //position of the user
      $org       = []; //org of the user
      $att_sheet = UserAttendance::with('user')
      ->where('event_id', '=', $eid)->where('status', 'false')->get();

      foreach ($att_sheet as $key => $value) {
        $att[$value->user_id] = $value->user->course->name;
        $pos = OrganizationGroup::with('position')
        ->with('organization')
        ->where('user_id', '=', $value->user_id)
        ->where('organization_id', '=', $id)
        ->get();
        foreach ($pos as $key => $val) {
          $pos2[$value->user_id] = $val->position->name;
          $org[$value->user_id] = $val->organization->name;
        }
      }

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/declined-attendance-member-list', compact(
        'login_type', 'att_sheet', 'organization', 'event', 'att', 'pos2', 'org'
      ));
    }

    public function confirmedAttendanceMemberList($id, $eid)
    {
      parent::loginCheck();
      $this->adviser->isAdviser();

      #get the event details
      $event = Event::find($eid);

      #get the organization details
      $organization = Organization::find($id);

      # Get the users in the user_attendance table whose status are false
      $att       = []; //the course of user in user_attendance
      $pos2       = []; //position of the user
        $org       = []; //org of the user
      $att_sheet = UserAttendance::with('user')
      ->where('event_id', '=', $eid)->where('status', 'true')->get();

      foreach ($att_sheet as $key => $value) {
        $att[$value->user_id] = $value->user->course->name;
        $pos = OrganizationGroup::with('position')
        ->with('organization')
        ->where('user_id', '=', $value->user_id)
        ->where('organization_id', '=', $id)
        ->get();
        foreach ($pos as $key => $val) {
          $pos2[$value->user_id] = $val->position->name;
          $org[$value->user_id] = $val->organization->name;
        }
      }

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/confirmed-attendance-member-list', compact(
        'login_type', 'att_sheet', 'organization', 'event', 'att', 'pos2', 'org'
      ));
    }


    public function officialAttendanceMemberList($id, $eid)
    {
      parent::loginCheck();
      $this->adviser->isAdviser();

      #get the event details
      $event = Event::find($eid);

      #get the organization details
      $organization = Organization::find($id);

      # Get the users in the user_attendance table whose status are false
      $att       = []; //the course of user in user_attendance
      $pos2       = []; //position of the user
      $org       = []; //org of the user
      $att_sheet = UserAttendance::with('user')
      ->where('event_id', '=', $eid)->where('status', 'true')->where('confirmation', 'true')->get();

      foreach ($att_sheet as $key => $value) {
        $att[$value->user_id] = $value->user->course->name;
        $pos = OrganizationGroup::with('position')
        ->with('organization')
        ->where('user_id', '=', $value->user_id)
        ->where('organization_id', '=', $id)
        ->get();
        foreach ($pos as $key => $val) {
          $pos2[$value->user_id] = $val->position->name;
          $org[$value->user_id] = $val->organization->name;
        }
      }

      $login_type = 'user';
      return view('pages/users/organization-adviser/generate-attendance/official-attendance-member-list', compact(
        'login_type', 'att_sheet', 'organization', 'event', 'att', 'pos2', 'org'
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
