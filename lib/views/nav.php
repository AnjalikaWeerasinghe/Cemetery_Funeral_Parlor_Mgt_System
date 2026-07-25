<!-- <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> -->

<style>
.sidebar-wrapper{
    width: 260px;
    min-height: 100vh;
    background: linear-gradient(to bottom, #8b6f47, #d4af7a);
    padding: 20px 15px;
    overflow-y: auto;
    transition: all 0.3s ease;
    z-index: 1040;
}

.sidebar-header{
    color: #1e1e1e;
    font-weight: bold;
    margin-bottom: 25px;
    padding-left: 10px;
}

.sidebar-menu .nav-link{
    color: #1e1e1e;
    font-weight: 600;
    border-radius: 10px;
    padding: 12px 15px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.sidebar-menu .nav-link:hover{
    background: rgba(255,255,255,0.2);
    transform: translateX(5px);
}

.sidebar-dropdown-btn{
    width: 100%;
    border: none;
    background: transparent;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    border-radius: 10px;
    font-weight: 600;
    color: #1e1e1e;
    transition: 0.3s ease;
}

.sidebar-dropdown-btn:hover{
    background: rgba(255,255,255,0.2);
    transform: translateX(5px);
}

.sidebar-submenu{
    padding-left: 15px;
    margin-top: 5px;
}

.sidebar-submenu a{
    display: block;
    text-decoration: none;
    color: #2f2f2f;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 5px;
    transition: 0.3s ease;
}

.sidebar-submenu a:hover{
    background: rgba(255,255,255,0.2);
    padding-left: 20px;
}

.sidebar-wrapper.collapsed{
    width: 0;
    padding: 0;
    overflow: hidden;
}

@media (max-width: 991px){

    .sidebar-wrapper{
        position: fixed;
        left: -260px;
        top: 75px;
        width: 260px;
        z-index: 1050;
        height: calc(100vh - 75px);
        transition: left 0.3s ease;
    }

    .sidebar-wrapper.active{
        left: 0;
    }

}

</style>

<div id="sidebar" class="sidebar-wrapper">

    <div class="sidebar-header">
        <h5 class="m-0">Admin Panel</h5>
    </div>

    <ul class="nav flex-column sidebar-menu">

        <li class="nav-item">
            <a class="nav-link" href="admin.php?page=dashboard">
                <i class="fa-solid fa-gauge-high me-2"></i>Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin.php?page=deceased">
                <i class="fa-solid fa-file-lines me-2"></i>Deceased Records
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin.php?page=burialPlotSection">
                <i class="fa-solid fa-map-location-dot me-2"></i>Plot & Grave Management
            </a>
        </li>

        <li class="nav-item">

            <button class="sidebar-dropdown-btn" data-bs-toggle="collapse" data-bs-target="#funeralMenu">
                <span>
                    <i class="fa-solid fa-cross me-2"></i>Funeral & Services
                </span>
            </button>

            <div class="collapse sidebar-submenu" id="funeralMenu">
                <a href="admin.php?page=funeralBookings">Funeral Bookings</a>
                <a href="admin.php?page=cremationTimeSlots">Cremation Time Slots</a>
                <!-- <a href="admin.php?page=burialPlotSection">Burial Plot Allocation Management</a> -->
            </div>

        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-money-bill-wave me-2"></i>Payments & Billing
            </a>
        </li>

        <li class="nav-item">

            <button class="sidebar-dropdown-btn" data-bs-toggle="collapse" data-bs-target="#userMenu">
                <span>
                    <i class="fa-solid fa-users me-2"></i>User Management
                </span>
            </button>

            <div class="collapse sidebar-submenu" id="userMenu">
                <a href="admin.php?page=staff">Staff Management</a>
                <a href="admin.php?page=member">Member Management</a>
            </div>

        </li>

        <li class="nav-item">
            <button class="sidebar-dropdown-btn" data-bs-toggle="collapse" data-bs-target="#resourceMenu">
                <span>
                    <i class="fa-solid fa-warehouse me-2"></i>Resource Management
                </span>
            </button>

            <div class="collapse sidebar-submenu" id="resourceMenu">
                <a href="admin.php?page=supplier">Supplier Management</a>
                <a href="admin.php?page=inventory">Inventory Management</a>
            </div>
            
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin.php?page=report">
                <i class="fa-solid fa-chart-line me-2"></i>Reports
            </a>
        </li>

        <li class="nav-item">

            <button class="sidebar-dropdown-btn" data-bs-toggle="collapse" data-bs-target="#settingsMenu">
                <span>
                    <i class="fa-solid fa-gear me-2"></i>System Settings
                </span>
            </button>

            <div class="collapse sidebar-submenu" id="settingsMenu">
                <a href="admin.php?page=roleSettings">Manage Roles</a>
            </div>

        </li>

    </ul>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const menuToggle = document.getElementById("menu-toggle");

        const sidebar = document.getElementById("sidebar");

        menuToggle.addEventListener("click", function () {

            if(window.innerWidth <= 991){
                sidebar.classList.toggle("active");
            } else {
                sidebar.classList.toggle("collapsed");
            }

        });

    });
</script>




