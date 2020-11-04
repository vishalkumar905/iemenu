<?php $this->load->view('comman/header'); ?>
<?php $this->load->view('comman/sidebar'); ?>
<?php $this->load->view('self-billing/style'); ?>


<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="get" action="" class="form-horizontal">
                            <div class="card-header card-header-text" data-background-color="rose">
                                <h4 class="card-title">Generate Bill</h4>
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Customer Name</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Mobile No</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType">Delivery
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType">Pick Up
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="orderType">Dine In
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
                                                <th colspan="2">
                                                    <input type="text" style="width:100%"  id="item" placeholder="Search Items"/>
                                                    <ul class= "list-group" id="suggestion"></ul>
                                                </th>
                                                <th colspan="3"><input type="text" style="width:100%" id="specialNote" placeholder="Special Note"/></th>
                                            </tr>
                                        
                                            <tr>
                                                <th>Item</th>
                                                <th>Special Note</th>
                                                <th>Qty.</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-right">Total Qty.</td>
                                                <td class="text-right">1</td>
                                                <td class="text-right">Sub Total</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Total(&#x20B9;)</td>
                                                <td>738</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Delivery Charge</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Container Charge</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Round off</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Grand Total(&#x20B9;</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Customer Paid</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">Return to Customer</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                    data.push('<li class="list-group-item" onclick="getItems('+ items[i] +')">'+ items[i].name +'</li>');
                }
                $("#suggestion").html(data).show();
            }
        })
    }

    function getItems(getItems) 
    {
        console.log(getItems);
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
    
</script>
