
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
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            overflow:hidden;
        }
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

        </style>
</head>
<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="Ecommerce website\images\logo1.png" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome Guest</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
        <!-- Main Content -->
        
    <div class="container-fluid m-3">
<h2 class="text-center mb-5">Admin Login</h2>
<div class="row justify-content-center m-auto">
    
    <div class="col-lg-6 col-xl-4">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">
            </div>
            <div class="form-outline mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required="required" class="form-control">
            </div>
            <div>
                <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                <p class="small fw-bold mt-2 pt-1">Don't you have an account?<a href="admin_registration.php" class="link-danger">Register</a></p>
            </div>
        </form>
    </div>
</div>
    
</body>
</html>
<?php
if(isset($_POST['admin_login'])){
    $admin_email=$_POST['username'];
    $admin_password=$_POST['password'];
    $select_query="SELECT * FROM `admin_table` WHERE admin_name='$admin_email'";

    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    if($row_count>0){
        if(password_verify($admin_password,$row_data['admin_password'])){
            $_SESSION['admin_name']=$admin_email;
            echo "<script>alert('Logged In successfully')</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }
        else{
            echo "<script>alert('Check your password')</script>";

        }
    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}

?>