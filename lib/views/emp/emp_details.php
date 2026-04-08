<!-- <style>
    #preview {
      margin-top: 10px;
      width: 150px;
      height: 150px;
      border: 2px dashed #ccc;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    #preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    #status {
      margin-top: 10px;
      color: green;
    }
</style> -->

<div class="container-fluid mt-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Staff Management</h4>

        <div>
            <input type="text" id="searchStaff" class="form-control d-inline-block w-auto" placeholder="Search staff...">
            <a href="admin.php?page=addStaff" class="btn btn-primary ms-2 mb-1" id="emp_add">
                <i class="fa-solid fa-user"></i>
                Add Staff
            </a>
        </div>
    </div>

    <div id="staffTable">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Staff Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody id="emp_data">
                <!-- Load from database -->
            </tbody>
        </table>
    </div>
</div>

<!-- <div class="card border-primary mb-3">
  <div class="card-header">Staff Management</div>
  <div class="card-body">
   <form id="submit_form" enctype="multipart/form-data">
    <fieldset>
        <legend>Legend</legend>
        <div class="row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" name="staticEmail" value="email@example.com">
        </div>
        </div>
        <div>
        <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div>
        <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" placeholder="Password" autocomplete="off">
        </div>
        <div>
        <label for="exampleSelect1" class="form-label mt-4">Example select</label>
        <select class="form-select" id="exampleSelect1" name="exampleSelect1">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        </div>
        <div>
            <input type="file" name="image_sample" id="image_sample" class="form-control mt-4" accsept="image/*">
            
        </div>
        <button type="submit" class="btn btn-primary mt-2" id="submit_btn" onclick="return false">Submit</button>
    </fieldset>
    </form>
    <div id="preview"></div>
    
    <div class="alert alert-dismissible alert-primary" id="success_alert" style="display:none">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong id="success_msg"></strong> 
    </div>
  </div>
</div> -->

<!-- <script>
    $(document).ready(function(){
        // Preview the selected image
        $("#image_sample").on("change", function() {
        const file = this.files[0];
        if (file) {
            $("#preview").text("Preview will appear here");
            const reader = new FileReader();
            reader.onload = function(event) {
            $("#preview").html('<img src="' + event.target.result + '" alt="Image Preview">');
            }
            reader.readAsDataURL(file);
        } else {
            $("#preview").html("Preview will appear here");
        }
        });
        $("#submit_btn").click(function(e){
            e.preventDefault();
            
            var formData = new FormData($("#submit_form")[0]);

            $.ajax({
                url:"../routes/emp/add_emp_route.php",
                type:"post",
                data:formData,
                contentType: false,
                processData: false,
                success:function(data){
                    $("#success_alert").show();
                    $("#success_msg").html(data);
                    setTimeout(function(){
                        $("#success_alert").hide(1000);
                    },3000)
                },
                error:function(xhr,status,error){
                    console.log("AJAX Error:", {
                        xhr: xhr,
                        status: status,
                        error: error,
                        responseText: xhr.responseText
                    });
                    alert("Error: " + status + "\nResponse: " + xhr.responseText);
                }
            })
        })
    })
</script> -->

<script>
    $(document).on("click", ".addStaffBtn", function(){
    $("#content").load("emp_add.php");
    });

    $(document).ready(function(){
        $.get('../routes/emp/view_emp_route.php', function(data){

            $("#emp_data").html(data);

            $(".edit").click(function(){
                
            })


        })
    });
</script>