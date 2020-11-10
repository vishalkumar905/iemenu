        <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="<?php echo base_url(); ?>/assets/img/sidebar-1.jpg">
        <?php
        $userrole = $this->session->adminrole;
        $uid = $this->session->userid;
        
        $dashboardModel = new dashboardModel();
        $res = $dashboardModel->getUsersInfo($uid);
        ?>
		
            <div class="logo">
                <a href="" class="simple-text">
                   <?php echo $res[0]->name; ?>
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="" class="simple-text">
                    <i class="material-icons">dashboard</i>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="<?php echo base_url().'/'.$res[0]->userimg; ?>" style="height: 100%;object-fit: cover;" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            
                            <?php echo $res[0]->name; ?>
                            <br>
                             <?php echo $res[0]->tagline; ?>
                            
                            
                            <b class="caret"></b>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url('dashboard/viewProfile'); ?>">My Profile</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('dashboard/editProfile'); ?>">Edit Profile</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                   $url_key = $this->uri->segment(1);
                   $url_key_sec = $this->uri->segment(2);
                   $url_key_third = $this->uri->segment(3);
                ?>
                <ul class="nav">
                    
                    <li <?php if($url_key == 'dashboard'){ echo 'class="active"'; }?>>
                        <a href="<?php echo base_url('dashboard'); ?>">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php if($userrole == 0){  ?>
                     <li <?php if($url_key_sec == 'orderlist'||$url_key_sec == 'translist'){ echo 'class="active"'; }?>>
                        <a data-toggle="collapse" href="#order">
                            <i class="material-icons">reorder</i>
                            <p>Order
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="order">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url(); ?>Restaurant/orderlist">View order</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>Restaurant/translist">View Transaction</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php }?>
					<?php if($userrole == 1){  ?>
                    <li <?php if($url_key == 'Restaurant'){ echo 'class="active"'; }?>>
                        <a data-toggle="collapse" href="#Restaurents">
                            <i class="material-icons">person</i>
                            <p>Restaurents
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="Restaurents">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url(); ?>Restaurant/add">Add Restaurents</a>
                                </li>
								<!--<li>
                                    <a href="<?php echo base_url(); ?>Restaurant/update">Update Restaurents</a>
                                </li>-->
								<li>
                                    <a href="<?php echo base_url(); ?>Restaurant/list">View Restaurents</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                   <!-------li>
                        <a href="<?php echo base_url('menu').'/'.$uid;?>">
                            <i class="material-icons">Menu</i>
                            <p>Menu</p>
                        </a>
                      
                    </li----->
					<?php }  ?>
					<?php if($userrole == 0){  ?>
                    <li <?php if($url_key == 'Menu'){ echo 'class="active"'; }?>>
                        <!--<a data-toggle="collapse" href="#Menu">
                            <i class="material-icons">restaurant_menu</i>
                            <p>Menu
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="Menu">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url(); ?>">Add Recipe</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>">Update Recipe</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>">View Recipe</a>
                                </li>
                            </ul>
                        </div>-->
                        <a href="<?php echo base_url('Menu/index').'/'.$uid;?>">
                            <i class="material-icons">restaurant_menu</i>
                            <p>Menu</p>
                        </a>
                    </li>
                    <li <?php if($url_key == 'table'){ echo 'class="active"'; }?>>
                        <a data-toggle="collapse" href="#Table">
                            <i class="material-icons">table_chart</i>
                            <p>Table/Room
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="Table">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url('table/addTable/'); ?>">Add Table/Room Qr</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url('table/'); ?>">View Table/Room Qr</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li <?php if($url_key == 'QrController'){ echo 'class="active"'; }?>>
                        <a data-toggle="collapse" href="#qr_code">
                            <i class="material-icons">qr_code</i>
                            <p>Generate QR
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="qr_code">
                            <ul class="nav">
								<li>
                                    <a href="<?php echo base_url('/QrController/qrConfig'); ?>">Qr Config</a>
                                </li>
								<!---li>
                                    <a href="<?php //echo base_url('/QrController/'); ?>">View Table/Room</a>
                                </li--->
                            </ul>
                        </div>
                    </li>
                    <li <?php if(($url_key_sec == 'addtax'||$url_key_sec == 'taxlist')){ echo 'class="active"'; }?>>
                        <a data-toggle="collapse" href="#tax">
                            <i class="material-icons">style</i>
                            <p>Tax
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="tax">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url(); ?>Restaurant/addtax">Add tax</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>Restaurant/taxlist">View tax</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                     <li <?php if(($url_key_sec == 'addDiscount'||$url_key_sec == 'discountList')){ echo 'class="active"'; }?>>
                        <a data-toggle="collapse" href="#discount">
                            <i class="material-icons">style</i>
                            <p>Discount
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="discount">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url(); ?>Restaurant/addDiscount">Add Discount</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>Restaurant/discountList">View Discount</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                   
                    <?php if($res[0]->online_pay_status == 'on'){  ?>
                    <li <?php if($url_key == 'payment'){ echo 'class="active"'; }?>>
                        <a href="<?php echo base_url('payment/paymentConfig'); ?>">
                            <i class="material-icons">payment</i>
                            <p>Payment Setup
                            </p>
                        </a>
                    </li>
                    <?php }  ?>
                    <li <?php if($url_key_sec == 'reportorderlist' || $url_key_sec == 'voidorderlist' ||$url_key_sec == 'reporttranslist'){ echo 'class="active"'; }?>>
                        <a data-toggle="collapse" href="#report">
                            <i class="material-icons">data_usage</i>
                            <p>Report
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="report">
                            <ul class="nav">
                                <li>
                                    <a href="<?php echo base_url(); ?>Restaurant/reportorderlist">Order Report</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url(); ?>Restaurant/voidorderlist">Void Bill Report</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo base_url(); ?>Restaurant/nckorderlist">NCK Bill Report</a>
                                </li>

								<li>
                                    <a href="<?php echo base_url(); ?>Restaurant/reporttranslist">Transaction Report</a>
                                </li>
                            </ul>
                        </div>
                    </li>
				<?php }  ?>
                </ul>
            </div>
        </div>