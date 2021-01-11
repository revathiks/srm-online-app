<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
function frm_auto_submit(){
	//alert('venkat');
	document.payuForm.submit();
}
</script>

<body onload="frm_auto_submit();">
<form action="<?php echo $action; ?>/_payment" method="post" id="payuForm" name="payuForm">
<input type="hidden" name="key" value="<?php echo $mkey; ?>" />
<input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
<input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
<input class="form-control" type="hidden" name="amount" value="<?php echo $amount; ?>"  readonly/>
<input class="form-control" type="hidden"  name="firstname" id="firstname" value="<?php echo $name; ?>" readonly/>
<input class="form-control" type="hidden" name="email" id="email" value="<?php echo $mailid; ?>" readonly/>
<input class="form-control" type="hidden" name="phone" value="<?php echo $phoneno; ?>" readonly />
<input class="form-control" type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" readonly />
<!--<textarea class="form-control" type="hidden" name="productinfo" readonly><?php echo $productinfo; ?></textarea>-->
<input class="form-control" type="hidden" name="address1" value="<?php echo $address; ?>" readonly/>     
<input name="surl" value="<?php echo $sucess; ?>" size="64" type="hidden" />
<input name="furl" value="<?php echo $failure; ?>" size="64" type="hidden" />  
<input name="curl" value="<?php echo $cancel; ?> " type="hidden" />
<!--<input type="submit" value="Pay Now" class="btn btn-success" />->>
</form>
</body>