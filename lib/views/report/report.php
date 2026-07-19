<style>
body {
    background: #f5f5f5;
}

.page-header h3 {
    color: black;
    font-weight: 700;
}

.page-header p {
    color: #6c757d;
}

.report-filter-card {
    background: #fff;
    border: none;
    border-top: 4px solid #c9a44c;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
}

.report-filter-card .card-header {
    background: #212529;
    color: #c9a44c;
    font-weight: 600;
    border-radius: 12px 12px 0 0;
}

label {
    font-weight: 600;
    color: #333;
}

.report-card {
    background: #fff;
    border: none;
    border-radius: 12px;
    border-top: 4px solid #c9a44c;
    box-shadow: 0 5px 15px rgba(0,0,0,.08);
    padding: 25px;
    text-align: center;
    transition: 0.3s;
    height: 100%;
}

.report-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,.15);
}

.report-card .icon {
    width: 70px;
    height: 70px;
    margin: auto;
    border-radius: 50%;
    background: #212529;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.report-card .icon i {
    color: #c9a44c;
    font-size: 30px;
}

.report-card h5 {
    color: #212529;
    font-weight: 600;
}

.report-card p {
    color: #6c757d;
    font-size: 14px;
    line-height:1.6;
    min-height:55px;
    margin-bottom:20px;
}

.btn-gold {
    background: #c9a44c;
    color: #fff;
    border: none;
    font-weight: 600;
}

.btn-gold:hover {
    background: #b18d35;
    color: #fff;
}

.report-result-card {
    border-radius: 14px;
    border: none;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    overflow: hidden;
}

.report-result-card .card-header {
    background: #c9a44c;
    color: white;
    font-weight: 600;
    padding: 15px 20px;
}

.report-result-card .card-body {
    padding: 25px;
    background: #fff;
}
</style>

<div class="container-fluid py-0">

    <div class="page-header mb-4">
        <h3><i class="fas fa-chart-bar"></i> Reports Dashboard</h3>
        <p>Generate and export cemetery management reports.</p>
    </div>

    <div class="card report-filter-card mb-4">

        <div class="card-header">
            <i class="fas fa-filter"></i> Report Filters
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-lg-4 mb-3">
                    <label>Report Type</label>
                    <select class="form-select" id="reportType">
                        <option value="">Select Report</option>
                        <option value="monthly_income">Monthly Income Report</option>
                        <option value="monthly_expense">Monthly Expense Report</option>
                        <option value="monthly_revenue">Revenue Report</option>
                        <option value="member">Member Report</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-3">
                    <label>Month</label>
                    <select class="form-select" id="month">
                        <option value="">Select month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>

                <div class="col-lg-2 mb-3">
                    <label>Year</label>
                    <select class="form-select" id="year">
                        <option value="2027">2027</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-3">
                    <label>&nbsp;</label>

                    <div class="d-grid gap-2 d-md-flex">
                        <button class="btn btn-gold flex-fill me-2" id="generateReport">
                            <i class="fas fa-search"></i> Generate
                        </button>
                        <button class="btn btn-outline-secondary flex-fill" id="resetReport">
                            Reset
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div id="reportResult">

    </div>

    <div class="row g-4" id="reportCards">

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-fire"></i></div>
                <h5>Cremation Reports</h5>
                <p>Daily, Monthly and Schedule reports.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-cross"></i></div>
                <h5>Burial Reports</h5>
                <p>Plot allocation and burial statistics.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-building"></i></div>
                <h5>Funeral Parlor</h5>
                <p>Reservation and availability reports.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-chart-line"></i></div>
                <h5>Revenue Reports</h5>
                <p>Monthly income and payment summaries.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h5>Member Reports</h5>
                <p>Registered members and activity reports.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <h5>Deceased Reports</h5>
                <p>Deceased registry and monthly statistics.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-map-marked-alt"></i></div>
                <h5>Plot Reports</h5>
                <p>Available, occupied and reserved plots.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="report-card">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <h5>Staff Reports</h5>
                <p>Staff workload and activity reports.</p>

                <button class="btn btn-gold w-100">View Reports</button>
            </div>
        </div>

    </div>

</div>

<script>
    $(document).ready(function(){

        $("#generateReport").click(function(){

            let reportType = $("#reportType").val();
            let month = $("#month").val();
            let year = $("#year").val();

            if(reportType=="" || month=="" || year==""){
                alert("Please select report type, month and year.");
                return;
            }

            $.ajax({
                url:"../routes/report/generate_report_route.php",
                type:"POST",
                data:{
                    action:"generateReport",
                    reportType:reportType,
                    month:month,
                    year:year
                },
                success:function(response){

                    if(response.trim() !== ""){

                        $("#reportResult").html(`
                            <div class="card report-result-card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-file-alt"></i> Generated Report
                                </div>
                                <div class="card-body">
                                    ${response}
                                </div>
                            </div>
                        `);

                        $("#reportCards").slideUp();

                    }else{

                        $("#reportResult").html(`
                            <div class="alert alert-warning">
                                No records found for this report.
                            </div>
                        `);

                        $("#reportCards").slideDown();
                    }

                },
                error:function(xhr, status, error){
                    alert("Error has been occured");
                }
            });
        });

        $("#resetReport").click(function(){
            $("#reportResult").html("");
            $("#reportCards").slideDown();
            $("#reportType").val("");

        });
        
    });

</script>