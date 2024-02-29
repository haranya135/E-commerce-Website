<?php
include('../includes/connect.php');

// Function to handle deleting a user order
function deleteUserOrder($orderId, $con) {
    // Query to delete the user order with the specified order ID
    $delete_query = "DELETE FROM `user_orders` WHERE order_id = '$orderId'";
    $result_delete = mysqli_query($con, $delete_query);
    
    if($result_delete) {
        echo "<script>alert('User order deleted successfully')</script>";
        echo "<script>window.location.href = 'index.php';</script>";

    } else {
        echo "<script>alert('Failed to delete user order')</script>";
    }
}

// Check if a user order should be deleted
if(isset($_GET['delete_order'])) {
    // Get the order ID from the URL
    $orderId = $_GET['delete_order'];
    // Call the deleteUserOrder function
    deleteUserOrder($orderId, $con);
}
?>