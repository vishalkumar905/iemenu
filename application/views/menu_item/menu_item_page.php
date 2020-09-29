<?php $this->load->view('comman/header'); ?>
	<?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
		<?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                        
                       <?php foreach ($all_items as $items) { ?>
	                            
	                        <div class="col-md-3 col-sm-4 col-xs-12 autodivset" style="margin-top: 30px;">
                                <div class="card autodivset">
                                    <div class="card-image" data-header-animation="true">
                                      <!--<a href="<?php //base_url('Menu_item/index').'/'.$items->item_id;?>">-->
                                        <img class="img" src="../../<?= ($items->image) ? $items->image : 'assets/img/image_placeholder.jpg' ?>" style="max-height: 156.75px;min-height: 156.75px;" style="top: 30px;">
                                      <!--</a>-->
                                    </div>
                                    <div class="card-content">
                                        <div class="card-actions">
                                            <!-- <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                                <i class="material-icons">build</i> Fix Header!
                                            </button>
                                            <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                                                <a href="<?php // base_url('Menu_item/index').'/'.$items->item_id;?>"><i class="material-icons">art_track</i></a>
                                            </button> -->
                                            <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit" data-toggle="modal" data-target="#menuForm-modal-<?= $items->item_id; ?>">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove"  onclick="delete_Item('<?= ($items->item_id) ?>', '<?= $menu_id ?>')">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="price">
                                            <h6 class="card-title"><?= $items->name ?></h6>
                                            <div class="card-description"><?= substr($items->description, 0, 30); ?></div>
                                        </div>
                                        <div class="stats pull-right">
                                            <div class="togglebutton">
                                              <label><input type="checkbox" id="publish" name="publish" onclick="manage_status(this,'<?= ($items->item_id) ?>','<?= $menu_id ?>')" <?php if($items->is_publish=='Yes') { echo 'checked'; } ?>></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start Modal -->
                                <div class="modal fade" id="menuForm-modal-<?= $items->item_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                  <i class="material-icons">clear</i>
                                              </button>
                                              <h4 class="modal-title">Update a menu</h4>
                                          </div>
                                          
                                          <div class="modal-body">
                                            <form id="menuForm" class="form-horizontal" method="POST" action="<?= base_url('Menu_item/store_menuitem/update') ?>" enctype="multipart/form-data">
                                              <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                  <input type="text" class="form-control" id="title" name="title" placeholder="Menu Title" value="<?= $items->name ?>" >
                                                </div>
                                              </div>
                                               
                                              <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                  <input type="text" class="form-control" id="description" name="description" placeholder="Menu Description" value="<?= $items->description ?>" >
                                                </div>
                                              </div>
                                              
                                              <br/>
                                              <div class="row">
                                                <div class="col-md-3 col-sm-3">
                                                  <label for="image" class="lableModal">Image</label>
                                                </div>
                                                <div class="col-md-9 col-sm-9">
                                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail">
                                                            <img src="../../<?= ($items->image) ? $items->image : 'assets/img/image_placeholder.jpg' ?>" alt="...">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                        <div>
                                                            <span class="btn btn-rose btn-round btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="menuImage" />
                                                            </span>
                                                            <a href="extended.html#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                        </div>
                                                        Maximum file size less than 2MB
                                                    </div>
                                                </div>
                                              </div>
                                              
                                              <div class="row">
                                                <div class="col-md-3 col-sm-3">
                                                    <label class="lableModal">Price(s)</label>
                                                </div>
                                                <div class="col-md-9 col-sm-9">
                                                <?php $price=json_decode($items->price); $price_desc=json_decode($items->price_desc);
                                                if(!empty($price) && !empty($price_desc)) {
                                                  for($i=0;$i<count($price);$i++) { 
                                                ?>
                                                    <div>
                                                      <div class="row">
                                                         <div class="col-md-4 col-sm-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="input-group-text">₹</span>
                                                                </span>
                                                                <div class="form-group label-floating">
                                                                    <input name="price[]" placeholder="0.00" type="text" class="form-control" value="<?= $price[$i] ?>">
                                                                </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-5 col-sm-5">
                                                            <div class="form-group">
                                                               <input name="price_description[]" placeholder="description" type="text" class="form-control" value="<?= $price_desc[$i] ?>">
                                                            </div>
                                                         </div>
                                                         <div class="col-md-3 col-sm-3">
                                                             <button type="button" class="btn btn-rose" onClick="removeDiv(this)"><i class="material-icons">delete</i></button>
                                                         </div>
                                                      </div>
                                                    </div>
                                                <?php
                                                  }
                                                }  ?>   
                                                    <div><button type="button" class="btn btn-rose" onClick="appendDiv(this)">Add Price</button></div>
                                                </div>
                                              </div> 
                                              <br/>
                                              
                                              <div class="row">
                                                <label class="col-md-3 col-sm-3 label-on-left">Food Type</label>
                                                <div class="col-md-9 col-sm-9 checkbox-radios">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" id="veg" name="food_type" value="veg" <?= ($items->food_type=='veg') ? 'checked' : '' ?>> Vegetarian
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" id="veg" name="food_type" value="non-veg" <?= ($items->food_type=='non-veg') ? 'checked' : '' ?>> Non Vegitarian
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" id="veg" name="food_type" value="egg" <?= ($items->food_type=='egg') ? 'checked' : '' ?>> Egg
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input type="radio" id="veg" name="food_type" value="not_applicable" <?= ($items->food_type=='not_applicable') ? 'checked' : '' ?>> Not Applicable
                                                        </label>
                                                    </div>
                                                </div>
                                              </div>
                                              <br/>
                                              <br/>
                                              <div class="row">
                                                <div class="col-md-3 col-sm-3">
                                                  <label for="publish" class="lableModal">Publish</label>
                                                </div>
                                                <div class="col-md-9 col-sm-9">
                                                  <div class="togglebutton">
                                                    <label>
                                                        <input type="checkbox" id="publish" name="publish" <?php if($items->is_publish=='Yes') { echo 'checked'; } ?>>
                                                    </label>
                                                  </div>
                                                </div>
                                              </div>
                                              <br/>
                                              <select class="selectpicker" name="tax[]" data-style="select-with-transition" multiple title="Choose Taxes">
                                                <option disabled> Choose taxes</option>
                                                <?php if(!empty($taxes)) { 
                                                  $taxesAll = $items->taxes;
                                                  if (!empty($items->taxes))
                                                  {
                                                    $taxesAll = unserialize($items->taxes);
                                                  }
                                                  else
                                                  {
                                                    $taxesAll = [];
                                                  }

                                                  foreach ($taxes as $tax) {
                                                    $selected = in_array($tax->tax_id, $taxesAll) ? 'selected' : '';
                                                ?>
                                                  <option value="<?=$tax->tax_id?>" <?=$selected?>><?=$tax->tax_percent?> % (<?=$tax->tax_type?>)</option>
                                                <?php 
                                                    } 
                                                  }
                                                ?>
                                              </select>
                                              <input type="hidden" name="item_id" value="<?= $items->item_id; ?>" >
                                              <input type="hidden" name="menu_id" value="<?= $menu_id ?>" >
                                              
                                              <button type="submit" class="btn btn-rose" id="btn-menuForm" value="create">Update Item</button>
                                              <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                              
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  End Modal -->
                            
                            </div>  
	                     	
                        <?php } ?>
                        
                       		<div class="col-md-3 col-sm-4 col-xs-12" style="margin-top: 30px;">
                                <div class="card autodivset" style="min-height: 223px;">
                                    <div class="card-content text-center" style="top: 30px;">
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
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                              <i class="material-icons">clear</i>
                          </button>
                          <h4 class="modal-title">Add an item</h4>
                      </div>
                      
                      <div class="modal-body">
                        <form id="menuForm" class="form-horizontal" method="POST" action="<?= base_url('Menu_item/store_menuitem') ?>" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                              <input type="text" class="form-control" id="title" name="title" placeholder="Item Title" value="" >
                            </div>
                          </div>
                           
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                              <input type="text" class="form-control" id="description" name="description" placeholder="Item Description" value="" >
                            </div>
                          </div>
                          
                          <br/>
                          <div class="row">
                            <div class="col-md-3 col-sm-3">
                              <label for="image" class="lableModal">Image</label>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="../../assets/img/image_placeholder.jpg" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="itemImage" />
                                        </span>
                                        <a href="extended.html#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                    Maximum file size less than 2MB
                                </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <label class="lableModal">Price(s)</label>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <div>
                                  <div class="row">
                                     <div class="col-md-4 col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">₹</span>
                                            </span>
                                            <div class="form-group label-floating">
                                                <input name="price[]" id="price" placeholder="0.00" type="text" class="form-control" value="" required>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                           <input name="price_description[]" id="description" placeholder="description" type="text" class="form-control" value="" required>
                                        </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3">
                                         <!--<button type="button" class="btn btn-rose" onClick="removeDiv(this)"><i class="material-icons">delete</i></button>-->
                                     </div>
                                  </div>
                                </div>
                                
                                <div><button type="button" class="btn btn-rose" onClick="appendDiv(this)">Add Price</button></div>
                            </div>
                          </div> 
                          <br/>
                          <div class="row">
                            <label class="col-md-3 col-sm-3 label-on-left">Food Type</label>
                            <div class="col-md-9 col-sm-9 checkbox-radios">
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" id="veg" name="food_type" value="veg"> Vegetarian
                                    </label>
                                </div>
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" id="veg" name="food_type" value="non-veg"> Non Vegitarian
                                    </label>
                                </div>
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" id="veg" name="food_type" value="egg"> Egg
                                    </label>
                                </div>
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" id="veg" name="food_type" value="not_applicable"> Not Applicable
                                    </label>
                                </div>
                            </div>
                          </div>
                          <br/>
                          <br/>
                          <div class="row">
                            <div class="col-md-3 col-sm-3">
                              <label for="publish" class="lableModal">Publish</label>
                            </div>
                            <div class="col-md-9 col-sm-9">
                              <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="publish" name="publish">
                                </label>
                              </div>
                            </div>
                            <style>
                              .togglebutton label input[type=checkbox]:checked + .toggle, .radio input[type=radio]:checked ~ .check { background-color: #e91e63; }
                              .togglebutton label input[type=checkbox]:checked + .toggle:after, .radio input[type=radio]:checked ~ .circle { border-color: #e91e63; }
                              .radio.radio-inline { padding-left: 0; padding-right: 10px; margin-top: 0 !important; }
                              .card .card-footer .price { width: 70%; }
                            </style>
                          </div>
                          <br/>
                          <select class="selectpicker" name="tax[]" data-style="select-with-transition" multiple title="Choose Taxes">
                            <option disabled> Choose taxes</option>
                            <?php if(!empty($taxes)) { 
                              foreach ($taxes as $tax) {
                            ?>
                              <option value="<?=$tax->tax_id?>"><?=$tax->tax_percent?> % (<?=$tax->tax_type?>)</option>
                            <?php 
                                } 
                              }
                            ?>
                          </select>
                          <input type="hidden" name="menu_id" value="<?= $menu_id ?>" >

                          <button type="submit" class="btn btn-rose" id="btn-menuForm" value="create">Add Item</button>
                          <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                          
                      </div>
                    </div>
                </div>
            </div>
<!--  End Modal -->
<?php $this->load->view('comman/footer'); ?>

<script type="text/javascript">

$(document).ready(function () {
   if ($("#menuitemForm").length > 0) {
      $("#menuitemForm").validate({
        rules: {
            title: {
                required: true,
            },
            description: {
                required: true
            },
            food_type: {
                required: true
            }
        },
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
function removeDiv(elem) {
    $(elem).closest('div[class^="row"]').parent('div').remove();
}

function appendDiv(elem){
    var html='';
    html+='<div>';
       html+='<div class="row">';
        html+='<div class="col-md-4 col-sm-4">';
            html+='<div class="input-group">';
                html+='<span class="input-group-addon">';
                    html+='<span class="input-group-text">₹</span>';
                html+='</span>';
                html+='<div class="form-group label-floating">';
                    html+='<input name="price[]"  placeholder="0.00" type="text" class="form-control" value="">';
                html+='</div>';
            html+='</div>';
        html+='</div>';
        html+='<div class="col-md-5 col-sm-5">';
            html+='<div class="form-group">';
                html+='<input name="price_description[]" placeholder="description" type="text" class="form-control" value="">';
            html+='</div>';
        html+='</div>';
        html+='<div class="col-md-3 col-sm-3">';
            html+='<button type="button" class="btn btn-rose" onClick="removeDiv(this)"><i class="material-icons">delete</i></button>';
        html+='</div>';
      html+='</div>';
    html+='</div>';
    
    // console.log(html);
    $(elem).parent("div").before(html);

}
function delete_Item(itemId=0,menuId=0) {
    if (confirm("Do you really want to delete section?")) {
       location.href="<?= base_url('Menu_item/delete_item') ?>" +'/'+ itemId +'/'+ menuId;
    }
    return false;
}
function manage_status(obj,itemId=0,menuId=0) {
    if($(obj). is(":checked")){ 
        location.href="<?= base_url('Menu_item/manage_status') ?>" +'/'+ itemId +'/'+ menuId +'/Yes';
    }
    else {
        location.href="<?= base_url('Menu_item/manage_status') ?>" +'/'+ itemId +'/'+ menuId +'/No';
    }
    return false;
}
</script>