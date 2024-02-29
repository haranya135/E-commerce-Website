<?php
include('../includes/connect.php');
include('../../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styles */
        .navbar {
            background-color: #343a40 !important; /* Set navbar background color */
        }

        .navbar-brand img {
            height: 50px; /* Adjust logo height */
            width: auto;
        }

        .navbar-nav .nav-link {
            color: #f8f9fa !important; /* Set nav link color */
        }

        .navbar-nav .nav-link:hover {
            color: #f0f0f0 !important; /* Set nav link hover color */
        }

        .adminimg {
            width: 100px;
            object-fit: contain;
        }

        .btn-ad-nav {
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff; /* Set button background color */
            border-radius: 4px;
            padding: 8px 16px;
            margin: 5px;
            transition: all 0.3s ease;
            display: inline-block;
            border: 1px solid #007bff; /* Button border */
            box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5); /* Button shadow */
        }

        .btn-ad-nav:hover {
            background-color: #0056b3; /* Change button color on hover */
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="/Ecommerce website/images/logo1.png" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php
                    if(isset($_SESSION['admin_name'])){
    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome " .$_SESSION['admin_name']."</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='index.php?logout=true'>Logout</a>
        </li>
        ";
} else {
    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Admin</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='./admin_area/admin_login.php?logout=true'>Login</a>
        </li>";
}
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();
    // Redirect to a page after logout if needed
    echo "<script>window.location.href = 'admin_login.php';</script>";

    exit();
}
?>
                    </ul>
                </div>
            </div>
        </nav>
    
        <!-- Main Content -->
        <div class="bg-light">
            <h3 class="text-center p-2">Admin Dashboard</h3>
        </div>
        
        <!-- Dashboard Buttons -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-3 d-flex align-items-center justify-content-center">
                <div class="px=5">
                    <a href="#" alt="admin image link"><img src="/Ecommerce website/images/logo1.avif"  class="adminimg" alt="admin img"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <div class="butto text-center ms-3">
                    <button><a href="index.php?insert_product" class="btn-ad-nav">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="btn-ad-nav">View Products</a></button>
                    <button><a href="index.php?insert_category" class="btn-ad-nav">Insert Categories</a></button>
                    <button><a href="index.php?view_category" class="btn-ad-nav">View Categories</a></button>
                    <button><a href="index.php?all_order" class="btn-ad-nav">All Orders</a></button>
                    <button><a href="index.php?all_pay" class="btn-ad-nav">All Payments</a></button>
                    <button><a href="index.php?li" class="btn-ad-nav">List Users</a></button>
                    <button><a href="#" class="btn-ad-nav">Logout</a></button>
                </div>
            </div>
        </div>
        
        <!-- Included Content -->
        <div class="container my-5">
            
            <?php
            if(isset($_SESSION['admin_name'])){
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['insert_product'])){
                include('insert_products.php');
            }
            if(isset($_GET['view_category'])){
                include('view_category.php');
            }
            if(isset($_GET['all_order'])){
                include('allproduct.php');
            }
            if(isset($_GET['all_pay'])){
                include('all_confirmed.php');
            }
            if(isset($_GET['li'])){
                include('liu.php');
            }}
            else{
                echo "<script>window.location.href = 'admin_login.php';</script>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
