<?php
session_start();
if(empty($_SESSION['user_id'])){
    header('location:../../index.php');
}

//include header page 
include_once('header.php');
?>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-success border-bottom shadow fixed-top">
    <div class="container-fluid p-0" style="height: calc(100vh - 625px);">

        <div class="d-flex align-items-center">
            <button class="btn btn-outline-dark me-3 ms-1" id="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>

            <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="">
                <img src="..\uploads\cemetery_logo.png" class="rounded-circle me-2" height="45" alt="Logo">
                <span class="lh-sm">
                    General Cemetery <br> & Funeral Parlor
                </span>
            </a>
        </div>

        <div class="d-flex align-items-center ms-auto">
            <form class="mt-3 mb-3 me-4" role="search">
                <div class="input-group">
                    <input class="form-control border-end-0" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn input-group-text bg-white border-start-0" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>

            <form action="../routes/logout.php" method="post" class="d-flex mt-3 me-3 mb-3">
                <button type="submit" value="Logout" class="btn btn-danger">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>
        
    </div>
</nav>

<div class="container-fluid p-0" style="margin-top: 90px;">
    <div class="row g-0">

        <div class="col-md-2" id="sidebar-wrapper" style="height: calc(100vh - 90px);">
            <?php include_once('nav.php'); ?>
        </div>

        <div class="col-md-10" id="root" style="height: calc(100vh - 90px); overflow-y: auto;">
            <div class="p-4">
                <?php
                switch ($page){
                    case 'staff':
                        include 'emp/emp_details.php';
                        break;

                    case 'addStaff':
                        include 'emp/emp_add.php';
                        break;    

                    default:
                        include 'dashboard.php';
                }
                ?>
            </div>
        </div>
    </div>
</div> 

<!-- <script>
    $(document).ready(function(){
        $("#add_emp").click(function(){
          $("#root").load('emp/add_emp.php')
        });
        $("#view_emp").click(function(){
            $("#root").load('emp/view_emp.php')
        })
    })
</script> -->

<script>
    document.getElementById("menu-toggle").addEventListener("click", function () {

    const sidebar = document.getElementById("sidebar-wrapper");
    const root = document.getElementById("root");

    sidebar.classList.toggle("d-none");

    if (sidebar.classList.contains("d-none")) {
        root.classList.remove("col-md-10");
        root.classList.add("col-md-12");
    } else {
        root.classList.remove("col-md-12");
        root.classList.add("col-md-10");
    }

});
</script>


