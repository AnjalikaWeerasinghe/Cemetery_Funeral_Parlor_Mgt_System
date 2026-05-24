<div class="container-fluid mt-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Funeral Bookings</h4>

        <div>
            <input type="text" id="searchBookings" class="form-control d-inline-block w-auto" placeholder="Search Bookings...">
            <a href="admin.php?page=selectbookingtype" class="btn btn-primary ms-2 mb-1" id="select_booking_type">
                <i class="fa-regular fa-calendar"></i>
                Add New Booking
            </a>
        </div>
    </div>

    <div id="bookingTable">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Booking Code</th>
                    <th>Deceased Name</th>
                    <th>Date of Death</th>
                    <th>Applicant Name</th>
                    <th>Contact Number</th>
                    <th>Service Type</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody id="booking_data">
                
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        function loadBookings() {
            $.ajax({
                url: '../routes/funeral_booking/view_booking_route.php',
                method: 'GET',
                success: function(data) {
                    $('#booking_data').html(data);
                },
                error: function() {
                    alert('Failed to load bookings.');
                }
            });
        }

        loadBookings();

        $('#searchBookings').on('input', function() {
            var query = $(this).val().toLowerCase();
            $('#booking_data tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1)
            });
        });
    });
</script>