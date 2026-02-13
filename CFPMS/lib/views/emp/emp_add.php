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
      <form id="submit_form" enctype="multipart/form-data">

        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-control" name="email" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>

        <!-- Role -->
        <div class="mb-3">
          <label class="form-label">Role</label>
          <select class="form-select" name="role" required>
            <option value="">Select role</option>
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option>
          </select>
        </div>

        <!-- Profile Image -->
        <div class="mb-3">
          <label class="form-label">Profile Image</label>
          <input type="file"
                 name="image_sample"
                 id="image_sample"
                 class="form-control"
                 accept="image/*">
        </div>

        <!-- Preview -->
        <div id="preview" class="mb-3">
          Image preview
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-success">
            Save Staff
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

  // Image Preview
  $("#image_sample").on("change", function() {
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


