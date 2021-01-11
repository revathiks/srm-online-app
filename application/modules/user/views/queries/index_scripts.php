<script>
var url = "<?php echo base_url(); ?>create_query";
var logged_applicant_id = '<?php echo $logged_applicant_login_id; ?>';
$(document).ready(function () {
	var base_url = "<?php echo base_url();?>"; 
	  $('#datatable').DataTable({
	     "pageLength" : 2,
	     "serverSide": true,
	     "order": [[0, "asc" ]],
	     "ajax":{
	              url :  base_url+'Queries/index',
	              type : 'POST'
	            },
	  }); // End of DataTable
});

</script>