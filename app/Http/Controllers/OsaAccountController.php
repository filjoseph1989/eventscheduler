<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Position;
use App\Models\Organization;
use App\Models\OrganizationGroup;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\EventType;
use App\Models\EventApprovalMonitor;
use App\Http\Controllers\ManageNotificationController;

class OsaAccountController extends Controller
{
  /**
   * Display the list of user on OSA's page|dashboard
   *
   * @return \Illuminate\Response
   */
  public function showAllUserList()
  {
    $organizations       = Organization::all();
    $organization_groups = new OrganizationGroup();
    $positions           = Position::all();
    $user_accounts       = UserAccount::all();

    $user = new User();
    $data = $user->select(
      'users.id as user_id',
      'users.user_account_id as u_acc_id',
      'user_accounts.name as u_acc_name',
      'users.account_number',
      'users.first_name',
      'users.last_name',
      'users.email',
      'users.mobile_number',
      'users.status',
      'users.approver_or_not'
    )
    ->join('user_accounts', 'users.user_account_id', '=', 'user_accounts.id')
    ->where('user_accounts.name', '!=', 'admin')
    ->get();

    $org_grps = $organization_groups->select(
      'organization_groups.id as org_grp_id',
      'organization_groups.user_id as og_user_id',
      'organization_groups.organization_id as og_org_id',
      'organization_groups.position_id as og_pos_id',
      'organizations.name as org_name',
      'positions.name as pos_name',
      'users.first_name as user_fname',
      'users.middle_name as user_mname',
      'users.last_name as user_lname',
      'users.suffix_name as user_sname'
    )
    ->join('users', 'organization_groups.user_id', '=', 'users.id')
    ->join('organizations', 'organization_groups.organization_id', '=', 'organizations.id')
    ->join('positions', 'organization_groups.position_id', '=', 'positions.id')
    ->get();

    $login_type = 'user';
    return view('pages.users.osa-user.manage-users.list', compact('login_type','data', 'organizations', 'positions', 'org_grps', 'user_accounts'));
  }

  /**
   * Display the list of organization
   *
   * @return
   */
  public function showAllOrganizationList()
  {
      $organizations = Organization::all();
      $login_type = 'user';
      return view('pages.users.osa-user.organization.list', compact('login_type','organizations'));
  }

  /**
   * Show organization
   *
   * @return
   */
  public function showOrganizationAddForm()
  {
    return view('pages.users.osa-user.organization.add');
  }

  public function addOrganizationToMember(){
    //
  }

  public function addMemberToOrganization()
  {

  }

  public function getOrganizationGroup(){
    $organization_group = new OrganizationGroup();
    $org_grp = $organization_group->select(
      'organization_groups.id as org_g_id',
      'organization_groups.user_id as orgg_user_id',
      'organization_groups.organization_id as orgg_org_id'
    )
    ->join('users', 'organization_groups.user_id', '=', 'users.id')
    ->join('organizations', 'organization_groups.organization_id', '=', 'organizations.id')
    ->get();
  }

  public function getEventOfTheMonthList()
  {
    # Issue 23: find a way to make it more laravel
    $event = new Event();
    $event = $event->query("select * from events where date_start = YEAR('".date('YYYY/mm/dd')."')");
    $event = $event->get();

    $login_type = 'user';
    $calendar   = Calendar::all();
    return view('pages.users.osa-user.events.list', compact('login_type', 'event', 'calendar'));
  }

