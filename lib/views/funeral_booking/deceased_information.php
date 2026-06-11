<!-- Step 1 - Deceased and Applicant Information -->

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

</style>

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
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deceased_address" class="form-label">Address</label>
                                <textarea name="deceased_address" id="deceased_address" rows="2" class="form-control" placeholder="Enter address"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="deceased_gn_division" class="form-label">G. N. Division</label>
                                    <input type="text" name="deceased_gn_division" id="deceased_gn_division" class="form-control" placeholder="Enter Grama Niladari division">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="municipal_council" class="form-label">Area of Urban Council</label>
                                    <input type="text" name="municipal_council" id="municipal_council" class="form-control" placeholder="Enter municipal council">
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
                        <div class="col-md-4 mb-3">
                            <label for="contact_number" class="form-label">Contact Number *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-phone text-secondary"></i>
                                </span>
                                <input type="text" name="contact_number" id="contact_number" class="form-control border-start-0" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa-solid fa-envelope text-secondary"></i>
                                </span>
                                <input type="email" class="form-control border-start-0" name="email" id="email" autocomplete="off" placeholder="Enter email">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="applicant_gn_division" class="form-label">G. N. Division</label>
                            <input type="text" name="applicant_gn_division" id="applicant_gn_division" class="form-control" placeholder="Enter Grama Niladari division">
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
        loadBookingCode();

        restoreStep1Data();

        // This function restores previously entered step 1 data from sessionStorage
        // This is useful when users navigate back to Step 1 from Step 2
        function restoreStep1Data(){
            let savedPreview = sessionStorage.getItem("deceased_photo_preview");

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

            $("#contact_number").val(sessionStorage.getItem("contact_number"));
            $("#email").val(sessionStorage.getItem("email"));

            $("#applicant_gn_division").val(sessionStorage.getItem("applicant_gn_division"));
            $("#applicant_address").val(sessionStorage.getItem("applicant_address"));

            if(savedPreview){
                $("#previewImage").attr("src", savedPreview).show();
                $("#previewPlaceholder").hide();
            }

        }

        // This function generates a unique booking code based on the selected service type
        function loadBookingCode(){
            const serviceType = localStorage.getItem("selectedBookingService");

            // console.log("DEBUG serviceType:", serviceType);

            if(!serviceType){
                alert("No service type selected. Please select a service first.");
                return;
            }

            $("#booking_code").val("Generating..");

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

            $("#service_type").val(localStorage.getItem("selectedBookingService"));

            var formData = new FormData(this);

            $.ajax({
                url: "../routes/funeral_booking/add_deceased_info_route.php",
                method: "POST",
                data : formData,
                processData: false,
                contentType: false,

                success:function(response){
                    console.log("Response:", response);

                    response = response.trim();

                    if(response === "success"){

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
                        sessionStorage.setItem("contact_number", $("#contact_number").val());
                        sessionStorage.setItem("email", $("#email").val());
                        sessionStorage.setItem("applicant_gn_division", $("#applicant_gn_division").val());
                        sessionStorage.setItem("applicant_address", $("#applicant_address").val());
                        
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
            let title = $(this).val();

            if(title === "Mr"){
                $("#gender").val("Male");
            }
            else if(title === "Mrs" || title === "Miss"){
                $("#gender").val("Female");
            }
        });

    });
 
</script>
