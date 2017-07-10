<?php
/**
* This will display the menus for the user account
*/
?>
<li>
  <li>
    <a href="#">
      <i class="material-icons">assignment_turned_in</i>
      <span>REGISTRATION</span>
    </a>
  </li>
 <a href="#" class="menu-toggle">
   <i class="material-icons">input</i>
   <span>Insert Data</span>
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
   <li>
     <a href="#">
       <span>APPROVERS</span>
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
      <a href="#">
        <span>List of Organization</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Upcomming Events</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Generate Attendance</span>
      </a>
    </li>
  </ul>
</li>
<li>
  <a href="#" class="menu-toggle">
    <i class="material-icons">supervisor_account</i>
    <span>Manage Member</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="#">
        <span>Add New Member</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>All Members</span>
      </a>
    </li>
</li>
