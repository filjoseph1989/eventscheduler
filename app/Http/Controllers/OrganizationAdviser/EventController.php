<?php

namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Library\ApproverLibrary;
use App\Http\Controllers\Controller;
use App\Library\OrgAdviserLibrary as Adviser;
use App\Http\Controllers\ManageNotificationController;

# Models
use App\Models\Event;
use App\Models\EventType;
use App\Models\PersonalEvent;
use App\Models\EventCategory;
use App\Models\OrganizationGroup;
use App\Models\EventApprovalMonitor;
use App\Models\OrganizationAdviserGroup;

class EventController extends Controller
{
    private $adviser;

    public function __construct()
    {
      $this->middleware('web');
      $this->adviser = new Adviser();
    }

    /**
     * Display the list of event
     * 
     * @param  int $id Event ID
     * @return void
     */
    public function index($id = null)
    {
      # is adviser loggedin?
      parent::loginCheck();

      # Is the user an adviser?
      $this->adviser->isAdviser();

      $login_type = "user";
      if ($id == null) {
        return view('pages/users/organization-adviser/events/choices', compact(
          'login_type'
        ));
      } else {
        if ($id != 4) {
          $eventCategory = EventCategory::find($id);
          $event         = Event::where('event_category_id', '=', $id)->with('organization')->get();
          return view('pages/users/organization-adviser/events/list', compact(
            'login_type', 'eventCategory', 'event', 'id'
          ));
        } elseif ($id == 4) {
          # Issue: 45
          #  Note: Set some event to archive when date is before the current date

          $event = PersonalEvent::where('date_start', '>=', date('m'))
            ->where('user_id', '=', Auth::user()->id)
            ->get();
          return view('pages/users/organization-adviser/events/mylist', compact(
            'login_type', 'event', 'id'
          ));
        } else {
          return back();
        }
      }
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # Is the user loggedin?
      parent::loginCheck();

      # Is the user an adviser?
      $this->adviser->isAdviser();

      $login_type     = 'user';
      $event_type     = EventType::all()->except(1);
      $organization   = OrganizationAdviserGroup::with('organization')
        ->where('organization_adviser_groups.user_id', '=', Auth::user()->id)
        ->get();
      return view('pages/users/organization-adviser/events/form', compact(
        'login_type',
        'event_type',
        'event_category',
        'organization'
      ));
    }

    /**
     * Receive passed data and create new event
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
      # is the user login?
      parent::loginCheck();

      # is the user rank as adivser?
      $this->adviser->isAdviser();

      # Issue 59 - Check the data and time if there's a conflict

      # return to form if the following does not satisfy
      if ($data->event_type_id == 0) {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose type of event');
      }
      if ($data->event_category_id == 0) {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose the audience for this event');
      }
      if ($data->semester == '0') {
        return back()
          ->withInput()
          ->with('status_warning', 'You must chose for what semester this event');
      }
      if ($data->organization_id == 0) {
        return back()
          ->withInput()
          ->with('status_warning', "Sorry you cannot create event because you are not yet a member of any organization");
      }

      # is the user a member of the given organization?
      if ( ! self::_isMember($data->organization_id)) {
        return back()
          ->withInput()
          ->with('status_warning', "Sorry you are not yet a member of any organization.<br>You need to be a member first");
      }

      # is data entry valid?
      $this->adviser->isValid($data);

      # is the user an adviser to an organization?
      $this->adviser->isAdviserInGivenOrganization($data->organization_id);

      # Get the data from form
      $request = $data->only(
        'user_id', 'event_type_id', 'event_category_id',
        'organization_id', 'title', 'description',
        'venue', 'date_start', 'date_start_time',
        'date_end', 'date_end_time', 'whole_day',
        'notify_via_facebook', 'notify_via_twitter',
        'notify_via_email', 'notify_via_sms', 'semester',
        'additional_msg_facebook', 'additional_msg_sms',
        'additional_msg_email'
      );

      # Finally create events
      $result = Event::create($request);

      # inform the user what happend
      if ($result->wasRecentlyCreated) {
        return back()->with('status', 'Successfuly added new event');
      } else {
        return back()->with('status_warning', 'Sorry, we have problem saving the event');
      }
    }

    /**
     * Display events
     *
     * @param  int  $id Organization ID
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
      # Get the events from organiation ID
      $event = Event::where('organization_id', '=', $id)
        ->where('approve_status', '=', 'approved')
        ->get();

      $login_type = 'user';
      return view('pages/users/organization-adviser/events/list_for_attendance', compact(
        'event', 'login_type'
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

    /**
     * Approve events
     * @return [type] [description]
     */
    public function approveEvents()
    {
      # Check the authentication of this account
      parent::loginCheck();

      # Check if user is an adviser
      $this->adviser->isAdviser();

      # Check if the account is an approver
      if (parent::isApprover()) {
        $login_type = 'user';

        $ev = ApproverLibrary::getGetEventsNeedApproval();

        return view('pages/users/organization-adviser/events/approve-events', compact(
          'login_type','ev'
        ));
      } else {
        return back()->with('status_warning', "Sorry, that page is for approver only");
      }
    }

