<style>

.signup-section {
    margin-top: 110px;
    margin-bottom: 20px;
}

.signup-card {
    background: #ffffff;
    color: #333;
    border-radius: 15px;
    padding: 35px;
    border: 1px solid rgba(212,175,122,0.3);
}

.signup-card h3 {
    color: #d4af7a;
}

.form-control {
    background: #fff;
    border: 1px solid #ccc;
    color: #000;
}

.form-control:focus {
    border-color: #d4af7a;
    box-shadow: none;
}

::placeholder {
    color: #aaa;
}

.btn-gold {
    background-color: #d4af7a;
    border: none;
    color: black;
    font-weight: 600;
}

.btn-gold:hover {
    background-color: #c19b5f;
}

</style>

<section class="container signup-section">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="signup-card shadow">

                <h3 class="text-center mb-4">Create Account</h3>

                <form id="signup_form" method="POST" autocomplete="off">

                    <div class="mb-3">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="nic" class="form-control" placeholder="NIC Number" pattern="^([0-9]{9}[vVxX]|[0-9]{12})$" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number" pattern="^07[0-9]{8}$" required>
                    </div>

                    <div class="mb-3">
                        <textarea name="address" class="form-control" rows="3" placeholder="Address" required></textarea>
                    </div>

                    <div class="mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" minlength="8" required>
                        <small class="text-muted">Password must contain atleast 8 characters.</small>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                    </div>

                    <button type="submit" class="btn btn-gold w-25 mb-3">
                        Sign Up
                    </button>

                    <p class="text-center text-muted">
                        Already have an account? 
                        <a href="index.php?page=login" class="text-gold ms-2">Login</a>
                    </p>

                </form>

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
                alert("Passwords do not match.");
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
                    $("button[type='submit']")
                        .prop("disabled", true)
                        .text("Creating...");
                },

                success: function (response) {

                    response = response.trim();

                    if (response == "success") {
                        alert("Account created successfully.");

                        $("#signup_form")[0].reset();

                        window.location.href = "index.php?page=login";

                    } else {
                        alert(response);
                    }

                },

                error: function (xhr) {
                    alert(xhr.responseText);
                },

                complete: function () {
                    $("button[type='submit']").prop("disabled", false).text("Sign Up");
                }

            });

        })

    })
</script>