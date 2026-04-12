<style>

.booking-card {
    background: rgba(30,30,30,0.85);
    border-radius: 15px;
    border: 1px solid rgba(212,175,122,0.2);
    transition: 0.3s;
    color: #ccc;
    position: relative;
    overflow: hidden;
    margin-bottom: 25.5px;
}

.booking-card h5 {
    color: #d4af7a;
    font-weight: bold;
}

.booking-card i {
    font-size: 40px;
    color: #d4af7a;
    margin-bottom: 10px;
}

.booking-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 15px 30px rgba(212,175,122,0.3);
    background: rgba(30,30,30,1);
}

.booking-card::before {
    content: "";
    position: absolute;
    width: 0%;
    height: 100%;
    top: 0;
    left: 0;
    background: linear-gradient(120deg, transparent, rgba(212,175,122,0.2), transparent);
    transition: 0.5s;
}

.booking-card:hover::before {
    width: 100%;
}

</style>

<div class="container mt-5">
    <div class="text-center mb-5" style="margin-top: 110px;">
        <h2 class="fw-bold text-gold">Select Booking Type</h2>
        <p class="text-muted">Choose a service to continue your booking</p>
    </div>

        <div class="row" id="booking_cards">

            <div class="col-md-4 mb-4">
                <div class="card booking-card text-center p-4 booking-option" data-service-type="Cremation" data-page="add_cremation_booking">
                    <i class="fa-solid fa-fire"></i>
                    <h5>Crematorium</h5>
                    <p>Reserve cremation services and available time slots.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card booking-card text-center p-4 booking-option" data-service-type="Burial" data-page="burial_booking">
                    <i class="fa-solid fa-cross"></i>
                    <h5>Burial</h5>
                    <p>Book burial plots and cemetery services.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card booking-card text-center p-4 booking-option" data-service-type="Parlor" data-page="parlor_booking">
                    <i class="fa-solid fa-building-columns"></i>
                    <h5>Funeral Parlor</h5>
                    <p>Reserve parlor facilities for funeral arrangements.</p>
                </div>
            </div>

        </div>

</div>

<script>

const userRole = "<?php echo $_SESSION['role'] ?? 'Guest'; ?>";

function goToBooking(type) {

    if (userRole === "Admin") {
        window.location.href = "admin.php?page=" + type;
    } else {
        window.location.href = "index.php?page=" + type;
    }

}

function saveServiceType(serviceType, page) {
    $.ajax({
        url: "lib/routes/funeral_booking/add_booking_service_type_route.php",
        type: "POST",
        data: { service_type: serviceType },
        success: function(response) {
            if (response.trim() === "success") {
                goToBooking(page);
            } else {
                alert("Unable to save service type: " + response);
            }
        },
        error: function(xhr) {
            alert("Error saving service type: " + xhr.responseText);
        }
    });
}

$(document).ready(function() {
    $(".booking-option").on("click", function() {
        const serviceType = $(this).data("service-type");
        const page = $(this).data("page");

        if (!serviceType || !page) {
            alert("Invalid booking selection.");
            return;
        }

        saveServiceType(serviceType, page);
    });
});

</script>