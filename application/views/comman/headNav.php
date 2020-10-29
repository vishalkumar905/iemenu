<nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php if($this->uri->segment(1) !== 'Restaurant') { $nav_brand= $this->uri->segment(1); }
                        else{
                            if($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'update' || $this->uri->segment(2) == 'list') { $nav_brand= 'Restaurant'; }
                            if($this->uri->segment(2) == 'addtax' || $this->uri->segment(2) == 'taxlist') { $nav_brand= 'Tax'; }
                            if($this->uri->segment(2) == 'addDiscount' || $this->uri->segment(2) == 'discountList') { $nav_brand= 'Discount'; }
                            if($this->uri->segment(2) == 'orderlist' || $this->uri->segment(2) == 'translist') { $nav_brand= 'Order'; }
                            if($this->uri->segment(2) == 'reportorderlist' || $this->uri->segment(2) == 'reporttranslist' || $this->uri->segment(2) == 'voidorderlist' || $this->uri->segment(2) == 'nckorderlist') { $nav_brand= 'Report'; }
                            }
                        ?>
                        <a class="navbar-brand" href="javascript:void(0)" style="text-transform: capitalize;"> <?= $nav_brand ?> </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="dashboard.html#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
								<ul class="dropdown-menu">
								    <li>
                                        <a href="#" id="ieMenuInventoryLink">Inventory</a>
                                    </li>
                                    <li>
                                        <a href="#" datahref="<?php echo base_url('login/logout'); ?>" id="logoutSession">Log Out</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>