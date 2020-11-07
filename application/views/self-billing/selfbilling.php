<?php $this->load->view('comman/header'); ?>
<?php $this->load->view('comman/sidebar'); ?>
<?php $this->load->view('self-billing/style'); ?>


<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form class="form-horizontal">
                            <div class="card-header card-header-text" data-background-color="rose">
                                <h4 class="card-title">Self Billing</h4>
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Customer Name</label>
                                                <input type="text" class="form-control" value="" name="customerName" id="customerName">
                                            <div id="nameError" class="alert alert-danger displaynone" role="alert">
                                                <span aria-hidden="true"></span> Please enter customer name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Mobile No</label>
                                                <input type="text" class="form-control" value="" name="mobieNumber" id="mobieNumber">
                                            <div id="mobileErr" class="alert alert-danger displaynone" role="alert">
                                                <span aria-hidden="true"></span> Please enter mobile number
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                                <input type="text" class="form-control" value="" name="address" id="address">
                                            <div id="addressErr" class="alert alert-danger displaynone" role="alert">
                                                <span aria-hidden="true"></span> Please enter address
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType" value="Delivery" checked="checked">Delivery
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType" value="Pick Up">Pick Up
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType" value="Dine In">Dine In
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                </br></br>
                                <div class="table-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="3">
                                                    <input type="text" style="width:100%"  id="item" placeholder="Search Items"/>
                                                    <ul class= "list-group" id="suggestion"></ul>
                                                </th>
                                                <th colspan="3"><input type="text" style="width:100%" id="specialNote" placeholder="Special Note"/></th>
                                            </tr>
                                        
                                            <tr>
                                                <th>Item</th>
                                                <th>Item Type</th>
                                                <th>Special Note</th>
                                                <th>Qty.</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="menuItems">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-right" >Total Qty.</td>
                                                <td class="text-right"><span id="totalQty">1</span></td>
                                                <td class="text-right">Sub Total</td>
                                                <td><span id="subTotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Total(&#x20B9;)</td>
                                                <td><span id="total"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Delivery Charge</td>
                                                <td><input type="number" class="width60" min="0" value="0" id="deliveryCharge"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Container Charge</td>
                                                <td><input type="number" class="width60" min="0"  value="0" id="containerCharge"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Round off</td>
                                                <td><span id="roundOff"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Grand Total (&#x20B9;)</td>
                                                <td><span id="grandTotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Customer Paid</td>
                                                <td><input type="number" id="customerPaid" min="0" class="width60"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Return to Customer</td>
                                                <td><span id="customerReturn"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType">Card
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType">Due Payment
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType">Part Payment
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <button type="button" id="selfbilling" name="selfbilling" class="btn btn-rose pull-right">Add Self Billing</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('comman/footer'); ?>

<script>
    var selectedMenuItems = {};
    var baseUrl = "<?= base_url()?>";

    let getMenuItems = function(searchText) {
        $.ajax({
            url: baseUrl + 'Selfbilling/getMenuItems',
            type: 'GET',
            data: {'search': searchText},
            success: function(response) 
            {
                let items = response.items;
                let data = [];
                for(i=0; i < items.length; i++)
                {
                    data.push('<li class="list-group-item" id="items-'+ items[i].item_id +'" data-price="'+ items[i].price +'" data-menuid="'+ items[i].menu_id +'" data-itemType="'+ items[i].price_desc +'" data-tax="'+ items[i].taxes +'" data-name="'+ items[i].name +'" >'+ items[i].name +'</li>');
                }
                $("#suggestion").html(data).show();

                $("[id^=items-]").click(addItem); 
            }
        })
    }

    $("#item").keyup(function(){
        let itemText = $("#item").val();
        if (itemText) 
        {
            getMenuItems(itemText);
        }
        else
        {
            $("#suggestion").hide();
        }
    });

    let addItem = function() {
        let id = $(this).attr("id").split("-");
            id= id[1];
        let itemName = $(this).attr("data-name");
        let price = $(this).attr("data-price");
        let menuId = $(this).attr("data-menuid");
        let tax = $(this).attr("data-tax");
        let itemType = $(this).attr("data-itemType");
        let itemArray = itemType.split(",");
        let priceArray = price.split(",");

        if(selectedMenuItems[id])
        {
            return false;
        }

        selectedMenuItems[id] = {
            itemId: id,
            itemName: itemName,
            itemPrice: priceArray[0],
            itemType: itemArray[0],
            itemTax: tax,
            itemQty: 1,
            itemTotalAmount: priceArray[0]
        }

        $("#item").val(itemName);
        $("#suggestion").hide();
        
        
            
        let selectBox = "<select id='itemType' name='item[itemType]["+ id +"]'>";  
        
        for(i=0; i < itemArray.length; i++) 
        {
            selectBox += "<option price='"+ priceArray[i] +"' itemid = '"+ id +"' value='"+ itemArray[i] +"'>"+ itemArray[i] +"</option>";
        }
        selectBox += "</select>";


        var itemData = "";
        itemData += "'<tr>";
        itemData += "<td>"+ itemName +" </td>";
        itemData += "<td>"+ selectBox +" </td>";
        itemData += "<td><span itemid='"+ id +"' id='item[itemNote]["+ id +"]'></span></td>";
        itemData += "<td> <input type='number' min='1' value='1' itemid='"+ id +"' class='width60' name='item[qty]["+ id +"]'> </td>";
        itemData += "<td><span itemid='"+ id +"' id='item[price]["+ id +"]'> "+ priceArray[0] +" </span></td>";
        itemData += "<td><span itemid='"+ id +"' id='item[totalPrice]["+ id +"]'> "+ priceArray[0] +" </span></td>";
        itemData += "</tr>'"

        $("#menuItems").append(itemData);
        
        calculateOrderTotal();

        $("select[name^='item[itemType]']").change(function() {
            
            let itemType = $(this).val();
            let selectedItem = $(this).find(':selected');
            let itemId = selectedItem.attr('itemid');
            let itemPrice = selectedItem.attr('price');
            let itemQty = $("input[name='item[qty]["+ itemId +"]']").val();
            let totalAmount = itemPrice * itemQty;

            $("span[id='item[price]["+ itemId +"]']").text(itemPrice);
            $("span[id='item[totalPrice]["+ itemId +"]']").text(totalAmount);

            selectedMenuItems[id].itemPrice = itemPrice;
            selectedMenuItems[id].itemType = itemType;
            selectedMenuItems[id].itemTotalAmount = totalAmount;
            calculateOrderTotal();
        });

        $("input[name^='item[qty]']").change(function() {
            let itemId = $(this).attr('itemid');
            let qty = $(this).val();
            let selectedItem = $("select[name='item[itemType]["+ itemId +"]']").find(':selected');
            let price = selectedItem.attr('price');
            let totalAmount = price * qty;

            $("span[id='item[totalPrice]["+ itemId +"]']").text(totalAmount);

            selectedMenuItems[id].itemQty = qty;
            selectedMenuItems[id].itemTotalAmount = totalAmount;
            calculateOrderTotal();
        });
    }

    var calculateOrderTotal = function() {
        let totalItemsPrice = 0;
        let totalQty = 0;
        let deliveryCharge = Number($("#deliveryCharge").val());
        let containerCharge = Number($("#containerCharge").val());

        for(let item in selectedMenuItems)
        {
            let menuItem = selectedMenuItems[item];
            totalItemsPrice = totalItemsPrice + (Number(menuItem.itemQty) * Number(menuItem.itemPrice));
            totalQty = totalQty + Number(menuItem.itemQty);
        }

        let totalOrderAmount = totalItemsPrice + deliveryCharge + containerCharge;

        $("#subTotal").text(totalItemsPrice);
        $("#total").text(totalItemsPrice);
        $("#totalQty").text(totalQty);
        $("#grandTotal").text(totalOrderAmount);
        $("#roundOff").text(totalOrderAmount);
    }

    $("#deliveryCharge").keyup(calculateOrderTotal);

    $("#containerCharge").keyup(calculateOrderTotal); 
    
    $("#selfbilling").click(function() {
        let customerName = $("#customerName").val();
        let address = $("#address").val();
        let mobieNumber = $("#mobieNumber").val();
        let orderType = $("input[name='orderType']:checked").val();

        if(customerName == "")
        {
            $("#nameError").show();
        }
        else
        {
            $("#nameError").hide();
        }

        if(address == "")
        {
            $("#addressErr").show();
        }
        else 
        {
            $("#addressErr").hide();
        }

        if(mobieNumber == "")
        {
            $("#mobileErr").show();
        }
        else
        {
            $("#mobileErr").hide();
        }

        let data = {
            customerName: customerName,
            address: address,
            mobile: mobieNumber,
            orderType: orderType,
            selectedItem: selectedMenuItems
        };

        $.ajax({
            url: baseUrl + 'Selfbilling/saveSelfBilling',
            type: "POST",
            data: data,
            cache: false,
            success: function(response) {
                if(response.status == "success")
                {
                    alert(response.msg);
                    location.reload();
                }
            }
        })
    });

</script>
