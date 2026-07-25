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

    .booking-stat-card{
        border-radius:18px;
        transition:0.3s ease;
    }


    .booking-stat-card:hover{
        transform:translateY(-5px);
    }


    .icon-circle{
        width:55px;
        height:55px;

        border-radius:50%;

        display:flex;
        align-items:center;
        justify-content:center;

        font-size:22px;

    }
</style>

<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-calendar text-primary me-2"></i>Funeral Bookings</h3>
                <p class="text-muted mb-0">Manage all funeral bookings in the cemetery system.</p>
            </div>

            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchBookings" class="form-control search-box" placeholder="Search Bookings...">
                </div>

                <a href="admin.php?page=selectbookingtype" class="btn btn-primary shadow-sm addBookingBtn">
                    <i class="fa-regular fa-calendar"></i> Add New Booking
                </a>
            </div>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm booking-stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total Bookings</small>
                            <h2><div class="fw-bold mt-2 mb-0" id="totalBookings">0</div></h2>
                        </div>
                        <div class="icon-circle bg-primary-subtle text-primary"><i class="fa-solid fa-calendar-days"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm booking-stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Pending Approvals</small>
                            <h2><div class="fw-bold mt-2 mb-0 text-warning" id="pendingBookings">0</div></h2>
                        </div>
                        <div class="icon-circle bg-warning-subtle text-warning"><i class="fa-solid fa-clock"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm booking-stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Approved</small>
                            <h2><div class="fw-bold mt-2 mb-0 text-success" id="approvedBookings">0</div></h2>
                        </div>
                        <div class="icon-circle bg-success-subtle text-success"><i class="fa-solid fa-circle-check"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm booking-stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Cancelled</small>
                            <h2><div class="fw-bold mt-2 mb-0 text-danger" id="cancelledBookings">0</div></h2>
                        </div>
                        <div class="icon-circle bg-danger-subtle text-danger"><i class="fa-solid fa-circle-xmark"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div id="bookingTable" class="table">
                <table id="funeralBookingTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>Deceased Name</th>
                            <th>Date of Death</th>
                            <th>Applicant Name</th>
                            <th>Contact Number</th>
                            <th>Service Type</th>
                            <th>Booking Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="booking_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="plotModal">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Allocated Plot Details</h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="plotDetails">
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        loadBookings();
        loadBookingDashboardStats();

        function loadBookings(search = "") {
            $.ajax({
                url: '../routes/funeral_booking/view_booking_route.php',
                method: 'GET',
                data: { search: search },
                success: function(data) {
                    if ($.fn.DataTable.isDataTable("#funeralBookingTable")) {
                        $("#funeralBookingTable").DataTable().destroy();
                    }

                    $('#booking_data').html(data);

                    $("#funeralBookingTable").DataTable({
                        pageLength: 10,
                        dom: "rtip", // Remove the default search box
                        lengthMenu: [5, 10, 25, 50],
                        ordering: true,
                        searching: true,
                        info: false,
                        responsive: true
                    });

                    var table = $("#funeralBookingTable").DataTable();

                    $("#searchBookings").on("keyup", function(){
                        table.search(this.value).draw();
                    });
                },
                error: function() {
                    showError('Failed to load bookings.');
                }
            });
        }

        function loadBookingDashboardStats(){

            $.get("../routes/funeral_booking/get_booking_dashboard_stats_route.php", function(res){

                let data = JSON.parse(res);

                $("#totalBookings").text(data.total_bookings);
                $("#pendingBookings").text(data.pending_bookings);
                $("#approvedBookings").text(data.approved_bookings);
                $("#cancelledBookings").text(data.cancelled_bookings);

            });

        }

        $(document).on("click", ".edit", function(e){
            e.preventDefault();

            let id = $(this).data("id");

        })

        $(document).on("click", ".view", function(e){
            
        })

        $(document).on("click",".approveBooking",function(){
            let funeral_service_id=$(this).data("id");

            Swal.fire({
                title: "Confirm this booking?",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Yes, Confirm"
            }).then((result)=>{

                if(result.isConfirmed){
                    $.ajax({
                        url: "../routes/funeral_booking/approve_booking_route.php",
                        method: "POST",
                        data: {
                            funeral_service_id:funeral_service_id
                        },
                        dataType: "json",
                        success:function(response){
                            showSuccess(response.message);

                            loadBookings();
                        },
                        error:function(xhr){
                            console.log(xhr.responseText);
                        }

                    });

                }

            });
        });

        $(document).on("click",".rejectBooking",function(){
            let funeral_service_id=$(this).data("id");

            Swal.fire({
                title: "Cancel this booking?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Cancel"
            }).then((result)=>{

                if(result.isConfirmed){
                    $.ajax({
                        url: "../routes/funeral_booking/reject_booking_route.php",
                        method: "POST",
                        data: {
                            funeral_service_id:funeral_service_id
                        },
                        dataType: "json",
                        success:function(response){
                            showSuccess(response.message);

                            loadBookings();
                        },
                        error:function(xhr){
                            console.log(xhr.responseText);
                        }
                    });

                }

            });

        });

        $(document).on("click", ".allocatePlot", function () {
            console.log("Allocate button clicked");

            let funeralServiceId = $(this).data("id");

            console.log("Funeral Service ID:", funeralServiceId);

            $("#root").load("funeral_booking/burial_plot_allocation.php?funeral_service_id=" + funeralServiceId,
                function(response, status, xhr){
                    console.log("Load status:", status);
                    if(status === "error"){
                        console.log("Error:", xhr.status, xhr.statusText);
                    }
                }

            );
            
        });

        $(document).on("click",".viewPlot",function(){
            let plotId = $(this).data("id");

            console.log("Plot ID:", plotId);

            $.post("../routes/funeral_booking/burial_plot/view_allocated_plot_route.php",
                {
                    plot_id: plotId
                },
                function(response){
                    $("#plotDetails").html(response);
                    $("#plotModal").modal("show");
                }
            );

        });

        $(document).on("click", ".completeBooking", function () {

            let bookingId = $(this).data("id");

            Swal.fire({
                title: "Mark as Completed?",
                text: "This booking will be marked as completed.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, Complete",
                confirmButtonColor: "#198754"
            }).then((result) => {

                if(result.isConfirmed){

                    $.ajax({
                        url: "../routes/funeral_booking/complete_booking_route.php",
                        type: "POST",
                        data: {
                            funeral_service_id: bookingId
                        },
                        success: function(response){

                            Swal.fire(
                                "Completed!",
                                "Booking marked as completed.",
                                "success"
                            ).then(() => {
                                location.reload();
                            });

                        }
                    });

                }

            });

        });

    });
</script>