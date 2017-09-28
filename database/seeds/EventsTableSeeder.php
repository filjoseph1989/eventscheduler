<?php
require 'vendor/autoload.php';

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('events')->insert([
        array(
          'event_type_id'           => '2', 
          'semester_id'             => '1',
          'title'                   => "UP Foundation",
          'description'             => "UP-Mindanao took part in the simultaneous U.P. System-wide flag-raising ceremony to close the Centennial Celebration and open U.P.'s Next Century.",
          'venue'                   => "Eden Nature Park",
          'date_start'              => "2017-06-18",
          'date_end'                => "2017-06-18",
          'date_start_time'         => "06:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => 'false',
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',          
          'semester_id'             => '1',
          'title'                   => "REGULAR PERIOD for Removal and Completion",
          'description'             => "Removal and Completion of Grades",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-07-12",
          'date_end'                => "2017-07-24",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => 'false',
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',          
          'semester_id'             => '1',
          'title'                   => "Deadline for transfer students to file Application for Admission",
          'description'             => "Admission for Transfer Students",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-07-06",
          'date_end'                => "2017-07-06",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "16:00:00",
          'whole_day'               => 'false',
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',          
          'semester_id'             => '1',
          'title'                   => "Readmission, Validation of advanced credits for transferees, Application for Shifting",
          'description'             => "Readmission/Validation of advanced credits for transferees /Application for Shifting",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-07-24",
          'date_end'                => "2017-07-28",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => 'false',
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Deadline for Application for Waiver of Prerequisite",
          'description'             => "Application for Waiver of Prerequisite",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-07-26",
          'date_end'                => "2017-07-26",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => 'false',
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "General Registration for Student Number 2014 and older",
          'description'             => "General Registration",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-08-01",
          'date_end'                => "2017-08-01",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "12:00:00",
          'whole_day'               => 'false',
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "General Registration for Student Number 2015",
          'description'             => "General Registration",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-08-01",
          'date_end'                => "2017-08-01",
          'date_start_time'         => "13:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => 'false',
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "General Registration for Transferees, Cross Registrants, and others",
          'description'             => "General Registration",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-08-02",
          'date_end'                => "2017-08-02",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "START OF CLASSES",
          'description'             => "Start of Classes",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-08-03",
          'date_end'                => "2017-08-03",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Change/Add Matriculation Period",
          'description'             => "General Registration",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-08-03",
          'date_end'                => "2017-08-04",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "UP College Admission Test",
          'description'             => "College Admission Test",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-10-21",
          'date_end'                => "2017-10-22",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "University Curriculum Committee Meeting",
          'description'             => "Curriculum Committee Meeting",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-09-25",
          'date_end'                => "2017-09-25",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "University Council Meeting to Approve Candidates for Graduation",
          'description'             => "for Mid-Year Term 2016-2017, First Semester_id 2017-2018, Second Semester_id 2017-2018",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-10-09",
          'date_end'                => "2017-10-09",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "UPMin Tagbo (Student Leadership Seminar)",
          'description'             => "Student Leadership Seminar",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-10-27",
          'date_end'                => "2017-10-28",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Mid-Semester_id",
          'description'             => "Deadline for Dropping subjects without evaluation",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-10-04",
          'date_end'                => "2017-10-04",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Deadline for Dropping subjects with evaluation",
          'description'             => "Deadline for Dropping subjects with evaluation",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-11-06",
          'date_end'                => "2017-11-06",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Preregistration Period",
          'description'             => "Preregistration",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-11-06",
          'date_end'                => "2017-11-07",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Deadline for Filing Leave of Absence",
          'description'             => "LOA",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-11-20",
          'date_end'                => "2017-11-20",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "MORATORIUM",
          'description'             => "No student organization activities",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-11-20",
          'date_end'                => "2017-12-04",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "LAST DAY OF CLASSES",
          'description'             => "last day of classes",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-12-04",
          'date_end'                => "2017-12-04",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Integration Period",
          'description'             => "Integration Period",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-12-05",
          'date_end'                => "2017-12-05",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "UP Mindanao KASADYA",
          'description'             => "UP Mindanao KASADYA",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-12-12",
          'date_end'                => "2017-12-12",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
        array(
          'event_type_id'           => '2',
          'semester_id'             => '1',
          'title'                   => "Deadline for Submission of Grades",
          'description'             => "for Continuing Students",
          'venue'                   => "UP Mindanao",
          'date_start'              => "2017-12-18",
          'date_end'                => "2017-12-18",
          'date_start_time'         => "08:00:00",
          'date_end_time'           => "18:00:00",
          'whole_day'               => "false",
          'status'                  => 'upcoming',
          'is_approve'              => 'true',
          'twitter'                 => "off",
          'twitter_msg'             => null,
          'twitter_img'             => null,
          'facebook'                => "off",
          'facebook_msg'            => null,
          'facebook_img'            => null,
          'sms'                     => "off",
          'sms_msg'                 => null,
          'email'                   => "off",
          'email_msg'               => null,
          'email_img'               => null,
          'created_at'              => Carbon::now()->toDateTimeString(),
          'updated_at'              => Carbon::now()->toDateTimeString(),
        ),
      ]);
    }
}
