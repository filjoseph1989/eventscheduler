<?php
/**
 * This will display the menus for organization head account
 */
?>
<li>
  <a href="#" class="menu-toggle">
    <i class="material-icons">supervisor_account</i>
    <span>Action</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('university-calendar') }}">
        <span>Manage Schedule</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Generate Attendance</span>
      </a>
    </li>
    <li>
      <a href="{{ route('event.show') }}">
        <span>Manage Notification</span>
      </a>
    </li>
  </ul>
</li>
