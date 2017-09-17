<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Models
use App\Models\Organization;

class JsonOrganizationController extends Controller
{
    # build a class instance
    public function __construct()
    { 
        $this->middleware('web');
    }

    /**
     * Update the organization column
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
      if ($request->status != null) {
        $result = Organization::where('id', '=', $request->id)
          ->update([
              'status' => $request->status
          ]);

        if ($result) {
          echo json_encode([
            'status' => ucwords($request->status)
          ]);
        }
      }
    }

}
