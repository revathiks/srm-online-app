<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url(); ?>" class="logo logo-dark pt-3">
                    <span class="logo-sm">
                        <!-- <img src="<?php echo base_url(); ?>assets/common/images/logo.svg" alt="" height="22"> -->
                        <img class="main_logo" src="<?php echo base_url(); ?>assets/common/images/srm_main_logo.jpg" alt="SRM University" height="22">
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="<?php echo base_url(); ?>assets/common/images/logo-dark.png" alt="" height="17"> -->
                        <img class="main_logo" src="<?php echo base_url(); ?>assets/common/images/srm_main_logo.jpg" alt="SRM University" height="40">
                    </span>
                </a>

                <a href="<?php echo base_url(); ?>" class="logo logo-light pt-3">
                    <span class="logo-sm">
                        <img src="<?php echo base_url(); ?>assets/common/images/srm-brand-logo.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url(); ?>assets/common/images/srm-logo-white.png" alt="" height="45">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge badge-danger badge-pill">4</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> Notifications (4) </h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="mdi mdi-message-text-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Need Clear Profile Picture </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">Kindly provide the new profile picture</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-warning rounded-circle font-size-16">
                                        <i class="mdi mdi-message-text-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Regarding : SSLC certificate</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">Update the SSLC certificate</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-info rounded-circle font-size-16">
                                        <i class="mdi mdi-message-text-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Regarding : HSLC certificate</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">Update the HSLC certificate</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-danger rounded-circle font-size-16">
                                        <i class="mdi mdi-message-text-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Regarding : Application Form Fee</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">Kindly pay the application fee</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                       <!-- <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-danger rounded-circle font-size-16">
                                        <i class="mdi mdi-message-text-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">New Message received</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">You have 87 unread messages</p>
                                    </div>
                                </div>
                            </div>
                        </a>-->
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            View all
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo base_url(); ?>assets/common/images/users/user-4.jpg"
                        alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="<?php echo base_url(); ?>user/edit_profile"><i
                            class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i> Profile</a>
                    <!--<a class="dropdown-item" href="#"><i class="mdi mdi-wallet font-size-17 align-middle mr-1"></i> My Wallet</a> -->
                    <!--<a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i
                            class="mdi mdi-settings font-size-17 align-middle mr-1"></i> Settings</a>-->
							
                    <!--<a class="dropdown-item" href="#"><i
                            class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Lock
                        screen</a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?php echo base_url(); ?>crm-admin/logout"><i
                            class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
                </div>
            </div>

            <div class="dropdown d-inline-block">
               <!-- <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="mdi mdi-settings-outline"></i>
                </button>-->
            </div>

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
               <!-- <li class="menu-title">Main</li>-->

                <li>
                    <a href="<?php echo base_url('crm-admin/dashboard'); ?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!--<li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fab fa-wpforms"></i>
                        <span>Application Form</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a  href="<?php echo base_url('all-application'); ?>" class="waves-effect">All</a></li>
                        <li><a  href="<?php echo base_url('phd'); ?>" class="waves-effect">Ph.D</a></li>
						<li><a  href="<?php echo base_url('dis-education'); ?>" class="waves-effect">Distance Education</a></li>
                        <li><a  href="<?php echo base_url('hcma'); ?>" class="waves-effect">Hotel & Catering Management</a></li>
                        <li><a  href="<?php echo base_url('b-ed-m-ed-m-phil'); ?>" class="waves-effect">B.Ed / M.Ed / M.Phil</a></li>
                       <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fab fa-wpforms"></i> 
                                <span>Engineering</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a  href="<?php echo base_url('btech'); ?>" class="waves-effect">B.Tech</a></li>
                                <li><a  href="<?php echo base_url('mtech'); ?>" class="waves-effect">M.Tech</a></li>
                                <li><a  href="<?php echo base_url('mtechresearch'); ?>" class="waves-effect">Mtech Research</a></li>
                                <li><a  href="<?php echo base_url('barch'); ?>" class="waves-effect">B.Arch / B.Design</a></li>
								<li><a  href="<?php echo base_url('bsc-am'); ?>" class="waves-effect">B.Sc. Aircraft Maintenance</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('user/edit_profile'); ?>" class="waves-effect">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('queries'); ?>" class="waves-effect">
                        <i class="fab fa-rocketchat"></i>
                        <span>Queries</span>
                    </a>
                </li>-->
				
				<li>
				<a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fab fa-wpforms"></i>
					<span>CRM Admin Form</span>
				</a>
				<ul class="sub-menu mm-collapse2" aria-expanded="false">
				<li><a  href="<?php echo base_url('admindashboard'); ?>" class="waves-effect">Admin Dashboard</a></li>
				<li><a  href="<?php echo base_url('admin-benchmarkingdashboard'); ?>" class="waves-effect">Benchmarking Dashboard</a></li>
				<li><a  href="<?php echo base_url('admin-trend-analyze'); ?>" class="waves-effect">Trend Analyze</a></li>
				<li><a  href="<?php echo base_url('admin-counsellor-dashboard'); ?>" class="waves-effect">Counsellor Dashboard</a></li>
				<li><a  href="<?php echo base_url('admin-area-manager-weekly-plan'); ?>" class="waves-effect">Area Manger Weekly Plan</a></li>
				<li><a  href="<?php echo base_url('admin-manage-requirements'); ?>" class="waves-effect">Manage Requirements</a></li>
				<li><a  href="<?php echo base_url('admin-manage-raise-requirements'); ?>" class="waves-effect">Raise Requirements</a></li>
				<li><a  href="<?php echo base_url('admin-view-consolidated-reports'); ?>" class="waves-effect">View Consolidated Reports</a></li>
				<li><a  href="#" class="waves-effect">Manage Student Query</a></li>
				<li><a  href="<?php echo base_url('admin-manage-faq'); ?>" class="waves-effect">Manage FAQ</a></li>
				<li><a  href="#" class="waves-effect">Session Management</a></li>
				<li><a  href="<?php echo base_url('admin-view-consolidated-reports'); ?>" class="waves-effect">View Consolidated Reports</a></li>
				<li><a  href="<?php echo base_url('admin-view-consolidated-reports'); ?>" class="waves-effect">View Consolidated Reports</a></li>
				<li><a  href="<?php echo base_url('admin-view-consolidated-reports'); ?>" class="waves-effect">View Consolidated Reports</a></li>
                <li><a  href="<?php echo base_url('crm-admin/payment_history'); ?>" class="waves-effect">View Payment History</a></li>
				</ul>
				</li>
				
                <li>
                    <a href="<?php echo base_url('crm-admin/logout'); ?>" class="waves-effect">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->