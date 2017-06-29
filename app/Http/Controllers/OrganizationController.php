<?php

namespace App\Http\Controllers;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        session(['class' => parent::getTheme()]);
    }
    /**
     * Display the registration form for courses
     *
     * @return \Illuminate\Response
     */
    public function showRegisterForm()
    {
        $login_type = 'admin';
        return view('pages.forms.users.organization-register', compact('login_type'));
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
    public function adminCreate(Request $data)
    {
        $organization       = Organization::create([
            'name'         => $data['name'],
            'status'       => $data['status'],
            'url'          => $data['url'],
            'date_started' => $data['date_started'],
            'date_expired' => $data['date_expired'],
        ]);

        if ($organization->save()) {
          return redirect()->route('admin.organization.list')
            ->with('status', 'Successfuly updated module');
        }
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
    public function edit(Request $data)
    {
      $organization               = Organization::find($data->id);
      $organization->name         = $data['name'];
      $organization->status       = $data['status'];
      $organization->url          = $data['url'];
      $organization->date_started = $data['date_started'];
      $organization->date_expired = $data['date_expired'];

      if ($organization->save()) {
        return redirect()->route('admin.organization.list')
          ->with('status', 'Successfuly updated module');
      }
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
