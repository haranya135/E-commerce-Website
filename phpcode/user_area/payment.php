<?php
include('../includes/connect.php');
include('../../functions/common_function.php');
session_start();
$_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    img{
    width:100%;
    }
</style>
<body>
    <?php
        if(isset($_SESSION['username'])) {
            // Get the username from the session variable
            $username = $_SESSION['username'];
        $get_user="Select * from `user_table` where username='$username'";
        $result=mysqli_query($con,$get_user);
        $run_query=mysqli_fetch_assoc($result);
        $user_id=$run_query['user_id'];
        }
        else{
            echo "<script>alert('Please Login and try again')</script>";
        }
    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="row d-flex justify-content-center align-items-center">
                <!-- Top content -->
                <div class="col-md-12">
                    <a href=""><img src="#" alt="online payment"></a>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <!-- Bottom content -->
                <div class="col-md-12">
                    <a href="" target="_blank"><h3>Pay Online</h3></a>
                </div>
            </div>
        </div>
        
        <!-- Right half -->
        <div class="col-md-6">
            <div class="row d-flex justify-content-center align-items-center">
                <!-- Top content -->
                <div class="col-md-12">
                <a href="order.php" target="_blank"><img src="#" alt="offline payment"></a>
                </div>
                
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <!-- Bottom content -->
                <div class="col-md-12">
                <a href="order.php"><h3>Pay Offline</h3></a>
            </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>