<div class="container-fluid mt-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Funeral Bookings</h4>

        <div>
            <input type="text" id="searchBookings" class="form-control d-inline-block w-auto" placeholder="Search Bookings...">
            <a href="admin.php?page=addNewBooking" class="btn btn-primary ms-2 mb-1" id="add_booking">
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
                    <th>Applicant NIC</th>
                    <th>Contact Number</th>
                    <th>Service Type</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody id="emp_data">
                <!-- Load from database -->
            </tbody>
        </table>
    </div>
</div>