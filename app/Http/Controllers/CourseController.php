<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
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
     * Display a listing of the resource
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
         $course = Course::create([
             'name' => $data['name'],
         ]);

         if ($course->save()) {
           return redirect()->route('admin.course.list')
             ->with('status', 'Successfuly updated module');
         }
     }
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */

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
     * Display the registration form for courses
     *
     * @return \Illuminate\Response
     */
    public function showRegisterForm()
    {
        $login_type = 'admin';
        return view('pages.forms.users.course-register', compact('login_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $data)
    {
      $course       = Course::find($data->id);
      $course->name = $data['name'];
      if ($course->save()) {
        return redirect()->route('admin.course.list')
          ->with('status', 'Successfuly updated module');
      }
    }
    public function delete(Request $data)
    {
      $course = Course::find($data->id);
      $name = "the course: ".$course->name;
      $course->deleted_or_not = 0;

      if ($course->save()){
        $data = [
          'result' => true,
          'name' => $name,
          'id'  => $data
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
