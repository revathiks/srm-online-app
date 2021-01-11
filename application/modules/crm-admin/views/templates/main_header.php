<body  class="<?php echo ($template_name  == 'applications/form')?'collapsed-sidebar':''; ?>">
<?php 
	// Get Username & Role Name
	$username = $session_userdata['user_details'][0]['username'];
	$role_name = $session_userdata['user_details'][0]['role_name'];
  $admissclass="";
  $activeClass = 'active';
  if($this->uri->segment(2) == 'admission'){
    $admissclass = $activeClass ;
  }
?>
  <!-- Page Container -->
  <div class="page-container">
    <!-- Page Content -->
    <div class="page-content">
    
