<body>
<?php 
	// Get Username & Role Name
	$username = $session_userdata['user_details'][0]['username'];
	$role_name = $session_userdata['user_details'][0]['role_name'];
  $admissclass="";
  $mailboxclass="";
  $activeClass = 'active';
  if($this->uri->segment(2) == 'admission'){
    $admissclass = $activeClass ;
  }
  if($this->uri->segment(2) == 'mailbox'){
    $mailboxclass = $activeClass ;
  }
?>
      <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo $admissclass;?>"><a href="<?php echo base_url(); ?>user/edit_profile">My Profile</a></li>
             <li class="<?php echo $mailboxclass;?>"><a href="<?php echo base_url(); ?>mail_box/list">Mail Box</a></li>
            <!-- <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li> -->
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url(); ?>admin/logout">Logout</a>
                </li>
            </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>
    
