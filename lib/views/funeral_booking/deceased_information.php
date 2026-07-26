<!-- Step 1 - Deceased and Applicant Information -->
<?php
session_start();
?>

<?php 
$bookingId = $_GET['booking_id'] ?? null;
$mode = $_GET['mode'] ?? 'create';
?>

<style>
:root {
    --gold-main: #c9a44c;
    --gold-soft: #e8d9a3;
    --gold-dark: #a8892f;
}

body {
    background: #f4f6fb;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    border: none;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    padding: 10px;
}

h6 {
    font-weight: 600;
    color: var(--gold-main);
    border-left: 4px solid var(--gold-main);
    padding-left: 12px;
    letter-spacing: 0.4px;
}

.form-control, .form-select {
    border-radius: 10px;
    padding: 10px 12px;
    border: 1px solid #e0e6ed;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13,110,253,0.1);
}

.form-label {
    font-weight: 500;
    color: #444;
}

.form-control,
.form-select, 
button {
    transition: all 0.25s ease;
}

#load_step2 {
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

#load_step2::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

#load_step2:hover::after {
    left: 100%;
}

#load_step2:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(201,164,76,0.4);
}

#load_step2:active {
    transform: scale(0.98);
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

#load_step2:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(201,164,76,0.3);
}

#preview {
    width: 150px;
    height: 150px;
    border: 2px dashed #d0d7de;
    border-radius: 12px;
    background: #f9fbfd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 13px;
    transition: 0.3s;
}

#preview:hover {
    border-color: #0d6efd;
}

#preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-card{
    background:#fff;
    border-radius:18px;
    padding:20px;
    border:1px solid #edf1f5;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
}

.photo-upload-wrapper{
    width:100%;
    height:260px;
    border:2px dashed #d7dce2;
    border-radius:16px;
    overflow:hidden;
    background:#f9fbfd;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
    transition:0.3s ease;
}

.photo-upload-wrapper:hover{
    border-color:#c9a44c;
    background:#fffdf7;
}

#previewPlaceholder{
    text-align:center;
    color:#7b8794;
}

#previewPlaceholder i{
    font-size:42px;
    color:#c9a44c;
}

#previewImage{
    width:100%;
    height:100%;
    object-fit:cover;
}

.upload-btn{
    background:linear-gradient(135deg,#c9a44c,#e8d9a3);
    color:#2b2b2b;
    padding:10px 18px;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
    display:inline-block;
    transition:0.3s ease;
}

.upload-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(201,164,76,0.35);
}

.input-group-text{
    border-radius:10px 0 0 10px;
}

.input-group .form-control{
    border-radius:0 10px 10px 0;
}

.uploaded-file-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;

    background:linear-gradient(
        135deg, rgba(201,164,76,.12), rgba(232,217,163,.25)
    );

    color:#8a6d1f;
    border:1px solid rgba(201,164,76,.35);
    border-radius:12px;

    padding:5px 7px;
    margin-top:5px;

    font-size:13px;
    font-weight:600;

    box-shadow:0 4px 12px rgba(201,164,76,.12);
}

.uploaded-file-badge i{
    color:#c9a44c;
    font-size:14px;
}

.premium-preview-btn{
    display:inline-flex;
    align-items:center;
    text-decoration:none;

    background:linear-gradient(
        135deg, #c9a44c, #e8d9a3
    );

    color:#2b2b2b;
    font-weight:600;

    padding:5px 8px;
    border-radius:12px;

    transition:.3s ease;
}

.premium-preview-btn:hover{
    color:#2b2b2b;
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(201,164,76,.30);
}
</style>
<!-- 
<?php
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?> -->

