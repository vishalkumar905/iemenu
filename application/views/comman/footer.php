            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.fligobeamnetworks.in" target="_blank"><span style="color:#14BDEE">
                            fligobeamnetworks.in
                        </span></a>, All Rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?php echo base_url('/assets/js/jquery-3.1.1.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/jquery-ui.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/material.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/perfect-scrollbar.jquery.min.js'); ?>" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo base_url('/assets/js/jquery.validate.min.js'); ?>"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="<?php echo base_url('/assets/js/moment.min.js'); ?>"></script>
    <!--  Charts Plugin -->
    <?php if (isset($chartlistJs)) { ?>
    <script src="<?php echo base_url('/assets/js/chartist.min.js'); ?>"></script>
    <?php } ?>
    <!--  Plugin for the Wizard -->
    <script src="<?php echo base_url('/assets/js/jquery.bootstrap-wizard.js'); ?>"></script>
    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url('/assets/js/bootstrap-notify.js'); ?>"></script>
    <!--   Sharrre Library    -->
    <script src="<?php echo base_url('/assets/js/jquery.sharrre.js'); ?>"></script>
    <!-- DateTimePicker Plugin -->
    <script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.js'); ?>"></script>
    <!-- Vector Map plugin -->
    <script src="<?php echo base_url('/assets/js/jquery-jvectormap.js'); ?>"></script>
    <!-- Sliders Plugin -->
    <script src="<?php echo base_url('/assets/js/nouislider.min.js'); ?>"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <!-- Select Plugin -->
    <script src="<?php echo base_url('/assets/js/jquery.select-bootstrap.js'); ?>"></script>
    <!--  DataTables.net Plugin    -->
    <script src="<?php echo base_url('/assets/js/jquery.datatables.js'); ?>"></script>
    <!-- Sweet Alert 2 plugin -->
    <script src="<?php echo base_url('/assets/js/sweetalert2.js'); ?>"></script>
    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?php echo base_url('/assets/js/jasny-bootstrap.min.js'); ?>"></script>
    <!--  Full Calendar Plugin    -->
    <script src="<?php echo base_url('/assets/js/fullcalendar.min.js'); ?>"></script>
    <!-- TagsInput Plugin -->
    <script src="<?php echo base_url('/assets/js/jquery.tagsinput.js'); ?>"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="<?php echo base_url('/assets/js/material-dashboard.js'); ?>"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url('/assets/js/demo.js'); ?>"></script>
    
    <script>
        $("#ieMenuInventoryLink").click(function() {
            let hostname = window.location.hostname;
            let baseUrl = hostname == 'localhost' ? 'http://localhost/inventory/' : 'https://iemenu.in/inventory/';
            
            if (hostname == 'iemenu.beginweb.in')
            {
                baseUrl = 'http://inventory.beginweb.in/';
            }
            else if (hostname == 'iemenu.in')
            {
                baseUrl = 'https://iemenu.in/inventory/';
            }


            let url = baseUrl + 'home/generateLoginToken';
            let data = {
                userId: "<?=$this->session->userid?>",
                name: "<?=$this->session->name?>",
                email: "<?=$this->session->email?>",
                role: "<?=$this->session->adminrole?>",
            }

            alert('Click ok to redirect you to inventory');

            $.post(url, data, function(response) {
                if (response.isSuccess == false)
                {
                    alert('Something went wrong');
                }
                else
                {
                    window.open(response.response.url,'_blank');
                }
            }, 'json');
        });

        $("#logoutSession").click(function() {
            let hostname = window.location.hostname;
            let baseUrl = hostname == 'localhost' ? 'http://localhost/inventory/' : 'https://iemenu.in/inventory/'; 

            if (hostname == 'iemenu.beginweb.in')
            {
                baseUrl = 'http://inventory.beginweb.in/';
            }
            else if (hostname == 'iemenu.in')
            {
                baseUrl = 'https://iemenu.in/inventory/';
            }
            
            let url = baseUrl + 'home/destroySession';
            let logoutLink = $(this).attr("datahref");
            $.post(url, {}, function(response) {
                if (response.isSuccess == false)
                {
                    alert('Something went wrong');
                }
                else
                {
                    window.location.href = logoutLink;
                }
            }, 'json');
        });
    </script>
    
</body>
</html>