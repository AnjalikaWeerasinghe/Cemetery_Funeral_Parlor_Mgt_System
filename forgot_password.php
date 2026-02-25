<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
</head>

<body class="bg-light">
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Registered Email" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="nic" class="form-label">NIC</label>
                                <input type="text" name="nic" id="nic" class="form-control" placeholder="Enter your NIC" required>
                            </div>

                            <div id="messageBox"></div>

                            <div class="d-flex justify-content-center mt-2">
                                <input type="submit" value="Submit" name="submit" id="submitBtn" class="btn btn-success px-4 me-3" disabled>
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
    $(document).ready(function () {
        const emailInput = $('#email');
        const nicInput = $('#nic');
        const submitBtn = $('#submitBtn');

        submitBtn.prop('disabled', true);

        function validateNic(nic) {
            const oldNic = /^[0-9]{9}[vV]$/;
            const newNic = /^[0-9]{12}$/;
            return oldNic.test(nic) || newNic.test(nic);
        }

        function searchUserExits() {
            let email = emailInput.val().trim();
            let nic = nicInput.val().trim();

            if (email !== '' && validateNic(nic)) {

                $.ajax({
                    url:'lib/routes/forgot_password_route.php',
                    type: 'POST',
                    data: {email: email, nic: nic},
                    success: function(response){
                        response = response.trim();

                        console.log("Server Response:", response);

                        if(response === "match"){
                            submitBtn.prop('disabled', false);
                            $('#messageBox').html(`
                            <div class="alert alert-success">
                                Email and NIC matched successfully.
                            </div>
                        `);
                        }else{
                            submitBtn.prop('disabled', true);
                            $('#messageBox').html(`
                            <div class="alert alert-danger">
                                Email and NIC do not match.
                            </div>
                        `);
                        }

                    }
                });
            } else {
                submitBtn.prop('disabled',true);
            }
        }

        emailInput.on('keyup', searchUserExits);
        nicInput.on('keyup', searchUserExits);

        $('#forgot_password').on('submit', function(e){
            e.preventDefault();
        
            let email = $('#email').val().trim();
            let nic   = $('#nic').val().trim();
            let submitBtn = $('#submitBtn');

            $.ajax({
                url:'lib/routes/send_reset_email_route.php',
                type:'POST',
                data: {email: email, nic: nic},
                beforeSend: function(){
                    submitBtn.prop('disabled', true);
                    submitBtn.val("Sending...");
                },
                success: function(response){
                    response = response.trim();
                    if (response === "sent") {
                        $('#messageBox').html(`
                            <div class="alert alert-info">
                                Reset link has been sent to your email.
                            </div>
                        `);
                    } else {
                        $('#messageBox').html(`
                            <div class="alert alert-warning">
                                Something went wrong. Please try again.
                            </div>
                        `);
                    }
                    
                    submitBtn.prop('disabled',false);
                    submitBtn.val("submit");
                }
            });
        });  
    });
        
    // $(document).ready(function(){
    //     $('#forgot_password').on('submit', function(e){
    //         e.preventDefault();

    //         var email = $('#email').val();
    //         var nic = $('#nic').val();
    //         if(email == '' || nic == ''){
    //             alert("Please enter your Email and NIC.");
    //             return;
    //         }

    //         $.ajax({
    //             url: 'lib/routes/forgot_password_route.php',
    //             type: 'POST',
    //             data: {email: email, nic: nic},
    //             success: function(response){
    //                 alert(response);
    //             },
    //             error: function(){
    //                 alert("An error occurred. Please try again.");
    //             }
    //         });
            
    //     });
    // })

</script>

</html>