<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .dash-card {
            background:#fff;
            padding:20px;
            border-radius:12px;
            border-top:3px solid #c9a44c;
            box-shadow:0 10px 20px rgba(0,0,0,0.08);
            margin-bottom:15px;
        }

        .dash-card h3 {
            color:#c9a44c;
        }
    </style>
</head>
<body>
    <h5>Dashboard</h5>
    <p>Overview of Cemetery</p>
    <div class="container-fluid mt-4">

        <div class="row">

            <!-- Cards -->
            <div class="col-md-3">
                <div class="dash-card">
                    <h6>Total Payments</h6>
                    <h3>Rs. 1,250,000</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dash-card">
                    <h6>Today Payments</h6>
                    <h3>Rs. 45,000</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dash-card">
                    <h6>Pending</h6>
                    <h3>12</h3>
                </div>
            </div>

        </div>

        <!-- Table -->
        <div class="card mt-4 p-3">
            <h5>Payment Records</h5>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>

        </div>

    </div>
</body>
</html>