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
</style>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="searchSupplierItems" class="form-control w-50" placeholder="Search supplier items...">
        <button class="btn btn-gold addSupplierItemBtn">
            <i class="fa fa-plus me-2"></i> Add Supplier Item
        </button>
    </div>

    <div class="card shadow border-0">

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="supplierItemTable">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Item Name</th>
                            <th>Unit Type</th>
                            <th>Unit Price</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="supplier_item_data"></tbody>
                </table>
            </div>

        </div>

    </div>

</div>

<div id="supplierItemModalContainer"></div>

<script>
    $(document).ready(function(){
        loadSupplierItems();

        function loadSupplierItems(search=""){

            $.ajax({
                url:"../routes/inventory/view_supplier_item_route.php",
                type:"GET",
                data:{search:search},
                success:function(data){
                    if($.fn.DataTable.isDataTable("#supplierItemTable")){
                        $("#supplierItemTable").DataTable().destroy();
                    }

                    $("#supplier_item_data").html(data);

                    $("#supplierItemTable").DataTable({
                        pageLength:10,
                        lengthMenu: [5, 10, 25, 50],
                        dom:"rtip",
                        ordering: true,
                        searching: true,
                        info:false,
                        responsive:true
                    });

                    var table=$("#supplierItemTable").DataTable();

                    $("#searchSupplierItems").keyup(function(){
                        table.search(this.value).draw();
                    });

                }

            });

        }

        $(document).on("click",".addSupplierItemBtn",function(){
            $("#supplierItemModalContainer").load("inventory/add_supplier_item.php",function(){
                $("#addSupplierItemModal").modal("show");
            });

        });

    });
</script>