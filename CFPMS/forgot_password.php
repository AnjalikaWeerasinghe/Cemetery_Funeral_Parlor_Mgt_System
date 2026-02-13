<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
</head>

<body class="bg-light>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card mt-5 shadow">

                    <div class="card-header text-center">
                        <h5>Reset Password</h5>
                    </div>

                    <div class="card-body">
                        <form id="forgot_password">

                            <div class="form-group mb-3">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Registered Email" required>
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="submit" value="Submit" name="submit" class="btn btn-success px-4 me-3">
                                <a href="index.php" class="btn btn-secondary px-4">
                                    Cancel
                                </a>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function(){
        $('#forgot_password').on('submit', function(e){
            e.preventDefault();

            var email = $('#email').val();
            if(email == ''){
                alert("Please enter your registered email.");
                return;
            }

            $.ajax({
                url: 'lib/routes/forgot_password_route.php',
                type: 'POST',
                data: {email: email},
                success: function(response){
                    alert(response);
                },
                error: function(){
                    alert("An error occurred. Please try again.");
                }
            });
            
        });
    })
</script>

</html>