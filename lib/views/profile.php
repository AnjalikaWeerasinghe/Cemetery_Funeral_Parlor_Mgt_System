<?php
    $user_id = $_SESSION['user_id'] ?? '';
    $username = $_SESSION['username'] ?? '';
    $role = $_SESSION['role'] ?? '';
?>

<style>
    .profile-card{
        background:white;
        border-radius:20px;
        padding:30px;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
    }

    .profile-header{
        background:linear-gradient(135deg,#8b6f47,#d4af7a);
        color:white;
        padding:30px;
        border-radius:20px;
    }

    .profile-icon{
        width:100px;
        height:100px;
        border-radius:50%;
        background:white;
        display:flex;
        justify-content:center;
        align-items:center;
        margin:auto;
        font-size:45px;
        color:#8b6f47;
    }

    .nav-tabs .nav-link{
        color:#8b6f47;
        font-weight:600;
    }

    .nav-tabs .nav-link.active{
        background:#d4af7a;
        color:white;
    }

    .info-box{
        background:#f8f9fa;
        border-radius:15px;
        padding:20px;
    }

    .table thead{
        background:#8b6f47;
        color:white;
    }
</style>

<div class="container my-5 pt-4">

    <div class="profile-card">

        <div class="profile-header text-center">
            <div class="profile-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <h3 class="mt-3"><?= $username ?></h3>

            <p><?= $role ?></p>
        </div>

        <ul class="nav nav-tabs mt-4" id="profileTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile">
                    <i class="fa-solid fa-user"></i>Profile
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bookings">
                    <i class="fa-solid fa-calendar"></i>My Bookings
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#payments">
                    <i class="fa-solid fa-credit-card"></i>Payments
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password">
                    <i class="fa-solid fa-key"></i>Security
                </button>
            </li>
        </ul>

        <div class="tab-content mt-4">

            <!-- User Profile -->
            <div class="tab-pane fade show active" id="profile">

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <h6>Username</h6>
                            <p><?= $username ?></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <h6>Role</h6>
                            <p><?= $role ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Funeral Bookings -->
            <div class="tab-pane fade" id="bookings">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="bookingTable"></tbody>
                </table>

            </div>

            <!-- Funeral Payments -->
            <div class="tab-pane fade" id="payments">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Payment Code</th>
                            <th>Booking Code</th>
                            <th>Service Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Paid Date & Time</th>
                        </tr>
                    </thead>

                    <tbody id="paymentTable"></tbody>
                </table>

            </div>

            <!-- Password Reset -->
            <div class="tab-pane fade" id="password">

                <div class="row">

                    <div class="col-md-6">

                        <div class="info-box">
                            <h5 class="mb-4">
                                <i class="fa-solid fa-lock"></i>Change Password
                            </h5>

                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" id="current_password" class="form-control" placeholder="Enter current password">
                            </div>

                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" id="new_password" class="form-control" placeholder="Enter new password">
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm new password">
                            </div>

                            <button class="btn btn-warning" id="changePassword">
                                <i class="fa-solid fa-key"></i>Change Password
                            </button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="bookingModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header" style="background:#8b6f47;color:white;">
                <h5 class="modal-title">
                    <i class="fa-solid fa-calendar me-2"></i>
                    Booking Details
                </h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body" id="bookingDetails">

            </div>

        </div>

    </div>

</div>

</div>

<script>
    $(document).ready(function(){
        loadMyBookings();
        loadMyPayments();
    });

    function loadMyBookings(){

        $.post("lib/routes/profile/load_my_bookings_route.php",
            {},
            function(data){
                $("#bookingTable").html(data);
            }
        );
    }

    function loadMyPayments(){

        $.post("lib/routes/profile/load_my_payments_route.php",
            {},
            function(data){
                $("#paymentTable").html(data);
            }
        );
    }

    $(document).on("click", ".viewBooking", function(){
        let funeralServiceId = $(this).data("id");

        console.log("Booking ID:", funeralServiceId);

        let url = "lib/views/funeral_booking/view_booking.php?funeral_service_id=" 
                + funeralServiceId;

        $("#bookingDetails").load(url,function(response,status,xhr){
            console.log("Status:",status);
            console.log("Response:",response);

            if(status=="success"){
                $("#bookingModal").modal("show");
            }

        });

    });

    $("#changePassword").click(function(){
        let current = $("#current_password").val();
        let newPass = $("#new_password").val();
        let confirm = $("#confirm_password").val();

        if(current=="" || newPass=="" || confirm==""){
            Swal.fire(
                "Error",
                "Please fill all fields",
                "error"
            );
            return;
        }

        if(newPass !== confirm){
            Swal.fire(
                "Error",
                "New password and confirm password do not match",
                "error"
            );
            return;
        }

        $.ajax({
            url:"lib/routes/profile/change_password_route.php",
            method:"POST",
            data:{
                current_password:current,
                new_password:newPass
            },
            success:function(response){
                let res=JSON.parse(response);

                if(res.status=="success"){
                    Swal.fire(
                        "Success",
                        "Password changed successfully",
                        "success"
                    );

                    $("#current_password").val("");
                    $("#new_password").val("");
                    $("#confirm_password").val("");
                }
                else{
                    Swal.fire(
                        "Error",
                        res.message,
                        "error"
                    );
                }
            }
        });

    });

</script>