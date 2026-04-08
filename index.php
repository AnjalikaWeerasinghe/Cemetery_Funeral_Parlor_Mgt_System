<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top shadow opacity-80" style="background: linear-gradient(to right, #8b6f47, #d4af7a);">
        <div class="container-fluid">

            <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="index.php">
                <img src="lib/uploads/cemetery_logo.png" class="rounded-circle mb-0" width="70" height="70" alt="Logo">
                <div class="lh-sm">
                General Cemetery <br> & Funeral Parlor
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center fw-bold" id="navbarColor01">
                <ul class="navbar-nav">
                    <a class="nav-link" href="index.php?page=home">Home</a>
                    <a class="nav-link" href="index.php?page=history">History</a>
                    <a class="nav-link" href="index.php?page=about">About Us</a>
                    <a class="nav-link" href="index.php?page=services">Our Services</a>
                    <a class="nav-link" href="index.php?page=contact">Contact</a>
                </ul>
            </div>

            <div class="d-flex ms-auto">
                <a href="login.php" class="btn btn-outline-dark me-2">Login</a>
                <a href="signup.html" class="btn btn-dark">Sign Up</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-0">

        <?php
        $page = $_GET['page'] ?? 'home';

        switch($page) {

            case 'history':
                include 'lib/views/main_pages/history.php';
                break;

            case 'about':
                include 'lib/views/main_pages/about.php';
                break;

            case 'services':
                include 'lib/views/main_pages/services.php';
                break;

            case 'contact':
                include 'lib/views/main_pages/contact.php';
                break;

            default:
                include 'lib/views/main_pages/home.php';
                break;
        }
        ?>

    </div>

    <div class="footer text-white" style="background: linear-gradient(to right, #8b6f47, #d4af7a);">
  
        <div class="container py-4">
            <div class="row text-center text-md-center">
            
                <div class="col-md-4 mb-2">
                    <h5 class="fw-bold mb-3">Contact Us</h5>
                    <p class="mb-1">📞 +94 711 654 562</p>
                    <p>📞 +94 771 562 456</p>
                </div>

                <div class="col-md-4 mb-2">
                    <h5 class="fw-bold mb-3">Come Visit Us</h5>
                    <p>📍 General Cemetery,<br>Urban Council Gampola</p>
                </div>

                <div class="col-md-4 mb-2">
                    <h5 class="fw-bold mb-3">Send Us A Message</h5>
                    <p>📧 generalcemeterygampola@gmail.com</p>
                </div>

            </div>
        </div>

        <div class="text-center py-3 border-top" style="border-color: rgba(255,255,255,0.3) !important;">
            <p class="mb-1">General Cemetery - Gampola Urban Council</p>
            <small>© 2026 All Rights Reserved</small>
        </div>

    </div>
</body>
</html>