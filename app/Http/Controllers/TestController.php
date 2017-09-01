<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Artisan;
use Illuminate\Http\Request;

class TestController extends Controller
{
  public function test(){
      Artisan::call('cache:clear');
      echo "refreshed artisan cache";
  }
}
