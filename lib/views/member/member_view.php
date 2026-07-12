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
                    <i class="fa fa-user me-2"></i>Member Details
                </h4>
                <p class="mb-0 opacity-75">
                    View member information
                </p>
            </div>

            <a href="admin.php?page=member" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left me-1"></i> Back
            </a>

        </div>

        <div class="card-body p-4">

            <form id="submit_form" enctype="multipart/form-data">

                <input type="hidden" id="member_id" name="member_id">

                <div class="row g-4">

                    <div class="col-lg-8">

                        <div class="section-box">

                            <div class="section-title">Personal Information</div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name *" readonly>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Middle Name" readonly>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name *" readonly>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="nic" name="nic" class="form-control" pattern="[0-9]{9}[vVxX]|[0-9]{12}" placeholder="NIC *" readonly>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="gender" name="gender" class="form-control" readonly placeholder="Gender">
                                </div>

                                <div class="col-md-3">
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" readonly>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="contact_number" name="contact_number" class="form-control" pattern="^(\+94|94|0)7[01245678][0-9]{7}$" placeholder="Contact" readonly>
                                </div>

                                <div class="col-12">
                                    <textarea id="address" name="address" class="form-control" rows="2" placeholder="Address" readonly></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="section-box mt-4">

                            <div class="section-title">
                                Account Details
                            </div>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email *" readonly>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" id="member_status" name="member_status" class="form-control" readonly placeholder="Member Status">
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

                            <hr>

                            <div class="mb-3">
                                <label class="form-label">Member Code</label>
                                <input type="text" class="form-control" id="member_code" readonly>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="admin.php?page=member" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

<script>
    $(document).ready(function () {

        const memberId = "<?= $member_id ?>";

        if (memberId !== "") {
            loadMember(memberId);
        }

        console.log("Member ID:", memberId);

        function loadMember(memberId) {

            $.ajax({
                url: "../routes/member/get_member_route.php",
                type: "GET",
                data: { member_id: memberId },

                success: function (res) {
                    const data = (typeof res === "string") ? JSON.parse(res) : res;

                    $("#member_id").val(data.member_id);
                    $("#member_code").val(data.member_code);

                    $("#first_name").val(data.first_name);
                    $("#middle_name").val(data.middle_name);
                    $("#last_name").val(data.last_name);

                    $("#nic").val(data.nic);
                    $("#gender").val(data.gender);
                    $("#date_of_birth").val(data.date_of_birth);
                    $("#contact_number").val(data.contact_number);
                    $("#address").val(data.address);

                    $("#email").val(data.email);
                    $("#member_status").val(data.member_status);

                    if (data.image) {
                        $("#previewImage").attr("src", "../" + data.image).show();
                        $("#previewPlaceholder").hide();
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Unable to load member information."
                    });
                }
            });
        }
    });
</script>