<div class="container-fluid">
    <div class="card shadow-sm border-0">

        <div class="card-body">
            <form id="deceased_info" autocomplete="off" enctype="multipart/form-data">
                <div>
                    <input type="hidden" name="service_type" id="service_type">

                    <div class="mb-4 p-3 bg-light rounded-3">
                        <h6 class="mb-0">Deceased Information</h6>
                    </div>

                    <div class="row g-4 align-items-start">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="full_name" class="form-label">Full Name *</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-user text-secondary"></i>
                                        </span>
                                        <input type="text" name="full_name" id="full_name" class="form-control border-start-0" placeholder="Enter deceased full name" required>
                                    </div>   
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="booking_code" class="form-label">Booking Code</label>
                                    <input type="text" name="booking_code" id="booking_code" class="form-control bg-light" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <select name="title" id="title" class="form-select">
                                        <option value="">Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <select name="religion" id="religion" class="form-select">
                                        <option value="">Select Religion</option>
                                        <option value="Buddhism">Buddhism</option>
                                        <option value="Catholic">Catholic</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nic" class="form-label">NIC *</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-id-card text-secondary"></i>
                                        </span>
                                        <input type="text" name="nic" id="nic" class="form-control border-start-0" pattern="[0-9]{9}[vVxX]|[0-9]{12}" placeholder="Enter NIC" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">DOB</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deceased_address" class="form-label">Address</label>
                                <textarea name="deceased_address" id="deceased_address" rows="2" class="form-control" placeholder="Enter address"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="deceased_gn_division" class="form-label">G. N. Division</label>
                                    <select name="deceased_gn_division" id="deceased_gn_division" class="form-select" placeholder="Enter Grama Niladari division">
                                        <option value="">Select GN Division</option>
                                        <option value="Gampola East">Gampola East</option>
                                        <option value="Bothalapitiya">Bothalapitiya</option>
                                        <option value="Illawathura">Illawathura</option>
                                        <option value="Gampola West">Gampola West</option>
                                        <option value="Polkubura">Polkubura</option>
                                        <option value="Aragoda">Aragoda</option>
                                        <option value="Kurukude">Kurukude</option>
                                        <option value="Kudamake">Kudamake</option>
                                        <option value="Jayamalapura">Jayamalapura</option>
                                        <option value="Godagama">Godagama</option>
                                        <option value="Singhapitiya South">Singhapitiya South</option>
                                        <option value="Kahatapitiya">Kahatapitiya</option>
                                        <option value="Ilangawaththa">Ilangawaththa</option>
                                        <option value="Unambuwa">Unambuwa</option>
                                        <option value="Mounttemple">Mounttemple</option>
                                        <option value="Kirinda">Kirinda</option>
                                        <option value="Galgediyawa">Galgediyawa</option>
                                        <option value="Udowita">Udowita</option>
                                        <option value="Rathmalkaduwa">Rathmalkaduwa</option>
                                        <option value="Singhapitiya North">Singhapitiya North</option>
                                        <option value="Hapugaspitiya">Hapugaspitiya</option>
                                        <option value="Kirapane">Kirapane</option>
                                        <option value="Ranawala">Ranawala</option>
                                        <option value="Bowala">Bowala</option>
                                        <option value="Egoda Kalugamuwa">Egoda Kalugamuwa</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="municipal_council" class="form-label">Local Authority</label>
                                    <select name="municipal_council" id="municipal_council" class="form-select" placeholder="Select urban council">
                                        <option value="">Select Local Authority</option>
                                        <option value="Gampola">Gampola</option>
                                        <option value="Wattegama">Wattegama</option>
                                        <option value="Kadugannawa">Kadugannawa</option>
                                        <option value="Nawalapitiya">Nawalapitiya</option>
                                        <option value="Kolonnawa">Kolonnawa</option>
                                        <option value="Seethawakapura">Seethawakapura</option>
                                        <option value="Maharagama">Maharagama</option>
                                        <option value="Boralesgamuwa">Boralesgamuwa</option>
                                        <option value="Kesbewa">Kesbewa</option>
                                        <option value="Kuliyapitiya">Kuliyapitiya</option>
                                        <option value="Puttalam">Puttalam</option>
                                        <option value="Chilaw">Chilaw</option>
                                        <option value="Ambalangoda">Ambalangoda</option>
                                        <option value="Hikkaduwa">Hikkaduwa</option>
                                        <option value="Weligama">Weligama</option>
                                        <option value="Tangalle">Tangalle</option>
                                        <option value="Point Pedro">Point Pedro</option>
                                        <option value="Valvettithurai">Valvettithurai</option>
                                        <option value="Chavakachcheri">Chavakachcheri</option>
                                        <option value="Mannar">Mannar</option>
                                        <option value="Kattankudi">Kattankudi</option>
                                        <option value="Eravur">Eravur</option>
                                        <option value="Ampara">Ampara</option>
                                        <option value="Trincomalee">Trincomalee</option>
                                        <option value="Kinniya">Kinniya</option>
                                        <option value="Haputale">Haputale</option>
                                        <option value="Balangoda">Balangoda</option>
                                        <option value="Embilipitiya">Embilipitiya</option>
                                        <option value="Kegalle">Kegalle</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-3">
                            <div class="photo-card text-center">
                                <div class="photo-upload-wrapper">
                                    <img id="previewImage" src="" style="display:none;">
                                    <div id="previewPlaceholder">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="mb-0 mt-2">Upload Photo</p>
                                    </div>
                                </div>

                                <label class="upload-btn mt-3">
                                    <i class="fa-solid fa-upload me-2"></i>Choose Photo
                                    <input type="file" name="deceased_photo" id="deceased_photo" accept="image/*" hidden>
                                </label>

                                <small class="text-muted d-block mt-2">Optional image upload</small>
                            </div>
                        </div>

                    </div>

                    <div class="mb-4 p-3 bg-light rounded-3">
                        <h6 class="mb-0">Applicant Information</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="applicant_name" class="form-label">Applicant Name *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-user text-secondary"></i>
                                </span>
                                <input type="text" name="applicant_name" id="applicant_name" class="form-control border-start-0" required>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="relationship_to_deceased" class="form-label">Relationship to the deceased *</label>
                            <input type="text" name="relationship_to_deceased" id="relationship_to_deceased" class="form-control" required>
                        </div>     
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="applicant_nic" class="form-label">Applicant NIC</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-id-card text-secondary"></i>
                                </span>
                                <input type="text" name="applicant_nic" id="applicant_nic" class="form-control border-start-0" pattern="[0-9]{9}[vVxX]|[0-9]{12}" placeholder="Enter NIC" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="applicant_nic_upload" class="form-label">Upload NIC Copy *</label>
                        <div class="col-md-6 mb-3">
                            <input type="file" name="applicant_nic_front" id="applicant_nic_front" class="form-control">
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div id="applicant_nic_front_status"></div>
                                <div id="nicFrontPreview"></div>
                            </div>
                            <small class="text-muted">Upload PDF or Image (Max 2MB) - Upload NIC front page</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <input type="file" name="applicant_nic_back" id="applicant_nic_back" class="form-control">
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <div id="applicant_nic_back_status"></div>
                                <div id="nicBackPreview"></div>
                            </div>
                            <small class="text-muted">Upload PDF or Image (Max 2MB) - Upload NIC back page</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="contact_number" class="form-label">Contact Number *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-phone text-secondary"></i>
                                </span>
                                <input type="text" name="contact_number" id="contact_number" pattern="^(\+94|94|0)7[01245678][0-9]{7}$" class="form-control border-start-0" placeholder="+94/0-7XXXXXXXX" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-envelope text-secondary"></i>
                                </span>
                                <input type="email" class="form-control border-start-0" name="email" id="email" autocomplete="off" placeholder="xxx@yyy.zzz">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="applicant_gn_division" class="form-label">G. N. Division</label>
                            <select name="applicant_gn_division" id="applicant_gn_division" class="form-select" placeholder="Enter Grama Niladari division">
                                <option value="">Select GN Division</option>
                                <option value="Gampola East">Gampola East</option>
                                <option value="Bothalapitiya">Bothalapitiya</option>
                                <option value="Illawathura">Illawathura</option>
                                <option value="Gampola West">Gampola West</option>
                                <option value="Polkubura">Polkubura</option>
                                <option value="Aragoda">Aragoda</option>
                                <option value="Kurukude">Kurukude</option>
                                <option value="Kudamake">Kudamake</option>
                                <option value="Jayamalapura">Jayamalapura</option>
                                <option value="Godagama">Godagama</option>
                                <option value="Singhapitiya South">Singhapitiya South</option>
                                <option value="Kahatapitiya">Kahatapitiya</option>
                                <option value="Ilangawaththa">Ilangawaththa</option>
                                <option value="Unambuwa">Unambuwa</option>
                                <option value="Mounttemple">Mounttemple</option>
                                <option value="Kirinda">Kirinda</option>
                                <option value="Galgediyawa">Galgediyawa</option>
                                <option value="Udowita">Udowita</option>
                                <option value="Rathmalkaduwa">Rathmalkaduwa</option>
                                <option value="Singhapitiya North">Singhapitiya North</option>
                                <option value="Hapugaspitiya">Hapugaspitiya</option>
                                <option value="Kirapane">Kirapane</option>
                                <option value="Ranawala">Ranawala</option>
                                <option value="Bowala">Bowala</option>
                                <option value="Egoda Kalugamuwa">Egoda Kalugamuwa</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="applicant_address" class="form-label">Address *</label>
                        <textarea name="applicant_address" id="applicant_address" rows="2" class="form-control" required></textarea>
                    </div>

                </div>

                <div class="text-end mt-3">
                    <button type="submit" id="load_step2">Proceed to Next Page</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        let today = new Date();

        today.setDate(today.getDate() -1); // Prevent user from selecting current and future dates
        
        let maxDate = today.toISOString().split('T')[0];

        $("#date_of_birth").attr("max", maxDate);
        
        const mode = window.mode;
        const bookingCode = window.bookingCode;

        console.log("Mode:", mode);

        if (mode === "create") {
            // loadBookingCodeIfCreate();
            restoreStep1DataIfCreate();
        }

        //Load existing deceased and applicant information if in view mode
        if(mode !== "create" && bookingCode) {
            applyMode(mode);

            $.ajax({
                url: "../routes/funeral_booking/get_funeral_booking_info_route.php",
                type: "GET",
                data: { booking_code: bookingCode },

                success: function (res) {
                    const data = (typeof res === "string") ? JSON.parse(res) : res;

                    $("#full_name").val(data.full_name);
                    $("#booking_code").val(data.booking_code);
                    $("#title").val(data.title);
                    $("#religion").val(data.religion);
                    $("#gender").val(data.gender);
                    $("#nic").val(data.nic);
                    $("#date_of_birth").val(data.date_of_birth);

                    $("#deceased_address").val(data.deceased_address);
                    $("#deceased_gn_division").val(data.deceased_gn_division);
                    $("#municipal_council").val(data.municipal_council);

                    $("#applicant_name").val(data.applicant_name);
                    $("#relationship_to_deceased").val(data.relationship_to_deceased);
                    $("#applicant_nic").val(data.applicant_nic);
                    $("#contact_number").val(data.contact_number);
                    $("#email").val(data.email);
                    $("#applicant_gn_division").val(data.applicant_gn_division);
                    $("#applicant_address").val(data.applicant_address);

                    if (data.deceased_photo) {
                        $("#previewImage").attr("src", data.deceased_photo).show();
                        $("#previewPlaceholder").hide();
                    }

                    if(data.applicant_nic_front){
                        $("#nicFrontPreview").html(
                            `<a href="${data.applicant_nic_front}" target="_blank">
                                View NIC Front
                            </a>`
                        );
                    }

                    if(data.applicant_nic_back){
                        $("#nicBackPreview").html(
                            `<a href="${data.applicant_nic_back}" target="_blank">
                                View NIC Back
                            </a>`
                        );
                    }

                    applyMode(mode);
                }
            });
        } else {
            applyMode(mode);
        }

        function applyMode(mode) {

            if (mode === "view") {
                $("#deceased_info :input").not("#booking_code").prop("disabled", true);

                $("#load_step2").hide();
                $(".upload-btn").hide();

            }

            if (mode === "edit") {

                $("#booking_code").prop("disabled", true); // prevent editing code
            }
        }

        // This function restores previously entered step 1 data from sessionStorage
        // This is useful when users navigate back to Step 1 from Step 2
        function restoreStep1DataIfCreate(){
            if(mode !== "create") return;

            let savedPreview = sessionStorage.getItem("deceased_photo_preview");

            $("#booking_code").val(sessionStorage.getItem("booking_code"));

            $("#full_name").val(sessionStorage.getItem("full_name"));
            $("#booking_code").val(sessionStorage.getItem("booking_code"));
            $("#title").val(sessionStorage.getItem("title"));
            $("#religion").val(sessionStorage.getItem("religion"));
            $("#nic").val(sessionStorage.getItem("nic"));
            $("#gender").val(sessionStorage.getItem("gender"));
            $("#date_of_birth").val(sessionStorage.getItem("date_of_birth"));

            $("#deceased_address").val(sessionStorage.getItem("deceased_address"));
            $("#deceased_gn_division").val(sessionStorage.getItem("deceased_gn_division"));
            $("#municipal_council").val(sessionStorage.getItem("municipal_council"));

            $("#applicant_name").val(sessionStorage.getItem("applicant_name"));
            $("#relationship_to_deceased").val(sessionStorage.getItem("relationship_to_deceased"));

            $("#applicant_nic").val(sessionStorage.getItem("applicant_nic"));
            
            $("#contact_number").val(sessionStorage.getItem("contact_number"));
            $("#email").val(sessionStorage.getItem("email"));

            $("#applicant_gn_division").val(sessionStorage.getItem("applicant_gn_division"));
            $("#applicant_address").val(sessionStorage.getItem("applicant_address"));

            const deceasedPhoto = sessionStorage.getItem("deceased_photo");

            if(deceasedPhoto){
                $("#previewImage").attr("src", "/Cemetery_Funeral_Parlor_Mgt_System/lib/" + deceasedPhoto).show();
                $("#previewPlaceholder").hide();
            }

            const nicFrontFile = sessionStorage.getItem("applicant_nic_front_path");

            if(nicFrontFile){

                const nicFrontPath = "/Cemetery_Funeral_Parlor_Mgt_System/lib/" + sessionStorage.getItem("applicant_nic_front_path");

                $("#applicant_nic_front_status").html(
                    `<span class="uploaded-file-badge">
                        <i class="fas fa-check-circle me-1 m-1"></i> ${sessionStorage.getItem("applicant_nic_front_name")}
                    </span>`
                );

                $("#nicFrontPreview").html(
                    `<a href="${nicFrontPath}" target="_blank" class="premium-preview-btn mt-2">
                        <i class="fas fa-eye me-2"></i>View NIC Front
                    </a>`
                );
            }

            const nicBackFile = sessionStorage.getItem("applicant_nic_back_path");

            if(nicBackFile){

                const nicBackPath = "/Cemetery_Funeral_Parlor_Mgt_System/lib/" + sessionStorage.getItem("applicant_nic_back_path");

                $("#applicant_nic_back_status").html(
                    `<span class="uploaded-file-badge">
                        <i class="fas fa-check-circle me-1 m-1"></i> ${sessionStorage.getItem("applicant_nic_back_name")}
                    </span>`
                );

                $("#nicBackPreview").html(
                    `<a href="${nicBackPath}" target="_blank" class="premium-preview-btn mt-2">
                        <i class="fas fa-eye me-2"></i>View NIC Back
                    </a>`
                );
            }

            if(sessionStorage.getItem("applicant_nic_back_name")) {
                $("#applicant_nic_back").removeAttr("required");
            }

             if(sessionStorage.getItem("applicant_nic_front_name")) {
                $("#applicant_nic_front").removeAttr("required");
            }

        }

        // This function generates a unique booking code based on the selected service type
        function loadBookingCodeIfCreate(){
            if (mode !== "create") return;

            const serviceType = localStorage.getItem("selectedBookingService");

            // console.log("DEBUG serviceType:", serviceType);

            if(!serviceType){
                showError("No service type selected. Please select a service first.");
                return;
            }

            $.ajax({
                url: "../routes/funeral_booking/generate_booking_code.php",
                type: "POST",
                data: { service_type: serviceType },
                success: function (response) {
                    // console.log("PHP RESPONSE:", response);
                    $("#booking_code").val(response.trim());
                    // localStorage.setItem("bookingCode", response);
                },
                error: function (xhr) {
                    console.log("AJAX ERROR:", xhr.responseText);
                }
            });
        }

        // Handle form submission for deceased and applicant information
        $("#deceased_info").on("submit", function(e) {
            e.preventDefault();

            if (mode === "view") return;

            $("#service_type").val(localStorage.getItem("selectedBookingService"));

            var formData = new FormData(this);

            let route = "<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin')
                ? '../routes/funeral_booking/add_deceased_info_route.php'
                : 'lib/routes/funeral_booking/add_deceased_info_route.php'; ?>";

            console.log("Role:", <?= json_encode($_SESSION['role'] ?? '') ?>);
            console.log("Route:", route);

            $.ajax({
                url: route,
                method: "POST",
                data : formData,
                processData: false,
                contentType: false,

                success:function(response){
                    console.log("Response:", response);

                    response = JSON.parse(response);

                    if(response.status === "success"){

                    // store data from Step 1 in sessionStorage to restore it when user comes back to Step 1 from Step 2
                        sessionStorage.setItem("full_name", $("#full_name").val());
                        sessionStorage.setItem("booking_code", $("#booking_code").val());
                        sessionStorage.setItem("title", $("#title").val());
                        sessionStorage.setItem("religion", $("#religion").val());
                        sessionStorage.setItem("nic", $("#nic").val());
                        sessionStorage.setItem("gender", $("#gender").val());
                        sessionStorage.setItem("date_of_birth", $("#date_of_birth").val());
                        sessionStorage.setItem("deceased_address", $("#deceased_address").val());
                        sessionStorage.setItem("deceased_gn_division", $("#deceased_gn_division").val());
                        sessionStorage.setItem("municipal_council", $("#municipal_council").val());

                        sessionStorage.setItem("applicant_name", $("#applicant_name").val());
                        sessionStorage.setItem("relationship_to_deceased", $("#relationship_to_deceased").val());
                        sessionStorage.setItem("applicant_nic", $("#applicant_nic").val());
                        
                        sessionStorage.setItem("contact_number", $("#contact_number").val());
                        sessionStorage.setItem("email", $("#email").val());
                        sessionStorage.setItem("applicant_gn_division", $("#applicant_gn_division").val());
                        sessionStorage.setItem("applicant_address", $("#applicant_address").val());

                        sessionStorage.setItem("applicant_nic_front_path", response.nic_front_path);
                        sessionStorage.setItem("applicant_nic_back_path", response.nic_back_path);
                        sessionStorage.setItem("deceased_photo", response.deceased_photo);

                        const nicFront = $("#applicant_nic_front")[0].files[0]?.name || sessionStorage.getItem("applicant_nic_front_name");
                        sessionStorage.setItem("applicant_nic_front_name", nicFront);

                        const nicBack = $("#applicant_nic_back")[0].files[0]?.name || sessionStorage.getItem("applicant_nic_back_name");
                        sessionStorage.setItem("applicant_nic_back_name", nicBack);

                        unlockStep(2);
                        loadStep(2);

                    } else {

                        alert(response);
                    }
                }
            });
        });

        // This function handles the image preview when a user selects a photo for the deceased
        $("#deceased_photo").change(function(e){
            if (mode === "view") return;

            let file = e.target.files[0];

            if(file){
                let reader = new FileReader();

                reader.onload = function(event){
                    $("#previewImage").attr("src", event.target.result).show();
                    $("#previewPlaceholder").hide();

                    sessionStorage.setItem("deceased_photo_preview", event.target.result);
                };

                reader.readAsDataURL(file);
            }

        });

        // Automatically set gender based on the selected title    
        $("#title").change(function(){
            if (mode === "view") return;

            let title = $(this).val();

            if(title === "Mr"){
                $("#gender").val("Male");
            }
            else if(title === "Mrs" || title === "Miss"){
                $("#gender").val("Female");
            }
        });

        $("input[type='file']").change(function(){

            const file = this.files[0];

            if(!file) return;

            if(file.size > 2 * 1024 * 1024){
                showError("File size must be below 2MB");
                $(this).val("");
                return;
            }

            const allowedTypes = ["application/pdf", "image/jpeg", "image/png", "image/jpg", "image/webp"];

            if(!allowedTypes.includes(file.type)){
                showError("Only PDF, JPG, JPEG, PNG, and WEBP files are allowed.")
                $(this).val("");
                return;
            }
        });

    });
 
</script>
