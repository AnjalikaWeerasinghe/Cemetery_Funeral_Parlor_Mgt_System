<?php
    $supplier_id = $_GET['supplier_id'] ?? '';
?>

<style>
    :root{
        --primary:#111111;
        --secondary:#1d1d1d;
        --gold:#c9a227;
        --gold-light:#e8c760;
        --background:#f4f6f9;
        --white:#ffffff;
        --text:#444;
        --border:#e5e5e5;
    }

    body{
        background:var(--background);
        font-family:'Segoe UI',sans-serif;
        color:var(--text);
    }

    .cem-wrapper{
        padding:25px;
    }

    .cem-card{
        border:none;
        border-radius:22px;
        overflow:hidden;
        background:#fff;
        box-shadow:0 15px 40px rgba(0,0,0,.08);
    }

    .cem-header{
        background:linear-gradient(135deg,#111,#2c2c2c);
        color:#fff;
        padding:25px 30px;
        border-bottom:4px solid var(--gold);
    }

    .cem-header h4{
        font-weight:700;
        margin-bottom:5px;
    }

    .section-box{
        background:#fff;
        border-radius:18px;
        padding:25px;
        border-top:4px solid var(--gold);
        box-shadow:0 5px 20px rgba(0,0,0,.05);
        margin-bottom:25px;
    }

    .section-title{
        font-size:15px;
        font-weight:700;
        color:#111;
        display:flex;
        align-items:center;
        gap:10px;
        margin-bottom:25px;
    }

    .section-title i{
        color:var(--gold);
    }

    .code-card{
        background:#fff;
        border:2px solid #111;
        border-radius:18px;
        padding:25px;
        text-align:center;
        margin-bottom:25px;
        transition:.3s;
    }

    .code-card:hover{
        border-color:var(--gold);
        box-shadow:0 8px 20px rgba(0,0,0,.08);
    }

    .code-card small{
        color:#666;
        font-size:13px;
        letter-spacing:1.5px;
        text-transform:uppercase;
        font-weight:600;
    }

    .code-card h3{
        margin-top:10px;
        color:#111;
        font-weight:700;
        letter-spacing:2px;
        font-size:28px;
    }

    .input-group-text{
        background:#fff;
        border-right:none;
        color:var(--gold);
    }

    .form-control, .form-select{
        height:48px;
        border-left:none;
    }

    textarea.form-control{
        height:110px;
        resize:none;
    }

    .form-control:focus, .form-select:focus{
        border-color:var(--gold);
        box-shadow:0 0 0 .18rem rgba(201,162,39,.18);
    }

    .status-card{
        background:#fafafa;
        border-radius:15px;
        padding:20px;
        border:1px solid #eee;
    }

    .btn-save{
        background:linear-gradient(135deg,var(--gold),#b98d17);
        color:#fff;
        border:none;
        padding:12px 35px;
        border-radius:10px;
        font-weight:600;
    }

    .btn-save:hover{
        color:#fff;
        transform:translateY(-2px);
    }

    .btn-cancel{
        border:2px solid var(--gold);
        color:var(--gold);
        padding:11px 25px;
    }
</style>

<div class="container-fluid cem-wrapper">

    <div class="card cem-card">

        <div class="cem-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="fa fa-user-plus me-2"></i>Supplier Registration
                </h4>
                <p class="mb-0 opacity-75">Register a new cemetery supplier</p>
            </div>

            <a href="admin.php?page=supplier" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card-body p-4">

            <form id="submit_form">

                <input type="hidden" id="supplier_id" name="supplier_id">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="section-box">

                            <div class="section-title">
                                <i class="fa fa-building"></i>Supplier Details
                            </div>

                            <div class="code-card">
                                <small>Supplier Code</small>
                                <h3 id="supplier_code"></h3>
                                <input type="hidden" id="supplier_code" name="supplier_code">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Supplier Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter supplier name">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Registration Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="registration_number" name="registration_number">
                                </div>
                            </div>

                            <div class="status-card mb-4">
                                <h6 class="fw-bold mb-3">Supplier Status</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="supplier_status" value="Active" checked>
                                    <label class="form-check-label">Active</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="supplier_status" value="Inactive">
                                    <label class="form-check-label">Inactive</label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="section-box">

                            <div class="section-title">
                                <i class="fa fa-address-book"></i>Contact Information
                            </div>

                            <div class="mb-3">
                                <label>Contact Person</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    <input type="email"class="form-control"id="email"name="email">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Supplier address"></textarea>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-light">Clear</button>

                    <a href="admin.php?page=supplier" class="btn btn-cancel">Cancel</a>

                    <button type="submit" class="btn btn-save">
                        <i class="fa fa-save me-2"></i>Save Supplier
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    $(document).ready(function (){
        loadSupplierCode();

        function loadSupplierCode() {
            $("#supplier_code").text("Generating..");

            $.ajax({
                url: "../routes/supplier/generate_supplier_code.php",
                type: "GET",
                success: function (response) {
                    $("#supplier_code").text(response);
                    $("#supplier_code").val(response);
                },
                error: function () {
                    $("#supplier_code").text("Error");
                }
            });
        }

        $("#submit_form").submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "../routes/supplier/add_supplier_route.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("button[type='submit']").prop("disabled", true).text("Saving...");
                },
                success: function(response){
                    if(response === "success"){
                        Swal.fire({
                            icon: "success",
                            title: "Supplier Added Successfully",
                            showConfirmButton: false,
                            timer: 3500
                        }).then(() => {
                            $("#root").load("supplier/supplier.php");
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Failed to Add Supplier",
                            text: response
                        });
                    }
                },
                error: function(xhr, status, error){
                    $("button[type='submit']").prop("disabled", false).text("Save Supplier");
                    Swal.fire({
                        icon: "error",
                        title: "Server Error",
                        text: "An error occurred while processing your request."
                    });
                },
                complete: function(){
                    $("button[type='submit']").prop("disabled", false).text("Save Supplier");
                }
            })
        })

        $("#submit_form").on("reset", function(){
            setTimeout(function(){
                loadSupplierCode(); 
            }, 100); 
        });

    })
</script>