<style>
    body{
        background:#f4f6fb;
    }

    .card{
        border:none;
        border-radius:16px;
    }

    .table th{
        color:#6b7280;
        font-weight:600;
    }

    .plot-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(110px,1fr));
        gap:15px;
    }

    #plotContainer{
        display:grid;
        grid-template-columns:repeat(7, 1fr);
        gap:10px;
    }

    .plot-card{
        width:100%;
        height:120px;
        background:#fff;
        border-radius:10px;
        border:2px solid #ddd;
        padding:8px 5px;
        text-align:center;
        cursor:pointer;
        transition:.2s;
    }

    .plot-card:hover{
        transform:scale(1.05);
    }

    .plot-number{
        font-size:18px;
        font-weight:700;
        color:#333;
    }

    .plot-info small{
        font-size:10px;
        color:#777;
    }

    .plot-type{
        display: inline-block;
        margin-top: 5px;
        padding: 2px 8px;
        border-radius: 12px;
        background: #f1f3f5;
        font-size: 11px;
        font-weight: 600;
    }

    .plot-status{
        display:inline-block !important;
        margin-top:5px;
        padding:3px 8px;
        border-radius:12px;
        font-size:11px;
        font-weight:600;
        color:white !important;
    }

    .available{
        border-color: #28a745;
    }

    .available .plot-status{
        background:#28a745;
    }

    .reserved{
        border-color: #ffc107;
    }

    .reserved .plot-status{
        background:#ffc107;
        color:#212529 !important;
    }

    .occupied{
        border-color: #dc3545;
    }

    .occupied .plot-status{
        background:#dc3545;
    }

    .nav-pills .nav-link{
        border-radius:40px;
        margin-right:8px;
    }
    .nav-pills .nav-link.active{
        background:#d4af37;
    }
</style>

<?php
    $funeralServiceId = $_GET['funeral_service_id'] ?? null;
?>

<div class="container-fluid p-4">

    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">
                    <i class="fa-solid fa-map-location-dot text-warning"></i>Burial Plot Allocation
                </h3>

                <small class="text-muted">
                    Select an available burial plot for this booking.
                </small>
            </div>

            <input type="hidden" id="funeral_service_id" value="<?= $funeralServiceId ?>">
        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-file-lines text-primary"></i>Burial Details
                    </h5>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%">Booking Code</th>
                            <td id="bookingCode">-</td>
                        </tr>

                        <tr>
                            <th>Deceased</th>
                            <td id="deceasedName">-</td>
                        </tr>

                        <tr>
                            <th>Applicant</th>
                            <td id="applicantName">-</td>
                        </tr>

                        <tr>
                            <th>Burial Date</th>
                            <td id="burialDate">-</td>
                        </tr>

                        <tr>
                            <th>Grave Type</th>
                            <td id="graveType">-</td>
                        </tr>

                        <tr>
                            <th>Area Type</th>
                            <td id="areaType">-</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-warning">Pending Allocation</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-location-dot text-success"></i>Selected Plot
                    </h5>
                </div>

                <div class="card-body text-center">
                    <h2 id="selectedPlotNo" class="text-success">None</h2>
                    <div id="selectedSection">Select a plot</div>

                    <button class="btn btn-success w-100 mt-3" id="allocatePlotBtn" disabled>
                        <i class="fa-solid fa-check"></i>Allocate Plot
                    </button>
                </div>
            </div>

        </div>

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="searchPlot" placeholder="Search Plot Number">
                        </div>

                        <div class="col-md-5 text-end">
                            <span class="badge bg-success me-2">Available</span>
                            <span class="badge bg-warning text-dark me-2">Reserved</span>
                            <span class="badge bg-danger">Occupied</span>
                        </div>
                    </div>

                    <ul class="nav nav-pills mb-4" id="sectionTabs">
                    </ul>

                    <div class="plot-grid" id="availablePlots">
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function(){
        let funeralServiceId = $("#funeral_service_id").val();

        loadBookingDetails();
        loadAvailablePlots();
        loadSections();
        

        function loadBookingDetails(){

            $.post("../routes/funeral_booking/get_booking_details_route.php", {
                funeral_service_id:funeralServiceId
            },
            function(response){
                console.log(response);

                let data = JSON.parse(response);

                if(data.status == "error"){
                    Swal.fire("Error", data.message, "error");
                    return;
                }

                $("#bookingCode").text(data.booking_code);
                $("#deceasedName").text(data.deceased_name);
                $("#applicantName").text(data.applicant_name);
                $("#burialDate").text(data.burial_date);
                $("#graveType").text(data.grave_type);
                $("#areaType").text(data.area_type);

                $("#bookingStatus").html(
                    `<span class="badge bg-warning">${data.booking_status}</span>`
                );
            });

        }

        function loadAvailablePlots(sectionId){

            $.post("../routes/funeral_booking/get_available_plots_route.php", 
                {
                    section_id:sectionId
                },
                function(response){
                    $("#availablePlots").html(response);
                }
            );
        }

        function loadSections(){

            $.post("../routes/funeral_booking/get_burial_section_route.php", {},
                function(response){

                    $("#sectionTabs").html(response);
                    $(".section-tab").first().trigger("click");

                }
            );

        }

        $(document).on("click",".section-tab",function(){

            $(".section-tab").removeClass("active");

            $(this).addClass("active");

            let sectionId=$(this).data("id");

            loadAvailablePlots(sectionId);

        });

        $("#allocatePlotBtn").click(function(){

            let plotId = $(this).data("plot");

            Swal.fire({
                title: "Allocate this plot?",
                text: "This action will reserve the selected burial plot.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Allocate"
            }).then((result)=>{

                if(result.isConfirmed){

                    $.post("../routes/funeral_booking/allocate_plot_route.php", {
                            plot_id: plotId,
                            funeral_service_id: funeralServiceId
                        },
                        function(response){
                            console.log(response);
                            let data = JSON.parse(response);

                            if(data.status=="success"){
                                Swal.fire(
                                    "Allocated!",
                                    "Burial plot allocated successfully.",
                                    "success"
                                );

                                loadAvailablePlots();
                                loadBookingDetails();
                            }else{
                                Swal.fire(
                                    "Error",
                                    data.message,
                                    "error"
                                );
                            }
                        }
                    );

                }

            });

        });

        $(document).on("click",".plot-card.available",function(){

            $(".plot-card").removeClass("active");

            $(this).addClass("active");

            let plotId = $(this).data("id");
            let plotNo = $(this).data("plot");
            let section = $(this).data("section");

            $("#selectedPlotNo").text(plotNo);
            $("#selectedSection").text("Section : " + section);

            $("#allocatePlotBtn").prop("disabled",false).data("plot",plotId);

        });

    });
</script>