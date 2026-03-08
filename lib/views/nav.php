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

<div id="sidebar" class="bg-success border-end vh-100 p-2">
    <ul class="nav flex-column gap-1">
        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="admin.php?page=dashboard">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#" id="">Deceased Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#" id="">Plot & Grave Management</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Funeral & Services</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="admin.php?page=funeralBookings" id="funeral_booking_details">Funeral Bookings</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#" id="">Payments & Billing</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">User Management</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="admin.php?page=staff" id="emp_details">Staff Details</a></li>
            <li><a class="dropdown-item" href="admin.php?page=member" id="mem_edit">Member Details</a></li>
          </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark fw-semibold" href="#" id="">Reports</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">System Settings</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="admin.php?page=roleSettings" id="role_settings">Manage Roles</a></li>
          </ul>
        </li>
    </ul>
</div>




