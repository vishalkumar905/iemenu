<?php $this->load->view('comman/header'); ?>
	<?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
		<?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                        
                       <?php foreach ($all_items as $items) { ?>      
                       
                       		                  
	                       		 <div class="col-md-3">
	                                <div class="card">
	                                    <div class="card-content text-center">
	                                        <h5><?php echo $items->name;?></h5>
	                                        <h3><?php echo $items->description;?></h3>
	                                    </div>
	                                </div>
	                            </div>
	                     	
                         <?php } ?>
                        
                       		<div class="col-md-3">
                                <div class="card">
                                    <div class="card-content text-center">
                                        <h5><i class="fa fa-plus"></i></h5>
                                        <a class="btn btn-rose btn-fill" data-toggle="modal" data-target="#menuitemForm-modal">
	                                            Add Item
	                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                    </div>
            </div>
            
<!-- Classic Modal -->
            <div class="modal fade" id="menuitemForm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                            </button>
                            <h4 class="modal-title">Add a menu</h4>
                        </div>
                        <form id="menuitemForm" name="menuForm" class="form-horizontal"  method="POST" action="<?= base_url('Menu_item/store_menuitem') ?>">
                        <div class="modal-body">
                             <div>
			                    <label for="name" class="lableModal">Name*</label>
			                    <input type="text" class="form-control" id="name" name="name" placeholder="enter item name" value="" required="required">
			                  </div>
				
							  <br/>
							  
							   <div>
			                    <label for="description" class="lableModal">Description*</label>
			                    <textarea class="form-control" id="description" name="description" placeholder="enter item description" value="" required></textarea>
			                  </div> 
							  <br/>
							  
							  <div>
			                    <label for="price" class="lableModal">Price*</label>
			                    <input type="number" class="form-control" id="price" name="price" placeholder="enter item price" value="" required="required">
			                  </div>
				
							  <br/>
							  
							  <div>
			                    <label for="price" class="lableModal">Food Type*</label>
			                  	  <br>
					                  <input type="radio" id="veg" name="food_type" value="veg">
									  <label for="veg"> Veg</label><br>
									  <input type="radio" id="non-veg" name="food_type" value="non-veg">
									  <label for="non-veg"> Non-Veg</label><br>
									  <input type="radio" id="egg" name="food_type" value="egg">
									  <label for="egg"> Egg</label><br>	
									  <input type="radio" id="not_applicable" name="food_type" value="not_applicable">
									  <label for="egg"> Not Applicable</label><br>							  	
								  <br>
								
			                  
			                  </div>	                  
			                <div>
			                </div>
			                <input type="hidden" class="form-control" name="menu_id" value="<?= $menu_id ?>" >
                        </div>
                        <div class="modal-footer">                       
                            <button type="submit" class="btn btn-rose" id="btn-menuitemForm" value="create">Add Item</button>
                            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
<!--  End Modal -->
<?php $this->load->view('comman/footer'); ?>

<script type="text/javascript">

$(document).ready(function () {
   if ($("#menuitemForm").length > 0) {
      $("#menuitemForm").validate({
 
        submitHandler: function (form) {

            var actionType = $('#btn-menuitemForm').val();
 
            $('#btn-menuitemForm').html('Submitting...');
            
            /*$.ajax({
               data: $('#menuitemForm').serialize(),
               url: SITEURL + "menu_item/store_menuitem",
               type: "POST",
               dataType: 'json',
               success: function (res) {
               
                  $('#menuitemForm').trigger("reset");
                  $('#menuitemForm-modal').modal('hide');
                  $('#btn-menuitemForm').html('Save Changes');
                  
               },
            submitHandler: function myFunction(e) {
                            document.getElementById("myText").value = e.target.value
                        },
              
               error: function (datae) {
                  console.log('Errore:', data);
                  $('#btn-menuitemForm').html('Save Changes');
               }
            });*/
            console.log("Submitted!");
            form.submit();
         }
      
      });
    } 
});
</script>