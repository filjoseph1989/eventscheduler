<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\RandomHelper;

# Apps
use App\Mail\EmailNotification;
use App\Common\CommonMethodTrait;

# Models
use App\Models\User;
use App\Models\Organization;
use App\Models\OrganizationGroup;
use App\Models\OrganizationHeadGroup;

class OrganizationController extends Controller
{
    use CommonMethodTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RandomHelper $helper)
    {
        $organizations[] = OrganizationGroup::with('organization')
          ->where('position_id', 3)
          ->with('user')
          ->get();
    
        return view('organization_list')->with([
          'organizations' => $organizations,
          'helper'        => $helper,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organization_add');
    }

    /**
     * Store new organization
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      # Get form data
      # validate form data
      # add to database
      $this->validate($request, [
        'name'           => 'Required',
        'acronym'        => 'Required',
        'account_number' => 'Required',
        'full_name'      => 'Required',
        'email'          => 'Required',
      ]);

      $data_organization = [
        'name'    => $request->name,
        'acronym' => $request->acronym,
      ];

      # Generate random password characters
      $password = str_random(15);
      $request->password = $password;

      # Send an email notification
      Mail::to($request->email)->send(new EmailNotification($request));

      $data_org_head = [
        'account_number' => $request->account_number,
        'full_name'      => $request->full_name,
        'email'          => $request->email,
        'user_type_id'   => 1,
        'password'       => bcrypt($password),
      ];

      $organization = Organization::create($data_organization);
      $org_head     = User::create($data_org_head);

      if ($organization->wasRecentlyCreated && $org_head->wasRecentlyCreated ) {
        $data_org_grp = [
          'user_id'         => $org_head->id,
          'organization_id' => $organization->id,
          'position_id'     => 7,
        ];

        $org_g = OrganizationGroup::create($data_org_grp);

        if ($org_g->wasRecentlyCreated) {
          return back()
            ->withInput()
            ->with('status', 'Successfully added organization and sent email for password to the organization head ');
        }
      }
    }

    public function myOrganizations (RandomHelper $helper){
      $org_ids = self::getOrganizations();

      foreach ($org_ids as $key => $value) {
        # code...
        $organizations[ $value ] = OrganizationGroup::with('organization')
            ->where('organization_id', $value)
            ->where('position_id', 3)
            ->with('user')
            ->get();
      }

      return view('organization_list')->with([
        'organizations' => $organizations,
        'helper'        => $helper,
      ]); 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
