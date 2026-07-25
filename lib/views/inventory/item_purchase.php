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
        padding:18px;
        font-weight:600;
    }

    .table tbody td{
        padding:18px;
        vertical-align:middle;
    }

    .table tbody tr:hover{
        background:#f8fbff;
    }

    .search-box{
        width:260px;
        padding-left:40px;
        border-radius:30px;
    }

    .btn{
        border-radius:10px;
        font-weight:600;
    }
</style>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between mb-3">

        <input type="text" id="searchPurchase" class="form-control w-50" placeholder="Search purchase orders...">
        
        <button class="btn btn-gold addPurchaseBtn" id="addPurchaseBtn">
            <i class="fa fa-plus me-2"></i>Create Purchase Order
        </button>

    </div>

    <div class="card shadow border-0">

        <div class="card-body p-0">

            <div class="table-responsive">
                <table id="purchaseTable" class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Purchase Code</th>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="purchase_data"></tbody>
                </table>
            </div>

        </div>

    </div>

</div>

<div id="purchaseModalContainer"></div>

<script>
    $(document).ready(function() {
        loadPurchases();

        function loadPurchases(search = ""){
            $.ajax({
                url: "../routes/inventory/view_purchase_route.php",
                type: "GET",
                data: {search: search},
                success: function(data){
                    if ($.fn.DataTable.isDataTable("#purchaseTable")) {
                        $("#purchaseTable").DataTable().destroy();
                    }

                    $("#purchase_data").html(data);

                    $("#purchaseTable").DataTable({
                        pageLength: 10,
                        dom: "rtip", // Remove the default search box
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        info: false,
                        responsive: true
                    });

                    var table = $("#purchaseTable").DataTable();

                    $("#searchPurchase").on("keyup", function(){
                        table.search(this.value).draw();
                    });
                }
            });
        }

        $(document).on("click", ".addPurchaseBtn", function(){
            $("#purchaseModalContainer").load("inventory/add_purchase.php", function () {
                $("#addPurchaseModal").modal("show");
            });
        });

    })
</script>