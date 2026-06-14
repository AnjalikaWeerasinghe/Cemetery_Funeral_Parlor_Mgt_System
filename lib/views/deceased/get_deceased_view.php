<?php 
include_once(dirname(__DIR__, 2) . '/routes/deceased/get_deceased_view_route.php');
?>

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

.back-btn {
    background: linear-gradient(135deg, #6c757d, #adb5bd);
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
    letter-spacing: 0.4px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.back-btn::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

.back-btn:hover::after {
    left: 100%;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

.back-btn:active {
    transform: scale(0.97);
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
            <div class="row align-items-center mb-3">
                <div class="col-md-2 text-center">
                    <img id="deceased_photo" src="" alt="Deceased Photo" style="width:100px; height:100px; object-fit:cover; border-radius:10px; border:1px solid #ccc; display:none;">
                </div>
                <div class="col-md-10">
                    <div><span class="label">Title:</span><span class="value" id="title"><?php echo $deceaseddata['title'] ?></span></div>
                    <div><span class="label">Full Name:</span> <span class="value" id="full_name"><?php echo $deceaseddata['full_name']; ?></span></div>
                    <div><span class="label">Religion:</span><span class="value" id="religion"><?php echo $deceaseddata['religion']; ?></span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><span class="label">NIC:</span> <span class="value" id="nic"><?php echo $deceaseddata['nic']; ?></span></div>
                <div class="col-md-4"><span class="label">Gender:</span> <span class="value" id="gender"><?php echo $deceaseddata['gender']; ?></span></div>
                <div class="col-md-4"><span class="label">DOB:</span> <span class="value" id="dob"><?php echo $deceaseddata['date_of_birth']; ?></span></div>
            </div>
            <div><span class="label">Address:</span> <span class="value" id="deceased_address"><?php echo $deceaseddata['deceased_address']; ?></span></div>
            <div class="row">
                <div class="col-md-6"><span class="label">G. N. Division:</span> <span class="value" id="gn_division"><?php echo $deceaseddata['deceased_gn_division']; ?></span></div>
                <div class="col-md-6"><span class="label">Area of Municipal Council:</span> <span class="value" id="municipal_council"><?php echo $deceaseddata['municipal_council']; ?></span></div>
            </div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Applicant Information</div>
        <div class="summary-box">
            <div class="row">
                <div class="col-md-6"><span class="label">Applicant Name:</span> <span class="value" id="applicant_name"><?php echo $deceaseddata['applicant_name']; ?></span></div>
                <div class="col-md-6"><span class="label">Relationship to deceased:</span> <span class="value" id="relation_to_deceased"><?php echo $deceaseddata['relationship_to_deceased']; ?></span></div>
            </div>
            <div class="row">
                <div class="col-md-6"><span class="label">Contact Number:</span> <span class="value" id="contact_number"><?php echo $deceaseddata['contact_number']; ?></span></div>
                <div class="col-md-6"><span class="label">Email:</span> <span class="value" id="email"><?php echo $deceaseddata['email']; ?></span></div>
            </div>
            <div class="row">
                <div class="col-md-6"><span class="label">G. N. Division:</span> <span class="value" id="applicant_gn_division"><?php echo $deceaseddata['applicant_gn_division']; ?></span></div>
                <div class="col-md-6"><span class="label">Address:</span> <span class="value" id="applicant_address"><?php echo $deceaseddata['applicant_address']; ?></span></div>
            </div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Document Information</div>
        <div class="summary-box">
            <div><span class="label">Death Certificate No:</span> <span class="value" id="death_certificate_no"><?php echo $deceaseddata['death_certificate_number']; ?></span></div>
            <div class="row">
                <div class="col-md-6"><span class="label">Name of the Registrar:</span> <span class="value" id="registrar_name"><?php echo $deceaseddata['registrar_name']; ?></span></div>
                <div class="col-md-6"><span class="label">Date of Death:</span> <span class="value" id="date_of_death"><?php echo $deceaseddata['date_of_death']; ?></span></div>
            </div>
            <div><span class="label">Cause of death:</span> <span class="value" id="cause_of_death"><?php echo $deceaseddata['cause_of_death']; ?></span></div>
            <div><span class="label">Death Certificate:</span> <span class="value" id="death_certificate"><?php echo $deceaseddata['death_certificate']; ?></span></div>
            <div class="row">
                <div class="col-md-6"><span class="label">Name of the Coroner & Position:</span> <span class="value" id="coroner_name_position"><?php echo $deceaseddata['coroner_name']; ?></span></div>
                <div class="col-md-6"><span class="label">Coroner Decision:</span> <span class="value" id="coroner_decision"><?php echo $deceaseddata['coroner_decision']; ?></span></div>
            </div>
            <div><span class="label">Inquirer's Certificate of Death:</span> <span class="value" id="inquirer_certificate"><?php echo $deceaseddata['coroner_certificate']; ?></span></div>
            <div><span class="label">Is body permitted for Cremation? :</span> <span class="value" id="cremation_permission"><?php echo $deceaseddata['cremation_permission']; ?></span></div>
            <div><span class="label">Family Consent Letter:</span> <span class="value" id="family_consent_letter"><?php echo $deceaseddata['family_consent_letter']; ?></span></div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Cremation Details</div>
        <div class="summary-box">
            <div class="row">
                <div class="col-md-6"><span class="label">Cremation Date:</span> <span class="value" id="cremation_date"></span></div>
                <div class="col-md-6"><span class="label">Area Type:</span> <span class="value" id="area_type"></span></div>
            </div>
            <div><span class="label">Time Slot:</span> <span class="value highlight" id="cremation_slot"></span></div>
            <div><span class="label">Are you collecting ash after cremation? :</span> <span class="value" id="collect_ash"></span></div>
            <div><span class="label">Ash collecting method? :</span> <span class="value" id="ash_collecting_method"></span></div>
                
            <div class="row">
                <div class="col-md-6">
                    <div id="memorialSection" style="display:none;" class="mt-3">
                        <span class="label d-block mb-2">Memorial Preview</span>

                        <div id="memorialPreview" class="p-3 text-center" style="width: 220px; border-radius: 10px; border: 1px solid #ccc; background: #f8f8f8">
                            <div class="confirmIcon" id="confirmIcon" style="font-size: 20px;"></div>
                            <img id="confirmImage" style="max-width:60px; display:none; margin:5px auto;" />
                            <h6 id="confirmName">Name</h6>
                            <p id="confirmMessage" style="font-size:13px;">Message</p>
                        </div>
                    </div>
                </div>
            </div>

            <div><span class="label">Notes:</span> <span class="value" id="notes" name="notes"></span></div>
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
            <button type="button" class="back-btn" id="load_step3">Back</button>

            <button type="button" id="load_step5">Confirm & Proceed to Payment</button>
        </div>

    </div>
</div>
