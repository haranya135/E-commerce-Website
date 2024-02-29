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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .cart_img{
    width:50px;
    height:80px;
    object-fit:contain;
}
</style>
</head>

<style>
    /* Custom styles */
    /* Navbar */
    .navbar {
        background-color: #343a40 !important; /* Dark color1 */
    }
    .container-fluid{
      padding: 0 !important; 
    }
    .navbar-brand img {
        height: 50px; /* Adjust logo height */
        width: auto;
    }

    .navbar-nav .nav-link {
        color: #ffffff !important; /* White color5 */
    }

    .navbar-nav .nav-link:hover {
        color: #8f96a6 !important; /* Light color3 */
    }

    /* Main Content */
    .bg-light {
        background-color: #dbd0d9; /* Light color4 */
        padding: 20px;
    }

    /* Sidebar */
    .bg-secondary {
        background-color: #413932;
        padding: 0 !important;  
    }

    .nav-item {
        padding: 10px;
    }

    .nav-link {
        color: #ffffff !important; /* White color5 */
    }
    .bg-grey{
      background-color: #413932;
    }
    .nav-link:hover {
        color: #8f96a6 !important; /* Light color3 */
    }

   
    /* Updated color for the second navbar */
    .navbar-secondary {
        background-color: #8f96a6 !important; /* Light color4 */
    }

    /* Updated text color for the second navbar */
    .navbar-secondary .nav-link {
        color: #fff !important; /* Darker color2 */
    }
</style>
  <body>
    <div class="container-fluid p=0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg  navbar-light bg-info">
  <div class="container-fluid">
  <img src="../../images/gemstone.png" alt="Logo" class="logo" style="height: 5%; width: 5%;">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
    <?php
    if(isset($_SESSION['username'])) {
        // If the user is logged in, show a link to the profile page
        echo '<a class="nav-link" href="./profile.php">Profile</a>';
    } else {
        // If the user is not logged in, show a link to the registration page
        echo '<a class="nav-link" href=user_registration.php">Register</a>';
    }
    ?>
</li>
        <li class="nav-item">
          <a class="nav-link" href="#footer">Contact</a>
        </li>
        
       
        
      </ul>
      <form class="d-flex" method="get" action="search_product.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
    </form>
    </div>
  </div>
</nav>

<!-- calling cart function-->
<?php
cart();
?>    
<!--second child-->
<nav class="navbar navbar-expand-lg navbar-secondary navbar-dark bg-secondary">
    <ul class="navbar-nav mg-auto">
      <?php
      if(isset($_SESSION['username'])){
    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome " .$_SESSION['username']."</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='index.php?logout=true'>Logout</a>
        </li>
        ";
      }else{
        echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='./user_area/user_login.php?logout=true'>Login</a>
        </li>";
      }
      if (isset($_GET['logout'])) {
        // Destroy the session
        session_destroy();
        // Redirect to a page after logout if needed
        echo "<script>window.location.href = './user_area/user_login.php';</script>";

        exit();
    }
      ?>
        
    </ul>
</nav>
<!--third child-->
<div class="bg-light">
    <h3 class="text-center">Store name</h3>
    <p class="text-center">Gemstone</p>
</div>

