<?php
/**
* This will display the menus for the user account
*/
?>
<li>
  <li>
    <a href="#" class="menu-toggle">
      <i class="material-icons">assignment_turned_in</i>
      <span>REGISTRATION</span>
    </a>
    <ul class="ml-menu">
      <li>
        <a href="#">
          <span>Add an OSA personnel</span>
        </a>
      </li>
      <li>
        <a href="#">
          <span>Add an Organization Head</span>
        </a>
      </li>e?
      <li>
        <a href="#">
          <span>Add an Organization Adviser</span>
        </a>
      </li>
      <li>
        <a href="#">
          <span>Activate accounts</span>
        </a>
      </li>
    </ul>
  </li>
 <a href="#" class="menu-toggle">
   <i class="material-icons">input</i>
   <span>Manage Data</span>
 </a>
 <ul class="ml-menu">
   <li>
     <a href="{{ route('administrator.user.list') }}">
       <span>USERS</span>
     </a>
   </li>
   <li>
     <a href="{{ route('administrator.course.list') }}">
       <span>COURSES</span>
     </a>
   </li>
   <li>
     <a href="{{ route('administrator.department.list') }}">
       <span>DEPARTMENTS</span>
     </a>
   </li>
   <li>
     <a href="{{ route('administrator.position.list') }}">
       <span>POSITIONS</span>
     </a>
   </li>
   <li>
     <a href="{{ route('administrator.organization.list') }}">
       <span>ORGANIZATIONS</span>
     </a>
   </li>
 </ul>
</li>
<?php
/**
 * This will display the menus for admin account
 */
?>
<li>
  <a href="#" class="menu-toggle">
    <i class="material-icons">supervisor_account</i>
    <span>Organization</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('administrator.organization.list') }}">
        <span>List of Organizations</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Upcoming Events</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Generate Attendance</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Manage Approvers</span>
      </a>
    </li>
  </ul>
</li>
