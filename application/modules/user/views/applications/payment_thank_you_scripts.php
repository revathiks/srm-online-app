<?php 
$formid=isset($_REQUEST)?$_REQUEST['app_form_id'] :APP_FORM_ID_PHD;
$path=$this->config->item('form_path');
$formpath=isset($path)?$path[$formid]:'phd';
$currentIndex=isset($_REQUEST)?$_REQUEST['currentIndex']:0;
$form_url=base_url().$formpath."?startIndex=".($currentIndex+1);
$payment_status=isset($payment_details_list['payment_status_id']) ? $payment_details_list['payment_status_id']:'';
?>
<script>
<?php if($payment_status==PAYMENT_SUCCESS){ ?>
	setTimeout(function() {
		//window.location.href = '<?php echo $form_url; ?>';
	}, 5000);
<?php }?>
</script>