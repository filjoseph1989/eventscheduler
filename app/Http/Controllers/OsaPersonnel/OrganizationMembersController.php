<?php

namespace App\Http\Controllers\OsaPersonnel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# Models
use App\Models\User;
use App\Models\OrganizationGroup;

class OrganizationMembersController extends Controller
{
    private $login_type = 'user';

    /**
     * Build object from the class
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display the members of the organization
     *
     * @param int $id Organization ID
     * @return void
     */
    public function show($id)
    {
        $members = OrganizationGroup::with('user')
            ->where('organization_id', '=', $id)
            ->where('membership_status', '=', 'yes')
            ->get();

    }
}
