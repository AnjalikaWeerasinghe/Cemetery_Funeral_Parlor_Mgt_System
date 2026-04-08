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

        <div class="card-body">
            <form id="deceased_info" autocomplete="off" enctype="multipart/form-data">
                <div>
                    <h6 class="border-bottom pb-2 mb-3 text-primary">Deceased Information</h6>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="full_name" class="form-label">Full Name *</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" required>
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

                    <h6 class="border-bottom pb-2 mb-3 text-primary">Applicant Information</h6>

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

                <div>
                    <button type="submit" id="load_step2" class="btn btn-success">Next</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $("#deceased_info").on("submit", function(e) {
        e.preventDefault();

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
                    
                    $("#bookingContent").load("funeral_booking/document_information.php");

                } else {

                    alert(response);
                }
            }
        });
    });
</script>