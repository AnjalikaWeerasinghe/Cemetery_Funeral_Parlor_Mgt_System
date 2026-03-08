<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Manage Cemetery Roles</h5>
        </div>

        <div class="card-body">
            <form id="submit_form" autocomplete="off">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Role *</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows=2></textarea>
                    </div>  
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="permission" class="form-label">Role Permission*</label>
                        <textarea name="permission" id="permission" class="form-control" required rows=2></textarea>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                </div>

            </form>

            <!-- <div class="alert alert-success mt-3 d-none" id="success_alert">
                <strong id="success_msg"></strong>
            </div> -->
        </div>
    </div>
</div>

<br>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5>View Role Details</h5>
        </div>

        <div class="card-body" id="roleTable">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Role</th>
                        <th>Description</th>
                        <th>Permission</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody id="role_data">
                    <!-- Load from database -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#submit_form").on("submit", function(e){
        e.preventDefault();

        let formData = new FormData(this);

            $.ajax({
            url: "../routes/system_settings/role_settings_route.php",
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

                setTimeout(function(){
                $("#success_alert").addClass("d-none");
                }, 3000);
            },
            error: function(xhr){
                alert("Error: " + xhr.responseText);
            },
            complete: function(){
                $("button[type='submit']").prop("disabled", false).text("Save");
            }
            });

        });

        $.get('../routes/system_settings/view_roles_route.php', function(data){
            $("#role_data").html(data);
        })
    });
</script>