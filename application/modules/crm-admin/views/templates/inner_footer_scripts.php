<!-- Javascripts -->
<script src="<?php echo base_url(); ?>assets/common/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/bootstrap/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/switchery/switchery.min.js"></script>
<?php 
	$not_applciationform = false;
    if(!isset($applciationform)) {
    	$not_applciationform = true;
    } else if(isset($applciationform)) {
        if($applciationform == false) {
        	$not_applciationform = true;
        }
    }
    if($not_applciationform == true) {
    	?>
		<script src="<?php echo base_url(); ?>assets/common/plugins/apexcharts/dist/apexcharts.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/common/plugins/chartjs/chart.min.js"></script>
    	<?php
    }
?>
<script src="<?php echo base_url(); ?>assets/common/js/concept.min.js"></script>
<?php
if($not_applciationform == true) {
?>
<script src="<?php echo base_url(); ?>assets/common/js/pages/dashboard_admin2.js"></script>
<?php
}
?>
<script src="<?php echo base_url(); ?>assets/common/plugins/jquery/jquery.validate.js"></script>
<?php 
    if(isset($applciationform)) {
        if($applciationform == true) {
?>
<script src="<?php echo base_url(); ?>assets/common/plugins/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/highlightjs/highlight.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/jquery.steps/jquery.steps.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/parsleyjs/parsley.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/starlight/js/starlight.js"></script>
<script src="<?php echo base_url(); ?>assets/common/plugins/shieldui/js/shieldui-all.min.js"></script>
<?php
        }
    } 
?>
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