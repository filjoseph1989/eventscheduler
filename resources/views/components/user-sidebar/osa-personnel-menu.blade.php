<?php
/**
 * This will display the menus for the user account
 */
?>
<li>
  <a href="#" class="menu-toggle">
    <i class="material-icons">supervisor_account</i>
    <span>Organization (OSA)</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="#" class="menu-toggle">
        <span>Manage organizations</span>
      </a>
      <ul class="ml-menu">
        <li>
          <a href="{{ route('organization.list') }}">
            <span>List of organizations</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.organization.add') }}">
            <span>Add an organization</span>
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#">
        <span>Create an event</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Generate event attendance</span>
      </a>
    </li>
  </ul>

  <a href="#" class="menu-toggle">
    <i class="material-icons">supervisor_account</i>
    <span>Manage Users</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{ route('osa.user.list') }}">
        <span>List Of Users</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Assign Positions</span>
      </a>
    </li>
  </ul>
</li>
