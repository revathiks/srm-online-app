    <?php
        $attributes = array('class' => 'loginForm', 'id' => 'loginForm' , 'name' => 'loginForm');
        echo form_open('login', $attributes);
    ?>
    <?php if($this->session->flashdata('error')) { ?>
        <div class='alert alert-danger' style="text-align: left;"><?php echo $this->session->flashdata('error');?><button type='button' class='close'   data-dismiss='alert'>&times;</button></div>
    <?php } ?>
    <div class="login-header m-0 p-0 text-center Login_header">
        <h4 class="srmjee">SRMJEEE <?php echo date("Y");?></h4>
        <h5 class="b_tech_Admission">B.Tech Admission Open</h5> 
    </div>
    <div class="form-group mt-3">
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email">
    </div>
    <div class="form-group">
         <input type="password" class="form-control" id="password" name="password" placeholder=" Your Password">
    </div>
    <!--<div class="custom-control custom-checkbox form-group">
        <input type="checkbox" class="custom-control-input" id="exampleCheck1">
        <label class="custom-control-label" for="exampleCheck1">Check to remember your login details</label> 
    </div>-->
    <button type="submit" class="btn btn-primary" id="loginSubmit"><?php echo $submit_button_name;?></button>
    <p class="m-t-sm"><a href="<?php echo base_url();?>forgot_password">Forgot password?</a><br><a href="<?php echo base_url('register');?>">New Registration</a></p>
    <?php form_close();?>