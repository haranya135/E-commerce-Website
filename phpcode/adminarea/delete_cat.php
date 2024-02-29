<?php

include('../includes/connect.php');
include('../../functions/common_function.php');
//session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container-fluid p=0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="Ecommerce website/images/admin.jpg" alt="Logo" class="logo" style="height: 5%; width: 5%;">
            
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="" class="nav-link">Welcome Guest</a>
                    </li>
                </ul>
            </nav>
            </div>
        </nav>
    
        <!--second child-->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!--third child-->    
        <div class="row">
            <div class="col-md-12 bg-secondary p-3 d-flex align-items-center justify-content-center">
                <div class="px=5">
                    <a href="" alt="admin image link"><img src="/Ecommerce website/images/logo1.avif"  style="width:100px; object-fit:contain" alt="admin img" class="adminimg"></a>
                    <p class="text-light text-center">Admin</p>
                </div>
                <div class="butto text-center ms-3">
                    <button><a href="index.php?insert_product" class="btn-ad-nav nav-link text-light bg-info my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="btn-ad-nav nav-link text-light bg-info my-1">View Products</a></button>
                    <button class="my-3"><a href="index.php?insert_category" class="btn-ad-nav nav-link text-light bg-info my-1">Insert Categories</a></button>

                    <button><a href="index.php?view_category" class="btn-ad-nav nav-link text-light bg-info my-1">View Categories</a></button>
                    <button><a href="" class="btn-ad-nav nav-link text-light bg-info my-1">All orders</a></button>
                    <button><a href="" class="btn-ad-nav nav-link text-light bg-info my-1">All Payments</a></button>
                    <button><a href="" class="btn-ad-nav nav-link text-light bg-info my-1">List Users</a></button>
                    <button><a href="" class="btn-ad-nav nav-link text-light bg-info my-1">Logout</a></button>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <?php
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
            ?>

        </div>

    </div>




   
<h2 class="text-center">Edit Categories</h2>
<?php

// Check if the edit_category parameter is set in the URL
if(isset($_GET['id'])){
    
    $category_id = $_GET['id'];
    
    // Fetch category details based on the category ID
    $select_query = "SELECT * FROM `categories` WHERE category_id = '$category_id'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    

    // Delete the product from the database
    $delete_query = "DELETE FROM `categories` WHERE category_id = '$category_id'";
    $result_delete = mysqli_query($con, $delete_query);

    if ($result_delete) {
        echo "<script>alert('Category deleted successfully');</script>";
        // Redirect to the index page or any other page after deletion
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to delete Category');</script>";
    }
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>
</html>