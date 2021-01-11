<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1></h1>
      </div>
    	<?php if($this->session->userdata('msg')) { ?>
      <div class='alert alert-success col-md-12'>
          		<?=$this->session->userdata('msg');?>
          		<button type='button' class='close'	data-dismiss='alert'>&times;</button>
     <?php } ?>
  </div>
      <div class="row">
        <div class="col-md-4">
          <a href="#">

        </div>
        <div class="col-md-4">
          <a href="#">Query</a>
        </div>
      </div>
     
      
    </div>


