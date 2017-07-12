<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
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
        $organization = Organization::create([
            'name'         => $data['name'],
            'status'       => $data['status'],
            'url'          => $data['url'],
            'date_started' => $data['date_started'],
            'date_expired' => $data['date_expired'],
        ]);

        if ($organization->save()) {
          if (Auth::guard('admin')->check()){
            return redirect()->route('admin.organization.list')
            ->with('status', "Successfuly Added New Organization <b>{$data['name']}</b>");
          }
          if (Auth::guard('web')->check()){
            return redirect()->route('organization.list')
            ->with('status', "Successfuly Added New Organization <b>{$data['name']}</b>");
          }
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
     * Display the organization form for adding
     * new organization name
     *
     * @return \Illuminate\Response
     */
    public function showOrganizationAddForm()
    {
      return view('pages.admin.organization.add');
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
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.organization.list')
          ->with('status', "Successfuly Added New Organization <b>{$data['name']}</b>");
        }
        if (Auth::guard('web')->check()){
          return redirect()->route('organization.list')
          ->with('status', "Successfuly Added New Organization <b>{$data['name']}</b>");
        }
      }
    }

    public function delete(Request $data)
    {
      $organization = Organization::find($data->id);
      $name = "the organization: ".$organization->name;
      $organization->deleted_or_not = 0;

      if ($organization->save()){
        $data = [
          'result' => true,
          'name' => $name
        ];
        echo json_encode($data);
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
    public function showAllOrganizationList()
    {
        $organizations = Organization::where('deleted_or_not', '=', 1)->get();
        $login_type = 'user';
        return view('pages.users.admin-user.organization.list', compact('login_type','organizations'));
    }
}
