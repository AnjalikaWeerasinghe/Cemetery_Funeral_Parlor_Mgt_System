.<style>
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
                <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-users text-primary me-2"></i>Staff Management</h3>
                <p class="text-muted mb-0">Manage all registered staff members of the cemetery system.</p>
            </div>

            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchStaff" class="form-control search-box" placeholder="Search staff members...">
                </div>

                <a class="btn btn-primary shadow-sm addStaffBtn">
                    <i class="fa-solid fa-user-plus me-2"></i>Add New Staff Member
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
                            <small class="text-muted">Total Staff Members</small>
                            <h2><div class="fw-bold mt-2" id="totalStaffMembers">0</div></h2>
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
                            <h2><div class="fw-bold mt-2 text-success" id="activeStaffMembers">0</div></h2>
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
                            <h2><div class="fw-bold mt-2 text-warning" id="inactiveStaffMembers">0</div></h2>
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
                            <h2><div class="fw-bold mt-2 text-info" id="newStaffMembers">0</div></h2>
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
                <table id="staffTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Staff Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="emp_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function(){
        loadStaffMemberDashboardStats();
        loadStaffMembers();

        $(document).on("click", ".addStaffBtn", function(){
            $("#root").load("emp/emp_add.php");
        });

        function loadStaffMemberDashboardStats(){

            $.post("../routes/emp/get_emp_dashboard_stats_route.php",
            function(data){
                
                data = JSON.parse(data);

                $("#totalStaffMembers").html(data.total_staffmembers);
                $("#activeStaffMembers").html(data.active_staffmembers);
                $("#inactiveStaffMembers").html(data.inactive_staffmembers);
                $("#newStaffMembers").html(data.new_staffmembers);

            });
        }

        function loadStaffMembers(search = ""){
            $.ajax({
                url: "../routes/emp/view_emp_route.php",
                type: "GET",
                data: {search: search},
                success: function(data){
                    if ($.fn.DataTable.isDataTable("#staffTable")) {
                        $("#staffTable").DataTable().destroy();
                    }

                    $("#emp_data").html(data);

                    $("#staffTable").DataTable({
                        pageLength: 10,
                        dom: "rtip", // Remove the default search box
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        info: false,
                        responsive: true
                    });

                    var table = $("#staffTable").DataTable();

                    $("#searchStaff").on("keyup", function(){
                        table.search(this.value).draw();
                    });
                }
            });
        }

    });
    
    $(document).ready(function(){
        $.get('../routes/emp/view_emp_route.php', function(data){

            $("#emp_data").html(data);

            $(".edit").click(function(){
                
            })


        })
    });
</script>