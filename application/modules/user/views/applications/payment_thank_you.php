<?php
/* echo "<pre>";
print_r($payment_details_list);
echo "</pre>"; */
$formid=isset($_REQUEST)?$_REQUEST['app_form_id'] :APP_FORM_ID_PHD;
$path=$this->config->item('form_path');
$formpath=isset($path)?$path[$formid]:'phd';
$currentIndex=isset($_REQUEST)?$_REQUEST['currentIndex']:0;
if(strpos($form_url, ADMIN_MODE_EDIT))
{
	$form_url=$form_url;
}else{
	$form_url=base_url().$formpath."?startIndex=".($currentIndex+1);
}
$payment_status=isset($payment_details_list['payment_status_id']) ? $payment_details_list['payment_status_id']:$_REQUEST['status'];
$payment_transaction_id=isset($payment_details_list['trans_no']) ? $payment_details_list['trans_no']:'';

if($payment_mode == 'dd') {
	$message = $applicant_instructions_list[0]['dd_message'];
	$message = str_replace('##@@@@##', $payment_transaction_id, $message);
	$message = str_replace('##FORM_LINK##', $form_url, $message);
	echo html_entity_decode($message);
} else {
	$message = $applicant_instructions_list[0]['online_message'];	
	$message = str_replace('##@@@@##', $payment_transaction_id, $message);
	$message = str_replace('##FORM_LINK##', $form_url, $message);
	if($payment_status==PAYMENT_FAILED){	
	    $message="";
	    $message.="<h5>Your payment has been failed.</h5><div class='mt-3'><a href='".$goback_url."'>GO BACK</a></div>";
	}
	echo html_entity_decode($message);	
}

?>