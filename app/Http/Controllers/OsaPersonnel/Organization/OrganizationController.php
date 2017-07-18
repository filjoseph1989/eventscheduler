<?php

namespace app\Http\Controllers\OsaPersonnel\Organization;

use Auth;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class controller handles the request related to
 * Organization
 *
 * @author jlvoice777
 * @author Janica Liz De Guzman
 * @version 0.1
 * @created 7/18/2017
 */
class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * The Osa make update on organization details in his/her
     * list of organization
     *
     * @param  Request $data
     * @return \Illuminate\Response
     */
    public function osaEditOrganization(Request $data)
    {
      # Check if login or not
      parent::loginCheck();

      if (parent::isOrgOsa()) {
        $organization               = Organization::find($data->id);
        $name                       = $organization->name;
        $organization->name         = $data->name;
        $organization->status       = $data->status;
        $organization->url          = $data->url;
        $organization->date_started = $data->date_started;
        $organization->date_expired = $data->date_expired;

        if ($organization->save()) {
          return redirect()->route('osa.org.list')
          ->with('status', "Successfuly Updated from <b>{$name}</b> to <b>{$data['name']}</b>");
        }
      }
    }

    /**
     * Store the new organization in organization table
     *
     * @return \Illuminate\Http\Response
     */
    public function adminCreate(Request $data)
    {
      # check authentication
      parent::loginCheck();

      if (parent::isOrgOsa()) {
        # Insert the receive data
        $organization = Organization::create([
          'name'         => $data->name,
          'status'       => $data->status,
          'url'          => $data->url,
          'date_started' => $data->date_started,
          'date_expired' => $data->date_expired
        ]);

        if ($organization->save()) {
          return redirect()->route('osa.org.list')
          ->with('status', "Successfuly Added New Organization <b>{$data['name']}</b>");
        }
      } else {
        return redirect()->route('login');
      }
    }

    /**
     * Display the organization list
     * @return [type] [description]
     */
    public function showAllOrganizationList()
    {
      $organizations = Organization::all();
      $login_type = 'user';
      return view('pages.users.admin-user.organization.list', compact('login_type','organizations'));
    }

    /**
     * -------------------------------------------
     * Subject for evaluation to keep or not
     * -------------------------------------------
     */


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
     * Reponse to http request for the list of organization.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrganizationList()
    {
        return Organization::All();
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
     * ! Depracated
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $data)
    {
      $organization               = Organization::find($data->id);
      $name                       = $organization->name;
      $organization->name         = $data['name'];
      $organization->status       = $data['status'];
      $organization->url          = $data['url'];
      $organization->date_started = $data['date_started'];
      $organization->date_expired = $data['date_expired'];

      if ($organization->save()) {
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.organization.list')
            ->with('status', "Successfuly Updated from <b>{$name}</b> to <b>{$data['name']}</b>");
        }
        if (Auth::guard('web')->check()){
          # User account
          return redirect()->route('osa.org.list')
            ->with('status', "Successfuly Updated from <b>{$name}</b> to <b>{$data['name']}</b>");
        }
      }
    }

    public function delete(Request $data)
    {
      $organization = Organization::find($data->id);
      $name = "the organization: ".$organization->name;
      $organization->delete();
      $data = [
        'result' => true,
        'name' => $name,
        'id'  => $data
      ];
      echo json_encode($data);
    }

    /**
     * Return the organization
     * @param  Request $data [description]
     * @return [type]        [description]
     */
    public function getOrganization(Request $data)
    {
      $org = Organization::find($data->id);
      echo json_encode([
        'organization' => $org
      ]);
    }
}
