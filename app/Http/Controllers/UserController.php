<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RandomHelper;

#Models
use App\Models\User;
use App\Models\OrganizationGroup;

class UserController extends Controller
{
    /**
     * Initial instance of the class
     */
    public function __construct()
    {

    }
 
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RandomHelper $help)
    {
      $organization = [];
      $position     = [];
      $users     = User::with('course')->where('status', 'true')->get();
      foreach ($users as $key => $v) {
        $og = OrganizationGroup::where('user_id', $v->id)
          ->with(['position', 'organization'])
          ->get();
        if( count($og) > 1 ){
          foreach ($og as $key => $value) {
            $position[$v->id][$key]     = $value->position->name;
            $organization[$v->id][$key] = $value->organization->name;
          }
        }
        else if( count($og) == 1 ) {
          foreach ($og as $key => $value){
            $position[$v->id]     = $value->position->name;
            $organization[$v->id] = $value->organization->name;
          }
        }
        else {
          $position[$v->id]     = "Not Yet Assigned";
          $organization[$v->id] = "Not Yet Assigned";
        }
      }
        return view('users_index', compact('users', 'position', 'organization', 'help'));
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
