<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Deceased</small>
                        <h2 class="fw-bold mb-0" id="totalDeceased">0</h2>
                    </div>
                    <div class="fs-1 text-secondary">
                        <i class="fas fa-user-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Cremations</small>
                        <h2 class="fw-bold mb-0" id="totalCremations">0</h2>
                    </div>
                    <div class="fs-1 text-danger">
                        <i class="fas fa-fire"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Burials</small>
                        <h2 class="fw-bold mb-0" id="totalBurials">0</h2>
                    </div>
                    <div class="fs-1 text-success">
                        <i class="fas fa-monument"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Parlor Reservations</small>
                        <h2 class="fw-bold mb-0" id="totalReservations">0</h2>
                    </div>
                    <div class="fs-1 text-primary">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-header bg-dark text-white">
                <i class="fas fa-fire me-2"></i> Upcoming Cremations
            </div>

            <div class="card-body" id="cremationContainer">

                <div class="text-center text-muted py-5">
                    Loading cremations...
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-header bg-dark text-white">
                <i class="fas fa-monument me-2"></i> Upcoming Burials
            </div>

            <div class="card-body" id="burialContainer">

                <div class="text-center text-muted py-5">
                    Loading burials...
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-header bg-dark text-white">
                <i class="fas fa-building me-2"></i> Upcoming Parlor Reservations
            </div>

            <div class="card-body" id="parlorContainer">

                <div class="text-center text-muted py-5">
                    Loading reservations...
                </div>

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
                if (data.length === 0) {
                    $('#burialContainer .text-muted').text('No upcoming burials.');
                } else {
                    let html = '<ul class="list-group">';
                    data.forEach(function(burial) {
                        html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${burial.deceased_name} - ${burial.date_time}
                                    <span class="badge bg-primary rounded-pill">${burial.status}</span>
                                </li>`;
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

    });
</script>