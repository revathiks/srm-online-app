<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>
<div class="container">
    <div>
		<canvas id="canvas2"></canvas>
    </div>
</div>
<?php

$resultData=array(
   'A2304' => array( 'name'=>'Sunokkiya.S','leads'=>15460,'applications'=>109394),
   'A2305' => array( 'name'=>'Arathy A','leads'=>17693,'applications'=>6412),
   'A2306' => array( 'name'=>'Bharathy S','leads'=>20370,'applications'=>8305),
   'A2307' => array( 'name'=>'Priyanka M R','leads'=>38163,'applications'=>17098),
   'A2308' => array( 'name'=>'Priya D','leads'=>31452,'applications'=>13093),
   'A2309' => array( 'name'=>'Nithya K','leads'=>19137,'applications'=>7218),
   'A2310' => array( 'name'=>'Varalakshmi','leads'=>11416,'applications'=>4815),
);
$label=$leaddata=$appdata=array();
if(!empty($resultData)){
    foreach ($resultData as $result){
       $label[]=$result['name'];              
       $leaddata[]=$result['leads'];
       $appdata[]=$result['applications'];
    }
}
$labelResult=json_encode($label);
$leadDataResult=json_encode($leaddata);
$appDataResult=json_encode($appdata);
?>
<script>

</script>