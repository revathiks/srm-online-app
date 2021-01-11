<body>
         <?php
         $attributes = array('class' => 'loginForm', 'id' => 'loginForm' , 'name' => 'loginForm');
         echo form_open('login', $attributes);
         ?>
            <!-- Page Container -->
            <div class="page-container">
                <div class="login">
                    <div class="login-bg"></div>
                    <div class="login-content">                    	
                        <div class="login-box">
                            <div class="login-header">
						<?php if($this->session->flashdata('error')) {?>
							<div class='alert alert-danger' style="text-align: left;"><?php echo $this->session->flashdata('error');?><button type='button' class='close'	data-dismiss='alert'>&times;</button></div>
						<?php } ?>
								<!-- <img src="img/srm-logo-blue.png" alt=""> -->
                                <h3><?php echo $page_heading_name;?></h3>
                                <p><b><?php echo $site_head_below;?></b></p>
                            </div>
                            <div class="login-body">
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder=" Your Password">
                                    </div>
                                    <div class="custom-control custom-checkbox form-group">
                                        <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1"> <?php echo $check_remember;?> </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="loginSubmit"><?php echo $submit_button_name;?> </button>									
                                </form>
                                <p class="m-t-sm"><a href="<?php echo base_url();?>forgot_password">Forgot password?</a><br><a href="<?php echo base_url('register');?>">New Registration</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /Page Container -->
            
         <?php form_close();?>

   