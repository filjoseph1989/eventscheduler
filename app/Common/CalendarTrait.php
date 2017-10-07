<?php
namespace App\Common;

date_default_timezone_set('Asia/Manila');

/**
 * Provide trait for calendar events
 *
 * @author Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @company DevCaffee
 * @date 10-07-2017
 * @date 10-07-2017 - Last update
 */
trait CalendarTrait
{
  public $title;
  public $allDay; // a boolean
  public $start; // a DateTime
  public $end; // a DateTime, or null
  public $properties = array(); // an array of other misc properties

	/**
	 * Set event
	 *
	 * @param object $event
	 * @param date $timezone
	 * @return void
	 */
	public function setEvent($event, $timezone=null) {

		$this->title = $event->title;

		if ($event->whole_day == 'true') {
			# allDay has been explicitly specified
			$this->allDay = (bool)$event->whole_day;
		} else {
			# Guess allDay based off of ISO8601 date strings
			$this->allDay = preg_match(self::ALL_DAY_REGEX, $event->date_start) &&
				(!isset($event->date_end) || preg_match(self::ALL_DAY_REGEX, $event->date_end));
		}

		if ($this->allDay) {
			# If dates are allDay, we want to parse them in UTC to avoid DST issues.
			$timezone = null;
		}

		# Parse dates
		$this->start = parseDateTime($event->date_start, $timezone);
		$this->end   = isset($event->date_end) ? parseDateTime($event->date_end, $timezone) : null;

		# Record misc properties
		foreach ($event as $name => $value) {
			if (!in_array($name, array('title', 'allDay', 'start', 'end'))) {
				$this->properties[$name] = $value;
			}
		}
	}


	/**
   * Returns whether the date range of our event intersects with the given all-day range.
   * $rangeStart and $rangeEnd are assumed to be dates in UTC with 00:00:00 time.
   *
	 * @param  [type]  $rangeStart [description]
	 * @param  [type]  $rangeEnd   [description]
	 * @return boolean             [description]
	 */
	public function isWithinDayRange($rangeStart, $rangeEnd) {

		# Normalize our event's dates for comparison with the all-day range.
		$eventStart = stripTime($this->start);

		if (isset($this->end)) {
			$eventEnd = stripTime($this->end); // normalize
		}
		else {
			$eventEnd = $eventStart; // consider this a zero-duration event
		}

		# Check if the two whole-day ranges intersect.
		return $eventStart < $rangeEnd && $eventEnd >= $rangeStart;
	}


	/**
   * Converts this Event object back to a plain data array, to be used for generating JSON
   *
	 * @return array
	 */
	public function toArray() {

		# Start with the misc properties (don't worry, PHP won't affect the original array)
		$array = $this->properties;

		$array['title'] = $this->title;

		# Figure out the date format. This essentially encodes allDay into the date string.
		if ($this->allDay) {
			$format = 'Y-m-d'; # output like "2013-12-29"
		}
		else {
			$format = 'c'; # full ISO8601 output, like "2013-12-29T09:00:00+08:00"
		}

		# Serialize dates into strings
		$array['start'] = $this->start->format($format);
		if (isset($this->end)) {
			$array['end'] = $this->end->format($format);
		}

		return $array;
	}

}


/**
 * Parses a string into a DateTime object, optionally forced into the given timezone.
 *
 * @param  date $string
 * @param  date $timezone
 * @return date
 */
function parseDateTime($string, $timezone=null) {
	$date = new \DateTime(
		$string,
		$timezone ? $timezone : new \DateTimeZone('UTC')
			// Used only when the string is ambiguous.
			// Ignored if string has a timezone offset in it.
	);
	if ($timezone) {
		// If our timezone was ignored above, force it.
		$date->setTimezone($timezone);
	}
	return $date;
}


/**
 * Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
 * but in UTC.
 *
 * @param  datetime $datetime
 * @return date
 */
function stripTime($datetime) {
	return new DateTime($datetime->format('Y-m-d'));
}
