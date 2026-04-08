<style>
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
</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body" id="document_info">
            <form id="document_info_form" autocomplete="off" enctype="multipart/form-data">
                <div>
                    <h6 class="border-bottom pb-2 mb-3 text-primary">Document Information</h6>
                    <p>Please upload the soft copies of the orginal documents to confirm the death of the deceased and 
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
                </div>

                <div class="mb-3">
                    <label for="cremation_permission" class="form-label pe-2">Is the body permitted for Cremation? *</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">No</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="family_consent_letter" class="form-label">Family Consent Letter *</label>
                    <input type="file" name="family_consent_letter" id="family_consent_letter" class="form-control" required>
                </div>
            </form>

            <div>
                <button type="submit" class="btn btn-success">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
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
                console.log("Response:", response);

                response = response.trim();

                if(response === "success"){
                    
                    $("#bookingContent").load("funeral_booking/cremation_information.php");

                } else {

                    alert(response);
                }
            }
        });
    });
</script>