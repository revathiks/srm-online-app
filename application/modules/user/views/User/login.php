    <h4 class="font-size-18 text-center">Welcome Back !</h4>
    <p class="text-muted text-center">Sign in to continue with SRM Admission.</p>    
    <?php
        $attributes = array('class' => 'loginForm custom-validation', 'id' => 'loginForm' , 'name' => 'loginForm');
        echo form_open('login', $attributes);
    ?>
    <?php if($this->session->flashdata('error')) { ?>
        <div class='alert alert-danger' style="text-align: left;"><button type='button' class='close'   data-dismiss='alert'>&times;</button><?php echo $this->session->flashdata('error');?></div>
    <?php } ?>
    <?php if($this->session->flashdata('success_verify')) { ?>
        <div class='alert alert-success' id='alert' style="text-align: left;"><button type='button' class='close'   data-dismiss='alert'>&times;</button><?php echo $this->session->flashdata('success_verify');?></div>
    <?php } ?>
    <!-- <div class="login-header m-0 p-0 text-center Login_header">
        <h4 class="srmjee">SRMJEEE <?php //echo date("Y");?></h4>
        <h5 class="b_tech_Admission">B.Tech Admission Open</h5> 
    </div> -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" autocomplete="off" maxlength="70"  id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" data-parsley-required="true" data-parsley-type="email" data-parsley-required-message="Email required" data-parsley-type-message="Enter valid Email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" autocomplete="off" maxlength="20" id="password" name="password" placeholder="Enter Password" data-parsley-required="true" data-parsley-minlength="<?php echo LOGIN_PASSWORD_LENGTH; ?>" 
        data-parsley-maxlength="<?php echo PWD_MAXLENGTH; ?>" data-parsley-required-message="Password required" data-parsley-minlength-message="Your password must be at least <?php echo LOGIN_PASSWORD_LENGTH; ?> characters long" >
    </div>
    <!--<div class="custom-control custom-checkbox form-group">
        <input type="checkbox" class="custom-control-input" id="exampleCheck1">
        <label class="custom-control-label" for="exampleCheck1">Check to remember your login details</label> 
    </div>-->
    <div class="form-group row">
        
        <div class="col-sm-12 text-right">
            <button type="submit" class="btn btn-primary w-md waves-effect waves-light w-100" id="loginSubmit"><?php echo $submit_button_name;?></button>
        </div>
    </div>
    <div class="form-group mt-2 mb-0 row">
        <div class="col-12 mt-3">
            <a href="<?php echo base_url();?>forgot_password"><i class="mdi mdi-lock"></i> Forgot password?</a>
        </div>
    </div>
    <?php form_close();?>

    <div class="mt-4 pt-2 text-center">
        <p>Don't have an account ? <?php if($pgm_name == ''){ ?> <a href="<?php echo base_url('register');?>" class="font-weight-medium text-primary"> Signup now </a> <?php } else { ?>  <a href="<?php echo base_url('register/'.$pgm_name);?>" class="font-weight-medium text-primary"> Signup now </a> <?php } ?> </p>    
    </div>
	