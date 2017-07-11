<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Position;
use Illuminate\Http\Request;
class PositionController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function positionCreate(Request $data)
    {
      $position = Position::create([
        'name' => $data['name'],
      ]);

      if ($position->save()) {
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.position.list')
          ->with('status', "Successfuly Added New Position <b>{$data['name']}</b>");
        }
        if (Auth::guard('web')->check()){
          return redirect()->route('position.list')
          ->with('status', "Successfuly Added New Position <b>{$data['name']}</b>");
        }
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $data)
    {
      $position       = Position::find($data->id);
      $position->name = $data['name'];
      if ($position->save()) {
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.position.list')
          ->with('status', "Successfuly Added New Position <b>{$data['name']}</b>");
        }
        if (Auth::guard('web')->check()){
          return redirect()->route('position.list')
          ->with('status', "Successfuly Added New Position <b>{$data['name']}</b>");
        }
      }
    }

    public function delete(Request $data)
    {
      $position = Position::find($data->id);
      $name = "the position: ".$position->name;
      $position->deleted_or_not = 0;

      if ($position->save()){
        $data = [
          'result' => true,
          'name' => $name
        ];
        echo json_encode($data);
      }
    }

    public function showPositionAddForm()
    {
      return view('pages.admin.position.add');
    }

    /**
     * Display the registration form for courses
     *
     * @return \Illuminate\Response
     */
    public function showRegisterForm()
    {
        $login_type = 'admin';
        return view('pages.forms.users.position-register', compact('login_type'));
    }

    public function showAllPositionList()
    {
        $positions  = Position::where('deleted_or_not', '=', 1)->get();
        $login_type = 'user';
        return view('pages.users.admin-user.position.list', compact('login_type','positions'));
    }

    /**
     * Return the position names
     *
     * This function used to response the ajax request
     * for the list of positions
     *
     * @return json
     */
    public function getPositions()
    {
      return Position::All();
    }
}
