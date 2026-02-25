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
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Add New Staff Member</h5>

      <a href="admin.php?page=staff" class="btn btn-light btn-sm bg-warning">
        <i class="fa-solid fa-arrow-left"></i>
        Back
      </a>
    </div>

    <div class="card-body">
      <form id="submit_form" autocomplete="off" enctype="multipart/form-data">

        <h6 class="border-bottom pb-2 mb-3 text-primary">Personal Information</h6>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="f_name" class="form-label">First Name *</label>
            <input type="text" name="first_name" id="f_name" class="form-control" required>
          </div>

          <div class="col-md-4 mb-3">
            <label for="m_name" class="form-label">Middle Name</label>
            <input type="text" name="middle_name" id="m_name" class="form-control">
          </div>

          <div class="col-md-4 mb-3">
            <label for="l_name" class="form-label">Last Name *</label>
            <input type="text" name="last_name" id="l_name" class="form-control" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="nic" class="form-label">NIC</label>
            <input type="text" name="nic" id="nic" class="form-control" required>
          </div>

          <div class="col-md-3 mb-3">
            <label for="gender" class="form-label">Gender *</label>
            <select name="gender" id="gender" class="form-select">
              <option value="">Select</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

          <div class="col-md-3 mb-3">
            <label for="date_of_birth" class="form-label">DOB</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
          </div>

          <div class="col-md-3 mb-3">
            <label for="contact_number" class="form-label">Contact Number *</label>
            <input type="text" name="contact_number" id="contact" class="form-control">
          </div>
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address *</label>
          <textarea name="address" id="address" rows="2" class="form-control"></textarea>
        </div>

        <h6 class="border-bottom pb-2 mb-3 text-primary">Employment Details</h6>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="role_id" class="form-label">Position *</label>
            <select name="role_id" id="role_id" class="form-select">
              <option value="">Select</option>
              <option value="1">Cemetery Manager</option>
              <option value="2">Clerk</option>
            </select>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">Employement Type *</label>
            <select name="employement_type" id="employment_type" class="form-select">
              <option value="">Select</option>
              <option value="Full-time">Full-time</option>
              <option value="Part-time">Part-time</option>
              <option value="Contract">On Contract</option>
            </select>
          </div>

          <div class="col-md-4 mb-3">
              <label class="form-label">Date Joined *</label>
              <input type="date" name="date_joined" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Status *</label>
            <select name="staff_status" class="form-select">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">Salary (Optional)</label>
            <input type="number" name="salary" class="form-control">
          </div>
        </div>

        <h6 class="border-bottom pb-2 mb-3 text-primary">Account Details</h6>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Email *</label>
            <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Enter email" required>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">Password *</label>
            <input type="password" class="form-control" name="password" autocomplete="new-password" placeholder="Enter password" required>
          </div>

          <div class="col-md-3 mb-3">
            <label class="form-label">System Role</label>
            <select class="form-select" name="system_role" required>
              <option value="">Select role</option>
              <option value="Admin">Admin</option>
              <option value="Manager">Manager</option>
              <option value="Staff">Staff</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 mb-3">
            <label class="form-label">Profile Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
          </div>

          <div class="col-md-4 mb-3">
            <label for="emp_code" class="form-label">Employee Code</label>
            <input type="text" name="staff_code" id="emp_code" class="form-control" readonly>
          </div>
        </div>

        <div id="preview" class="col-md-6 mb-3">
          Image preview
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-success">
            Save 
          </button>

          <a href="admin.php?page=staff" class="btn btn-secondary">
            Cancel
          </a>
        </div>

      </form>

      <!-- Success Alert -->
      <div class="alert alert-success mt-3 d-none" id="success_alert">
        <strong id="success_msg"></strong>
      </div>

    </div>
  </div>
</div>


<script>
$(document).ready(function(){

  $.ajax({
    url: "../routes/emp/generate_staff_code.php",
    type: "GET",
    success: function (response) {
      $("#emp_code").val(response);
    }
  });

  // Image Preview
  $("#image").on("change", function() {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        $("#preview").html(
          '<img src="' + e.target.result + '" alt="Preview">'
        );
      };
      reader.readAsDataURL(file);
    } else {
      $("#preview").html("Image preview");
    }
  });

  // Form Submit
  $("#submit_form").on("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
      url: "../routes/emp/add_emp_route.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function(){
        $("button[type='submit']").prop("disabled", true).text("Saving...");
      },
      success: function(response){

        $("#success_msg").html(response);
        $("#success_alert").removeClass("d-none");

        // Reset form
        $("#submit_form")[0].reset();
        $("#preview").html("Image preview");

        setTimeout(function(){
          $("#success_alert").addClass("d-none");
        }, 3000);
      },
      error: function(xhr){
        alert("Error: " + xhr.responseText);
      },
      complete: function(){
        $("button[type='submit']").prop("disabled", false).text("Save Staff");
      }
    });

  });

});
</script>


