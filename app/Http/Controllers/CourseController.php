<?php

namespace App\Http\Controllers;

use Auth;
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
        $this->middleware('web');
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
    public function courseCreate(Request $data)
    {
      $course = Course::create([
        'name' => $data['name'],
      ]);

      if ($course->save()) {
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.course.list')
            ->with('status', 'Successfuly Course Information');
        }
        if (Auth::guard('web')->check()){
          return redirect()->route('course.list')
            ->with('status', 'Successfuly Course Information');
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
     * Display the course adding form for info-box
     * in the super admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function showCourseAddForm()
    {
      return view('pages.admin.course.add');
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
        if (Auth::guard('admin')->check()){
          return redirect()->route('admin.course.list')
            ->with('status', 'Successfully Course Information');
        }
        if (Auth::guard('web')->check()){
          return redirect()->route('course.list')
            ->with('status', 'Successfully Course Information');
        }
      }
    }

    public function delete(Request $data)
    {
      $course = Course::find($data->id);
      $name = "the course: ".$course->name;
      $course->delete();
        $data = [
          'result' => true,
          'name' => $name,
          'id'  => $data
        ];
        echo json_encode($data);
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

    public function showAllCourseList()
    {
        $courses      = Course::all()->get();
        $login_type = 'user';
        return view('pages.users.admin-user.course.list', compact('login_type','courses'));
    }
}
