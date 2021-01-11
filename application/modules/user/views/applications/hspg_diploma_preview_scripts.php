<?php 
$get_print_yes = $this->input->get('print');
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_other_document1 = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
$document_id_other_document2 = DOCUMENT_ID_OTHER_DOCUMENTS;

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
        $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_other_document1 == $document_id)?'other_document1':(($document_id_other_document2== $document_id)?'other_document2':''))));
        $parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_other_document1 == $document_id)?'false':(($document_id_other_document2 == $document_id)?'false':''))));
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
var url = "<?php echo base_url(); ?>shug_preview";
$(document).ready(function () {
    'use strict';  
    $('input').attr('readonly', 'readonly');
   	$('select').attr('readonly', 'readonly');
   	$('select').prop("disabled",true);
   	$('textarea').attr('readonly', 'readonly');
	 $(document).ready(function () {	
		 disableFields();
		<?php
	      if($upload_scripts) {
	        foreach($upload_scripts as $k=>$v) {
	          echo $v."\n";
	        }
	      }
	    ?>	
	});
});
<?php if($get_print_yes=="yes"){ ?>
	var divToPrint = document.getElementById("hspgPreviewToPrint");
	var newWin = window.open('Print-Window');
	newWin.document.open();
	newWin.document.write('<?php echo HTML_OPEN; ?>' + divToPrint.innerHTML + '<?php echo HTML_CLOSE; ?>');
	newWin.document.close(); 
<?php } ?>
</script>