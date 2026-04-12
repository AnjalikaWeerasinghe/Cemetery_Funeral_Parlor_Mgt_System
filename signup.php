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

                <form action="routes/signup.php" method="POST">

                    <div class="mb-3">
                        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="nic" class="form-control" placeholder="NIC Number" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
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