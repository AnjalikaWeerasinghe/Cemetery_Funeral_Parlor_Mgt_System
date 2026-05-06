<style>
:root {
    --gold-main: #c9a44c;
    --gold-soft: #e8d9a3;
    --gold-dark: #a8892f;
}

.confirm-card {
    background: linear-gradient(145deg, #ffffff, #fafbfc);
    border-radius: 16px;
    border: none;
    box-shadow: 0 18px 45px rgba(0,0,0,0.08);
    padding: 30px;
}

.section-title {
    font-weight: 600;
    color: var(--gold-main);
    border-left: 4px solid var(--gold-main);
    padding: 12px 14px;
    border-radius: 8px;
    background: #f9fafb;
    letter-spacing: 0.4px;
}

.summary-box {
    background: linear-gradient(145deg, #ffffff, #f7f9fc);
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 18px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.summary-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.label {
    font-weight: 500;
    color: #777;
    font-size: 13px;
    margin-right: 6px;
}

.value {
    font-weight: 600;
    color: #222;
    letter-spacing: 0.3px;
}

.highlight {
    background: linear-gradient(135deg, var(--gold-main), var(--gold-soft));
    padding: 10px 16px;
    border-radius: 10px;
    font-weight: 600;
    color: #2b2b2b;
    display: inline-block;
    box-shadow: 0 4px 12px rgba(201,164,76,0.3);
}

#load_step5 {
    background: linear-gradient(135deg, var(--gold-main), var(--gold-soft));
    color: #2b2b2b;
    border: none;
    border-radius: 12px;
    padding: 12px 28px;
    font-weight: 600;
    letter-spacing: 0.6px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

#load_step5::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

#load_step5:hover::after {
    left: 100%;
}

#load_step5:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(201,164,76,0.4);
}

#load_step5:active {
    transform: scale(0.98);
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

#load_step5:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(201,164,76,0.3);
}

.edit-btn {
    border-radius: 10px;
    padding: 10px 22px;
    border: 1px solid #ccc;
    transition: 0.3s;
}

.edit-btn:hover {
    background: #f1f1f1;
    transform: translateY(-1px);
}

.confirm-card {
    animation: fadeInUp 0.4s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>

<div class="container-fluid">
    <div class="confirm-card">

        <h4 class="text-center mb-4">Confirm Cremation Reservation</h4>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Deceased Information</div>
        <div class="summary-box">
            <div><span class="label">Full Name:</span> <span class="value" id="full_name"></span></div>
            <div><span class="label">NIC:</span> <span class="value" id="nic"></span></div>
            <div><span class="label">Gender:</span> <span class="value" id="gender"></span></div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Applicant Information</div>
        <div class="summary-box">
            <div><span class="label">Name:</span> <span class="value" id="applicant_name"></span></div>
            <div><span class="label">Contact:</span> <span class="value" id="contact_number"></span></div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Document Information</div>
        <div class="summary-box">
            <div><span class="label">Death Certificate No:</span> <span class="value" id="death_certificate_no"></span></div>
            <div><span class="label">Date of Death:</span> <span class="value" id="date_of_death"></span></div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Cremation Details</div>
        <div class="summary-box">
            <div><span class="label">Date:</span> <span class="value" id="cremation_date"></span></div>
            <div><span class="label">Time Slot:</span> <span class="value highlight" id="cremation_slot"></span></div>
            <div><span class="label">Area Type:</span> <span class="value" id="area_type"></span></div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Booking Reference</div>
        <div class="summary-box text-center">
            <div class="highlight" style="font-size:20px; letter-spacing:1px;" id="booking_code"></div>
            <small class="text-muted d-block mt-2">Please keep this code for future reference</small>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Payment Summary</div>
        <div class="summary-box">
            <div class="d-flex justify-content-between">
                <span class="label">Total Amount</span>
                <span class="value highlight" id="total_amount"></span>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <button class="btn btn-outline-secondary edit-btn" id="editBtn">
                ← Edit Details
            </button>

            <button type="button" id="load_step5">
                Confirm & Proceed to Payment →
            </button>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){

        $("#full_name").text(sessionStorage.getItem("full_name"));
        $("#nic").text(sessionStorage.getItem("nic"));
        $("#gender").text(sessionStorage.getItem("gender"));

        $("#applicant_name").text(sessionStorage.getItem("applicant_name"));
        $("#contact_number").text(sessionStorage.getItem("contact_number"));

        $("#death_certificate_no").text(sessionStorage.getItem("death_certificate_number"));
        $("#date_of_death").text(sessionStorage.getItem("date_of_death"));

        $("#cremation_date").text(sessionStorage.getItem("cremation_date"));
        $("#cremation_slot").text(sessionStorage.getItem("slot_text"));
        $("#area_type").text(sessionStorage.getItem("area_type"));

        $("#booking_code").text(sessionStorage.getItem("booking_code"));

    });

    $("#editBtn").click(function(){
        $("#bookingContent").load("funeral_booking/deceased_information.php");
    });

    $("#load_step5").click(function(){
        $("#bookingContent").load("funeral_booking/booking_payment.php");
    });
</script>