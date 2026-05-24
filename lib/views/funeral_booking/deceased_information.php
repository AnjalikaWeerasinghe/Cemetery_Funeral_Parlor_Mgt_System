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

</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">

        <div class="card-body">
            <form id="deceased_info" autocomplete="off" enctype="multipart/form-data">
                <div>
                    <input type="hidden" name="service_type" id="service_type">

                    <div class="mb-4 p-3 bg-light rounded-3">
                        <h6 class="mb-3">Deceased Information</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="full_name" class="form-label">Full Name *</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" required>
                        </div>   

                        <div class="col-md-4 mb-3">
                            <label for="booking_code" class="form-label">Booking Code</label>
                            <input type="text" name="booking_code" id="booking_code" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nic" class="form-label">NIC *</label>
                            <input type="text" name="nic" id="nic" class="form-control" pattern="[0-9]{9}[vVxX]|[0-9]{12}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="date_of_birth" class="form-label">DOB</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deceased_address" class="form-label">Address</label>
                        <textarea name="deceased_address" id="deceased_address" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="deceased_gn_division" class="form-label">G. N. Division</label>
                            <input type="text" name="deceased_gn_division" id="deceased_gn_division" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="municipal_council" class="form-label">Area of Municipal Council</label>
                            <input type="text" name="municipal_council" id="municipal_council" class="form-control">
                        </div>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded-3">
                        <h6 class="mb-3">Applicant Information</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="applicant_name" class="form-label">Applicant Name *</label>
                            <input type="text" name="applicant_name" id="applicant_name" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="relationship_to_deceased" class="form-label">Relationship to the deceased *</label>
                            <input type="text" name="relationship_to_deceased" id="relationship_to_deceased" class="form-control" required>
                        </div>     
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="contact_number" class="form-label">Contact Number *</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Enter email">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="applicant_gn_division" class="form-label">G. N. Division</label>
                            <input type="text" name="applicant_gn_division" id="applicant_gn_division" class="form-control">
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

        function restoreStep1Data(){

            $("#full_name").val(sessionStorage.getItem("full_name"));
            $("#booking_code").val(sessionStorage.getItem("booking_code"));
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

        }

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

                        sessionStorage.setItem("full_name", $("#full_name").val());
                        sessionStorage.setItem("booking_code", $("#booking_code").val());
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

    });
 
</script>
