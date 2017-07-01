<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller

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
     public function adminCreate(Request $data)
     {
         $department = Department::create([
             'name' => $data['name'],
         ]);

         if ($department->save()) {
           return redirect()->route('admin.department.list')
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
      * Display the registration form for courses
      *
      * @return \Illuminate\Response
      */
     public function showRegisterForm()
     {
         $login_type = 'admin';
         return view('pages.forms.users.department-register', compact('login_type'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function edit(Request $data)
      {
        $department       = Department::find($data->id);
        $department->name = $data['name'];
        if ($department->save()) {
          return redirect()->route('admin.department.list')
            ->with('status', 'Successfuly updated module');
        }
      }

      public function delete(Request $data)
      {
        $department = Department::find($data->id);
        $name = "the department: ".$department->name;
        $department->deleted_or_not = 0;

        if ($department->save()){
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

}
