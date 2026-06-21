<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../../index.php?page=login");
    exit;
}

//include header page 
include_once('header.php');
?>

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

                <form class="search-form">
                    <div class="input-group">

                        <input class="form-control border-end-0" type="search" placeholder="Search">
                        <button class="btn bg-white border-start-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                    </div>
                </form>

                <form action="../routes/notification.php" method="post">

                    <button type="submit" class="btn btn-dark">
                        <i class="fa-solid fa-bell"></i>
                    </button>

                </form>

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
                        include 'member/member_view.php';
                        break;
                    case 'addMember':
                        include 'member/member_add.php';
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
                    case 'burialPlotDesign':
                        include 'funeral_booking/plot_design.php';
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
                        include 'deceased/get_deceased_view.php';
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

    });

</script>


