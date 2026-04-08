<?php

include_once('lib/functions/auth.php');

if(isset($_POST['login'])){
  $result = new Auth();
  $validation = $result->login($_POST['email'],$_POST['pwd']);
  echo($validation);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/all.min.css">
</head>

<body class="bg-light">

<div class="container my-5" style="margin-top: 95px;">
    <div class="row justify-content-center align-items-center" style="min-height:100vh;">
        <div class="col-md-4">
            <div class="card shadow border-0">
                
                <div class="card-header text-center text-white" style="background: linear-gradient(to right, #8b6f47, #d4af7a);">             
                    <img src="lib/uploads/cemetery_logo.png" class="rounded-circle mb-3" width="90" height="90" alt="Logo">
                    <h5 class="mb-0 fw-bold">Sign in</h5>
                </div>

                <div class="card-body">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <i class="fa-solid fa-envelope" style="color: #8b6f47;"></i>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <i class="fa-solid fa-lock" style="color: #8b6f47;"></i>
                            </span>
                            <input type="password" name="pwd" class="form-control" placeholder="********" required>
                        </div>

                        <div class="form-check mb-3 d-flex justify-content-center">
                            <input class="form-check-input me-2" type="checkbox" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <div class="d-grid col-6 mx-auto">
                            <button type="submit" name="login" class="btn text-white fw-bold" style="background-color:#8b6f47;">
                                Login
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="forgot_password.php" class="text-decoration-none" style="color:#8b6f47;">
                               Forgot Password?
                            </a>
                        </div>

                        <hr class="my-3">

                        <div class="text-center small text-muted">
                            General Cemetery <br>
                            Gampola Urban Council
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>