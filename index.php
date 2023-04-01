<?php

include "db.php";
include "logout.php"; 

session_start();

// if (isset($_SESSION['email'])) {
//     // header("Location: index.php");
//     $get_user = mysqli_query($db, "SELECT * FROM lms_admin WHERE email='$_SESSION[email]'");
//     $user = mysqli_fetch_array($get_user);
// }

if(isset($_POST['logout'])){
    $logout = new logout();
    $logout->do_logout();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Perpusku</title>

    <link rel="stylesheet" href="mazer/dist/assets/css/main/app.css">
    <link rel="stylesheet" href="mazer/dist/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="mazer/dist/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="mazer/dist/assets/images/logo/favicon.png" type="image/png">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="dashboard.php">My DigiLibrary</a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <?php
                            if (isset($_SESSION['email'])) { ?>
                            <?php 
                                // header("Location: index.php");
                                $get_user = mysqli_query($db, "SELECT * FROM staff WHERE email='$_SESSION[email]'");
                                $user = mysqli_fetch_array($get_user); ?>
                                <li class="sidebar-item  ">
                                    <a href="form_peminjaman.php" class='sidebar-link'>
                                        <i class="bi bi-grid-1x2-fill"></i>
                                        <span>Buat Peminjaman Buku</span>
                                    </a>
                                </li>

                                <li class="sidebar-item  ">
                                    <a href="data_peminjam.php" class='sidebar-link'>
                                        <i class="bi bi-grid-1x2-fill"></i>
                                        <span>Lihat Peminjaman Buku</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <form method="post">
                                        <button href="" type="submit" name="logout" class='sidebar-link'>
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Dashboard</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <?php
                                        if (isset($_SESSION['email'])) { ?>
                                        <?php 
                                        // header("Location: index.php");
                                        $get_user = mysqli_query($db, "SELECT * FROM staff WHERE email='$_SESSION[email]'");
                                        $user = mysqli_fetch_array($get_user); ?>
                                        <li class="breadcrumb-item"><?= $user['nama_awal']. " ". $user['nama_akhir']. " (". $user['jabatan'].")" ?></li>
                                            <?php }else{ ?>
                                                <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Login
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="login_admin.php">Admin</a></li>
    <li><a class="dropdown-item" href="login.php">User</a></li>
  </ul>
</div>
                                        <?php } ?>
                                </ol>
                            </nav>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div id="data" class="mt-4"></div>
        </div>
    </div>
    <script src="mazer/dist/assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(page) {
                $.ajax({
                    url: "data_buku.php",
                    method: "POST",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        $('#data').html(data);
                    }
                })
            }
            $(document).on('click', '.halaman', function() {
                var page = $(this).attr("id");
                load_data(page);
            });
        });
    </script>

</body>

</html>