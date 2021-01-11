<?php
   $get_print_yes = $this->input->get('print');
   $app_form_id_phd = APP_FORM_ID_PHD;
   $document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
   $document_id_signature = DOCUMENT_ID_SIGNATURE;
   $document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
   $document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
   $document_id_aadhar_card = DOCUMENT_ID_AADHAR_CARD;
   $document_id_post_graduation_marksheet = DOCUMENT_ID_POST_GRADUATION_MARKSHEET;
   $document_id_gate_score_card = DOCUMENT_ID_GATE_SCORE_CARD;
   $document_id_ugc_score_card = DOCUMENT_ID_UGC_SCORE_CARD;
   $document_id_slet_score_card = DOCUMENT_ID_SLET_SCORE_CARD;
   $document_id_net_score_card = DOCUMENT_ID_NET_SCORE_CARD;
   $document_id_score_card = DOCUMENT_ID_SCORE_CARD;
   $document_id_tentative_topic = DOCUMENT_ID_TENTATIVE_TOPIC;
   $document_id_additional_qualification = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
 
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
     		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_score_card == $document_id)?'score_card':(($document_id_aadhar_card == $document_id)?'aadhar_card':(($document_id_additional_qualification == $document_id)?'additional_qualification':(($document_id_post_graduation_marksheet == $document_id)?'post_graduation_marksheet':''))))));
     		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_score_card == $document_id)?'true':(($document_id_post_graduation_marksheet == $document_id)?'true':''))));
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
   
   $payment_mode_id = $applicant_payment_details_list['payment_mode_id'];
   ?>
<script>
   var url = "<?php echo base_url(); ?>phd";
   
          $(document).ready(function () {
              'use strict';
   
              $('#academic_accordion').click();
   		
   		<?php
      if($upload_scripts) {
        foreach($upload_scripts as $k=>$v) {
          echo $v."\n";
        }
      }
      ?>		
   	});
	<?php if($get_print_yes=="yes"){ ?>
		var divToPrint = document.getElementById("PHDPreviewToPrint");
		var newWin = window.open('Print-Window');
		newWin.document.open();
		newWin.document.write('<?php echo HTML_OPEN; ?>' + divToPrint.innerHTML + '<?php echo HTML_CLOSE; ?>');
		newWin.document.close(); 
	<?php } ?>	
</script>