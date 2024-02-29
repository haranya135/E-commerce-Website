 <?php

include('../includes/connect.php');
include('../../functions/common_function.php');
session_start();
$username = $_SESSION['username'];

$select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
$result_query = mysqli_query($con, $select_query);
$row = mysqli_fetch_assoc($result_query);
$user_id = $row['user_id'];

$total = 0;
$cart_query = "SELECT * FROM cart_details WHERE user_id='$user_id'";
$result_cart_query = mysqli_query($con, $cart_query);
$invoice_no = mt_rand();
$status = "pending";

$num_of_rows = mysqli_num_rows($result_cart_query);
while ($row_price = mysqli_fetch_array($result_cart_query)) {
    $product_id = $row_price['product_id'];
    $select_query = "SELECT * FROM `products` WHERE product_id = $product_id";
    $result_query = mysqli_query($con, $select_query);

    while ($row = mysqli_fetch_array($result_query)) {
        $product_price = array($row['product_price']);
        $product_values = array_sum($product_price);
        $total += $product_values;
    }
}
$get_cart = "SELECT * FROM `cart_details`";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];
$subtotal = $total;
$subtotal = $total * $quantity;
$insert_query = "INSERT INTO `user_orders` (user_id, amount, invoice_no, total_products, order_date, order_state)
     VALUES ('$user_id', '$subtotal', '$invoice_no', '$num_of_rows', NOW(), '$status')";
$result_query = mysqli_query($con, $insert_query);
if ($result_query) {
    echo "<script>alert('Orders are submitted')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

$insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_no, product_id, quantity, order_status)
     VALUES ('$user_id', '$invoice_no', '$product_id', '$quantity', '$status')";
$result_pending = mysqli_query($con, $insert_pending_orders);

// Redirect to confirm.php with invoice_no
header("Location: confirm.php?invoice_no=$invoice_no");



// Delete cart details after order processing
$del_cart = "DELETE FROM `cart_details` WHERE user_id='$user_id'";
$result_del = mysqli_query($con, $del_cart);
?>

