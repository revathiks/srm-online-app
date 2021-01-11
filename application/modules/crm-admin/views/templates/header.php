<?php
$title = $sitename.' - '.$site_title;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- Title -->
    <title><?php echo $title; ?></title>
    <!-- Styles -->
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/common/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/common/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/plugins/icomoon/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/plugins/switchery/switchery.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/backend/login_css/login.css" rel="stylesheet">	
    <?php

    $not_applciationform = false;
    if(!isset($applciationform)) {
        $not_applciationform = true;
    } else if(isset($applciationform)) {
        if($applciationform == false) {
            $not_applciationform = true;
        }
    }

    if($not_applciationform == true) {
    ?>
    <link href="<?php echo base_url(); ?>assets/common/plugins/select2/css/select2.min.css" rel="stylesheet"> 
    <link href="<?php echo base_url(); ?>assets/common/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"> 
    <?php
    }
    ?>
    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/common/css/concept.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/css/admin2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/css/custom.css" rel="stylesheet">
    <?php 
    if(isset($applciationform)) {
        if($applciationform == true) {
        ?>
        <!-- vendor css -->
        <link href="<?php echo base_url(); ?>assets/common/plugins/font-awesome/css/font-awesome_form.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/common/plugins/Ionicons/css/ionicons.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/common/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/common/plugins/highlightjs/github.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/common/plugins/jquery.steps/jquery.steps.css" rel="stylesheet">

        <!-- Starlight CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/plugins/starlight/css/starlight.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/common/css/application_form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/common/plugins/shieldui/css/all.min.css" />
        <?php
        }
    }
    ?>
    <link href="<?php echo base_url(); ?>assets/frontend/css/style_php.css" rel="stylesheet"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>