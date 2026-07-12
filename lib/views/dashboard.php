<style>
:root{
    --gold-main:#c9a44c;
    --gold-soft:#e8d9a3;
    --gold-dark:#a8892f;
}

body{
    background:#f5f7fb;
}

.dashboard-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.dashboard-card{
    background:#fff;
    border:none;
    border-left:5px solid var(--gold-main);
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s ease;
    overflow:hidden;
}

.dashboard-card:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 35px rgba(201,164,76,.18);
}

.dashboard-card .card-body{
    padding:24px;
}

.dashboard-card small{
    color:#777;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.5px;
}

.dashboard-card h2{
    font-size:34px;
    font-weight:700;
    color:#222;
    margin-top:6px;
}

.dashboard-card .card-icon{
    width:70px;
    height:70px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    color:#fff;
}

.bg-gold{
    background:linear-gradient(135deg,#c9a44c,#e8d9a3);
}

.bg-red{
    background:linear-gradient(135deg,#d62828,#f77f00);
}

.bg-green{
    background:linear-gradient(135deg,#2d6a4f,#52b788);
}

.bg-blue{
    background:linear-gradient(135deg,#3a86ff,#4895ef);
}

.chart-card,
.schedule-card{
    background:#fff;
    border:none;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.chart-card .card-header,
.schedule-card .card-header{
    background:#fff;
    border-bottom:1px solid #ececec;
    color:#444;
    font-weight:600;
    padding:16px 20px;
}

.schedule-card .list-group-item{
    border:none;
    border-bottom:1px solid #f1f1f1;
    padding:14px 20px;
}

.schedule-card .list-group-item:last-child{
    border-bottom:none;
}

.badge{
    font-size:12px;
    padding:6px 10px;
    border-radius:20px;
}
</style>

<div class="container-fluid">

    <div class="dashboard-header mb-4">
        <div>
            <h3 class="fw-bold mb-1">Welcome Back,</h3>
            <p class="text-muted mb-0">Cemetery & Funeral Parlor Management Dashboard</p>
        </div>

        <div class="text-end">
            <h6 class="mb-1">
                <i class="fas fa-calendar-alt text-warning"></i><?php echo date("d F Y"); ?>
            </h6>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Deceased</small>
                        <h2 id="totalDeceased">0</h2>
                    </div>

                    <div class="card-icon bg-gold">
                        <i class="fas fa-user-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Cremations</small>
                        <h2 id="totalCremations">0</h2>
                    </div>

                    <div class="card-icon bg-red">
                        <i class="fas fa-fire"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Burials</small>
                        <h2 id="totalBurials">0</h2>
                    </div>

                    <div class="card-icon bg-green">
                        <i class="fas fa-monument"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Reservations</small>
                        <h2 id="totalReservations">0</h2>
                    </div>

                    <div class="card-icon bg-blue">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header">
                    <strong><i class="fas fa-chart-line me-2"></i>Monthly Cremations vs Burials</strong>
                </div>

                <div class="card-body">
                    <canvas id="serviceChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header">
                    <strong>Revenue Distribution</strong>
                </div>

                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card rounded-4 shadow-sm">
                <div class="card-header bg-dark text-white">
                    🔥 Upcoming Cremations
                </div>
                <div id="cremationContainer" class="card-body"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card rounded-4 shadow-sm">
                <div class="card-header bg-dark text-white">
                    ⚰ Upcoming Burials
                </div>
                <div id="burialContainer" class="card-body"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card rounded-4 shadow-sm">
                <div class="card-header bg-dark text-white">
                    🏢 Upcoming Reservations
                </div>
                <div id="parlorContainer" class="card-body"></div>
            </div>
        </div>
    </div>

</div>

<script>
    
    $(document).ready(function(){
        function loadDashboardCounts() {

            $.ajax({
                url: '../routes/dashboard/dashboard_counts_route.php',
                type: 'GET',
                dataType: 'json',

                success: function(response) {

                    $('#totalDeceased').text(response.total_records ?? 0);
                    $('#totalBurials').text(response.total_burials ?? 0);
                    $('#totalCremations').text(response.total_cremations ?? 0);

                }
            });
        }
        
        $.ajax({
            url: '../routes/dashboard/dashboard_route.php?action=upcoming_cremations',
            method: 'GET',
            success: function(data) {
                console.log(data);

                if (typeof data === 'string') {
                    data = JSON.parse(data);
                }

                if (data.length === 0) {
                    $('#cremationContainer').html('<div class="text-center text-muted">No upcoming cremations.</div>');
                } else {
                    let html = '<ul class="list-group list-group-flush">';

                    data.forEach(function(cremation) {

                        html += `
                            <li class="list-group-item">
                                <div class="fw-semibold">${cremation.deceased_name}</div>
                                <small class="text-muted">
                                    ${cremation.cremation_date}(${cremation.start_time} - ${cremation.end_time})
                                </small>
                                <div>
                                    <span class="badge bg-success">${cremation.booking_status}</span>
                                </div>
                            </li>
                        `;
                    });

                    html += '</ul>';

                    $('#cremationContainer').html(html);
                }
            },
            error: function(xhr) {
                console.log(xhr.reponseText);
                $('#cremationContainer .text-muted').text('Failed to load upcoming cremations.');
            }
        });

        $.ajax({
            url: '../routes/dashboard/dashboard_route.php?action=upcoming_burials',
            method: 'GET',
            success: function(data) {
                if (typeof data === 'string') {
                    data = JSON.parse(data);
                }

                if (data.length === 0) {
                    $('#burialContainer').html('<div class="text-center text-muted">No upcoming burials.</div>');
                } else {
                    let html = '<ul class="list-group list-group-flush">';

                    data.forEach(function(burial) {

                        html += `
                            <li class="list-group-item">
                                <div class="fw-semibold">${burial.deceased_name}</div>
                                <small class="text-muted">
                                    ${burial.burial_date}
                                </small>
                                <div>
                                    <span class="badge bg-success">${burial.booking_status}</span>
                                </div>
                            </li>
                        `;
                    });

                    html += '</ul>';

                    $('#burialContainer').html(html);
                }
            },
            error: function() {
                $('#burialContainer .text-muted').text('Failed to load upcoming burials.');
            }
        });

        loadDashboardCounts();

        $.ajax({
            url:'../routes/dashboard/dashboard_route.php?action=monthly_chart',
            dataType: "json",
            success:function(data){
                console.log(data);
                
                let months=[];
                let burials=[];
                let cremations=[];

                data.forEach(function(row){
                    months.push(row.month);
                    burials.push(parseInt(row.burials));
                    cremations.push(parseInt(row.cremations));
                });

                new Chart(document.getElementById("serviceChart"),{
                    type:"bar",
                    data:{
                        labels:months,
                        datasets:[
                            {
                                label:"Burials",
                                data:burials,
                                backgroundColor:"#70cfa4"
                            },
                            {
                                label:"Cremations",
                                data:cremations,
                                backgroundColor:"#e38c8c"
                            }
                        ]
                    },
                    options:{
                        responsive:true,
                        plugins:{
                            legend:{position:"top"}
                        },
                        scales:{
                            y:{beginAtZero:true}
                        }
                    }
                });
            }
        });

        

const revenueChart=new Chart(
document.getElementById("revenueChart"),
{
type:"doughnut",
data:{
labels:["Burial","Cremation","Parlor"],
datasets:[{
data:[35,45,20]
}]
}
});

    });
</script>