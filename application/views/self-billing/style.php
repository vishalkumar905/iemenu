<style>
    .table-container {
        height: 350px;
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
        padding: 12px 8px;
        border: 1px solid #ccc;
    }

    .table-container table tr th {
        width: auto !important;
    }
    
    #suggestion {
        z-index: 99;
        position: absolute;
        max-width: 300px;
        max-height: 294px;
        overflow-y: auto;
    }
</style>