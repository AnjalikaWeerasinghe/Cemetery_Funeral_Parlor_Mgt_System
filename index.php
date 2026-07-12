<?php
include_once('lib/functions/auth.php');

include_once('lib/routes/notification/load_notifications_route.php');

if(isset($_POST['login'])){
    $auth = new Auth();
    $auth->login($_POST['email'], $_POST['pwd']);
}
?>

<?php
if (isset($_SESSION['login_success'])) {
    $message = $_SESSION['login_success'];
    unset($_SESSION['login_success']);
?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: "success",
        title: "Login Successful",
        text: "<?php echo addslashes($message); ?>",
        confirmButtonColor: "#8b6f47",
        timer: 3500,
        showConfirmButton: false
    });
});
</script>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/all.min.css">
    <link rel="stylesheet" href="styles/css/sweetalert2.min.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>

    <style>

        :root{
            --gold-main: #d4af7a;
            --gold-dark: #8b6f47;
            --dark-bg: #1e1e1e;
            --light-bg: #f8f9fa;
        }

        body{
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            overflow-x: hidden;
        }

        .main-content{
            margin-top: 90px;
            min-height: calc(100vh - 220px);
        }

        .navbar{
            backdrop-filter: blur(10px);
            padding: 13px 20px;
        }

        .navbar-brand{
            transition: 0.3s ease;
        }

        .navbar-brand:hover{
            transform: scale(1.02);
        }

        .nav-link{
            position: relative;
            color: #1e1e1e !important;
            margin: 0 8px;
            transition: 0.3s ease;
        }

        .nav-link::after{
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            left: 0;
            bottom: 0;
            background: #1e1e1e;
            transition: 0.3s ease;
        }

        .nav-link:hover::after{
            width: 100%;
        }

        .nav-link:hover{
            transform: translateY(-2px);
        }

        .logo-img{
            object-fit: cover;
        }

        .btn-dark{
            background: #1e1e1e;
            border: none;
            transition: 0.3s ease;
        }

        .btn-dark:hover{
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.2);
        }

        .btn-outline-dark:hover{
            background: #1e1e1e;
            color: white;
        }

        .footer{
            margin-top: 50px;
        }

        .footer h5{
            color: #1e1e1e;
        }

        .footer p,
        .footer small{
            color: #fff;
        }

        .dropdown-menu{
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .dropdown-item{
            transition: 0.2s ease;
        }

        .dropdown-item:hover{
            background: rgba(212,175,122,0.15);
            padding-left: 20px;
        }

        .footer .col-md-4{
            transition: 0.3s ease;
        }

        .footer .col-md-4:hover{
            transform: translateY(-5px);
        }

        .notification-dropdown{
            width:360px;
            max-height:450px;
            overflow-y:auto;
            border-radius:12px;
        }

        .notification-item{
            white-space:normal;
            padding:12px 15px;
            transition:.2s;
        }

        .notification-item:hover{
            background:#f8f9fa;
        }

        .notification-item.unread{
            background:#fff8e1;
            border-left:4px solid #d4af37;
        }

        .notification-message{
            display:-webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient:vertical;
            overflow:hidden;
        }

        @media (max-width: 768px){

            .logo-img{
                width: 45px;
                height: 45px;
            }

            .navbar-brand .lh-sm{
                font-size: 13px;
            }

        }

        @media (max-width: 991px){

            .navbar-collapse{
                background: rgba(255,255,255,0.95);
                padding: 15px;
                border-radius: 15px;
                margin-top: 10px;
            }

            .navbar-nav{
                text-align: center;
            }

            .d-flex.ms-auto{
                justify-content: center;
                margin-top: 15px;
            }

        }

    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top shadow opacity-80" style="background: linear-gradient(to right, #8b6f47, #d4af7a);">
        <div class="container-fluid">

            <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="index.php">
                <img src="lib/uploads/cemetery_logo.png" alt="Logo" class="rounded-circle me-2 logo-img" width="60" height="60">
                <div class="lh-sm">General Cemetery <br> & Funeral Parlor</div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center fw-bold mt-3 mt-lg-0" id="navbarColor01">
                <ul class="navbar-nav align-items-lg-center">
                    <a class="nav-link" href="index.php?page=home">Home</a>
                    <a class="nav-link" href="index.php?page=history">History</a>
                    <a class="nav-link" href="index.php?page=about">About Us</a>
                    <a class="nav-link" href="index.php?page=services">Our Services</a>
                    <a class="nav-link" href="index.php?page=contact">Contact</a>
                </ul>
            </div>

            <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "Member"): ?>

                <div class="dropdown me-2">

                    <button class="btn btn-dark position-relative" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-bell"></i>
                        <?php if($notificationCount > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $notificationCount ?? 0 ?>
                            </span>
                        <?php endif; ?>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end notification-dropdown shadow">

                        <div class="dropdown-header d-flex justify-content-between">
                            <span>
                                <i class="fa-solid fa-bell me-2"></i>Notifications
                            </span>

                            <span class="badge bg-warning text-dark">
                                <?= $notificationCount ?>
                            </span>
                        </div>

                        <?php if(!empty($notifications)): ?>

                            <?php foreach($notifications as $notification): ?>
                                <a class="dropdown-item notification-item <?= !$notification['is_read'] ? 'unread' : '' ?>" href="lib/routes/notification/open_member_notification.php?id=<?= $notification['notification_id'] ?>">
                                    <div class="fw-bold">
                                        <?= htmlspecialchars($notification['title']) ?>
                                    </div>
                                    <small class="text-muted d-block notification-message">
                                        <?= htmlspecialchars($notification['message']) ?>
                                    </small>
                                    <?php if(!empty($notification['created_at'])): ?>
                                        <small class="text-secondary">
                                            <?= date("d M Y h:i A", strtotime($notification['created_at'])) ?>
                                        </small>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="text-center p-4 text-muted">
                                <i class="fa-regular fa-bell-slash fa-2x mb-2"></i>
                                <div>No notifications</div>
                            </div>
                        <?php endif; ?>

                        <div class="dropdown-divider"></div>

                        <a href="index.php?page=mem_notifications" class="dropdown-item text-center fw-bold">
                            View All Notifications
                        </a>

                    </div>

                </div>

            <?php endif; ?>

            <div class="d-flex ms-auto">

                <?php if(isset($_SESSION['username'])): ?>

                <div class="dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle text-white" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user me-1"></i>
                        <?php echo $_SESSION['username']; ?>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="index.php?page=profile">
                                <i class="fa-solid fa-user me-2"></i>My Profile
                            </a>
                        </li>

                        <?php if($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Staff'): ?>
                            <li>
                                <a class="dropdown-item" href="lib/views/admin.php">
                                    <i class="fa-solid fa-user-gear me-2"></i>Admin Panel
                                </a>
                            </li>
                        <?php endif; ?>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-danger" href="lib/routes/logout.php">
                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Sign out
                            </a>
                        </li>

                    </ul>
                </div>

                <?php else: ?>

                    <a href="index.php?page=login" class="btn btn-outline-dark me-2">Login</a>
                    <a href="index.php?page=signup" class="btn btn-dark">Sign Up</a>

                <?php endif; ?>

            </div>
        </div>
    </nav>

    <div class="container-fluid p-0 main-content">

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

            case 'signup':
                include 'signup.php';
                break;

            case 'login':
                include 'login.php';
                break;

            case 'selectbookingtype':
                include 'lib/views/funeral_booking/booking_mainpage.php';
                break;
            case 'add_cremation_booking':
                include 'lib/views/funeral_booking/add_cremation_booking.php';
                break;
            case 'add_burial_booking':
                include 'lib/views/funeral_booking/add_burial_booking.php';
                break;
            case 'add_parlor_booking':
                include 'lib/views/funeral_booking/add_parlor_booking.php';
                break;

            case 'deceasedInfo':
                include 'lib/views/funeral_booking/deceased_information.php';
                break;
            case 'docInfo':
                include 'lib/views/funeral_booking/document_information.php';
                break;
            case 'cremationInfo':
                include 'lib/views/funeral_booking/cremation_information.php';
                break; 
            case 'burialInfo':
                include 'lib/views/funeral_booking/burial_information.php';
                break;
            case 'parlorInfo':
                include 'lib/views/funeral_booking/parlor_information.php';
                break;

            case 'mem_notifications':
                include 'lib/views/notification/member_notifications.php';
                break;

            default:
                include 'lib/views/main_pages/home.php';
                break;
        }
        ?>

    </div>

    <div class="footer text-white shadow-lg" style="background: linear-gradient(to right, #8b6f47, #d4af7a);">
  
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