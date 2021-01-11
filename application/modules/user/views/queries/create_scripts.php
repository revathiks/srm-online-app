<?php
$file_allowed_type = FILE_ALLOWED_TYPE;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$docs = $upload_scripts = array();
$file_count = 0;
if($upload_filelist) {
    foreach($upload_filelist as $doc){
        $document_id = $doc['document_id'];
        $id = $doc['id'];
        $file_name = $doc['name'];
        $file_path = $doc['path'];
        $file_name_user = remove_file_separator($file_name);
        $file_name_truncate = remove_file_separator($file_name, true);
        $file_doc_type = (($document_id_photograph == $document_id)?'photograph':'');
        $parsley_required = (($document_id_photograph == $document_id)?'false':'');
        if($document_id == $document_id_tentative_topic) {
            $docs[$document_id][]=array(
                'id'=>$id,
                'file_name'=>$file_name,
                'file_name_user'=>$file_name_user,
                'file_name_truncate'=>$file_name_truncate,
                'file_path'=>$file_path,
            );
            $file_count++;
        } else {
            $docs[$document_id]=array(
                'id'=>$id,
                'file_name'=>$file_name,
                'file_name_user'=>$file_name_user,
                'file_name_truncate'=>$file_name_truncate,
                'file_path'=>$file_path,
            );
            $upload_scripts[] = 'upload_file_set_download_delete_options("'.$file_doc_type.'", "'.$file_name.'", "'.$file_path.'", "'.$document_id.'", "'.$id.'", "'.$parsley_required.'")';
        }
    }
}
$docs['file_count'] = $file_count;
?>
<script>
<?php if($sidebar == 'is_international'){ ?>	
var url = "<?php echo base_url(); ?>create_query?is_international=1";
<?php } else { ?> 
var url = "<?php echo base_url(); ?>create_query";
<?php } ?>
var logged_applicant_id = '<?php echo $logged_applicant_login_id; ?>';
var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
$(document).ready(function () {
	$("#submit_query").click(function () {
		var name=$('#name').parsley();
		var category=$('#category').parsley();
		var form_id=$('#form_id').parsley();
		var description=$('#description').parsley();

		var name_val = $('#name').val();
		var category_val = $('#category').val();
		var form_id_val = $('#form_id').val();
		var description_val = $('#description').val();
		var user_data = 'name='+name_val+'&category='+category_val+'&form_id='+form_id_val+'&description='+description_val+'&'+csrfName+'='+csrfHash;
		var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
		if(name.isValid() && category.isValid() && form_id.isValid() && description.isValid())
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
		        	formData.append('name', name_val);
		        	formData.append('applicant_id', logged_applicant_id);
		        	formData.append('category', category_val);
		        	formData.append('form_id', form_id_val);
		        	formData.append('description', description_val);
		        	formData.append('field', file_doc_type);
		        	
		        	formData.append('chk_max_file_size', max_file_size);
		        	formData.append('max_file_size_js', max_file_size_js);
		        	formData.append('file_extension', file_extension);	
		        	
		        	formData.append('id', id);
		        	formData.append(csrfName,csrfHashRegenerate);
		        	formData.append('field', file_doc_type);
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
								 $("#formarea").hide();
								 $("#thankyou_div").show();
								 //setTimeout(function() { window.location.href = redirect; }, 100);
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
						},
					});
		}else{            	
		name.validate();
		category.validate();
		form_id.validate();
		description.validate();
		}
	});
	
	<?php if($sidebar == 'is_international'){ ?>
		getSelect2('form_id','<?php echo base_url("form_international_list"); ?>?is_lookup_master=1&sort_by=name&sort_order=asc','Select Form', formatRepoCommon,'No form available', false, formatRepoSelection);
	<?php } else { ?>
	getSelect2('form_id','<?php echo base_url("form_list"); ?>?is_lookup_master=1','Select Form', formatRepoCommon,'No form available', false, formatRepoSelection);
	<?php } ?>
	$('#description').keyup(function() {
        var text_length = $('#description').val().length;
        var text_remaining = 500 - text_length;
        $('#textarea_desc').html( 'Total characters count: '+ text_length +'/500');
    });
<?php
      if($upload_scripts) {
        foreach($upload_scripts as $k=>$v) {
          echo $v."\n";
        }
      }
 ?>
});

</script>