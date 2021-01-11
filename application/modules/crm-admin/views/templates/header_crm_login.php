<?php
$title = $sitename.' - '.$site_title;
?>
<style>
.account-pages {
    background:#FFF;
}
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SRM Technology">

    <!-- <meta name="generator" content="Jekyll v3.8.6"> -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/frontend/images/favicon.ico">

    <!-- Lightbox css -->
    <link href="<?php echo base_url(); ?>assets/common/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" /> 

    <link href="<?php echo base_url(); ?>assets/common/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/common/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">

    <!-- Icons Css -->
    <link href="<?php echo base_url(); ?>assets/common/css/icons.min.css" rel="stylesheet" type="text/css" />
    
    <!-- App Css-->
    <link href="<?php echo base_url(); ?>assets/common/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/css/custom.css">
    <link href="<?php echo base_url(); ?>assets/common/css/style_php.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/common/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/bootstrap/tabulator_bootstrap.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/bootstrap/tabulator_bootstrap.min.css" />	
		<!-- download sheet -->
	<!--
	 <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/dist/js/tabulator.min.js"></script>
	 <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/dist/js/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	-->
		
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/dist/js/xlsx.full.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/dist/js/jspdf.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backend/crm_common.js"></script>
   
   <!-- end download sheet -->
	<script type="text/javascript" src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
	<script type="text/javascript" src="https://www.chartjs.org/samples/latest/utils.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<!-- custom css crm -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/dist/css/crm_custom_style.css" />	
</head>
<?php echo $body; ?>