<?php

namespace App\Http\Controllers;
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
        $this->middleware('auth:admin');
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
    public function positionCreate(Request $data)
    {
      $position = Position::create([
        'name' => $data['name'],
      ]);

      if ($position->save()) {
        return redirect()->route('admin.position.list')
        ->with('status', "Successfuly Added New Position <b>{$data['name']}</b>");
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
        return redirect()->route('admin.position.list')
          ->with('status', 'Successfuly updated module');
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
