<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Event extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'organization_id',
    'event_type_id',
    'semester_id',
    'title',
    'category',
    'description',
    'venue',
    'date_start',
    'date_end',
    'date_start_time',
    'date_end_time',
    'whole_day',
    'status',
    'is_approve',
    'twitter',
    'twitter_msg',
    'twitter_img',
    'facebook',
    'facebook_msg',
    'facebook_img',
    'sms',
    'sms_msg',
    'email',
    'email_msg',
    'email_img',
  ];

  /**
   * One to one relationship with event_type table
   *
   * @return object
   */
  public function eventType()
  {
    return $this->belongsTo('App\Models\EventType');
  }

  /**
   * One to one relationship with table organization
   *
   * @return object
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Organization');
  }

  /**
   * One to one relationship with user table
   * @return [type] [description]
   */
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  /**
   * Return the list of event need approval
   *
   * @return object
   */
  public static function getEventsForApproval()
  {
     return static::with('organization')
      ->where('event_type_id', 1)
      ->where('is_approve', 'false')
      ->where('status', 'requested')
      ->get();
  }
  

  /**
   * Return the organization leader events
   *
   * @param  int $leaderId
   * @return object
   */
  public static function getOrgHeadEvents($leaderId)
  {
    return static::with('organization')
      ->where('category', 'within')
      ->orWhere('category', 'organization')
      ->where('organization_id', $leaderId)
      ->get();
  }

  /**
   * Return the approve events for organization head
   *
   * @param  int $organizationId
   * @param  int $kind
   * @return object
   */
  public static function getOrgHeadApprovedEvents($organizationId, $kind)
  {
    return static::with('organization')
      ->where('category', 'within')
      ->where('organization_id', $organizationId)
      ->where('is_approve', $kind)
      ->get();
  }

  /**
   * return the events for OSA
   *
   * @param  int $leaderId
   * @return object
   */
  public static function getOsaEvents()
  {
    return static::with('organization')
      ->where('category', 'organization')
      ->orWhere('category', 'university')
      ->get();
  }

  /**
   * return the members events
   *
   * @return object
   */
  public static function getMemberEvents($id)
  {
    return static::with('organization')
      ->where('category', 'within')
      ->where('organization_id', $id)
      ->get();
  }

  /**
   * Return approve or unapproved events
   *
   * @param  int $kind
   * @return object
   */
  public static function getApproveOrUnapproveEvents($kind)
  {
    return static::with('organization')
      ->where(function($query) {
        return $query
          ->where('category', 'organization')
          ->orWhere('category', 'university');
      })
      ->where('status', 'requested')
      ->where('is_approve', $kind)
      ->get();
  }

  /**
   * Return official Events
   *
   * @param  int $kind
   * @return object
   */
  public static function getOfficialEvents($kind)
  {
    return static::with('organization')
      ->where(function($query) {
        return $query
          ->where('category', 'organization')
          ->orWhere('category', 'university');
      })
      ->where('event_type_id', $kind)
      ->get();
  }

  /**
   * returns official events for edit notification settings
   * @param $id user_id
   */
  public static function getOfficialEventsForEditNotification($id)
  {
    return static::with(['organization', 'user'])
      ->where('user_id', $id)
      ->where('event_type_id', 1)
      ->where('is_approve', 'false')
      ->get();
  }

   /**
   * returns local events for edit notification settings
   * @param $id user_id
   */
  public static function getLocalEventsNotification($id, $value)
  {
    return static::with('organization')
      ->where('organization_id', $value->organization_id)
      ->where('event_type_id', $id)
      ->where('category', 'within')
      ->where('is_approve', 'false')            
      ->get()
      ->toArray();   
  }
}
