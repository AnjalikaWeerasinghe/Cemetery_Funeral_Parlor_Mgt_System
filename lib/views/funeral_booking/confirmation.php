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
                    <div><span class="label">Title:</span><span class="value" id="title"></span></div>
                    <div><span class="label">Full Name:</span> <span class="value" id="full_name"></span></div>
                    <div><span class="label">Religion:</span><span class="value" id="religion"></span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><span class="label">NIC:</span> <span class="value" id="nic"></span></div>
                <div class="col-md-4"><span class="label">Gender:</span> <span class="value" id="gender"></span></div>
                <div class="col-md-4"><span class="label">DOB:</span> <span class="value" id="dob"></span></div>
            </div>
            <div><span class="label">Address:</span> <span class="value" id="deceased_address"></span></div>
            <div class="row">
                <div class="col-md-6"><span class="label">G. N. Division:</span> <span class="value" id="gn_division"></span></div>
                <div class="col-md-6"><span class="label">Area of Municipal Council:</span> <span class="value" id="municipal_council"></span></div>
            </div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Applicant Information</div>
        <div class="summary-box">
            <div class="row">
                <div class="col-md-6"><span class="label">Applicant Name:</span> <span class="value" id="applicant_name"></span></div>
                <div class="col-md-6"><span class="label">Relationship to deceased:</span> <span class="value" id="relation_to_deceased"></span></div>
            </div>
            <div class="row">
                <div class="col-md-6"><span class="label">Contact Number:</span> <span class="value" id="contact_number"></span></div>
                <div class="col-md-6"><span class="label">Email:</span> <span class="value" id="email"></span></div>
            </div>
            <div class="row">
                <div class="col-md-6"><span class="label">G. N. Division:</span> <span class="value" id="applicant_gn_division"></span></div>
                <div class="col-md-6"><span class="label">Address:</span> <span class="value" id="applicant_address"></span></div>
            </div>
        </div>

        <div class="section-title mb-4 p-3 bg-light rounded-3">Document Information</div>
        <div class="summary-box">
            <div><span class="label">Death Certificate No:</span> <span class="value" id="death_certificate_no"></span></div>
            <div class="row">
                <div class="col-md-6"><span class="label">Name of the Registrar:</span> <span class="value" id="registrar_name"></span></div>
                <div class="col-md-6"><span class="label">Date of Death:</span> <span class="value" id="date_of_death"></span></div>
            </div>
            <div><span class="label">Cause of death:</span> <span class="value" id="cause_of_death"></span></div>
            <div><span class="label">Death Certificate:</span> <span class="value" id="death_certificate"></span></div>
            <div class="row">
                <div class="col-md-6"><span class="label">Name of the Coroner & Position:</span> <span class="value" id="coroner_name_position"></span></div>
                <div class="col-md-6"><span class="label">Coroner Decision:</span> <span class="value" id="coroner_decision"></span></div>
            </div>
            <div><span class="label">Inquirer's Certificate of Death:</span> <span class="value" id="inquirer_certificate"></span></div>
            <div><span class="label">Is body permitted for Cremation? :</span> <span class="value" id="cremation_permission"></span></div>
            <div><span class="label">Family Consent Letter:</span> <span class="value" id="family_consent_letter"></span></div>
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

