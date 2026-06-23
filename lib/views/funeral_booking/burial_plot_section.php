<style>
    body{
        background:#f4f6fb;
        font-family:'Segoe UI',sans-serif;
    }

    .card{
        border-radius:16px;
        border:none;
    }

    .btn-success{
        border-radius:12px;
        padding:10px 18px;
        background:linear-gradient(135deg,#b58b2a,#d4af37);
        border:none;
        font-weight:600;
    }

    .btn-success:hover{
        opacity:0.9;
    }

    .nav-pills{
        flex-wrap:nowrap;
        overflow-x:auto;
        gap:10px;
        padding-bottom:8px;
    }

    .nav-pills .nav-link{
        border-radius:50px;
        padding:10px 18px;
        background:#fff;
        border:1px solid #eee;
        color:#444;
        font-weight:600;
        white-space:nowrap;
    }

    .nav-pills .nav-link.active{
        background:linear-gradient(135deg,#b58b2a,#d4af37);
        color:white;
        border:none;
    }

    .stat-box{
        background:#fff;
        border-radius:16px;
        padding:16px;
        box-shadow:0 6px 18px rgba(0,0,0,0.05);
    }

    .stat-title{
        font-size:13px;
        color:#6b7280;
    }

    .stat-value{
        font-size:26px;
        font-weight:700;
    }

    .plot-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(110px,1fr));
        gap:14px;
    }

    .plot-card{
        background:white;
        border-radius:14px;
        padding:12px;
        text-align:center;
        cursor:pointer;
        transition:0.2s ease;
        border:1px solid #eee;
        position:relative;
    }

    .plot-card:hover{
        transform:scale(1.05);
        box-shadow:0 8px 20px rgba(0,0,0,0.08);
    }

    .plot-available{
        background:#ecfdf5;
        border-left:5px solid #10b981;
    }

    .plot-occupied{
        background:#fee2e2;
        border-left:5px solid #ef4444;
    }

    .plot-reserved{
        background:#fef3c7;
        border-left:5px solid #f59e0b;
    }

    .badge{
        border-radius:10px;
        padding:6px 10px;
        font-size:11px;
    }

    #selectedSectionTitle{
        font-weight:700;
        color:#111827;
    }

    .form-control, select{
        border-radius:12px;
        padding:10px 14px;
    }
</style>

<div class="container mt-4">

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h4 class="mb-3">🪦 Burial Plot Allocation Management</h4>

            <div class="row g-3">

                <div class="col-md-4">
                    <input type="text" id="section_name" class="form-control" placeholder="Cemetery Section Name">
                </div>

                <div class="col-md-4">
                    <select name="total_plots" id="total_plots" class="form-control" placeholder="Select Number of Plots Allocated for a Section">
                        <option value="">Select No. of Plots</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="300">300</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-success w-100" id="addSection">➕ Add Section</button>
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-title">Total Sections</div>
                <div class="stat-value" id="totalSections">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-title">Total Plots</div>
                <div class="stat-value" id="totalPlots">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-title">Available</div>
                <div class="stat-value text-success" id="availablePlots">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-title">Occupied</div>
                <div class="stat-value text-danger" id="occupiedPlots">0</div>
            </div>
        </div>

    </div>

    <!-- Automatically add section tabs -->
    <div class="card shadow-sm mb-4">

        <div class="card-body">
            <ul class="nav nav-pills justify-content-center" id="sectionTabs"></ul>
        </div>

    </div>

    <!-- Display section details when a section clicked -->
     <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">

            <h4 id="selectedSectionTitle">Select a Section</h4>

            <div id="sectionStats"></div>

        </div>
    </div>

    <!-- Display automatically generated plots according to the section and assigned plot count -->
    <div class="card shadow-sm">
        <div class="card-body">

            <input type="text" id="searchPlot" class="form-control mb-3" placeholder="Search Plot">

            <div class="plot-grid" id="plotContainer">

                <div class="text-center text-muted w-100 py-5">
                    <i class="fas fa-map-marked-alt fa-3x d-block mb-3"></i>
                </div>

            </div>

        </div>
    </div>

</div>

<script>
    $(document).ready(function(){

        loadSections();
        loadDashboardStats();

        $("#addSection").click(function(){
            let section_name = $("#section_name").val();
            let total_plots = $("#total_plots").val();

            if(section_name == "" || total_plots == ""){
                alert("Please fill all fields");
                return;
            }

            $.post("../routes/funeral_booking/burial_plot/add_burial_section_route.php",{
                section_name : section_name,
                total_plots  : total_plots
            },
            function(response){
                loadSections();
                loadDashboardStats();
                
                $("#section_name").val('');
                $("#total_plots").val('');
            }
            );

        });

    });


    function loadSections(){

        $.post("../routes/funeral_booking/burial_plot/get_burial_section_route.php",{},
            function(response){
                $("#sectionTabs").html(response);

                $(".section-tab").first().addClass("active").trigger("click");

            }
        );

    }


    $(document).on("click",".section-tab",function(){

        $(".section-tab").removeClass("active");

        $(this).addClass("active");

        let sectionId = $(this).data("id");

        loadPlots(sectionId);
        loadSectionStats(sectionId);

    });


    function loadPlots(sectionId){

        $.post("../routes/funeral_booking/burial_plot/get_burial_plots_route.php",{
                section_id : sectionId
            },
            function(response){
                $("#plotContainer").html(response);

            }
        );

    }

    function loadSectionStats(sectionId){

        $.post("../routes/funeral_booking/burial_plot/get_burial_section_stats_route.php",{
                section_id: sectionId
            },
            function(response){
                let data = JSON.parse(response);

                $("#selectedSectionTitle").html(data.section_name);

                $("#sectionStats").html(`
                    <span class="badge bg-primary">Total : ${data.total}</span>
                    <span class="badge bg-success">Available : ${data.available}</span>
                    <span class="badge bg-danger">Occupied : ${data.occupied}</span>
                `);
            }
        );

    }

    function loadDashboardStats(){

        $.post("../routes/funeral_booking/burial_plot/get_dashboard_stats_route.php",{},
        function(response){

            let data = JSON.parse(response);

            $("#totalSections").html(data.sections);
            $("#totalPlots").html(data.total_plots);
            $("#availablePlots").html(data.available);
            $("#occupiedPlots").html(data.occupied);

        });

    }

    $(document).on("click",".plot-card",function(){

        let plotId = $(this).data("id");

        alert("Plot ID: " + plotId);

        //Assign plot
    });
</script>