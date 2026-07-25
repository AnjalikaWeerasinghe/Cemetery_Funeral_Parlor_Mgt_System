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

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-users text-primary me-2"></i>Supplier Management</h3>
                <p class="text-muted mb-0">Manage all registered suppliers of the cemetery system.</p>
            </div>

            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchSupplier" class="form-control search-box" placeholder="Search suppliers...">
                </div>

                <a class="btn btn-primary shadow-sm addSupplierBtn">
                    <i class="fa-solid fa-user-plus me-2"></i>Add Supplier
                </a>
            </div>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Total Suppliers</small>
                            <h2><div class="fw-bold mt-2" id="totalSuppliers">0</div></h2>
                        </div>
                        <div class="icon-circle bg-primary"><i class="fa-solid fa-users"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Active</small>
                            <h2><div class="fw-bold mt-2 text-success" id="activeSuppliers">0</div></h2>
                        </div>
                        <div class="icon-circle bg-success"><i class="fa-solid fa-user-check"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Inactive</small>
                            <h2><div class="fw-bold mt-2 text-warning" id="inactiveSuppliers">0</div></h2>
                        </div>
                        <div class="icon-circle bg-warning"><i class="fa-solid fa-user-slash"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">New This Month</small>
                            <h2><div class="fw-bold mt-2 text-info" id="newSuppliers">0</div></h2>
                        </div>
                        <div class="icon-circle bg-info"><i class="fa-solid fa-user-plus"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table">
                <table id="supplierTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="160">Supplier Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="140">Status</th>
                            <th width="170" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="supplier_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        loadSuppliers();
        loadSupplierDashboardStats();
        
        function loadSuppliers(search = ""){
            $.ajax({
                url: "../routes/supplier/view_supplier_route.php",
                type: "GET",
                data: {search: search},
                success: function(data){
                    if ($.fn.DataTable.isDataTable("#supplierTable")) {
                        $("#supplierTable").DataTable().destroy();
                    }

                    $("#supplier_data").html(data);

                    $("#supplierTable").DataTable({
                        pageLength: 10,
                        dom: "rtip", // Remove the default search box
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        info: false,
                        responsive: true
                    });

                    var table = $("#supplierTable").DataTable();

                    $("#searchSupplier").on("keyup", function(){
                        table.search(this.value).draw();
                    });
                }
            });
        }

        $(document).on("click", ".addSupplierBtn", function(){
            $("#root").load("supplier/supplier_add.php");
        });

        $(document).on("click", ".view", function() {
            let supplierId = $(this).data("id");

            $("#root").load("supplier/supplier_view.php?supplier_id=" + supplierId);
        })

        $(document).on("click", ".edit", function(e){
            e.preventDefault();

            let id = $(this).data("id");

            $("#root").load("supplier/supplier_edit.php?supplier_id=" + id, function(){

                $.ajax({
                    url: "../routes/supplier/get_supplier_route.php",
                    type: "GET",
                    data: { supplier_id: id },
                    dataType: "json",

                    success: function(response){

                        $("#supplier_id").val(response.supplier_id);
                        $("#supplier_code").text(response.supplier_code);

                        $("#supplier_name").val(response.supplier_name);
                        $("#contact_person").val(response.contact_person);
                        $("#contact_number").val(response.contact_number);
                        $("#address").val(response.address);

                        $("#email").val(response.email);
                        $("#registration_number").val(response.registration_number);
                        $("#supplier_status").val(response.supplier_status);

                        $("button[type='submit']").text("Update Supplier");
                    },

                    error: function(xhr){
                        console.log("AJAX ERROR:", xhr.responseText);
                    }
                });

            });

        });

        $(document).on("click", ".supplier-status", function () {

            let btnId = $(this).attr("id");
            let status = $(this).data("status");
            let supplierName = $(this).data("name");

            let action = (status === "Active") ? "activate" : "deactivate";

            Swal.fire({
                title: "Are you sure?",
                html: `Do you want to ${action} the account of <br><b>${supplierName}</b>?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: status === "Active" ? "#198754" : "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, " + action + "!",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then((result) => {

                if(result.isConfirmed) {

                    $.post("../routes/supplier/activatedeactivate_supplier_route.php", {
                        id: btnId,
                        status: status
                    }, function (response) {
                        response = response.trim();

                        if (response === "success") {

                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                html: `<b>${supplierName}</b> has been ${action}d successfully.`,
                                confirmButtonColor: "#198754",
                                timer: 3500,
                                showConfirmButton: false
                            }).then(() => {
                                loadSuppliers();
                                loadSupplierDashboardStats();
                            });

                            loadSuppliers();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Operation Failed",
                                text: "Something went wrong. Please try again.",
                                confirmButtonColor: "#d33"
                            });
                        }
                        
                    });

                }

            });

        });

        function loadSupplierDashboardStats(){

            $.post("../routes/supplier/get_supplier_dashboard_stats_route.php",
            function(data){
                
                data = JSON.parse(data);

                $("#totalSuppliers").html(data.total_suppliers);
                $("#activeSuppliers").html(data.active_suppliers);
                $("#inactiveSuppliers").html(data.inactive_suppliers);
                $("#newSuppliers").html(data.new_suppliers);

            });
        }
        
    });

</script>