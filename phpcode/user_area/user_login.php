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
    <title>Login</title>
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

        .login-admin {
            color: red;
            text-decoration: none;  /* Set text color to red */
        }
        a{
          text-decoration: none;
        }
        .login-admin:hover {
            text-decoration: underline; /* Add underline on hover */
        }
        .lod{
          color: #000;
        }
        .reg:hover{
          text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container-fluid p=0">
    <!--first child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../../images/gemstone.png" alt="Logo" class="logo" style="height: 5%; width: 5%;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_all.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" method="get" action="search_product.php">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                    <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
            <div class="row justify-content-end">
                <div class="col-auto">
                <a href="" class="lod">Login as <span class="login-admin">Admin</span></a>
                <a href="../adminarea/admin_login.php" class="lod">Login as <span class="login-admin">Admin</span></a>                </div>
            </div>
        </div>
    <div class="container-fliuid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                    </div>
                    <div style="text-align: right;">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
                    <div class="text-center">
                        <input type="submit" value="Login" class="bg-info text-light p-3 border-0" name="user_login">
                        <p class="small m-2">Don't have an account, then <a href="user_registration.php" class="reg">Register</a>?</p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
    $select_query="Select * from user_table where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    if($row_count>0){
        if(password_verify($user_password,$row_data['user_password'])){
            $_SESSION['username']=$user_username;
            echo "<script>alert('Logged In sucessfully')</script>";
            echo "<script>window.location.href = '../index.php';</script>";
        }
        else{
            echo "<script>alert('Check your password')</script>";

        }
    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }

}
?>