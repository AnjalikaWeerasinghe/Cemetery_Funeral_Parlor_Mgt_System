<style>
    body{
        background:#f4f6fb;
    }

    .card{
        border-radius:18px;
    }

    .table{
        margin-bottom:0;
    }

    .table thead{
        background:#1f2937;
        color:white;
    }

    .table thead th{
        border:none;
        font-weight:600;
        padding:18px;
    }

    .table tbody td{
        padding:18px;
        vertical-align:middle;
        border-color:#eef2f7;
    }

    .table tbody tr{
        transition:.25s;
    }

    .table tbody tr:hover{
        background:#f8fbff;
        transform:scale(1.002);
    }

    .search-box{
        width:260px;
        padding-left:40px;
        border-radius:30px;
    }

    .search-icon{
        position:absolute;
        left:15px;
        top:50%;
        transform:translateY(-50%);
        color:#999;
    }

    .btn-primary{
        border-radius:10px;
        padding:10px 18px;
        font-weight:600;
    }

    .btn-group .btn{
        margin-right:4px;
        border-radius:10px !important;
    }

    .table-responsive{
        border-radius:18px;
    }

    .icon-circle{
        width:55px;
        height:55px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        color:white;
        font-size:22px;
    }

    .bg-primary{
        background:#4f46e5!important;
    }

    .bg-success{
        background:#10b981!important;
    }

    .bg-warning{
        background:#f59e0b!important;
    }

    .bg-info{
        background:#06b6d4!important;
    }
</style>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between mb-3">

        <input type="text" id="searchItems" class="form-control w-50" placeholder="Search items...">

        <button class="btn btn-gold addItemBtn">
            <i class="fa fa-plus me-2"></i>Add New Item
        </button>

    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table">
                <table id="inventoryTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="160">Item Code</th>
                            <th>Item Name</th>
                            <th>Unit Type</th>
                            <th>Description</th>
                            <th width="140">Item Status</th>
                            <th width="170" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="inventory_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div id="itemModalContainer"></div>

<script>
    $(document).ready(function() {
        loadItems();

        function loadItems(search = ""){
            $.ajax({
                url: "../routes/inventory/view_item_route.php",
                type: "GET",
                data: {search: search},
                success: function(data){
                    if ($.fn.DataTable.isDataTable("#inventoryTable")) {
                        $("#inventoryTable").DataTable().destroy();
                    }

                    $("#inventory_data").html(data);

                    $("#inventoryTable").DataTable({
                        pageLength: 10,
                        dom: "rtip", // Remove the default search box
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        info: false,
                        responsive: true
                    });

                    var table = $("#inventoryTable").DataTable();

                    $("#searchItems").on("keyup", function(){
                        table.search(this.value).draw();
                    });
                }
            });
        }

        $(document).on("click", ".addItemBtn", function(){
            $("#itemModalContainer").load("inventory/add_item.php", function () {
                $("#addItemModal").modal("show");
            });
        });

    })
</script>