<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sample</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" id="add_emp">Add EMP</a></li>
            <li><a class="dropdown-item" href="#" id="view_emp">View EMP</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form action="../routes/logout.php" method="post">
        <input type="submit" value="Logout" class="btn btn-danger">
      </form>
    </div>
  </div>
</nav> -->

<!-- <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> -->

<div id="sidebar" class="vh-100 p-3" style="width: 220px; background: linear-gradient(to bottom, #8b6f47, #d4af7a);">

    <ul class="nav flex-column gap-2">

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="admin.php?page=dashboard">
                <!-- <i class="fa-solid fa-gauge-high me-2"></i> --> 
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#">
                <!-- <i class="fa-solid fa-file me-2"></i>-->
                Deceased Records
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#">
                <!-- <i class="fa-solid fa-square-parking me-2"></i>  -->
                Plot & Grave Management
            </a>
        </li>

        <li class="nav-item dropdown-container">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- <i class="fa-solid fa-candle-holder me-2"></i>  -->
                Funeral & Services
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="admin.php?page=funeralBookings">Funeral Bookings</a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#">
                <!-- <i class="fa-solid fa-money-bill-wave me-2"></i>  -->
                Payments & Billing
            </a>
        </li>

        <li class="nav-item dropdown-container">
            <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- <i class="fa-solid fa-users me-2"></i>  -->
                User Management
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="admin.php?page=staff">Staff Details</a></li>
                <li><a class="dropdown-item" href="admin.php?page=member">Member Details</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#">
                <!-- <i class="fa-solid fa-chart-line me-2"></i>  -->
                Reports
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- <i class="fa-solid fa-gear me-2"></i>  -->
                System Settings
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="admin.php?page=roleSettings">Manage Roles</a></li>
            </ul>
        </li>

    </ul>
</div>




