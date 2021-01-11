<?php 
	// Get Username & Role Name
	$username = $session_userdata['user_details'][0]['username'];
?>	
<div class="secondary-sidebar">
  <div class="secondary-sidebar-profile">
      <a href="<?php echo base_url('user/edit_profile'); ?>">
          <p>Gowtham</p>
          <i class="fas fa-angle-right"></i>
     </a>
      <ul class="secondary-sidebar-profile-menu list-unstyled d-flex">
          <li class="flex-fill"><a href="<?php echo base_url('dashboard'); ?>"><i class="menu-icon fas fa-tachometer-alt"></i></a></li>
          <li class="flex-fill"><a href="<?php echo base_url('all-application'); ?>"><i class="menu-icon icon-apps"></i></a></li>
          <li class="flex-fill"><a href="<?php echo base_url('queries'); ?>"><i class="menu-icon fab fa-rocketchat"></i></a></li>
          <li class="flex-fill"><a href="<?php echo base_url('logout'); ?>"><i class="menu-icon fas fa-sign-out-alt"></i></a></li>
      </ul>
  </div>
  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="secondary-sidebar-menu" style="overflow: hidden; width: auto; height: 100%;">
      <ul class="accordion-menu">
          <li class="active-page">
              <a href="<?php echo base_url('dashboard'); ?>">
                  <i class="menu-icon fas fa-tachometer-alt"></i><span>Dashboard</span>

              </a>
              <!-- <ul class="sub-menu" style="display: none;">
                  <li><a href="Dashboard.html">Dashboard</a></li>
              </ul> -->
          </li>
          <li class="">
              <a href="<?php echo base_url('application'); ?>" id="showmenuall" onclick="show_single('all')">
                  <i class="menu-icon icon-apps"></i><span> All Applications</span>
                  <i class="accordion-icon fas fa-angle-left">

                  </i>
              </a>
              <ul class="sub-menu" style="display: none;">
                  <li class="animation" onclick="show_single('all')"><a href="<?php echo base_url('all-application'); ?>">All Application Form</a></li>
                  <li class="animation" id="showSingle" onclick="show_single(1)"><a href="<?php echo base_url('all-application'); ?>">Engineering Application Form</a></li>
                  <li class="animation" id="showSingle" onclick="show_single(2)"><a href="<?php echo base_url('all-application'); ?>">Science & Humanities Form</a></li>
                  <li class="animation" id="showSingle" onclick="show_single(3)"><a href="<?php echo base_url('all-application'); ?>">Medical Application Form</a></li>
                  <li class="animation" id="showSingle" onclick="show_single(4)"><a href="<?php echo base_url('all-application'); ?>">Law Application Form</a></li>
                  <li class="animation" id="showSingle" onclick="show_single(5)"><a href="<?php echo base_url('all-application'); ?>">Hotel Management Application Form</a></li>
                  <li class="animation" id="showSingle" onclick="show_single(6)"><a href="<?php echo base_url('all-application'); ?>">Agriculture Application Form</a></li>
              </ul>
          </li>
          <li>
              <a href="<?php echo base_url('user/edit_profile'); ?>">
                  <i class="menu-icon fas fa-user"></i><span>My Profile</span>
              </a>
          </li>
          <li>
              <a href="<?php echo base_url('queries'); ?>">
                  <i class="menu-icon fab fa-rocketchat"></i><span>My Queries</span>
              </a>
          </li>
          <li>
              <a href="<?php echo base_url('logout'); ?>">
                  <i class="menu-icon fas fa-sign-out-alt"></i><span>Log out</span>
              </a>
          </li>
      </ul>
  </div><div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 6px; position: absolute; top: 62px; opacity: 0.2; display: none; border-radius: 0px; z-index: 99; right: 0px; height: 383px;"></div><div class="slimScrollRail" style="width: 6px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div></div>
</div>