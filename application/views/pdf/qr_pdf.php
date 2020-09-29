<table style="width: 100%;border-spacing: 20px;">
<?php $column_count=0; ?>
<?php foreach($multi_generate as $qr_data){  ?>
    <?php if($column_count==0){ echo '<tr>'; }  ?>
        <td style="padding: 25px;border: 2px solid #cbb252;text-align: center;">
            <div style="width:350px;margin:0 auto;">
                <div style="width:150px;height:50px;">
                	<?php if($config->logo_status == 1){ ?>
                	    <p><img src="<?php echo base_url($rest_data[0]->userimg) ?>" style="max-height: 100px;width: auto; padding-bottom:10px;" /></p>
                	<?php } ?>
    	        </div>
    	        <div>
    	            <p style="color: #a78234;font-size: 24px;font-weight: 400;padding:10px;">E-Menu</p>
    	        </div>
    	        <div style="width:300px;height:50px;">
                	<?php if($config->welcome_msg != ''){ ?>
                	    <p><?php echo $config->welcome_msg ?></p>
                	<?php } ?>
            	</div>
    	        
    	        <div><img src="<?php echo base_url($qr_data->table_qr) ?>" style="width: 200px;"></div>
    	        
    	        <div style="width:300px;height:50px;">
                	<?php if($config->table_name_status == 1){ ?>
                	    <p><b><?php echo $qr_data->table_name ?></b></p>
                	<?php } ?>
            	</div>
            	
            	<div style="width:300px;height:50px;">
                	<?php if($config->custom_msg != '' && $config->venue_name_staus == 1){ ?>
                        <p><small><?php echo $config->custom_msg ?></small></p>
                	<?php } ?>
                </div>
    	    </div>
        </td>
    <?php $column_count++; ?>
    <?php if($column_count==2){ $column_count=0; echo "</tr>"; } ?>
<?php } ?>
</table>
