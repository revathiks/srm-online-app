<script type="text/javascript">
	var pgm_name = '<?php echo $pgm_name;?>';
	var is_international = '<?php echo $is_international;?>';
		//setTimeout(function() { window.location.href = '<?php echo base_url(); ?>'}, 5000);
		if(pgm_name !='' && is_international == '' )
		{
			window.location.href = '<?php echo base_url().'login/'?>'+pgm_name;
		}else if(pgm_name !='' && is_international != '' )
		{
			window.location.href = '<?php echo base_url().'international-form/login/'?>'+pgm_name;
		}else if(pgm_name =='' && is_international != '' )
		
		{
			window.location.href = '<?php echo base_url().'international-form/login'?>';
		}
		else
		{
			window.location.href = '<?php echo base_url(); ?>';
		}
		
	</script>
<?php die; ?>

<body>
	<!-- Page Container -->
	<div class="page-container">
		<div class="login">
			<div class="login-bg"></div>
			<div class="login-content">
				<div class="login-box login_box">
					<div class="login-body login_align login_body">
						<form>
							<div class="login-header m-0 p-0 Login_header">
								<h3>Verification</h3>
								<!-- <p>Complete this simple form to register.</p> -->
							</div>
							<div class="row">
								<div class="col-sm-12" id="msgs"></div>
								<div class="col-sm-12" id="success_text">
									<h4>Thanks for verification</h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								</div>
								<div class="col-sm-12" id="fail_text" style="display:none">
									<a href="">Resend Verification link</a>
								</div>
							</div>
						</form>
                	</div>
            	</div>
			</div>
		</div>
	</div><!-- /Page Container -->
	