<!--fourth child-->
<div class="container">
    <div class="row">
        <form action="" method="post">
            <table class="table table-bordered text-center">
                <!--php code to display dynamic data-->
                <?php
                global $con;
                
                    $username=$_SESSION['username'];
                    $select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
                    $result_query = mysqli_query($con, $select_query);
                    $row = mysqli_fetch_assoc($result_query);                
                    $user_id=$row['user_id'];
                    
                $get_ip_add=getIPAddress();
                $total_price=0;
                $cart_query="Select * from `cart_details` where user_id='$user_id'";
                $result=mysqli_query($con,$cart_query);
                $result_count=mysqli_num_rows($result);
                if($result_count>=0){
                    echo"
                    <tr>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                        
                    </tr>  
                </thead>
                <tbody>";
            }
            while($row=mysqli_fetch_array($result)){
                $product_id=$row['product_id'];
                $select_products="Select * from `products` where product_id='$product_id'";
                $result_products=mysqli_query($con,$select_products);
                while($row_product_price=mysqli_fetch_array($result_products)){
                    $product_price=array($row_product_price['product_price']);
                    $price_table=$row_product_price['product_price'];
                    $product_title=$row_product_price['product_title'];
                    $product_values=array_sum($product_price);
                    $total_price+=$product_values;
            ?>
            <tr>
            <td><?php echo $product_title?></td>

<td>
<?php
    // Assuming $product_id is already defined and represents the current product ID
    // Fetch the original quantity from your database for the current product
    $original_quantity_query = "SELECT quantity FROM cart_details WHERE product_id = $product_id";
    $original_quantity_result = mysqli_query($con, $original_quantity_query);
    if ($original_quantity_row = mysqli_fetch_assoc($original_quantity_result)) {
        $original_quantity = $original_quantity_row['quantity'];
    } else {
        $original_quantity = 0; // Default to 0 if quantity is not found in the database
    }
    ?>
<input type="hidden" name="original_qty[<?php echo $product_id; ?>]" value="<?php echo $original_quantity; ?>">
                        <!-- Input field for the user to update the quantity -->
                        <input type="number" name="qty[<?php echo $product_id; ?>]" value="<?php echo $original_quantity; ?>">
                    
</td>
<td><?php echo $price_table?>/-</td>
<?php
$username = $_SESSION['username'];
$select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
$result_query = mysqli_query($con, $select_query);
$row = mysqli_fetch_assoc($result_query);
$user_id = $row['user_id'];

if (isset($_POST['update_cart'])) {
    $quantities = $_POST['qty']; // Array of quantities

    // Iterate over each quantity and update the corresponding row
    foreach ($quantities as $product_id => $quantity) {
        // Sanitize input and ensure integer value
        $product_id = mysqli_real_escape_string($con, $product_id);
        $quantity = (int)$quantity;

        // Prepare and execute the update statement
        $update_cart = "UPDATE cart_details SET quantity=? WHERE product_id=? AND user_id=?";
        $stmt = mysqli_prepare($con, $update_cart);
        mysqli_stmt_bind_param($stmt, "sss", $quantity, $product_id, $user_id);
        mysqli_stmt_execute($stmt);

        // Check for errors
        if (mysqli_stmt_errno($stmt) !== 0) {
            // Handle error
            echo "Error occurred while updating cart: " . mysqli_stmt_error($stmt);
        } else {
            // Update successful
            echo "Quantity updated successfully for product ID: $product_id";
        }
        echo "<script> window.location.href = document.referrer;</script>";
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
?>


<td><input type= "checkbox" name="removeitem[]" value="<?php echo $product_id?>"></td>
                
            </tr>
            <?php }}
            
                
                ?>
                
        </tbody>
    </table>
    <table>
        <tbody>
        <tr>
                
                <!--<button class="bg-info px-3 py-2 border-0 mx-3">Update</button>-->
                <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 m-3"
                name="update_cart">
                <!--<button class="bg-info px-3 py-2 border-0 mx-3">Remove</button>-->
                <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 m-3"
                name="remove_cart">
            
</tr>
        </tbody>
    </table>
    <!--subtotal-->
        <div class="d-flex mb-5">


        <?php
        $get_ip_add=getIPAddress();
        $total_price=0;
        $username=$_SESSION['username'];
                    $select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
                    $result_query = mysqli_query($con, $select_query);
                    $row = mysqli_fetch_assoc($result_query);                
                    $user_id=$row['user_id'];
                    
        $cart_query="Select *from cart_details where user_id='$user_id'";
        $result=mysqli_query($con,$cart_query);
        $result_count=mysqli_num_rows($result);
        
        if($result_count>0){

            echo"
            <h4 class='px-4'>Subtotal: <strong class='text-info'>" . calculateTotalPrice() . "/-</strong></h4>
            <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
            <a href='order.php' target='_blank'>
  <button class='bg-grey p-3 py-2 border-0 text-light' type='button'>Checkout</button>
</a>";

        }else{
            echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
        }
        if(isset($_POST['continue_shopping'])){
            echo "<script>window.open('./index.php','_self)</script>";
        }
?>
        
        </div>
    </div>
</div>
        </form>
    





<!--function to remove item-->
<?php
function remove_cart_item(){
    global $con;
    $username=$_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result_query);                
    $user_id=$row['user_id'];
    if(isset($_POST['remove_cart']) && isset($_POST['removeitem'])){ // Ensure removeitem is set
        
        foreach($_POST['removeitem'] as $remove_id){
            
            $remove_id = mysqli_real_escape_string($con, $remove_id); // Sanitize input
            $delete_query = "DELETE FROM cart_details WHERE product_id = '$remove_id' AND user_id='$user_id'";
            $run_delete = mysqli_query($con, $delete_query);
            if(!$run_delete){
                // Handle deletion failure if necessary
                return false;
            }
        }
        echo '<script>window.location.href = "cart.php";</script>';
        exit(); // Stop further execution
    }
    return true; // If there was no item to remove
}

$remove_item = remove_cart_item();
if(!$remove_item) {
    echo "Error occurred while removing items from the cart.";
}
?>

<!-- last child-->
<?php
include('..\includes\footer.php');
?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>

</html>