    /**
     * Process the approval of events
     *
     * @param int $id Event ID
     * @return Illuminate\Response
     */
    public function setApprove($id)
    {
      # is login?
      parent::loginCheck();

      # is an approver & adviser?
      if (parent::isOrgAdviser() and parent::isApprover()) {
        $approved_events = Event::with('organization')
          ->where('id', '=', $id)
          ->get();

        # is the event exist?
        if ($approved_events->count() == 0) {
          return redirect()->route('org-adviser.approve.event')
            ->with('status_warning', 'There is no event yet');
        }

        $approved_event = $approved_events[0];

        # the majority approve already?
        if ( ($approved_event->event_category_id == 3 || $approved_event->event_category_id == 1 ) && $approved_event->approver_count >= 0 and $approved_event->approver_count < 3) {
          # Before confirming the approve,
          # we need to check if the user already approved the event
          $done = EventApprovalMonitor::where('event_id', '=', $id)
            ->where('approvers_id', '=', Auth::user()->id)
            ->exists();

          if ($done) {
            return redirect()->route('org-adviser.approve.event')
              ->with('status_warning', "You already approved this event ( {$approved_event->title} ). Press the UNAPPROVE button to disable your approval.");
          } else {
            # Increment approver count on events table.
            # This determine how many already approved the event
            $event_temp = Event::find($id);
            $event_temp->approver_count++;
            $event_temp->save();

            # Save users ID to prevent performing more approval
            # when the user already did it.
            EventApprovalMonitor::create([
              'event_id'     => $id,
              'approvers_id' => Auth::user()->id
            ]);

            # With notification message
            if ($event_temp->approver_count >= 3) {
              # Update the status of event
              $event_temp = Event::find($id);
              $event_temp->approve_status = 'approved';
              $event_temp->save();

              # Notification
              $notify = new ManageNotificationController();
              $notify->notify($approved_event);

              # message
              # I think no need here, hm
              return redirect()->route('org-adviser.approve.event')
                ->with('status', "Successfuly approved the event ( {$approved_event->title} ) and Notified");
            }

            # with no notification message
            return redirect()->route('org-adviser.approve.event')
              ->with('status', "Successfuly approved the event ( {$approved_event->title} )");
          }
        }

        if ( ($approved_event->event_category_id == 2 ) && $approved_event->approver_count >= 0 and $approved_event->approver_count < 2) {
          # Before confirming the approve,
          # we need to check if the user already approved the event
          $done = EventApprovalMonitor::where('event_id', '=', $id)
            ->where('approvers_id', '=', Auth::user()->id)
            ->exists();

          if ($done) {
            return redirect()->route('org-adviser.approve.event')
              ->with('status_warning', "You already approved this event ( {$approved_event->title} ). Press the UNAPPROVE button to disable your approval.");
          } else {
            # Increment approver count on events table.
            # This determine how many already approved the event
            $event_temp = Event::find($id);
            $event_temp->approver_count++;
            $event_temp->save();

            # Save users ID to prevent performing more approval
            # when the user already did it.
            EventApprovalMonitor::create([
              'event_id'     => $id,
              'approvers_id' => Auth::user()->id
            ]);

            # With notification message
            if ($event_temp->approver_count >= 2) {
              # Update the status of event
              $event_temp = Event::find($id);
              $event_temp->approve_status = 'approved';
              $event_temp->save();

              # Notification
              $notify = new ManageNotificationController();
              $notify->notify($approved_event);

              # message
              # I think no need here, hm
              return redirect()->route('org-adviser.approve.event')
                ->with('status', "Successfuly approved the event ( {$approved_event->title} ) and Notified");
            }

            # with no notification message
            return redirect()->route('org-adviser.approve.event')
              ->with('status', "Successfuly approved the event ( {$approved_event->title} )");
          }
        }
      }
    }

    /**
     * Disapprove the event
     *
     * @param [int] $id Event ID
     * @return Illuminate\Response
     */
    public function setDisApprove($id)
    {
      # is login?
      parent::loginCheck();

      # is an adviser & approver?
      if (parent::isOrgAdviser() and parent::isApprover()) {
        # Get one row of event
        $approved_event = Event::find($id);

        # is the event exist?
        if ( ! $approved_event->exists) {
          return redirect()->route('org-adviser.approve.event')
            ->with('status_warning', 'There no event yet');
        }

        # is the majority not yet approve?
        if ($approved_event->approver_count >= 0 and $approved_event->approver_count < 3) {
          $done = EventApprovalMonitor::where('event_id', '=', $id)
            ->where('approvers_id', '=', Auth::user()->id)
            ->exists();

          if ($done) {
            EventApprovalMonitor::where('event_id', '=', $id)
              ->where('approvers_id', '=', Auth::user()->id)
              ->delete();

            $approved_event->approver_count--;
            if ($approved_event->save()) {
              return redirect()->route('org-adviser.approve.event')
                ->with('status', "Successfuly disapproved the event ( {$approved_event->title} )");
            }
          } else {
            return redirect()->route('org-adviser.approve.event')
              ->with('status_warning', "You already disapproved or not yet approve this event ( {$approved_event->title} )");
          }
        }
      }
    }

    /**
     * Display the infor box for event management
     *
     * @return void
     */
    public function manageSchedule()
    {
      parent::loginCheck();

      $this->adviser->isAdviser();

      $login_type = "user";
      return view('pages/users/organization-adviser/events/manange-schedule')
        ->with([
          'login_type' => $login_type
        ]);
    }

    /**
     * Determined if this loggedin user
     * is a member of the given organization ID
     *
     * @param  int  $id Organization ID
     * @param boolean $get Used to determine if need to return boolean or redirect
     * @return boolean
     */
    private function _isMember($id)
    {
      $result = OrganizationGroup::where('user_id', '=', Auth::user()->id)
      ->where('organization_id', '=', $id)
      ->where('membership_status', '=', 'yes')
      ->count();

      return $result == 1 ? true : false;
    }
}
