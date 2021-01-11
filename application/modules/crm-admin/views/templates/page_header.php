<!-- Page Header -->
<div class="page-header">
    <div class="search-form">
        <form action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Type something...">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="close-search" type="button"><i class="icon-close"></i></button>
                </span>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-default navbar-expand-md">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="logo-sm">
                    <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fas fa-bars"></i></a>
                    <a class="logo-box" href="index.html"><img src="<?php echo base_url(); ?>assets/common/images/srm-all-logos.png" alt="" class="srm_logo"></a></a>
                </div>
                
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
        
            <div class="collapse navbar-collapse justify-content-between" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="collapsed-sidebar-toggle-inv"><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assets/common/images/srm-all-logos.png" alt="" class="srm_logo"></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
                <ul class="nav navbar-nav">
                    <!-- <li class="nav-item d-md-block"><a href="javascript:void(0)" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><i class="fas fa-envelope"></i></a></li> -->
                    <li class="dropdown nav-item d-md-block">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-lg dropdown-content">
                            <li class="drop-title">Notifications<a href="#" class="drop-title-link"><i class="fas fa-angle-right"></i></a></li>
                            <li class="slimscroll dropdown-notifications">
                                <ul class="list-unstyled dropdown-oc">
                                    <li>
                                        <a href="#"><span class="notification-badge bg-info"><i class="fas fa-at"></i></span>
                                            <span class="notification-info">
                                                <span class="notification-info"><b>Gowtham</b> mentioned you in a post "Update v1.5"</span>
                                                <small class="notification-date">06:07</small>
                                            </span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="notification-badge bg-danger"><i class="fas fa-bolt"></i></span>
                                            <span class="notification-info">
                                                <span class="notification-info">4 new special offers from the apps you follow!</span>
                                                <small class="notification-date">Yesterday</small>
                                            </span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="notification-badge bg-success"><i class="fas fa-bullhorn"></i></span>
                                            <span class="notification-info">
                                                <span class="notification-info">There is a meeting with <b>Ethan</b> in 15 minutes!</span>
                                                <small class="notification-date">Yesterday</small>
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item d-md-block">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown"
                            role="button" aria-haspopup="true" aria-expanded="false"><img
                                src="<?php echo base_url(); ?>assets/common/images/profile.jpg" alt="" class="rounded-circle"></a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="<?php echo base_url('dashboard'); ?>">
                                    <i class="fas fa-tachometer-alt mr-3" aria-hidden="true" style="font-size:14px;"></i>My Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('all-application'); ?>"><i class="menu-icon icon-apps mr-3" aria-hidden="true" style="font-size:14px;font-weight:600;"></i>All Forms
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('user/edit_profile'); ?>"><i class="menu-icon fas fa-user mr-3" aria-hidden="true" style="font-size:14px;font-weight:600;"></i>My Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('queries'); ?>"><i class="menu-icon fab fa-rocketchat mr-3" aria-hidden="true" style="font-size:16px;"></i>My Queries
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('change-password'); ?>"><i class="icon-key mr-3" aria-hidden="true"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('crm-admin/logout'); ?>"><i class="menu-icon fas fa-sign-out-alt mr-3" aria-hidden="true"></i>Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
        </div><!-- /.container-fluid -->
    </nav>
</div><!-- /Page Header -->