<?php
$file_allowed_type = FILE_ALLOWED_TYPE;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
?>
<script>
var ticketid=$('#ticket_id').val();
var url = "<?php echo base_url(); ?>ticket_details";
var redirect="<?php echo base_url(); ?>ticket_details/"+ticketid;
var logged_applicant_id = '<?php echo $logged_applicant_login_id; ?>';
var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
$(document).ready(function () {
	$("#submit_query").click(function () {		
		var description=$('#description').parsley();
		var description_val = $('#description').val();
		var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
		
		if(description.isValid())
		{
		            var moveNxt=0;
		            var file_doc_type="photograph";	        	
		        	var parsley_required = $('#'+file_doc_type).attr('data-parsley-required');
		        	var max_file_size = $('#'+file_doc_type).attr('data-parsley-max-file-size');
		        	var max_file_size_js = $('#'+file_doc_type).attr('data-max-file-size-js');
		        	var file_extension = $('#'+file_doc_type).attr('data-parsley-file-extension');
		        	var id = $('#'+file_doc_type).attr('data-file-id');
		        	var file_count = 'false';
		        	if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
		        		file_count = $('#'+file_doc_type).attr('data-file-count');    
		        	}

		            var formData = new FormData();		        	
		        	formData.append('applicant_id', logged_applicant_id);
		        	formData.append('description', description_val);
		        	formData.append('field', file_doc_type);
		        	formData.append('ticket_id', ticketid);
		        	formData.append('chk_max_file_size', max_file_size);
		        	formData.append('max_file_size_js', max_file_size_js);
		        	formData.append('file_extension', file_extension);	
		        	
		        	formData.append('id', id);
		        	formData.append(csrfName,csrfHashRegenerate);
		        	if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
		        		$($('#'+file_doc_type)[0].files).each(function(k,v) {
		        			formData.append(file_doc_type+'[]', v);     
		        		});
		        	} else {
		        		formData.append(file_doc_type, $('#'+file_doc_type)[0].files[0]); 
		        	}		        	
					$.ajax({
						type: 'POST',
						url: url,
						data: formData,
						dataType: 'json',
						cache: false,
						async: false,
						contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
						processData: false, // NEEDED, DON'T OMIT THIS
						beforeSend: function() { $('.loader').show(); },
						success: function(returndata) {							
							if(returndata.status == 'true') {
								$("#formerr").hide();
								 setTimeout(function() { window.location.href = redirect; }, 100);
							}
							if(returndata.error ) {
								// Set Regenerated CSRF Dynamically
								var csrfHash = $("input[name='"+csrfName+"']").val(returndata.token);
							    $("#formerr").show();
								$("#formerr").html(returndata.error);
							}
						},
						error: function(returndata) {							
							moveNxt=0;							
							$("#formerr").show();
							console.log(returndata);								 
						},
					});
		}else{
		 description.validate();
		}
	});
	
});

</script>