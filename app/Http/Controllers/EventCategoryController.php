<?php

namespace App\Http\Controllers;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        session(['class' => parent::getTheme()]);
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
         $event_category = EventCategory::create([
             'name' => $data['name'],
         ]);

         if ($event_category->save()) {
           return redirect()->route('admin.event-category.list')
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
     * Display the registration form for courses
     *
     * @return \Illuminate\Response
     */
    public function showRegisterForm()
    {
        $login_type = 'admin';
        return view('pages.forms.users.event-category-register', compact('login_type'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $data)
    {
      $event_category       = EventCategory::find($data->id);
      $event_category->name = $data['name'];
      if ($event_category->save()) {
        return redirect()->route('admin.event-category.list')
          ->with('status', 'Successfuly updated module');
      }
    }
    public function delete(Request $data)
    {
      $event_category = EventCategory::find($data->id);
      $name = "the event-category: ".$event_category->name;
      $event_category->deleted_or_not = 0;

      if ($event_category->save()){
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
