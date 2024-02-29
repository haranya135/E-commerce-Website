<?php
if(isset($_GET['edit_account'])){
    $username=$_SESSION['username'];
    
    $select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);                
    $user_id=$row_fetch['user_id'];
    $user_name=$row_fetch['username'];
    $user_email=$row_fetch['user_email'];
    $user_addr=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];

    if(isset($_POST['edit_btn'])){
        $update_id=$user_id;
    $uuser_name=$_POST['user_username'];
    $uuser_email=$_POST['user_email'];
    $uuser_addr=$_POST['user_address'];
    $uuser_mobile=$_POST['user_mobile'];
    $update_query = "UPDATE user_table SET username='$uuser_name', user_email='$uuser_email', user_address='$uuser_addr', user_mobile='$uuser_mobile' WHERE user_id='$update_id'";
    $result_queryup = mysqli_query($con, $update_query);
    if($result_queryup){
        echo "<script>alert('Data Updated Successfully')</script>";
        $_SESSION['username'] = $uuser_name;
        
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-center mb-4">Edit Account</h3>
    <form action="" method="post" class="text-center">
    <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_username" value="<?php echo $user_name?>">
        </div>        
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_addr?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile?>">
        </div>
        <input type="submit" class=" p-3 border-0" value="Submit" name="edit_btn">
    </form>
</body>
</html>