  /**
   * Display the create event form
   *
   * @return \Illuminate\Response
   */
  public function createNewEventForm()
  {
    parent::loginCheck();

    if (parent::isOrgOsa()) {
      $login_type = 'user';
      $calendar   = Calendar::all();
      return view('pages.users.osa-user.events.new_event', compact('login_type', 'calendar'));
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * Method for approving events
   *
   * Note: Those who have prefix parent::
   *  are the methods declared in Apps\Http\Controller\Controller class
   *
   * @return Illuminate\Response
   */
  public function approveEvents()
  {
    # Check the authentication of this account
    parent::loginCheck();

    # Check if the account is an OSA
    if (parent::isOrgOsa()) {
      # Check if the account is an approver
      if (parent::isApprover()) {
        $login_type = 'user';

        # Get all event that need the OSA approval.
        # This method is declare below as private.
        $ev = self::getEventsThatNeedOsaApproval();

        # Pass the result to the view
        return view('pages.users.osa-user.events.approve-events', compact('login_type','ev'));
      }
    } else {
      return redirect()->route('home');
    }
  }

  /**
   * Approve event
   *
   * @param  int $id event ID
   * @return
   */
  public function approve($id)
  {
    # is User login?
    parent::loginCheck();

    # is user an osa staff? and approver?
    if (parent::isOrgOsa() and parent::isApprover()) {
      # Get a single row of event
      $approved_event = Event::find($id);

      /*
       Issue 34: What if they want more than (3) approvers?
        There should be another column on event to determine how many shoud approve

       If the the event is not yet approved by 3
       Do the approving
       */
      if ($approved_event->approver_count >= 0 and $approved_event->approver_count < 3) {
        # Before confirming the approve,
        # we need to check if the user already approved the event
        $done = EventApprovalMonitor::where('event_id', '=', $id)->where('approvers_id', '=', Auth::user()->id)->exists();
        if ($done) {
          return redirect()->route('osa.event.approval')
            ->with('status', "You already approved this event ( {$approved_event->event} ). Press the UNAPPROVE button to disable your approval.");
        } else {
          # Increment approver count on events table.
          # This determine how many already approved the event
          $approved_event->approver_count++;
          $approved_event->save();

          # Save users ID to prevent performing more approval
          # when the user already did it.
          EventApprovalMonitor::create([
            'event_id'     => $id,
            'approvers_id' => Auth::user()->id
          ]);

          # With notification message
          if ($approved_event->approver_count >= 3) {
            # Update the status of event
            $approved_event->status = 1;
            $approved_event->save();

            # Notification
            $notify = new ManageNotificationController();
            $notify->notify($approved_event);

            # message
            # I think no need here
            return redirect()->route('osa.event.approval')
              ->with('status', "Successfuly approved the event ( {$approved_event->event} ) and Notified");
          }

          # with no notification message
          return redirect()->route('osa.event.approval')
            ->with('status', "Successfuly approved the event ( {$approved_event->event} )");
        }
      }
    }

    // if($approved_event->event_category_id == 1 || $approved_event->event_category_id == 3 && $approved_event->approver_count == 3){
    //   //call notify function
    // }
  }

  public function disapprove($id, $orgg_uid)
  {
    $approved_event = Event::find($id);
    if(EventApprovalMonitor::where('event_id', '=', $id)->where('approvers_id', '=', $orgg_uid)->exists()){
      $delete_record = EventApprovalMonitor::where('event_id', '=', $id)->where('approvers_id', '=', $orgg_uid);
      $delete_record->delete();
      $approved_event->approver_count--;
    } else{
      return redirect()->route('osa.event.approval')
      ->with('status', "You can't disapprove this event ( {$approved_event->event} ) because you have not approved it yet.");
    }
    if($approved_event->save() ){
      return redirect()->route('osa.event.approval')
      ->with('status', "Successfuly disapproved the event ( {$approved_event->event} ).");
    }
  }

  /**
   * return the events that needs the approval of the OSA
   * personnel
   *
   * @return object
   */
  private function getEventsThatNeedOsaApproval()
  {
    return Event::select(
      'events.*',
      'organizations.id as org_id',
      'organizations.name as org_name',
      'organizations.name as org_name'
    )
    ->join('organizations', 'events.organization_id', '=', 'organizations.id')
    ->where('approver_count', '<', 3)
    ->get();
  }
}
