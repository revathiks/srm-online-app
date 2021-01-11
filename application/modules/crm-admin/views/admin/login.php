       <style type="text/css">
        .account-page
        {
            top: 11% !important;
        }
    </style>
    <h4 class="font-size-18 text-center">Welcome Back !</h4>
    <p class="text-muted text-center">Sign in to continue with SRM Admission.</p>    
    <?php
        $attributes = array('class' => 'loginForm custom-validation', 'id' => 'loginForm' , 'name' => 'loginForm');
        echo form_open('crm-admin/login', $attributes);
    ?>
    <div id="msgs"></div>
    <!-- <?php if($this->session->flashdata('error_admin')) { ?>
        <div class='alert alert-danger' style="text-align: left;"><?php echo $this->session->flashdata('error_admin');?><button type='button' class='close'   data-dismiss='alert'>&times;</button></div>
    <?php } ?>
    <?php if($this->session->flashdata('success_verify')) { ?>
        <div class='alert alert-success' id='alert' style="text-align: left;"><?php echo $this->session->flashdata('success_verify');?><button type='button' class='close'   data-dismiss='alert'>&times;</button></div>
    <?php } ?> -->
    <!-- <div class="login-header m-0 p-0 text-center Login_header">
        <h4 class="srmjee">SRMJEEE <?php //echo date("Y");?></h4>
        <h5 class="b_tech_Admission">B.Tech Admission Open</h5> 
    </div> -->
    <div class="form-group">
        <label for="email"></label>
        <select name="role_id" id="role_id" class="form-control">
            <option value="<?php echo CRM_ADMIN_USER_ROLE_ID ; ?>"><?php echo ADMIN_NAME ; ?></option>
            <option value="<?php echo COUNSELLOR_ROLE_ID ; ?>"><?php echo COUNSELLOR_NAME ; ?></option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username" data-parsley-required="true" data-parsley-required-message="Username required">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" data-parsley-required="true" data-parsley-minlength="<?php echo LOGIN_PASSWORD_LENGTH; ?>" 
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
    
    <?php form_close();?>

    
	