<script>
    $(document).ready(function(){
        let permission = sessionStorage.getItem("cremation_permission");
        let collect_ash = sessionStorage.getItem("collect_ash");
        let deceasedPhoto = sessionStorage.getItem("deceased_photo");

        console.log(sessionStorage.getItem("deceased_photo"));
        console.log("Photo Name:", deceasedPhoto);
        console.log("Image Path:", "../uploads/deceased_photoes/" + deceasedPhoto);

        if(deceasedPhoto){
            $("#deceased_photo").attr("src", "/Cemetery_Funeral_Parlor_Mgt_System/lib/" + deceasedPhoto).show();
        }

        $("#title").text(sessionStorage.getItem("title"));
        $("#religion").text(sessionStorage.getItem("religion"));
        $("#full_name").text(sessionStorage.getItem("full_name"));
        $("#nic").text(sessionStorage.getItem("nic"));
        $("#gender").text(sessionStorage.getItem("gender"));
        $('#dob').text(sessionStorage.getItem("date_of_birth"));
        $("#deceased_address").text(sessionStorage.getItem("deceased_address"));
        $("#gn_division").text(sessionStorage.getItem("deceased_gn_division"));
        $("#municipal_council").text(sessionStorage.getItem("municipal_council"));

        $("#applicant_name").text(sessionStorage.getItem("applicant_name"));
        $("#relation_to_deceased").text(sessionStorage.getItem("relationship_to_deceased"));
        $("#email").text(sessionStorage.getItem("email"));
        $("#contact_number").text(sessionStorage.getItem("contact_number"));
        $("#applicant_gn_division").text(sessionStorage.getItem("applicant_gn_division"));
        $("#applicant_address").text(sessionStorage.getItem("applicant_address"));

        $("#death_certificate_no").text(sessionStorage.getItem("death_certificate_number"));
        $("#registrar_name").text(sessionStorage.getItem("registrar_name"));
        $("#date_of_death").text(sessionStorage.getItem("date_of_death"));
        $("#cause_of_death").text(sessionStorage.getItem("cause_of_death"));
        
        $("#coroner_name_position").text(sessionStorage.getItem("coroner_name"));
        $("#coroner_decision").text(sessionStorage.getItem("coroner_decision"));
        
        $("#cremation_permission").text(permission == "1" ? "Yes" : "No");

        $("#cremation_date").text(sessionStorage.getItem("selectedDate"));
        $("#cremation_slot").text(sessionStorage.getItem("slot_text")); // Display selected cremation time slot

        $("#death_certificate").html(
            sessionStorage.getItem("death_certificate_name") 
                ? `<span class="text-success">${sessionStorage.getItem("death_certificate_name")}</span>`
                : `<span class="text-danger">Not Uploaded</span>`
        );

        $("#inquirer_certificate").html(
            sessionStorage.getItem("coroner_certificate_name") 
                ? `<span class="text-success">${sessionStorage.getItem("coroner_certificate_name")}</span>`
                : `<span class="text-danger">Not Uploaded</span>`
        );

        $("#family_consent_letter").html(
            sessionStorage.getItem("family_consent_letter_name") 
                ? `<span class="text-success">${sessionStorage.getItem("family_consent_letter_name")}</span>`
                : `<span class="text-danger">Not Uploaded</span>`
        );

        let areaType = sessionStorage.getItem("area_type");

        if(areaType === "municipal_limit"){
            $("#area_type").text("Municipal Limit Area");
        }
        else if(areaType === "outside_municipal_limit"){
            $("#area_type").text("Outside Municipal Limit Area");
        } 

        $("#collect_ash").text(collect_ash == "1" ? "Yes" : "No");

        if(collect_ash == "0"){
            $("#ash_collecting_method").closest(".col-md-6").hide();
            $("#memorialSection").hide();
        }

        let ashMethod = sessionStorage.getItem("ash_collection_method");

        if(ashMethod === "memorial"){
            $("#ash_collecting_method").text("Memorial Service");
        }
        else if(ashMethod === "collect"){
            $("#ash_collecting_method").text("Collecting Ashes");
        }
        else if(ashMethod === "scatter"){
            $("#ash_collecting_method").text("Scatter Ashes in Cemetery Premise");
        }

        if(ashMethod === "memorial"){

            $("#memorialSection").show();

            let name = sessionStorage.getItem("memorial_name");
            let message = sessionStorage.getItem("memorial_message");
            let icon = sessionStorage.getItem("memorial_icon");
            let theme = sessionStorage.getItem("tablet_theme");
            let font = sessionStorage.getItem("font_style");

            let memorialImage = sessionStorage.getItem("memorial_image");

            $("#confirmName").text(name || "Name");
            $("#confirmMessage").text(message || "Message");

            if(icon === "cross"){
                $("#confirmIcon").text("✝");
            }
            else if(icon === "flower"){
                $("#confirmIcon").text("🌸");
            }
            else{
                $("#confirmIcon").text("");
            }

            if(memorialImage){
                $("#confirmImage").attr("src", memorialImage).show();
            }

            if(theme === "dark"){
                $("#memorialPreview").css({
                    background: "linear-gradient(145deg, #2b2b2b, #1a1a1a)",
                    color: "#fff"
                });
            }
            else if(theme === "light"){
                $("#memorialPreview").css({
                    background: "#f8f8f8",
                    color: "#222"
                });
            }
            else if(theme === "gold"){
                $("#memorialPreview").css({
                    background: "linear-gradient(145deg, #b8962e, #e6c65c)",
                    color: "#2b2b2b"
                });
            }

            if(font === "classic"){
                $("#memorialPreview").css("font-family", "Georgia, serif");
            }
            else if(font === "modern"){
                $("#memorialPreview").css("font-family", "Arial, sans-serif");
            }
            else if(font === "elegant"){
                $("#memorialPreview").css("font-family", "Times New Roman, serif");
            }
        }
        $("#notes").text(sessionStorage.getItem("notes") || "None");

        $("#total_amount").text("LKR " + sessionStorage.getItem("total_amount"));

        $("#booking_code").text(sessionStorage.getItem("booking_code"));

    });

    $(document).on("click", "#load_step5", function () {
        unlockStep(5);
        loadStep(5);
    });

    $(document).on("click", "#load_step3", function () {
        loadStep(3);
    });
</script>