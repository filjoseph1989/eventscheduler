<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

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
    public function index(RandomHelper $helper)
    {
        $organizations = OrganizationGroup::with(['organization', 'user'])
          ->get();

        return view('organization_list')->with([
          'organizations' => $organizations,
          'loginClass'    => 'theme-teal',
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

        return view('organization_add')->with([
          'loginClass' => 'theme-teal',
          'leaders'    => User::where('user_type_id', 1)->get()
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
        # Validate
        $this->validate($request, [
          'name'        => 'Required',
          'acronym'     => 'Required',
          'description' => 'Required',
          'user_id'     => 'Required',
          'url'         => 'nullable|url',
        ]);

        # Check if already in the record
        if (self::isAlreadyExists($request)) {
          return back()
            ->withInput()
            ->with('status_warning', 'Sorry the organization or acronym or a leader already in the record');
        }

        $organization = Organization::create($request->all());

        if ($organization->wasRecentlyCreated === false) {
          return back()
            ->with('status_warning', "Sorry, we're unable to save the organization");
        }

        $group = OrganizationGroup::create([
          'user_id'         => $request->user_id,
          'organization_id' => $organization->id,
          'position_id'     => 3,
        ]);

        if ($group->wasRecentlyCreated) {
          return back()
            ->with('status', 'Great! we successfully added the organization');
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

    /**
     * Check if the given organization exists
     *
     * @param  Request  $request
     * @return boolean
     */
    private function isAlreadyExists($request)
    {
      $organization = Organization::where('name', $request->name)
        ->orWhere('acronym', $request->acronym)
        ->get();

      $group = OrganizationGroup::where('user_id', $request->user_id)
        ->get();

      if ($organization->count() > 0 OR $group->count() > 0) {
        return true;
      }

      return false;
    }
}
