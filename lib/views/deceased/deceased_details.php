<style>
    body{
        background:#f4f7fc;
    }

    .card{
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

    .search-box{
        width:350px;
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

.stats-card{
    border-radius:15px;
    transition:.3s;
}

.stats-card:hover{
    transform:translateY(-4px);
}

.table thead{
    background:#1f2937;
    color:white;
}

.table th{
    padding:15px;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:.5px;
}

.table td{
    vertical-align:middle;
}

.deceased-img{
    width:55px;
    height:55px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid #e5e7eb;
}

.badge-pending{
    background:#fff3cd;
    color:#856404;
}

.badge-approved{
    background:#dbeafe;
    color:#1d4ed8;
}

.badge-completed{
    background:#dcfce7;
    color:#166534;
}

.action-btn{
    width:35px;
    height:35px;
    border-radius:50%;
}

.card{
    border-radius:15px;
}
</style>

<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-users text-primary me-2"></i>Deceased Record Management</h3>
                <p class="text-muted mb-0">Manage and monitor all deceased information.</p>
            </div>

            <div class="d-flex align-items-center">
                <button class="btn btn-dark shadow-sm exportBtn">
                    <i class="fas fa-download me-2"></i>Export Report
                </button>
            </div>
                
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Total Records</small>
                            <h2><div class="fw-bold mt-2" id="totalDeceasedRecords">0</div></h2>
                        </div>
                        <div class="icon-circle bg-primary"><i class="fa-solid fa-user-alt"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Burials</small>
                            <h2><div class="fw-bold mt-2" id="burials">0</div></h2>
                        </div>
                        <div class="icon-circle bg-success"><i class="fa-solid fa-monument"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Cremations</small>
                            <h2><div class="fw-bold mt-2" id="cremations">0</div></h2>
                        </div>
                        <div class="icon-circle bg-warning"><i class="fa-solid fa-fire"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="row g-3">

                <div class="col-lg-4">
                    <div class="position-relative me-3">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchDeceased" class="form-control search-box" placeholder="Search by Name, NIC">
                    </div>
                </div>

                <div class="col-lg-3">
                    <select class="form-select" id="religionFilter" name="religion">
                        <option value="">All Religions</option>
                        <option value="Buddhism">Buddhist</option>
                        <option value="Catholic">Catholic</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Tamil">Tamil</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <select class="form-select" id="serviceTypeFilter" name="service_type">
                        <option value="">All Services</option>
                        <option value="Burial">Burial</option>
                        <option value="Cremation">Cremation</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <a href="admin.php?page=deceased" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>

            </div>

        </div>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-0">
            <div class="table">
                <table id="deceasedTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Gender</th>
                            <th>Date of Death</th>
                            <th>Service Type</th>
                            <th>Religion</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="deceased_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        loadDeceasedData();
        loadDeceasedDashboardStats();

        function loadDeceasedData(search = "", religion = "", service_type = "") {
            $.ajax({
                url: '../routes/deceased/deceased_details_route.php',
                method: 'GET',
                data: {
                    search: search,
                    religion: religion,
                    service_type: service_type
                },
                success: function(data) {
                    if ($.fn.DataTable.isDataTable("#deceasedTable")) {
                        $("#deceasedTable").DataTable().destroy();
                    }

                    $('#deceased_data').html(data);

                    $("#deceasedTable").DataTable({
                        pageLength: 10,
                        dom: "rtip", // Remove the default search box
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        info: false,
                        responsive: true,
                        language: {
                            emptyTable: "No deceased records found."
                        }
                    });

                    var table = $("#deceasedTable").DataTable();

                    $("#searchDeceased").on("keyup", function(){
                        table.search(this.value).draw();
                    });
                },
                error: function() {
                    showError('Failed to load deceased data.');
                }
            });
        }

        function loadDeceasedDashboardStats(){

            $.post("../routes/deceased/get_deceased_dashboard_stats_route.php",
            function(data){

                data = JSON.parse(data);

                $("#totalDeceasedRecords").html(data.total_deceased);
                $("#burials").html(data.total_burials);
                $("#cremations").html(data.total_cremations);

            });
            
        }

        $("#religionFilter, #serviceTypeFilter").on("change", function(){

            loadDeceasedData(
                $("#searchDeceased").val(),
                $("#religionFilter").val(),
                $("#serviceTypeFilter").val()
            );

        });

        $(document).on("click", ".view", function() {
            let bookingCode = $(this).data("id");

            $("#root").load("deceased/deceased_view.php?booking_code=" + bookingCode);
        })

        $(document).on("click", ".edit", function(e) {
            e.preventDefault();

            let bookingCode = $(this).data("id");

            $("#root").load("deceased/deceased_edit.php?booking_code=" + encodeURIComponent(bookingCode)); 

        })
    });

</script>