<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganizationGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_groups')->insert([
            [
                'user_id'           => 1,
                'organization_id'   => 2,
                'position_id'       => 5,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id'           => 2,
                'organization_id'   => 2,
                'position_id'       => 6,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id'           => 3,
                'organization_id'   => 2,
                'position_id'       => 7,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id'           => 4,
                'organization_id'   => 2,
                'position_id'       => 8,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id'           => 5,
                'organization_id'   => 2,
                'position_id'       => 9,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id'           => 6,
                'organization_id'   => 2,
                'position_id'       => 10,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id'           => 7,
                'organization_id'   => 2,
                'position_id'       => 11,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
            [
                'user_id'           => 8,
                'organization_id'   => 2,
                'position_id'       => 12,
                'membership_status' => 'yes',
                'created_at'        => Carbon::now()->toDateTimeString(),
                'updated_at'        => Carbon::now()->toDateTimeString(),
            ],
        ]);
    }
}
