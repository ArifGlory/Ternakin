<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php $user = $this->session->userdata('user'); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Ternak.in</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="<?php echo base_url();?>assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets1/css/icomoon-social.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?php echo base_url();?>assets1/css/leaflet.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo base_url();?>assets1/css/leaflet.ie.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets1/css/main.css">

    <script src="<?php echo base_url();?>assets1/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <link href="<?php echo base_url();?>assets3/SweetAlert/sweetalert.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->

    <script src="<?php echo base_url();?>assets1/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url();?>assets3/SweetAlert/sweetalert.min.js"></script>

    <script src="<?php echo base_url();?>/assets2/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets2/js/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets2/js/basic.min.css">
    <script type="text/javascript" src="<?php echo base_url();?>/assets2/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets2/js/dropzone.min.js"></script>
    <script src="<?php echo base_url();?>/assets2/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/assets2/js/scripts.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->


<!-- Navigation & Logo-->
<div class="mainmenu-wrapper" style="background:#222">
    <div class="container-fluid">
        <nav id="mainmenu" class="mainmenu">
            <ul>
                <li class="logo-wrapper"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets2/logo-ternak.png"></a></li>
                <li class="active">
                    <a href="<?php echo base_url();?>Utama/caraInvestasi">Cara Investasi</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>Utama/listProyek">Proyek Investasi</a>
                </li>
                <?php
                if (!empty($user['id'])){
                    if ($user['bagian'] == "peternak") {
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>Peternak">Dashboard</a>
                        </li>
                        <?php
                    }else if ($user['bagian'] == "investor"){
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>Investor">Dashboard</a>
                        </li>
                <?php
                    }
                    } ?>

                <li class="pull-right" style="padding-top: 20px;color: white">
                    <?php
                    if(!empty($user['id'])){
                        ?>
                        <div style="padding-bottom: 20px">
                            <span class="glyphicon glyphicon-user"> </span>
                            <?php echo $user['nama']; ?>
                            <a type="submit" href="<?php echo base_url();?>Login/logout" class="btn btn-green">Keluar</a>
                        </div>
                    <?php }else { ?>
                        <!-- <p>Anda belum login</p> -->
                        <div style="padding-bottom: 20px">
                            <a type="submit" href="<?php echo base_url();?>Utama/pilihanLogin" class="btn btn-green">Masuk</a> |
                            <a type="submit" href="<?php echo base_url();?>Utama/pilihanDaftar" class="btn btn-green">Daftar</a>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </nav>
    </div>
</div>