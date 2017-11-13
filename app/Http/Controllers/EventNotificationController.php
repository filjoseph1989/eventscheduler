<?php

namespace App\Http\Controllers;
use Auth;

#Traits
use App\Common\CommonMethodTrait;

#Models
use App\Models\Event;
use App\Models\PersonalEvent;
use App\Models\OrganizationGroup;

use Illuminate\Http\Request;

class EventNotificationController extends Controller
{
    use CommonMethodTrait;

    private $list  = [
      'all',
      'official',
      'local',
      'true'  => 'Approved Events',
      'false' => 'Unapproved Events'
    ];

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * if ang official, show events made by the user with is_approve == 'false' with event_type_id = 1
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( $id == 1 ){
            $events = Event::getOfficialEventsForEditNotification(Auth::id());

            self::getDateComparison($events);

            return view('edit_notification_official')
              ->with([
                'title'      => $this->list[$id], # title of the modal
                'events'     => $events,
                'eventType'  => $id,
                'account'    => self::getAccount(Auth::user()->user_type_id)
              ]);
        } elseif( $id == 2 ) {

            $org_id = OrganizationGroup::where('user_id', Auth::id() )
                ->get();
            // dd( $org_id );

            $events = [];

            if( $org_id->isEmpty() ){
                $events['within'] = [];
                $events['personal'] = PersonalEvent::getLocalPersonalEventsNotification(Auth::id());
            }

            foreach ($org_id as $key => $value) {
                $events['within'][$value->id] = Event::getLocalEventsNotification(Auth::id(), $value);
            }
            // dd($events);
            $events['personal'] = PersonalEvent::getLocalPersonalEventsNotification(Auth::id());

            return view('edit_notification_local')
              ->with([
                  'title'          => $this->list[$id],
                  'eventsPersonal' => $events['personal'],
                  'eventsWithin'   => $events['within'],
                  'eventType'      => $id,
                  'account'        => self::getAccount(Auth::user()->user_type_id)
              ]);
        }
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
