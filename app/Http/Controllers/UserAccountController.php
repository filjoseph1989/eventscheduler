<?php

namespace App\Http\Controllers;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class UserAccountController extends Controller
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
        $useraccount = UserAccount::create([
            'name' => $data['name'],
        ]);

        if ($useraccount->save()) {
          return redirect()->route('admin.user.account.list')
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
     * Return registration form to be display in the dashboard
     *
     * @return \Illuminate\Response
     */
    public function showRegisterForm()
    {
        $login_type = 'admin';
        return view('pages.forms.users.user-account-register', compact('login_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $data)
    {
        $user_account        = UserAccount::find($data->id);
        $user_account->name  = $data['name'];
        if ($user_account->save()) {
          return redirect()->route('admin.user.account.list')
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

    public function delete(Request $data)
    {
      $user_account = UserAccount::find($data->id);
      $name = "the user account type: ".$user_account->name;
      $user_account->deleted_or_not = 0;

      if ($user_account->save()){
        $data = [
          'result' => true,
          'name' => $name
        ];
        echo json_encode($data);
      }
    }
}
