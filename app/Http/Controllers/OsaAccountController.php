<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class OsaAccountController extends Controller
{
  public function showAllUserList()
  {
      $user = new User();
      $data = $user->select(
        'users.id',
        'users.user_account_id',
        'user_accounts.name',
        'users.account_number',
        'users.first_name',
        'users.last_name',
        'users.email',
        'users.mobile_number',
        'users.deleted_or_not',
        'users.status'
        )->join(
          'user_accounts', 'users.user_account_id', '=', 'user_accounts.id'
        )
        ->where('users.deleted_or_not', '=', 1)
        ->where('user_accounts.name', '!=', 'admin')
        ->get();

      // dd($data);
      $login_type = 'user';
      return view('pages.users.osa-user.users.list', compact('login_type','data'));
  }
}
