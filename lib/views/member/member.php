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
                <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-users text-primary me-2"></i>Member Management</h3>
                <p class="text-muted mb-0">Manage all registered members of the cemetery system.</p>
            </div>

            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchMember" class="form-control search-box" placeholder="Search members...">
                </div>

                <a class="btn btn-primary shadow-sm addMemberBtn">
                    <i class="fa-solid fa-user-plus me-2"></i>Add Member
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
                            <small class="text-muted">Total Members</small>
                            <h2><div class="fw-bold mt-2" id="totalMembers">0</div></h2>
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
                            <h2><div class="fw-bold mt-2 text-success" id="activeMembers">0</div></h2>
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
                            <h2><div class="fw-bold mt-2 text-warning" id="inactiveMembers">0</div></h2>
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
                            <h2><div class="fw-bold mt-2 text-info" id="newMembers">0</div></h2>
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
                <table id="memberTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="160">Member Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="140">Status</th>
                            <th width="170" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="member_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        loadMembers();
        loadMemberDashboardStats();

        function loadMembers(search = ""){
            $.ajax({
                url: "../routes/member/view_member_route.php",
                type: "GET",
                data: {search: search},
                success: function(data){
                    if ($.fn.DataTable.isDataTable("#memberTable")) {
                        $("#memberTable").DataTable().destroy();
                    }

                    $("#member_data").html(data);

                    $("#memberTable").DataTable({
                        pageLength: 10,
                        dom: "rtip", // Remove the default search box
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        info: false,
                        responsive: true
                    });

                    var table = $("#memberTable").DataTable();

                    $("#searchMember").on("keyup", function(){
                        table.search(this.value).draw();
                    });
                }
            });
        }

        $(document).on("click", ".member-status", function () {

            let btnId = $(this).attr("id");
            let status = $(this).data("status");
            let memberName = $(this).data("name");

            let action = (status === "Active") ? "activate" : "deactivate";

            Swal.fire({
                title: "Are you sure?",
                html: `Do you want to ${action} the account of <br><b>${memberName}</b>?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: status === "Active" ? "#198754" : "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, " + action + "!",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then((result) => {

                if(result.isConfirmed) {

                    $.post("../routes/member/activatedeactivate_member_route.php", {
                        id: btnId,
                        status: status
                    }, function (response) {
                        response = response.trim();

                        if (response === "success") {

                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                html: `<b>${memberName}</b> has been ${action}d successfully.`,
                                confirmButtonColor: "#198754",
                                timer: 3500,
                                showConfirmButton: false
                            }).then(() => {
                                loadMembers();
                                loadMemberDashboardStats();
                            });

                            loadMembers();
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

        $(document).on("click", ".addMemberBtn", function(){
            $("#root").load("member/member_add.php");
        });

        $(document).on("click", ".view", function() {
            let memberId = $(this).data("id");

            $("#root").load("member/member_view.php?member_id=" + memberId);
        })

        $(document).on("click", ".edit", function(e){
            e.preventDefault();

            let id = $(this).data("id");

            $("#root").load("member/member_edit.php?member_id=" + id, function(){

                $.ajax({
                    url: "../routes/member/get_member_route.php",
                    type: "POST",
                    data: { member_id: id },
                    dataType: "json",

                    success: function(response){

                        $("#member_id").val(response.member_id);
                        $("#first_name").val(response.first_name);
                        $("#middle_name").val(response.middle_name);
                        $("#last_name").val(response.last_name);
                        $("#nic").val(response.nic);
                        $("#gender").val(response.gender);
                        $("#date_of_birth").val(response.date_of_birth);
                        $("#contact_number").val(response.contact_number);
                        $("#address").val(response.address);
                        $("#email").val(response.email);
                        $("#member_status").val(response.member_status);
                        $("#member_code").val(response.member_code);

                        if(response.image){
                            $("#preview").html(`<img src="/Cemetery_Funeral_Parlor_Mgt_System/uploads/images/${response.image}" width="100">`);
                        }

                        $("button[type='submit']").text("Update Member");
                    },

                    error: function(xhr){
                        console.log("AJAX ERROR:", xhr.responseText);
                    }
                });

            });

        });

        function loadMemberDashboardStats(){

            $.post("../routes/member/get_member_dashboard_stats_route.php",
            function(data){
                
                data = JSON.parse(data);

                $("#totalMembers").html(data.total_members);
                $("#activeMembers").html(data.active_members);
                $("#inactiveMembers").html(data.inactive_members);
                $("#newMembers").html(data.new_members);

            });
        }
        
    });

</script>