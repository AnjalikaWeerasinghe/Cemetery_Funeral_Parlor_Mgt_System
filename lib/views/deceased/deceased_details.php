<style>
    body{
    background:#f4f7fc;
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

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Deceased Records</h2>
            <p class="text-muted mb-0">
                Manage and monitor all deceased information.
            </p>
        </div>

        <button class="btn btn-dark">
            <i class="fas fa-download me-2"></i>Export Report
        </button>
    </div>

    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Total Records</h6>
                    <h3 class="fw-bold">245</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Burials</h6>
                    <h3 class="fw-bold text-primary">120</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Cremations</h6>
                    <h3 class="fw-bold text-warning">95</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <h6>Pending Approval</h6>
                    <h3 class="fw-bold text-danger">30</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="row g-3">

                <div class="col-lg-4">
                    <input type="text"
                           class="form-control"
                           placeholder="Search Name, NIC, Booking Code">
                </div>

                <div class="col-lg-2">
                    <select class="form-select">
                        <option>All Religions</option>
                        <option>Buddhist</option>
                        <option>Christian</option>
                        <option>Muslim</option>
                        <option>Hindu</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <select class="form-select">
                        <option>All Services</option>
                        <option>Burial</option>
                        <option>Cremation</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Completed</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <button class="btn btn-dark w-100">
                        Search
                    </button>
                </div>

            </div>

        </div>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-semibold">
                Deceased Information List
            </h5>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Gender</th>
                        <th>Date of Death</th>
                        <th>Service Type</th>
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