<?php
namespace App\Http\Controllers\OrganizationAdviser;

use Auth;
use Illuminate\Http\Request;
use App\Library\ImageLibrary;
use App\Http\Controllers\Controller;
use App\Library\OrgAdviserLibrary as Adviser;

# Models
use App\Models\Organization;
use App\Models\OrganizationGroup;
use App\Models\OrganizationAdviserGroup;

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
    private $adviser;

    /**
     * Guard
     */
    public function __construct()
    {
        $this->middleware('web');
        $this->adviser = new Adviser();
    }

    /**
     * Display a listing of the organizations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      # Is the adviser loggedin?
      parent::loginCheck();

      # is the user an adviser?
      $this->adviser->isAdviser();

      $login_type = 'user';

      /*
        We do not include the ID 1 in getting organization list,
        because that used only to user wherein not a member to an organization yet
        but is active to system.
       */
      $organization = Organization::all()->where('id', '!=', 1);

      # Render view
      return view('pages/users/organization-adviser/organization/list', compact(
        'login_type',
        'organization'
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the organization profile
     *
     * @param  int  $id Organization ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

      # is the user an adviser?
      $this->adviser->isAdviser();

      $login_type   = 'user';
      $organization = Organization::find($id);
      $adviser      = self::_adviserOfThisOrganization($id);
      $isMember     = self::_isAmember($id);

      return view('pages/users/organization-adviser/organization/profile', compact(
        'login_type', 'organization', 'adviser', 'isMember'
      ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      # is the user loggedin?
      parent::loginCheck();

      # is the user an adviser?
      $this->adviser->isAdviser();

      # Get one row of organization
      $organization = Organization::find($id);
      $login_type   = 'user';

      # Display to browser
      return view('pages/users/organization-adviser/organization/edit', compact(
        'organization', 'login_type'
      ));
    }

    /**
     * Update the one row of the organization table base on the
     * given organization ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      # make sure user is loggedin
      parent::loginCheck();

      # make sure user is an adviser
      $this->adviser->isAdviser();

      # make sure entry is valid
      self::_isValid($request);

      # Finally update record
      $result = Organization::where('id', '=', $request->id)
        ->update([
          'name'         => $request->name,
          'description'  => $request->description,
          'url'          => $request->url,
          'color'        => $request->color,
          'date_started' => $request->date_started,
          'date_expired' => $request->date_expired,
          'status'       => $request->status
        ]);

      # Inform user about the changes
      if ($result) {
        return redirect()
          ->route('org-adviser.org-profile', $request->id)
          ->with('success', 'Successfully updated');
      } else {
        return back()->withInput()->with('status_warning', "Sorry, we have problem updating {$organization->name} information, please try again later");
      }
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
      # Is user loggedin?
      parent::loginCheck();

      # is the user an adviser?
      $this->adviser->isAdviser();

      # Upload image
      $imageName = ImageLibrary::uploadImage($request, 'images/org_profile');

      # Save to database
      $organization = Organization::find($request->id);
      $logo         = $organization->logo;
      $organization->logo = $imageName;

      # Delete old pic except default
      if ($organization->save() and file_exists("images/org_profile/$logo")) {
        unlink("images/org_profile/$logo");
      }

      # Return to uploader page
      return back()->with('success', 'Image Uploaded successfully.');
    }

    /**
     * Check if the account currently loggedin is the
     * adviser of the given organization ID
     *
     * @param  int  $id Organizatoin ID
     * @return int
     */
    private function _adviserOfThisOrganization($id)
    {
      $result = OrganizationAdviserGroup::where('user_id', '=', Auth::user()->id)
        ->where('organization_id', '=', $id)
        ->get()
        ->count();

      return ($result == 1) ? true : false;
    }

    /**
     * Check wether the loggedin account is a member of the organization
     *
     * # Issue: 43 - This method can comnine with _isAlreadyRequested()
     *
     * @param  int  $id Organization ID
     * @return boolean
     */
    private function _isAmember($id)
    {
      $result =  OrganizationGroup::where('user_id', '=', Auth::user()->id)
        ->where('organization_id', '=', $id)
        ->where('membership_status', '=', 'yes')
        ->get()
        ->count();

      return ($result == 1) ? true : false;
    }

    /**
     * Validated the organization update input
     *
     * @param  object  $request
     * @return boolean
     */
    private function _isValid($request)
    {
      $this->validate($request, [
        'name'         => 'Required',
        'description'  => 'Required',
        'url'          => 'active_url',
        'color'        => 'nullable|present',
        'date_started' => 'required|date|before_or_equal:today',
        'date_expired' => 'nullable|date|after_or_equal:date_start',
        'status'       => 'Required'
      ]);
    }
}
