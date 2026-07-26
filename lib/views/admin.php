<?php
session_start();

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Staff', 'Member'])) {
    header("Location: ../../index.php?page=login");
    exit;
}

//include header page 
include_once('header.php');
include_once('../routes/notification/load_notifications_route.php');
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

<?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<style>
.custom-navbar{
    background: linear-gradient(to right, #8b6f47, #d4af7a);
    min-height: 75px;
    padding: 10px 15px;
}

.brand-text{
    font-size: 14px;
    line-height: 1.2;
}

.search-form{
    width: 280px;
}

#sidebar-wrapper{
    background: #1e1e1e;
    transition: all 0.3s ease;
}

#root{
    transition: all 0.3s ease;
}

.main-wrapper{
    margin-top: 75px;
}

.content-area{
    min-height: calc(100vh - 75px);
    overflow-y: auto;
}

@media (max-width: 991px){

    .search-form{
        width: 100%;
    }

    #sidebar-wrapper{
        position: fixed;
        z-index: 1050;
        width: 260px;
        left: -260px;
        top: 75px;
        height: calc(100vh - 75px);
        overflow-y: auto;
    }

    #sidebar-wrapper.active{
        left: 0;
    }

    #root{
        width: 100% !important;
        margin-left: 0 !important;
    }

    .brand-text{
        font-size: 12px;
    }

    .notification-item.unread{
        background:#fff9e8;
        border-left:4px solid #d4af37;
    }

    .notification-item.unread:hover{
        background:#fef3c7;
    }

    .notification-message{
        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
    }

}

@media (max-width: 576px){

    .navbar-brand img{
        height: 38px;
        width: 38px;
    }

    .brand-text{
        display: none;
    }

}

</style>

