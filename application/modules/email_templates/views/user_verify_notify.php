<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>concept - Responsive Admin Dashboard Templatesss</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/plugins/icomoon/style.css" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/common/css/concept.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/css/admin2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/css/custom.css" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/css/starlight.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
   
</head>

<body class="collapsed-sidebar">

    <!-- Page Container -->
    <div class="page-container">
        <div class="page-content page_content">
           
            <!-- Page Header -->
           
            <!-- Page Inner -->
            
                   
                    <table width="100%" cellspacing="0" cellpadding="0"
                        style="max-width:600px;margin:0 auto;border:1px solid #cccccc;color:#333333">
                        <tbody>
                            <tr>
                                <td style="border-bottom:1px solid #cccccc;padding:5px 0">
                                    <table width="100%"  cellspacing="0" cellpadding="0" style="max-width:398px">
                                        <tbody>
                                            <tr>
                                                <td style="padding:10px 0 10px 10px"> 
                                                    <img src="<?php echo base_url().$this->config->item('template_logo_image_path' );?>"
                                                        style="max-height: 92px;" alt="logo" class="CToWUd"> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:10px">
                                    <h4>Dear <?php echo $display_name;?>,</h4>

                                    <p class="m-1">Thank you for registration with SRM Group Of Institutions</p>
                                    <p class="m-1">Before you get started, please verify your email address below,</p>
                                    <?php
                                    if($pgm_name == ''){ 
                                        $link = base_url('check_verifylink/').$verify_text.'/'.$user_id;
                                    /*<a href="<?php echo base_url('check_verifylink/').$verify_text.'/'.$user_id; ?>" class="btn btn-primary">Verify your email</a> */
                                    } else { 
                                        $link = base_url('check_verifylink/').$verify_text.'/'.$user_id.'/'.$pgm_name;
                                        /*<a href="<?php echo base_url('check_verifylink/').$verify_text.'/'.$user_id.'/'.$pgm_name; ?>" class="btn btn-primary">Verify your email</a>*/
                                     } 
                                    if($is_international)
                                    {
                                        $link .='?is_inter='. $is_international;
                                    }
                                    ?>
                                    <a href="<?php echo $link; ?>" class="btn btn-primary">Verify your email</a>
                                    <!-- <p class="m-1">This verification link is valid upto <strong><?php echo $verify_end_time;?></strong>.</p> -->
                                    <p class="m-1">In case you have not verified with this link, please contact SRM Group Of Institutions</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:bottom">
                                    <table  width="100%" cellspacing="0" cellpadding="0" style="max-width:398px">
                                        <tbody>
                                            <tr>
                                                <td style="padding:10px;line-height:1.5em"> Thanks,<br> Support Team,<br> SRM Group Of
                                                    Institutions </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
    
    <!-- Steps Circular Progress - END -->
</body>

</html>