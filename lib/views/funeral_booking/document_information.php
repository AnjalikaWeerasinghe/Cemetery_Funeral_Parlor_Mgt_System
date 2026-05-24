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

.form-control {
    border-radius: 10px;
    padding: 10px 12px;
    border: 1px solid #e0e6ed;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13,110,253,0.1);
}

.form-label {
    font-weight: 500;
    color: #444;
}

.form-control,
button {
    transition: all 0.25s ease;
}

input[type="file"] {
    border: 2px dashed #d0d7de;
    background: #f9fbfd;
    padding: 10px;
    cursor: pointer;
}

input[type="file"]:hover {
    border-color: #0d6efd;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.section-box {
    background: #f8fafc;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
}

#load_step3 {
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

#load_step3::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

#load_step3:hover::after {
    left: 100%;
}

#load_step3:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(201,164,76,0.4);
}

#load_step3:active {
    transform: scale(0.98);
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

#load_step3:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(201,164,76,0.3);
}

#preview {
    width: 150px;
    height: 150px;
    border: 2px dashed #ced4da;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 10px;
    background-color: #f8f9fa;
    color: #6c757d;
    font-size: 14px;
}

#preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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

</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form id="document_info" autocomplete="off" enctype="multipart/form-data">
                <div class="section-box">
                    <h6 class="mb-3">Document Information</h6>
                    <p class="text-muted">Please upload the soft copies of the orginal documents to confirm the death of the deceased and 
                    to continue the funeral reservation process.</p>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="death_certificate_number" class="form-label">Death Certificate Number *</label>
                        <input type="text" name="death_certificate_number" id="death_certificate_number" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9 mb-3">
                        <label for="registrar_name" class="form-label">Name of the Registrar *</label>
                        <input type="text" name="registrar_name" id="registrar_name" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="date_of_death" class="form-label">Date of Death *</label>
                        <input type="date" name="date_of_death" id="date_of_death" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cause_of_death" class="form-label">Cause of death *</label>
                    <input type="text" name="cause_of_death" id="cause_of_death" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="death_certificate" class="form-label">Death Certificate *</label>
                    <input type="file" name="death_certificate" id="death_certificate" class="form-control" required>
                    <small class="text-muted">Upload PDF or Image (Max 2MB)</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="coroner_name" class="form-label">Name of the Coroner and Position</label>
                        <input type="text" name="coroner_name" id="coroner_name" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="coroner_decision" class="form-label">Coroner Desicion</label>
                        <input type="text" name="coroner_decision" id="coroner_decision" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="coroner_certificate" class="form-label">Inquirer's Certificate of Death</label>
                    <input type="file" name="coroner_certificate" id="coroner_certificate" class="form-control">
                    <small class="text-muted">Upload PDF or Image (Max 2MB)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label pe-2">Is the body permitted for Cremation? *</label>

                    <div class="d-flex gap-4 mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cremation_permission" value="1" required>
                            <label class="form-check-label">Yes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cremation_permission" value="0">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                    
                </div>

                <div class="mb-3">
                    <label for="family_consent_letter" class="form-label">Family Consent Letter *</label>
                    <input type="file" name="family_consent_letter" id="family_consent_letter" class="form-control" required>
                    <small class="text-muted">Upload PDF or Image (Max 2MB)</small>
                </div>

                <div id="filePreview" class="text-muted small mt-2"></div>

                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <button type="button" class="back-btn" id="load_step1">Back</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" id="load_step3">Proceed to Next Page</button>
                    </div>
                </div>

            </form>
 
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        restoreStep2Data();

        function restoreStep2Data() {
            $("#death_certificate_number").val(sessionStorage.getItem("death_certificate_number") || "");

            $("#registrar_name").val(sessionStorage.getItem("registrar_name") || "");
            $("#date_of_death").val(sessionStorage.getItem("date_of_death") || "");

            $("#cause_of_death").val(sessionStorage.getItem("cause_of_death") || "");
            $("#coroner_name").val(sessionStorage.getItem("coroner_name") || "");
            $("#coroner_decision").val(sessionStorage.getItem("coroner_decision") || "");

            const cremationPermission = sessionStorage.getItem("cremation_permission");
            if (cremationPermission !== null) {
                $(`input[name="cremation_permission"][value="${cremationPermission}"]`).prop("checked", true);
            }

            // Note: Cannot restore file inputs for security reasons, hence indicate if files were previously uploaded
            if (sessionStorage.getItem("death_certificate_uploaded") === "1") {
                $("#death_certificate").after("<small class='text-success'>File previously uploaded</small>");
            }
            if (sessionStorage.getItem("coroner_certificate_uploaded") === "1") {
                $("#coroner_certificate").after("<small class='text-success'>File previously uploaded</small>");
            }
            if (sessionStorage.getItem("family_consent_letter_uploaded") === "1") {
                $("#family_consent_letter").after("<small class='text-success'>File previously uploaded</small>");
            }
        }

        function showFileNames() {
            let files = [
                "death_certificate",
                "coroner_certificate",
                "family_consent_letter"
            ];

            let output = "";

            files.forEach(id => {
                let file = $(`#${id}`)[0].files?.[0];
                if (file) {
                    output += file.name + "<br>";
                }
            });

            $("#filePreview").html(output);
        }

        $("input[type='file']").change(function(){

            const file = this.files[0];

            if(file && file.size > 2 * 1024 * 1024){
                alert("File size must be below 2MB");
                $(this).val("");
            }
        });

        $("input[type='file']").change(showFileNames);

        $("#document_info").on("submit", function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "../routes/funeral_booking/add_document_info_route.php",
                method: "POST",
                data : formData,
                processData: false,
                contentType: false,
                success:function(response){
                    // console.log("Response:", response);

                    response = response.trim();

                    if(response === "success"){

                        sessionStorage.setItem("death_certificate_number", $("#death_certificate_number").val());
                        sessionStorage.setItem("registrar_name", $("#registrar_name").val());
                        sessionStorage.setItem("date_of_death", $("#date_of_death").val());
                        sessionStorage.setItem("cause_of_death", $("#cause_of_death").val());
                        sessionStorage.setItem("coroner_name", $("#coroner_name").val());
                        sessionStorage.setItem("coroner_decision", $("#coroner_decision").val());
                        
                        sessionStorage.setItem("cremation_permission", $('input[name="cremation_permission"]:checked').val());

                        sessionStorage.setItem(
                            "death_certificate_uploaded",
                            $("#death_certificate")[0].files.length > 0 ? "1" : "0"
                        );

                        sessionStorage.setItem(
                            "coroner_certificate_uploaded",
                            $("#coroner_certificate")[0].files.length > 0 ? "1" : "0"
                        );

                        sessionStorage.setItem(
                            "family_consent_letter_uploaded",
                            $("#family_consent_letter")[0].files.length > 0 ? "1" : "0"
                        );

                        unlockStep(3);
                        loadStep(3);

                    } else {

                        alert(response);
                    }
                },

                error:function(xhr){
                    // console.log(xhr.responseText);
                    alert("Something went wrong");
                }
            });
        });

        $("#load_step1").click(function(){
            loadStep(1);
            setActiveStep(1);
        });
    });
    
</script>