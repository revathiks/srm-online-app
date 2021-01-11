						</div>
						<!-- Main Wrapper -->
					</div>
					<!-- /Page Inner -->
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /Page Container -->
			<!-- Javascripts -->
			<script src="<?php echo base_url(); ?>assets/backend/plugins/jquery/jquery-3.1.0.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/plugins/bootstrap/popper.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/plugins/switchery/switchery.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/plugins/apexcharts/dist/apexcharts.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/plugins/chartjs/chart.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/js/concept.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/backend/js/pages/dashboard_admin2.js"></script>
			<script>
			var pageSize = '<?php echo PAGE_LIMIT; ?>';
			// baseURL variable
			var baseURL= "<?php echo base_url();?>";
			jQuery(function(){

			});

			function show_single(id)
			{
				if(id == 'all')
				{
				    jQuery('.targetDiv').show();
				}
				else
				{
					jQuery('.targetDiv').hide();
					jQuery('#div'+id).show();
				}
			}
			</script>