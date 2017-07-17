<?php

namespace App\Http\Controllers\OrganizationHead;

use Auth;
use App\Models\OrganizationGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrgHeadAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOrganization()
    {
      if (Auth::check()) {
        # Issue 31: Change this to eloquent way of getting data
        # Get the organization base onn the user's ID
        $organization = OrganizationGroup::select(
          'organizations.id',
          'organizations.name'
        )
        ->join('organizations', 'organizations.id', '=', 'organization_groups.organization_id')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

        $login_type = "user";
        return view(
          'pages.users.organization-head.manage_schedule.my-organization',
          compact(
            'login_type',
            'organization'
          )
        );
      } else {
        return redirect()->route('login');
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
