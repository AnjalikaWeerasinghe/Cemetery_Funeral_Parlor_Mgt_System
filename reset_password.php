<?php

include_once('lib/functions/reset_passwordController.php');

if (!isset($_GET['token']) || empty($_GET['token'])) {
    die("Invalid request.");
}

$token = $_GET['token'] ?? '';
$tokenHash = hash('sha256', $token);

// var_dump($token);
// var_dump($tokenHash);
// exit();

$controller = new ResetPasswordController();
$result = $controller->validateToken($tokenHash);

if ($result->num_rows === 0) {
    die("Invalid or expired reset link.");
}

$user = $result->fetch_assoc();
$userId = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newPassword = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // validation
    if (strlen($newPassword) < 8) {
        $error = "Password must be at least 8 characters.";
    }
    elseif ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    }
    else {

        // session_regenerate_id(true);

        updatePassword($userId, $newPassword);
        echo "<h3>Password successfully updated.</h3>";
        echo "<a href='index.php'>Go to Login</a>";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <h2>Reset your password</h2>
                    </div>

                    <?php if (!empty($error)) : ?>
                        <p style="color:red;"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <div class="card-body">
                        <form method="POST" id="reset_password">

                            <div class="form-group mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-end mt-2">
                                <input type="submit" value="Update Password" name="submit" id="submitBtn" class="btn btn-success px-4 me-3">
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
</html>