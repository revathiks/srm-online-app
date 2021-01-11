<!-- <div class="content-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style-1">
            <li class="breadcrumb-item">
               <a href="<?php echo base_url('queries'); ?>">  
                    <button type="button" class="btn btn-primary" >
                        Any Queries? Ask Us
                    </button>
                </a> 
            </li>
        </ol>
    </nav>
    <h1 class="page-title"><?php echo $page_title; ?></h1>
</div> -->

<!-- Begin page -->
<div id="layout-wrapper">
    <?php echo $this->load->view('templates/international_topbar',true); ?>
    <?php //include 'layouts/topbar.php'; ?>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4 class="font-size-18"><?php echo $page_title; ?></h4>
                            <!-- <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Veltrix</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Wizard</li>
                            </ol> -->
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                            <a href="<?php echo base_url('create_query').'?is_international=1'; ?>">
                                <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button">
                                     <i class="mdi mdi-settings mr-2"></i>
                                    Any Queries
                                </button>
                                </a>
                                <!-- <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card align-card">
                            <div class="card-body">
                                <!-- <h4 class="card-title"><?php echo $page_title; ?></h4> -->
                                <!-- <p class="card-title-desc">A powerful jQuery wizard plugin that
                                    supports accessibility and HTML5</p> -->