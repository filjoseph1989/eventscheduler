<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\CalendarTrait;
use Carbon\Carbon;
use Auth;
# Models
use App\Models\Event;
use App\Models\PersonalEvent;
use App\Models\OrganizationGroup;

/**
 * Handle the calendar request
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @date 10-07-2017
 * @date 10-07-2017 - Last Update
 */
class CalendarController extends Controller
{
    use CalendarTrait;

    const ALL_DAY_REGEX = '/^\d{4}-\d\d-\d\d$/'; // matches strings like "2013-12-29";


    private $list = ['', 'official', 'local', 'personal'];

    /**
     * Build instance of a class
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( $id == 1 ) {
            $events = Event::select(
              'title',
              'date_start',
              'date_end',
              'whole_day'
            )->where('event_type_id', $id)
             ->where('is_approve', 'true')
             ->get();
        } else if ($id == 2) {
            $events = Event::select(
              'title',
              'date_start',
              'date_end',
              'whole_day'
            )->where('event_type_id', $id)
             ->where('is_approve', 'true')
             ->where('user_id', Auth::id())
             ->get();
        } else if ($id == 3) {
          $events = PersonalEvent::select(
            'title',
            'date_start',
            'date_end',
            'whole_day'
          )->where('event_type_id', 2)
           ->where('is_approve', 'true')
           ->where('user_id', Auth::id())
           ->get();
        }

        $output_arrays = array();

        // if(Auth::user()->user_type_id == 1){
        //   $orName = OrganizationGroup::with('organization')
        //   ->where('user_id', Auth::id())
        //   ->where('position_id', 3)
        //   ->get()
        //   ->first();
        //   $this->list[2] = $orName->organization->name;
        // } else {
        //   $this->list[2] = '';
        // }

        # Convert the input array into a useful Event object
        foreach ($events as $key => $event) {
          $event = $this->setEvent($event, new \DateTimeZone('Asia/Manila'));
          $output_arrays[] = self::toArray(); # naa ni sa CalendarTrait
        }

        return view("calendar")->with([
            'title'          => $this->list[$id],
            'calendarEvents' => json_encode($output_arrays),
        ]);
    }
}
