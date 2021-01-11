<?php
$get_print_yes = $this->input->get('print');
$app_form_id = APP_FORM_ID_INTERNATIONAL;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$const_grad_id = MTECH_GRADUATION_ID;
$const_deg_id = MTECH_DEGREE_ID;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_grade = DOCUMENT_ID_TENTH_GRADE;
$document_id_twelvfth_grade = DOCUMENT_ID_TWELVFTH_GRADE;
$document_id_bachelors_marksheet = DOCUMENT_ID_BACHELORS_MARKSHEET;
$document_id_masters_marks_card = DOCUMENT_ID_MASTERS_MARKS_CARD;
$document_id_transcripts = DOCUMENT_ID_TRANSCRIPTS;
$document_id_other_document1 = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
$document_id_other_document2 = DOCUMENT_ID_OTHER_DOCUMENTS;
$occupation_other_id = OCCUPATION_OTHER_ID;

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
      // $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_grade == $document_id)?'tenth_grade':(($document_id_twelvfth_grade == $document_id)?'twelvfth_grade':''))));
      $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_grade == $document_id)?'tenth_grade':(($document_id_twelvfth_grade == $document_id)?'twelvfth_grade':(($document_id_bachelors_marksheet == $document_id)?'bachelors_marksheet':(($document_id_masters_marks_card == $document_id)?'masters_marks_card':(($document_id_transcripts == $document_id)?'transcripts':(($document_id_other_document1 == $document_id)?'other_document1':(($document_id_other_document2 == $document_id)?'other_document2':'')))))))));   
      $parsley_required = (($document_id_photograph == $document_id)?'false':(($document_id_signature == $document_id)?'false':(($document_id_tenth_grade == $document_id)?'true':(($document_id_twelvfth_grade == $document_id)?'true':(($document_id_bachelors_marksheet == $document_id)?'true':(($document_id_masters_marks_card == $document_id)?'true':(($document_id_transcripts == $document_id)?'true':(($document_id_other_document1 == $document_id)?'true':(($document_id_other_document2 == $document_id)?'true':'')))))))));
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
var url = "<?php echo base_url(); ?>mtech-preview";
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
	var divToPrint = document.getElementById("InternationalPreviewToPrint");
	var newWin = window.open('Print-Window');
	newWin.document.open();
	newWin.document.write('<?php echo HTML_OPEN; ?>' + divToPrint.innerHTML + '<?php echo HTML_CLOSE; ?>');
	newWin.document.close(); 
<?php } ?>
</script>