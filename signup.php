<style>
    .signup-section{
        margin-top:110px;
        margin-bottom:40px;
    }

    .signup-card{
        border-radius:20px;
        overflow:hidden;
        border:none;
        background:#fff;
    }

    .signup-left{
        background:linear-gradient(135deg,#1d3557,#274c77);
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:50px;
    }

    .branding{
        text-align:center;
    }

    .logo{
        width:90px;
    }

    .signup-left h2{
        font-weight:700;
        margin-bottom:8px;
    }

    .signup-left h5{
        color:#d4af7a;
        font-weight:500;
    }

    .signup-left p{
        color:#e8e8e8;
        line-height:1.8;
    }

    .divider{
        width:70px;
        height:3px;
        background:#d4af7a;
        margin:25px auto;
        border-radius:50px;
    }

    .small-text{
        font-style:italic;
        color:#ddd;
    }

    .form-control{
        height:52px;
        border-radius:10px;
        border:1px solid #d9d9d9;
        box-shadow:none;
    }

    textarea.form-control{
        height:auto;
    }

    .form-control:focus{
        border-color:#d4af7a;
        box-shadow:0 0 0 .2rem rgba(212,175,122,.15);
    }

    .btn-gold{
        background:#d4af7a;
        color:#fff;
        border:none;
        border-radius:12px;
        font-weight:600;
        transition:.3s;
    }

    .btn-gold:hover{
        background:#bf995d;
        transform:translateY(-2px);
        box-shadow:0 10px 25px rgba(212,175,122,.3);
    }

    .login-link{
        color:#d4af7a;
        text-decoration:none;
        font-weight:600;
    }

    .login-link:hover{
        text-decoration:underline;
    }
</style>

<section class="container signup-section">

    <div class="row justify-content-center">

        <div class="col-lg-10 col-xl-9">

            <div class="signup-card shadow-lg p-0">

                <div class="row g-0">

                    <!-- Left Side -->
                    <div class="col-lg-5 signup-left">

                        <div class="branding">

                            <img src="lib/uploads/cemetery_logo.png" class="logo mb-4" alt="Logo">

                            <h2>Cemetery Management</h2>

                            <h5 class="mb-4">Member Portal</h5>

                            <p>
                                Register your account to conveniently manage cemetery
                                services, reservations and your personal profile online.
                            </p>

                            <div class="divider"></div>

                            <p class="small-text">
                                "Serving families with dignity, compassion and care."
                            </p>

                        </div>

                    </div>

                    <!-- Right Side -->
                    <div class="col-lg-7">

                        <div class="p-5">

                            <h3 class="text-center mb-2">Create Account</h3>

                            <p class="text-center text-muted mb-4">Please fill in your details below.</p>

                            <form id="signup_form" method="POST" autocomplete="off">

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="nic" class="form-control" placeholder="NIC Number" pattern="^([0-9]{9}[vVxX]|[0-9]{12})$" maxlength="12" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" pattern="^07[0-9]{8}$" maxlength="10" required>
                                </div>

                                <div class="mb-3">
                                    <textarea name="address" class="form-control" rows="3" placeholder="Address" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" minlength="8" required>
                                    <small class="text-muted">Password must contain at least 8 characters.</small>
                                </div>

                                <div class="mb-4">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                                </div>

                                <button type="submit" class="btn btn-gold w-100 py-3">
                                    <i class="fa-solid fa-user-plus me-2"></i>Create Account
                                </button>

                            </form>

                            <div class="text-center mt-4">

                                <small class="text-muted">
                                    Already have an account? <a href="index.php?page=login" class="login-link">Sign In</a>
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>
    $(document).ready(function() {
        $("#signup_form").on("submit", function(e){
            e.preventDefault();

            let password = $("input[name='password']").val();
            let confirmPassword = $("input[name='confirm_password']").val();

            if (password !== confirmPassword) {

                Swal.fire({
                    icon: "error",
                    title: "Password Mismatch",
                    text: "Passwords do not match.",
                    confirmButtonColor: "#d4af7a"
                });

                return;
            }

            let formData = new FormData(this);

            $.ajax({
                url: "lib/routes/signup_route.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                beforeSend: function () {
                    Swal.fire({
                        title: "Creating your account...",
                        html: "Please wait a moment.",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $("button[type='submit']")
                        .prop("disabled", true)
                        .text("Creating...");
                },

                success: function (response) {

                    response = response.trim();

                    if (response == "success") {
                        let fullName = $("input[name='first_name']").val() + " " + $("input[name='last_name']").val();

                        Swal.fire({
                            icon: "success",
                            title: "<span style='font-size:30px;'>Welcome!</span>",
                            html: `
                                <div style="padding:10px 0">
                                    <div style="font-size:18px;font-weight:600;color:#333;">
                                        ${fullName}
                                    </div>

                                    <div style="margin-top:12px;color:#6c757d;">
                                        Your account has been created successfully.
                                    </div>

                                    <div style="margin-top:18px;padding:12px;border-radius:10px; background:#f8f9fa;color:#555;">
                                        You can now sign in using your email address and password.
                                    </div>
                                </div>
                            `,
                            confirmButtonText: "Continue to Login",
                            confirmButtonColor: "#d4af7a",
                            background: "#ffffff",
                            showClass: {
                                popup: "animate__animated animate__zoomIn"
                            },
                            hideClass: {
                                popup: "animate__animated animate__zoomOut"
                            }

                        }).then((result) => {

                            if (result.isConfirmed) {
                                $("#signup_form")[0].reset();
                                window.location.href = "index.php?page=login";
                            }

                        });

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Registration Failed",
                            text: "Something went wrong. Please try again.",
                            confirmButtonColor: "#d4af7a"
                        });
                    }

                },

                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: "Something went wrong while creating your account.",
                        confirmButtonColor: "#d4af7a"
                    });
                },

                complete: function () {
                    $("button[type='submit']").prop("disabled", false).text("Create Account");
                }

            });

        })

    })
</script>