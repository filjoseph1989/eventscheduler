<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\CalendarTrait;
use Carbon\Carbon;

# Models
use App\Models\Event;

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

    private $list = ['', 'official', 'personal'];

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
        $events = Event::select(
          'title',
          'date_start',
          'date_end',
          'whole_day'
        )->where('event_type_id', $id)
         ->where('is_approve', 'true')
         ->get();

        $output_arrays = array();
        foreach ($events as $key => $event) {
            # Convert the input array into a useful Event object
            $event = $this->setEvent($event, new \DateTimeZone('Asia/Manila'));
            $output_arrays[] = $this->toArray();
        }

        return view("calendar")->with([
            'title'          => $this->list[$id],
            'calendarEvents' => json_encode($output_arrays),
        ]);
    }
}
