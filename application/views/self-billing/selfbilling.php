<?php $this->load->view('comman/header'); ?>
<?php $this->load->view('comman/sidebar'); ?>

<style>
.table-container {
height: 193px;
}
.table-container table {
    display: flex;
    flex-flow: column;
    height: 100%;
    width: 100%;
}
.table-container table thead {
    /* head takes the height it requires, 
    and it's not scaled when table is resized */
    flex: 0 0 auto;
    width: calc(100% - 0.9em);
}
.table-container table tbody {
    /* body takes all the remaining available space */
    flex: 1 1 auto;
    display: block;
    overflow-y: scroll;
}
.table-container table tbody tr {
    width: 100%;
}
.table-container table thead,
.table-container table tbody tr {
    display: table;
    table-layout: fixed;
}

.table-container table {
    border: 1px solid lightgrey;
}
.table-container table td, .table-container table th {
    padding: 0.3em;
    border: 1px solid lightgrey;
}
.table-container table th {
    border: 1px solid grey;
}
</style>
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
                                    <label class="col-sm-1 label-on-left">Name</label>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating is-empty has-success">
                                            <label class="control-label"></label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <label class="col-sm-1 label-on-left">Mobile No.</label>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating is-empty has-success">
                                            <label class="control-label"></label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-1 label-on-left">Address</label>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating is-empty has-success">
                                            <label class="control-label"></label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">Delivery
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">Pick Up
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">Dine In
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <label class="col-sm-1 label-on-left">Item</label>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating is-empty has-success">
                                            <label class="control-label"></label>
                                            <input type="text" class="form-control" value="" id="item">
                                            <ul class= "list-group" id="suggestion">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 label-on-left">Special Note</label>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating is-empty has-success">
                                            <label class="control-label"></label>
                                            <input type="text" class="form-control" value="" id="specialNote">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Special Note</th>
                                                <th>Qty.</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>content1</td>
                                                <td>content2</td>
                                                <td>content3</td>
                                                <td>content4</td>
                                                <td>content4</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
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
                $("#suggestion").html(data);
            }
        })
    }

    function getItems(getItems) 
    {
        console.log(getItems);
    }

    $("#item").keyup(function(){
        let itemText = $("#item").val();
        getMenuItems(itemText);
    });
    
</script>
