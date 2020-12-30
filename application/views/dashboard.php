<?php $this->load->view('comman/header'); ?>
<style> 
    tbody .label { border-radius: 0px; } 
    table.table.table-hover {
        display: block;
        height: 240px;
        overflow-y: scroll;
    }
    table.table.table-hover thead, table.table.table-hover tbody {
        display: table;
        width: 100%;
    }
</style>
	<?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
		<?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!--<div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">weekend</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Bookings</p>
                                    <h3 class="card-title">184</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-danger">warning</i>
                                        <a href="dashboard.html#pablo">Get More Space...</a>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="rose">
                                    <i class="material-icons">equalizer</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Close Orders </p>
                                    <h3 class="card-title"><?= $tab['closeCount']; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Revenue</p>
                                    <h3 class="card-title">₹<?= $tab['closePrice']; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="white">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Revenue By Cash</p>
                                    <h3 class="card-title">₹<?= $totalPaymentByCash; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Revenue By Online</p>
                                    <h3 class="card-title">₹<?= $totalPaymentByOnline; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="blue">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Revenue By UPI</p>
                                    <h3 class="card-title">₹<?= $totalPaymentByUpi; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Revenue By Card</p>
                                    <h3 class="card-title">₹<?= $totalPaymentByCard; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="purple">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Revenue By BTC</p>
                                    <h3 class="card-title">₹<?= $totalPaymentByBtc; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="blue">
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Followers</p>
                                    <h3 class="card-title">+245</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">update</i> Just Updated
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-tab" data-background-color="rose">
                                    <h4 class="card-title">Open Order List</h4>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover order-table">
                                        <thead class="text-rose">
                                            <th>Order ID</th>
                                            <th>Table No</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    <a href="<?php echo base_url('Restaurant/orderlist'); ?>"><button class="btn btn-rose btn-round"> All Orders </button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-tab" data-background-color="orange">
                                    <h4 class="card-title">Confirm Order List</h4>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover confirm-table">
                                        <thead class="text-orange">
                                            <th>Order ID</th>
                                            <th>Table No</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-tab" data-background-color="rose">
                                    <h4 class="card-title">Close Order List</h4>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover close-table">
                                        <thead class="text-rose">
                                            <th>Order ID</th>
                                            <th>Table No</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>
<script>
    jQuery(document).ready(function() {
        getorderlist();
        getconfirmorderlist();
        getcloseorderlist();
        
        setInterval(function(){ getorderlist(); getconfirmorderlist(); getcloseorderlist(); }, 60000 * 5);
    });
    
    function getorderlist() {
        $.ajax({
		   url: 'dashboard/openOrderlist',
		   type: 'GET',
		   error: function() {
			    alert('Something is wrong');
		   },
		   success: function(data) { 
			    $('table.order-table tbody').html(data);
		   }
		});
    }
    function getconfirmorderlist() {
        $.ajax({
		   url: 'dashboard/confirmOrderlist',
		   type: 'GET',
		   error: function() {
			    alert('Something is wrong');
		   },
		   success: function(data) { 
			    $('table.confirm-table tbody').html(data);
		   }
		});
    }
    function getcloseorderlist() {
        $.ajax({
		   url: 'dashboard/closeOrderlist',
		   type: 'GET',
		   error: function() {
			    alert('Something is wrong');
		   },
		   success: function(data) { 
			    $('table.close-table tbody').html(data);
		   }
		});
    }
</script>
    