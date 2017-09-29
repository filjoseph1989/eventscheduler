<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;
# Models
use App\Models\User;
use App\Models\Organization;
use App\Models\OrganizationGroup;
use App\Models\OrganizationHeadGroup;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = OrganizationHeadGroup::with('organization')
          ->with('user')
          ->get();

        return view('organization_list')->with([
          'organizations' => $organizations,
          'loginClass'    => 'theme-teal'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         *  TO CONSIDER
         *parent::loginCheck();
         *$this->osa_personnel->isOsaPersonnel();
         *return view('pages/users/osa-personnel/organization/add')->with([
         *   'login_type' => $this->login_type
         *]);
         */
        return view('organization_add')->with([
            'loginClass' => 'theme-teal'
        ]);
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
            'name'           => $request->name,
            'acronym'        => $request->acronym,
        ];

        $faker = Faker::create();

        $data_org_head = [
        'account_number' => $request->account_number,
        'full_name'      => $request->full_name,
        'email'          => $request->email,
        'user_type_id'   => 1,
        'password'       => $faker->password,
        'status'         => true,
        ];

        $organization = Organization::create($data_organization);
        $org_head = User::create($data_org_head);
        if ($organization->wasRecentlyCreated && $org_head->wasRecentlyCreated ) {
            ##create checker later to trap whenever a user is already an org head of an organization
            
            $data_org_grp = [
                'user_id'         => $org_head->id,
                'organization_id' => $organization->id,
                'position_id'     => 7,
            ];
            $org_h_g = OrganizationHeadGroup::create($data_org_grp);
            $org_g = OrganizationGroup::create($data_org_grp);
            dd('true');
        //create the alert later
        }
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
