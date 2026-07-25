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
        color:#fff;
    }

    .table thead th{
        border:none;
        padding:18px;
        font-weight:600;
    }

    .table tbody td{
        padding:18px;
        vertical-align:middle;
        border-color:#eef2f7;
    }

    .table tbody tr{
        transition:.2s ease;
    }

    .table tbody tr:hover{
        background:#f8fbff;
        transform:scale(1.002);
    }

    .btn-primary{
        border-radius:10px;
        font-weight:600;
    }

    .badge{
        padding:8px 12px;
        border-radius:20px;
    }

    .item-icon{
        width:38px;
        height:38px;
        border-radius:50%;

        background:#e8d9a3;
        color:#a8892f;

        display:flex;
        align-items:center;
        justify-content:center;
    }

    .stock-low{
        background:#fee2e2;
        color:#dc2626;
    }

    .stock-ok{
        background:#dcfce7;
        color:#16a34a;
    }
</style>


<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="searchInventory" class="form-control w-50" placeholder="Search inventory items...">

        <button class="btn btn-gold addInventoryBtn">
            <i class="fa fa-plus me-2"></i>Add Inventory Item
        </button>
    </div>

    <div class="card shadow border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0" id="inventoryTable">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Stock Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="inventory_data"></tbody>
                </table>

            </div>

        </div>

    </div>

</div>

<div id="inventoryModalContainer"></div>

<script>
    $(document).ready(function(){
        loadInventory();

        function loadInventory(search=""){

            $.ajax({
                url:"../routes/inventory/view_inventory_route.php",
                type:"GET",
                data:{
                    search:search
                },
                success:function(data){
                    if($.fn.DataTable.isDataTable("#inventoryTable")){
                        $("#inventoryTable").DataTable().destroy();
                    }

                    $("#inventory_data").html(data);

                    $("#inventoryTable").DataTable({
                        pageLength:10,
                        lengthMenu:[5,10,25,50],
                        dom:"rtip",
                        ordering:true,
                        searching:true,
                        info:false,
                        responsive:true
                    });

                    var table=$("#inventoryTable").DataTable();

                    $("#searchInventory").keyup(function(){
                        table.search(this.value).draw();
                    });

                }

            });
        }

        $(document).on("click",".addInventoryBtn",function(){

            $("#inventoryModalContainer").load("inventory/add_inventory.php",function(){
                $("#addInventoryModal").modal("show");
            });

        });

    });
</script>