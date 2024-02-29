
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
    <title>Admin Registration</title>
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
                <a class="navbar-brand" href="#"><img src="/Ecommerce website/images/logo1.png" alt="Logo"></a>
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
    <div class="container-fluid m-3">
<h2 class="text-center mb-5">Admin Registration</h2>
<div class="row d-flex justify-content-center"></div>
    
    <div class="col-lg-6 col-xl-4  m-auto">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-outline mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required="required" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required="required" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline mb-4">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required="required" class="form-control" autocomplete="off">
            </div>
            <div>
                <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                <p class="small fw-bold mt-2 pt-1">Do you already have an account?<a href="admin_login.php" class="link-danger">Login</a></p>
            </div>
    </form>
    </div>
    </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_registration'])){
    $admin_name=$_POST['username'];
    $admin_email=$_POST['email'];
    $admin_password=$_POST['password']; // Assign $admin_password here
    $conf_admin_password=$_POST['confirm_password']; // Assuming this is also available in your form submission

    $select_query="SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('Admin name or email already exists')</script>";
    }
    else if($admin_password != $conf_admin_password){
        echo "<script>alert('Passwords do not match')</script>";
    }
    else {
        // Use $admin_password here, not $_POST['admin_password']
        $hash_password=password_hash($admin_password, PASSWORD_DEFAULT);
        $admin_ip=getIPAddress();
        $insert_query="INSERT INTO `admin_table` (admin_name, admin_email, admin_password)
        VALUES ('$admin_name', '$admin_email', '$hash_password')";
        $sql_execute=mysqli_query($con,$insert_query);
        if($sql_execute){
            echo "<script>alert('Admin successfully registered')</script>";
            echo "<script>window.location.href = 'admin_login.php';</script>";
        }
        else{
            echo "<script>alert('Sorry, something went wrong!')</script>";
            die(mysqli_error($con));
        }
    }
}
?>
