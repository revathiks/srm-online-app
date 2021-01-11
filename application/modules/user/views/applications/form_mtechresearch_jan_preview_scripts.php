<?php
$get_print_yes = $this->input->get('print');
$app_form_id_mtech = APP_FORM_ID_MTECH_RESEARCH;
$const_grad_id = MTECH_RESEARCH_GRADUATION_ID;
$const_deg_id = MTECH_RESEARCH_DEGREE_ID;

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
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
      $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet':'')));
      $parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':''));;
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
var url = "<?php echo base_url(); ?>mtechresearch-preview";
$(document).ready(function () {
    'use strict';
     disableFields();
    <?php
        if($upload_scripts) {
          foreach($upload_scripts as $k=>$v) {
            echo $v."\n";
          }
        }
      ?>  
 
});
<?php if($get_print_yes=="yes"){ ?>
	var divToPrint = document.getElementById("MtechsearchjanPreviewToPrint");
	var newWin = window.open('Print-Window');
	newWin.document.open();
	newWin.document.write('<?php echo HTML_OPEN; ?>' + divToPrint.innerHTML + '<?php echo HTML_CLOSE; ?>');
	newWin.document.close(); 
<?php } ?>
</script>