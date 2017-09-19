<?php

namespace App\Http\Controllers\OsaPersonnel;

use Auth;
use Illuminate\Http\Request;
use App\Library\ApproverLibrary;
use App\Http\Controllers\Controller;
use App\Library\OsaPersonnelLibrary as OsaPersonnel;
use App\Http\Controllers\ManageNotificationController;

# Models
use App\Models\Event;
use App\Models\EventType;
use App\Models\PersonalEvent;
use App\Models\EventCategory;
use App\Models\OrganizationGroup;
use App\Models\Organization;
use App\Models\EventApprovalMonitor;

class EventController extends Controller
{
    private $osa_personnel;

    public function __construct()
    {
      $this->middleware('web');
      $this->osa_personnel = new OsaPersonnel();
    }

    /**
     * Display the list of event
     *
     * # Issue 82
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function index($id = null)
    {
      # is head loggedin?
      parent::loginCheck();

      # Is the user an head?
      $this->osa_personnel->isOsaPersonnel();

      $login_type = "user";

      if ($id == null) {
        return view('pages/users/osa-personnel/events/choices', compact(
          'login_type'
        ));
      } else {
        # Is event not belong to personal event?
        if ($id != 4) {
          if ($id == 2) {
            $organization = Organization::all();
            return view('pages/users/osa-personnel/events/list1', compact(
                'organization'
              ))->with([
                'login_type' => $login_type
              ]);
          } else {
            $eventCategory = EventCategory::find($id);
            $event         = Event::where('event_category_id', '=', $id)
              ->with('organization')
              ->get();

            return view('pages/users/osa-personnel/events/list', compact(
              'login_type', 'eventCategory', 'event'
            ));

          }
        } elseif ($id == 4) {
          # Issue: 45
          #  Note: Set some event to archive when date is before the current date

          $event = PersonalEvent::where('date_start', '>=', date('m'))
            ->where('user_id', '=', Auth::user()->id)
            ->get();
          return view('pages/users/osa-personnel/events/mylist', compact(
            'login_type', 'event'
          ));
        }
      }

      return back();
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

      # Is the user an head?
      $this->osa_personnel->isOsaPersonnel();

      $login_type     = 'user';
      $event_type     = EventType::all()->except(1);
      $event_category = EventCategory::all()->except(4);

      return view('pages/users/osa-personnel/events/form', compact(
        'login_type', 'event_type', 'event_category'
      ));
    }

    /**
     * Receive passed data and create new event
     *
     * @param  \Illuminate\Http\Request  $data
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
      # is the user login?
      parent::loginCheck();

      # is the user rank as adivser?
      $this->osa_personnel->isOsaPersonnel();

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

      # is data entry valid?
      $this->osa_personnel->isValid($data);

      # Get the data from form
      $request = $data->only(
        'user_id', 'event_type_id', 'event_category_id',
        'title', 'description', 'venue', 'date_start', 'date_start_time',
        'date_end', 'date_end_time', 'whole_day',
        'notify_via_facebook', 'notify_via_twitter',
        'notify_via_email', 'notify_via_sms', 'semester',
        'additional_msg_facebook', 'additional_msg_sms',
        'additional_msg_email'
      );

      $request['organization_id'] = 1;
 
      # Replace with defaults the following
      $index = ['notify_via_facebook', 'notify_via_twitter', 'notify_via_sms', 'notify_via_email'];
      foreach ($index as $key => $value) {
        if ($request[$index[$key]] == null) {
          $request[$index[$key]] = 'off';
        }
      }

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
      return view('pages/users/osa-personnel/calendars/events/list_for_attendance', compact(
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
     * Approve event method
     *
     * @return illuminate\Response
     */
    public function approveEvents()
    {
      # Check the authentication of this account
      parent::loginCheck();

      # Check if user is an head
      $this->osa_personnel->isOsaPersonnel();

      # Check if the account is an approver
      if (parent::isApprover()) {
        $login_type = 'user';

        # Get the organization of the osa-personnel
        $organization = OrganizationGroup::with('organization')
          ->where('user_id', '=', Auth::user()->id)
          ->get();

        # when the account has no organization
        if ( ! isset($organization[0])) {
          return redirect()
            ->route('home')
            ->with('status_warning', 'Sorry, you\'re not a member of any organization');
        }

        if ( ! isset($organization[0])) {
          return redirect()->route('home');
        }

        $organization = $organization[0];

        # Get the events of the organization
        if ($organization->exists) {
          // $event = Event::where('organization_id', '=', $organization->organization_id)->get();
          //changed because OSA can access all organization events
          $event = Event::where('event_category_id', '!=', 2)->get();
        }

        # Display view
        return view('pages/users/osa-personnel/events/approve-events', compact(
          'login_type', 'organization', 'event'
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

      # is an approver & org_head?
      if (parent::isOsaPersonnel() and parent::isApprover()) {
        $approved_events = Event::with('organization')
          ->where('id', '=', $id)
          ->get();

        # is the event exist?
        if ($approved_events->count() == 0) {
          return redirect()->route('osa-personnel.approve.event')
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
            return redirect()->route('osa-personnel.approve.event')
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
              return redirect()->route('osa-personnel.approve.event')
                ->with('status', "Successfuly approved the event ( {$approved_event->title} ) and Notified");
            }

            # with no notification message
            return redirect()->route('osa-personnel.approve.event')
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
            return redirect()->route('osa-personnel.approve.event')
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
              return redirect()->route('osa-personnel.approve.event')
                ->with('status', "Successfuly approved the event ( {$approved_event->title} ) and Notified");
            }

            # with no notification message
            return redirect()->route('osa-personnel.approve.event')
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

      # is an head & approver?
      if (parent::isOsaPersonnel() and parent::isApprover()) {
        # Get one row of event
        $approved_event = Event::find($id);

        # is the event exist?
        if ( ! $approved_event->exists) {
          return redirect()->route('osa-personnel.approve.event')
            ->with('status_warning', 'There no event yet');
        }

        if ($approved_event->approver_count >= 3) {
          return back()->with('status_warning', 'This event is already approved');
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
              return back()
                ->with('status', "Successfuly disapproved the event ( {$approved_event->title} )");
            }
          } else {
            return back()
              ->with('status_warning', "You already disapproved or not yet approve this event ( {$approved_event->title} )");
          }
        }
      }
    }

    /**
     * Display the info box for event management
     *
     * @return void
     */
    public function manageSchedule()
    {
      parent::loginCheck();

      $this->osa_personnel->isOsaPersonnel();

      $login_type = "user";
      return view('pages/users/osa-personnel/events/manange-schedule')
        ->with([
          'login_type' => $login_type
        ]);
    }
    /**
     * Manage notification
     *
     * @return void
     */
    public function manageNotification()
    {
      parent::loginCheck();

      # is the org_head logged in?
      $this->osa_personnel->isOsaPersonnel();

      #get all events of the org head's organization
      $org_head_group = OrganizationGroup::where('user_id', Auth::user()->id)->get();
      foreach ($org_head_group as $key => $value) { $org = $value->organization_id; }
      $event = Event::where('organization_id', $org)->get();

      $login_type = "user";
      return view('pages/users/osa-personnel/events/list0')->with([
        'login_type' => $login_type,
        'event'      => $event,
      ]);
    }

    public function manageNotificationMenu()
    {
      parent::loginCheck();

      # is the org_head logged in?
      $this->osa_personnel->isOsaPersonnel();

      # Get event created by the adiviser
      $event = Event::where('user_id', Auth::user()->id)->get();

      $login_type = "user";
      return view('pages/users/osa-personnel/events/manage-notif-menu')->with([
        'login_type' => $login_type,
        'event'      => $event
      ]);
    }

    /**
     * Update event notifications
     *
     * @param  Request $data Event Informations
     * @return void
     */
    public function updateNotification(Request $data)
    {
      parent::loginCheck();

      # is the org_head logged in?
      $this->osa_personnel->isOsaPersonnel();

      $request = $data->only(
        'notify_via_facebook', 'notify_via_twitter',
        'notify_via_email', 'notify_via_sms',
        'additional_msg_facebook', 'additional_msg_sms',
        'additional_msg_email'
      );

      # Finally create events
      $result = Event::find($data->event_id);
      $result = $result->update($request);

      if ($result) {
        return back()->with('status', 'Successfuly updated notifications');
      }
    }
}
