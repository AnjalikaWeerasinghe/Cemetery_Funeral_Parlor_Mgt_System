<div class="row mt-4">

    <!-- Upcoming Cremations -->
    <div class="col-lg-6 mb-4">

        <div class="card shadow border-0 rounded-4">

            <div class="card-header bg-dark text-white">
                Upcoming Cremations
            </div>

            <div class="card-body" id="cremationContainer">

                <div class="text-center text-muted">
                    
                </div>

            </div>

        </div>

    </div>

    <!-- Upcoming Burials -->
    <div class="col-lg-6 mb-4">

        <div class="card shadow border-0 rounded-4">

            <div class="card-header bg-dark text-white">
                Upcoming Burials
            </div>

            <div class="card-body" id="burialContainer">

                <div class="text-center text-muted">
                    
                </div>

            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function(){
        $.ajax({
            url: '../routes/dashboard/dashboard_route.php?action=upcoming_cremations',
            method: 'GET',
            success: function(data) {
                if (data.length === 0) {
                    $('#cremationContainer .text-muted').text('No upcoming cremations.');
                } else {
                    let html = '<ul class="list-group">';
                    data.forEach(function(cremation) {
                        html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${cremation.deceased_name} - ${cremation.date_time}
                                    <span class="badge bg-primary rounded-pill">${cremation.status}</span>
                                </li>`;
                    });
                    html += '</ul>';
                    $('#cremationContainer').html(html);
                }
            },
            error: function() {
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
    });
</script>