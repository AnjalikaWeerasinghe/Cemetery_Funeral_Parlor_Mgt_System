<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h3 class="fw-bold">Deceased Records</h3>
            <p class="text-muted mb-0">
                Manage all deceased information
            </p>
        </div>

    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-2">
                    <input type="text"
                           class="form-control"
                           placeholder="Search deceased name or NIC">
                </div>

                <div class="col-md-3 mb-2">
                    <select class="form-select">
                        <option>All Religions</option>
                        <option>Buddhist</option>
                        <option>Christian</option>
                        <option>Muslim</option>
                        <option>Tamil</option>
                    </select>
                </div>

                <div class="col-md-3 mb-2">
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Completed</option>
                    </select>
                </div>

            </div>

        </div>
    </div>

    <div class="card shadow border-0 rounded-4">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>Photo</th>
                        <th>Deceased Name</th>
                        <th>NIC</th>
                        <th>Gender</th>
                        <th>Date of Death</th>
                        <th>Burial/Cremation</th>
                        <th>Religion</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody id="deceased_data">   

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
    $(document).ready(function() {
        function loadDeceasedData() {
            $.ajax({
                url: '../routes/deceased/deceased_details_route.php',
                method: 'GET',
                success: function(data) {
                    $('#deceased_data').html(data);
                },
                error: function() {
                    alert('Failed to load deceased data.');
                }
            });
        }

        loadDeceasedData();
    });

</script>