<?php
$get_print_yes = $this->input->get('print');
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_provsional_certicate = DOCUMENT_ID_PROVISIONAL_CERTICATE;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;

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
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':(($document_id_twelvfth_marksheet == $document_id)?'twelvfth_marksheet':(($document_id_provsional_certicate == $document_id)?'provisional_certificate':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet':''))))));
  		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_tenth_marksheet == $document_id)?'true':(($document_id_twelvfth_marksheet == $document_id)?'true':(($document_id_provsional_certicate == $document_id)?'true':(($document_id_graduation_marksheet == $document_id)?'true':''))))));
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
$payment_mode_id = $payment_details_list['payment_mode_id'];

   ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
<script>
    function ExportFormPreview(){ 
		kendo.drawing
		.drawDOM("#form_preview_de", 
		{ 
			paperSize: "A2",
			margin: { top: "1cm", bottom: "1cm" , right: "1cm" , left: "1cm"},
			scale: 0.7,
			height: 1000
		})
			.then(function(group){
			kendo.drawing.pdf.saveAs(group, "ExportFormPreview.pdf")
		});
	}
</script>   
<script>
var url = "<?php echo base_url(); ?>application-form/phd_form";
   
$(document).ready(function () {
	'use strict';
   	$('input').attr('readonly', 'readonly');
   	$('select').attr('readonly', 'readonly');
   	$('select').prop("disabled",true);
   	$('textarea').attr('readonly', 'readonly');
   	
	$(document).ready(function () {
    'use strict';			  
		$('#academic_accordion').click();
	
		var cqs_id = "current_qualification_status";
		<?php if($applicant_schooling_list[0]['result_declared']=='t') { ?>
			var dbcqs_val = 'twelfth';
			var dbcgsVal = 'Twelfth / 3 year Diploma Passed';
		<?php }
		
		if($applicant_graduations_list[0]['is_curr_qualify']=='t'){ ?>
			var dbcqs_val = 'graduation';
			var dbcgsVal = 'Graduation Passed';
		<?php } ?>
				
		 if(dbcqs_val){
			setTimeout(function(){ select2Set(cqs_id,dbcqs_val,dbcgsVal);
			}, 1);
		}

	});
	<?php
	if($upload_scripts) {
		foreach($upload_scripts as $k=>$v) {
		  echo $v."\n";
		}	
	}
	?>
	<?php if($get_print_yes=="yes"){ ?>
		var divToPrint = document.getElementById("DDEPreviewToPrint");
		var newWin = window.open('Print-Window');
		newWin.document.open();
		newWin.document.write('<?php echo HTML_OPEN; ?>' + divToPrint.innerHTML + '<?php echo HTML_CLOSE; ?>');
		newWin.document.close();
	<?php } ?>	
});
<?php if($get_print_yes=="yes"){ ?>
	var divToPrint = document.getElementById("DistanceJanPreviewToPrint");
	var newWin = window.open('Print-Window');
	newWin.document.open();
	newWin.document.write('<?php echo HTML_OPEN; ?>' + divToPrint.innerHTML + '<?php echo HTML_CLOSE; ?>');
	newWin.document.close(); 
<?php } ?>
</script>