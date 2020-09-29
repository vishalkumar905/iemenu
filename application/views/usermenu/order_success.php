<!DOCTYPE HTML>
<html lang="en">
<head>
        <title>E-Menu</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/fonts/beyond_the_mountains-webfont.css" type="text/css"/>

		<!-- Stylesheets -->
		<link href="<?= base_url('assets/front_end/'); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url('assets/front_end/'); ?>css/fonts/ionicons.css" rel="stylesheet">
		<link href="<?= base_url('assets/front_end/'); ?>css/styles.css" rel="stylesheet">
		<link href="<?= base_url('assets/front_end/'); ?>css/custom.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
		
		<link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/owl.carousel.min.css">
		<link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/owl.theme.default.min.css">
</head>
<body>
    <?php $this->session->sess_destroy(); ?>
    
    <header class="bg-3 h-100vh pos-relative">
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white">
                                <h5><b><?php echo $this->session->flashdata('SUCCESSMSG'); ?></b></h5>
                                <h5>Order Id <b>#<?php echo $this->session->flashdata('ORDER_ID'); ?></b></h5>
                                <h2 class="mt-30 mb-15">Thank You!!!</h2>
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div>
    </header>
    <script src="<?= base_url('assets/front_end/'); ?>js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/scripts.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/owl.carousel.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
</body>
</html>
