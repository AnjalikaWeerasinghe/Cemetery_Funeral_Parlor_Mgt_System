<?php
    $member_id = $_GET['member_id'] ?? '';
?>

<style>
    :root {
        --primary: #111111;
        --secondary: #1b1b1b;
        --gold: #c9a227;
        --gold-light: #e8c760;

        --text: #2c2c2c;
        --card: #ffffff;
        --border: #e8e8e8;
        --bg: #f5f5f5;
    }

    body {
        background: var(--bg);
        font-family: 'Segoe UI', sans-serif;
        color: var(--text);
    }

    .cem-wrapper {
        padding: 20px;
    }

    .cem-header {
        background: linear-gradient(135deg,#111,#242424);
        color: #fff;
        padding: 22px 28px;
        border-bottom: 4px solid var(--gold);
    }

    .cem-card {
        border: none;
        border-radius: 18px;
        background: white;
        box-shadow: 0 12px 30px rgba(0,0,0,.08);
    }

    .section-box {
        border: none;
        border-radius: 16px;
        background: #f9f9f9;
        padding: 22px;
        box-shadow: 0 3px 12px rgba(0,0,0,.05);
        margin-bottom: 22px;
    }

    .section-title {
        color: var(--gold);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-left: 4px solid var(--gold);
        padding-left: 12px;
        margin-bottom: 18px;
    }

    .form-control, .form-select {
        height: 48px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 .18rem rgba(201,162,39,.18);
    }

    .photo-card {
        border-radius: 18px;
        padding: 25px;
        background: white;
        text-align: center;
        border: 1px solid #eee;
        box-shadow: 0 6px 18px rgba(0,0,0,.05);
    }

    .photo-upload-wrapper {
        width: 180px;
        height: 180px;
        margin: auto;
        border-radius: 50%;
        border: 3px dashed var(--gold);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fafafa;
    }

    .upload-btn {
        background: var(--gold);
        color: #111;
        padding: 10px 22px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 600;
        margin-top: 20px;
    }

    .btn-cem {
        background: linear-gradient(135deg,#111,#2d2d2d);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
    }

    .btn-cem:hover {
        background: linear-gradient(135deg,#000,#111);
        box-shadow: 0 10px 20px rgba(0,0,0,.18);
    }

    .btn-outline-secondary {
        border: 2px solid var(--gold);
        color: var(--gold);
    }

</style>

<div class="container-fluid cem-wrapper">

    <div class="card cem-card">

        <div class="cem-header d-flex justify-content-between align-items-center">

            <div>
                <h4 class="fw-bold mb-1">
                    <i class="fa fa-user-plus me-2"></i>Supplier Registration
                </h4>
                <p class="mb-0 opacity-75">
                    Register a new cemetery supplier
                </p>
            </div>

            <a href="admin.php?page=supplier" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back
            </a>

        </div>

        <div class="card-body p-4">

            <form id="submit_form" enctype="multipart/form-data">

                <input type="hidden" id="supplier_id" name="supplier_id">

                <div class="row g-4">

                    <div class="col-lg-8">

                        <div class="section-box">

                            <div class="section-title">Contact Information</div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name *">
                                </div>

                                <div class="col-md-4">
                                    <input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Middle Name">
                                </div>

                                <div class="col-md-4">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name *">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="nic" name="nic" class="form-control" pattern="[0-9]{9}[vVxX]|[0-9]{12}" placeholder="NIC *">
                                </div>

                                <div class="col-md-3">
                                    <select id="gender" name="gender" class="form-select">
                                        <option value="">Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="contact_number" name="contact_number" class="form-control" pattern="^(\+94|94|0)7[01245678][0-9]{7}$" placeholder="Contact">
                                </div>

                                <div class="col-12">
                                    <textarea id="address" name="address" class="form-control" rows="2" placeholder="Address"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="section-box mt-4">

                            <div class="section-title">
                                Account Details
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email *">
                                </div>

                                <div class="col-md-4">
                                    <input type="password" name="password_hash" class="form-control" placeholder="Password *">
                                </div>

                                <div class="col-md-4">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password *">
                                </div>

                                <div class="col-md-4">
                                    <select id="member_status" name="member_status" class="form-select">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="photo-card">
                            <h6 class="section-title mb-4">Profile Information</h6>

                            <div class="photo-upload-wrapper mx-auto">
                                <img id="previewImage" src="" style="display:none;">
                                <div id="previewPlaceholder">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="mt-2 mb-0">Upload Photo</p>
                                </div>
                            </div>

                            <label class="upload-btn mt-4">
                                <i class="fa-solid fa-upload me-2"></i>Choose Photo
                                <input type="file" hidden id="image" name="image" accept="image/*">
                            </label>

                            <hr>

                            <div class="mb-3">
                                <label class="form-label">Member Code</label>
                                <input type="text" class="form-control" id="member_code" readonly>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-light">
                        Clear
                    </button>

                    <a href="admin.php?page=member" class="btn btn-outline-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-cem">
                        <i class="fa fa-save me-2"></i>Save Member
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>