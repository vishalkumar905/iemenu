<style>

    .width60 {
        width: 60%;
    }
    .width5 {
        width: 5% !important;
    }
    .table-container {
        height: 300px;
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
        width: calc(100% - 1.21em);
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
    .table-container table tbody  {
        width: 100%;
        border-bottom: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-left: 1px solid #ccc;
    }
    
    .table-container table thead,
    .table-container table tbody tr {
        display: table;
        table-layout: fixed;
    }

    .table-container table td, .table-container table th {
        padding: 8px 8px;
        border: 1px solid #ccc;
    }

    .table-container table tr th {
        width: auto !important;
    }
    
    #suggestion {
        z-index: 99;
        position: absolute;
        max-width: 300px;
        max-height: 254px;
        overflow-y: auto;
    }

    #suggestion li {
        cursor: pointer;
    }

    .displaynone {
        display: none;
    }

    .pointer
    {
        cursor: pointer;
    }

    .customTableHead .table > tbody > tr > td
    {
        padding: 5px 8px !important;
        font-size: 14px;
    }

    .checkbox-inline, .radio-inline
    {
        padding-left: 0px;
    }
    
    .box{
        color: #fff;
        padding: 10px;
        display: none;

    }

    .td-underline  {
        text-decoration:underline;
        cursor:pointer;
        color:blue;
    }

    .width30 {
        width: 30% !important;
    }

    .tableFixHead { overflow-y: auto; overflow-x: auto; height: 300px;  border: 1px solid #ccc;}
    .tableFixHead thead th { position: sticky; top: 0; white-space: nowrap; }

    .tableFixHead table { border-collapse: collapse; width: 100%; }
    .tableFixHead th     { background:#eee; }

    .pt-3 { padding-top: 3px !important;} 
    .pb-3 { padding-bottom: 3px !important;}
    @media (min-width: 768px)
    {        
        .modal-sm {
            width: 300px !important;
        }
    }

    .textunderline { 
		text-decoration: underline;
		color: blue !important;
		cursor: pointer;
	}

	ul.partialPaymentMethods li {
		width: 18%;
		padding: 10px;
		border: 1px solid #ccc;
		margin: 4px;
		background-color: #ccc;
		color: #000;
		font-weight: bold;
		border-radius: 5px;
		cursor: pointer;
        display: inline-block;
	}

    ul.partialPaymentMethods {
		padding: 0;
	}
	#partialPaymentMethodSummary ul li {
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 4px;
        color: #000;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        list-style-type: none;
        width: 20%;
        text-align: left;
        display: inline-block;
        margin-left: 5px;
	}

    #partialPaymentMethodSummary {
        padding-top: 20px;
    }

	ul.partialPaymentMethods li:hover
	{
		box-shadow: 0 0 0 1px rgb(0 0 0 / 20%);
    	transition: all 200ms ease-out;	
	}

    .totalOrderPriceView {
        font-size:  25px;
        font-weight:  bold;
    }
    
	#partialPaymentMethodsModal .form-control {
		width: 100%;
	}

	#partialPaymentMethodsModal input[type=number] {
		all: revert;
	}

	.removeSplitPaymentMethod {
		float: right;
		width: 20px;
		text-align: center;
		background-color: #ccc;
		border-radius: 10px;
	}
	
    .partialPaymentMethodSummary {
        text-align: center;
    }

    .partialPaymentMethodSummary {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .partialPaymentMethodSummary li {
        list-style-type: none;
    }
</style>