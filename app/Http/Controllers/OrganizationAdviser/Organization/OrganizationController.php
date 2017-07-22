<?php

namespace App\Http\Controllers\OrganizationAdviser\Organization;

use Auth;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class controller handles the request related to
 * Organization
 *
 * @author jlvoice777
 * @author Janica Liz De Guzman
 * @version 0.1
 * @created 7/19/2017
 */
class OrganizationController extends Controller
{
    /**
     * Guard
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Return the list of organization
     *
     * @return Illuminate\Response
     */
    public function showAllOrganizationList()
    {
      # Is the adviser loggedin?
      parent::loginCheck();

      # Is the current user an organization adviser?
      if (parent::isOrgAdviser()) {
        $login_type   = 'user';

        /*
        We do not include the ID 1 in getting organization list,
        because that used only to user wherein not a member to an organization yet
        but is active to system.
         */
        $organization = Organization::all()->where('id', '!=', 1);

        # Render view
        return view(
          'pages/users/organization-adviser/manage_schedule/my-organization',
          compact(
            'login_type',
            'organization'
          )
        );
      } else {
        return redirect()->route('home');
      }
    }

    /**
     * Display the organization profile
     *
     * @param  int $id Organization ID
     * @return Illuminate\Response
     */
    public function orgProfile($id)
    {
      /*
        ID 1 is the "Organization" ID.
        We do not include the "Organization" name since this
        stands for no organization yet.
       */
      if ($id == 1) {
        return redirect()->route('home');
      }

      # Is the user loggedin?
      parent::loginCheck();

      # Is the user an organization adiviser?
      if (parent::isOrgAdviser()) {
        $login_type   = 'user';
        $organization = Organization::find($id);

        return view(
          'pages/users/organization-adviser/organization/org-profile',
          compact(
            'login_type',
            'organization'
          )
        );
      } else {
        return redirect()->route('home');
      }
    }

    /**
     * Uploa image or logo related to organization
     *
     * Issue 36: This method should have a common method to be called
     * to upload image
     *
     * @return
     */
    public function uploadLogo(Request $request)
    {
      $this->validate($request, [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $imageName = time().'.'.$request->image->getClientOriginalExtension();
      $request->image->move(public_path('images'), $imageName);

      # Save to database
      $organization = Organization::find($request->id);
      $logo = $organization->logo;
      $organization->logo = $imageName;
      if ($organization->save()) {
        unlink("images/$logo");
      }

    	return back()
    		->with('success','Image Uploaded successfully.')
    		->with('path',$imageName);
    }
}