<nav class="navbar navbar-expand-lg fixed-top shadow border-bottom custom-navbar">

    <div class="container-fluid">

        <div class="d-flex align-items-center">

            <button class="btn btn-dark me-3" id="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>

            <a class="navbar-brand fw-bold d-flex align-items-center text-dark m-0" href="../../index.php">

                <img src="../uploads/cemetery_logo.png" class="rounded-circle me-2" height="45" width="45" alt="Logo">
                <div class="brand-text">General Cemetery <br> & Funeral Parlor</div>

            </a>

        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">

            <div class="d-flex align-items-center gap-2 flex-wrap mt-3 mt-lg-0">

                <!-- <form class="search-form">
                    <div class="input-group">

                        <input class="form-control border-end-0" type="search" placeholder="Search">
                        <button class="btn bg-white border-start-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                    </div>
                </form> -->

                <div class="dropdown">

                    <button class="btn btn-dark position-relative" type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-bell"></i>
                        <?php if(($notificationCount ?? 0) > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $notificationCount ?>
                            </span>
                        <?php endif; ?>

                    </button>

                    <div class="dropdown-menu dropdown-menu-end notification-dropdown shadow">

                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-bell me-2"></i>Notifications</span>
                            <span class="badge bg-warning text-dark">
                                <?= $notificationCount ?? 0 ?>
                            </span>
                        </div>

                        <?php if(!empty($notifications)): ?>

                            <?php foreach($notifications as $notification): ?>

                                <a href="../routes/notification/open_notification.php?id=<?= $notification['notification_id'] ?>"
                                    class="dropdown-item notification-item <?= !$notification['is_read'] ? 'unread' : '' ?>">

                                    <div class="d-flex">

                                        <div class="notification-icon me-3">
                                            <?php if($notification['notification_type']=="Cremation"): ?>
                                                <i class="fa-solid fa-fire text-danger"></i>
                                            <?php elseif($notification['notification_type']=="Burial"): ?>
                                                <i class="fa-solid fa-cross text-success"></i>
                                            <?php else: ?>
                                                <i class="fa-solid fa-bell text-warning"></i>
                                            <?php endif; ?>
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="fw-bold">
                                                <?= htmlspecialchars($notification['title']) ?>
                                            </div>

                                            <?php if(!$notification['is_read']): ?>
                                                <span class="badge bg-danger ms-2">NEW</span>
                                            <?php endif; ?>

                                            <small class="text-muted d-block notification-message">
                                                <?= htmlspecialchars($notification['message']) ?>
                                            </small>

                                            <?php if(!empty($notification['created_at'])): ?>
                                                <small class="text-secondary">
                                                    <?= date("d M Y h:i A", strtotime($notification['created_at'])) ?>
                                                </small>
                                            <?php endif; ?>

                                        </div>

                                    </div>

                                </a>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <div class="text-center py-4 text-muted">
                                <i class="fa-regular fa-bell-slash fa-2x mb-2"></i>
                                <div>No notifications</div>
                            </div>

                        <?php endif; ?>

                        <div class="dropdown-divider"></div>

                        <a href="admin.php?page=notifications" class="dropdown-item text-center fw-bold">
                            View All Notifications
                        </a>

                    </div>

                </div>

                <div class="dropdown">

                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user me-1"></i>
                        <?php echo $_SESSION['username']; ?>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="profile.php">
                                <i class="fa-solid fa-user me-2"></i>Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="settings.php">
                                <i class="fa-solid fa-gear me-2"></i>Settings
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="../routes/logout.php">
                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Sign Out
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</nav>

<div class="container-fluid p-0 main-wrapper">
    <div class="row g-0">

        <div class="col-lg-2" id="sidebar-wrapper" style="min-height: calc(100vh - 90px);">
            <?php include_once('nav.php'); ?>
        </div>

        <div class="col-lg-10 content-area" id="root" style="height: calc(100vh - 90px); overflow-y: auto;">
            <div class="p-4">
                <?php
                switch ($page){
                    case 'staff':
                        include 'emp/emp_details.php';
                        break;
                    case 'addStaff':
                        include 'emp/emp_add.php';
                        break; 
                        
                    case 'member':
                        include 'member/member.php';
                        break;
                    case 'addMember':
                        include 'member/member_add.php';
                        break;

                    case 'supplier':
                        include 'supplier/supplier.php';
                        break;

                    case 'inventory':
                        include 'inventory/inventory.php';
                        break;

                    case 'funeralBookings':
                        include 'funeral_booking/funeral_booking_details.php';
                        break;
                    case 'view_funeral_booking':
                        include 'funeral_booking/get_funeral_booking_view.php';
                        break;
                    case 'selectbookingtype':
                        include 'funeral_booking/booking_mainpage.php';
                        break;
                    case 'add_cremation_booking':
                        include 'funeral_booking/add_cremation_booking.php';
                        break;
                    case 'add_burial_booking':
                        include 'funeral_booking/add_burial_booking.php';
                        break;
                    case 'add_parlor_booking':
                        include 'funeral_booking/add_parlor_booking.php';
                        break;
                    
                    case 'deceasedInfo':
                        include 'funeral_booking/deceased_information.php';
                        break;
                    case 'docInfo':
                        include 'funeral_booking/document_information.php';
                        break;
                    case 'cremationInfo':
                        include 'funeral_booking/cremation_information.php';
                        break;
                    case 'burialInfo':
                        include 'funeral_booking/burial_information.php';
                        break;
                    case 'parlorInfo':
                        include 'funeral_booking/parlor_information.php';
                        break; 
                    case 'memorialInfo':
                        include 'funeral_booking/memorial_service_information.php';
                        break; 
                        
                    case 'cremationTimeSlots':
                        include 'funeral_booking/scheduling_cremation_slots.php';
                        break;
                    case 'burialPlotSection':
                        include 'funeral_booking/burial_plot_section.php';
                        break;

                    case 'roleSettings':
                        include 'system_settings/role_settings.php';
                        break;

                    case 'deceased':
                        include 'deceased/deceased_details.php';
                        break;

                    case 'view_deceased_details':
                        include 'deceased/deceased_view.php';
                        break;

                    case 'notifications':
                        include 'notification/notification.php';
                        break;

                    case 'report':
                        include 'report/report.php';
                        break;

                    default:
                        include 'dashboard.php';
                }
                ?>
            </div>
        </div>
    </div>
</div> 

<script>
    document.getElementById("menu-toggle").addEventListener("click", function () {
        // window.userMode = "admin";

        const sidebar = document.getElementById("sidebar-wrapper");

        if(window.innerWidth <= 991){
            sidebar.classList.toggle("active");
        } else {

            sidebar.classList.toggle("d-none");

            const root = document.getElementById("root");

            if(sidebar.classList.contains("d-none")){
                root.classList.remove("col-lg-10");
                root.classList.add("col-lg-12");
            } else {
                root.classList.remove("col-lg-12");
                root.classList.add("col-lg-10");
            }

        }

        let previousCount = 0;

        function loadNotifications(){

            $.get("../routes/notification/load_notifications_route.php", function(data){
                $(".badge").text(data.count);

                if(data.count > previousCount){
                    Swal.fire({
                        icon: "info",
                        title: "New Booking",
                        text: "A new funeral booking requires approval.",
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
                previousCount = data.count;
            }, "json");

        }

        loadNotifications();

        setInterval(loadNotifications, 10000);

    });

</script>


