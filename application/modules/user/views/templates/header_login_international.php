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
	<!-- CUSTOM FORM CSS -->
	<link href="<?php echo base_url(); ?>assets/common/css/custom_form.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/common/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<!-- Print CSS -->
	<link href="<?php echo base_url(); ?>assets/common/css/print.css" rel="stylesheet" type="text/css" />
</head>
<?php echo $body; ?>